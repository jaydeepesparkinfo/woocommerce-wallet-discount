<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WC_Account_Funds_Cart_Manager
 */
class WC_Account_Funds_Cart_Manager {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'woocommerce_review_order_before_order_total', array( $this, 'display_used_funds' ) );
		add_action( 'woocommerce_cart_totals_before_order_total', array( $this, 'display_used_funds' ) );
		add_filter( 'woocommerce_cart_total', array( $this, 'display_total' ) );

		// Allow partial payments - if used, the account funds gateway will be disabled
		if ( 'yes' === get_option( 'account_funds_partial_payment' ) ) {
			add_action( 'wp', array( $this, 'maybe_use_funds' ) );
			add_action( 'woocommerce_before_cart', array( $this, 'output_use_funds_notice' ), 6 );
			add_action( 'woocommerce_before_checkout_form', array( $this, 'output_use_funds_notice' ), 6 );
		}

		add_filter( 'woocommerce_calculated_total', array( $this, 'calculated_total' ) );
		add_action( 'woocommerce_cart_loaded_from_session', array( $this, 'calculate_totals' ) );
                $current_user = wp_get_current_user();
                $wallet_roles = $current_user->roles;
                if( $wallet_roles[0] == 'trader' ) {
                    if ( 'yes' === get_option( 'account_funds_trader_enable' ) ) {
                            add_filter( 'woocommerce_get_shop_coupon_data', array( $this, 'get_discount_data' ), 10, 2 );
                            add_filter( 'woocommerce_coupon_message', array( $this, 'get_discount_applied_message' ), 10, 3 );
                            add_filter( 'woocommerce_cart_totals_coupon_label', array( $this, 'coupon_label' ) );
                            add_filter( 'woocommerce_cart_totals_coupon_html', array( $this, 'coupon_html' ), 10, 2 );
                            add_filter( 'woocommerce_coupon_get_discount_amount', array( $this, 'get_discount_amount' ), 10, 5 );
                    }
                }
                if( $wallet_roles[0] == 'seller' ) {
                    if ( 'yes' === get_option( 'account_funds_seller_enable' ) ) {
                            add_filter( 'woocommerce_get_shop_coupon_data', array( $this, 'get_discount_data' ), 10, 2 );
                            add_filter( 'woocommerce_coupon_message', array( $this, 'get_discount_applied_message' ), 10, 3 );
                            add_filter( 'woocommerce_cart_totals_coupon_label', array( $this, 'coupon_label' ) );
                            add_filter( 'woocommerce_cart_totals_coupon_html', array( $this, 'coupon_html' ), 10, 2 );
                            add_filter( 'woocommerce_coupon_get_discount_amount', array( $this, 'get_discount_amount' ), 10, 5 );
                    }
                }
	}

	/**
	 * How can this cart be paid for using funds?
	 * @return string
	 */
	public static function account_funds_gateway_chosen() {
		$available_gateways = WC()->payment_gateways->get_available_payment_gateways();
		return ( isset( $available_gateways['accountfunds'] ) && $available_gateways['accountfunds']->chosen ) || ( ! empty( $_POST['payment_method'] ) && 'accountfunds' === $_POST['payment_method'] );
	}

	/**
	 * Can the user actually apply funds to this cart?
	 * @return bool
	 */
	public static function can_apply_funds() {
		$can_apply = 'yes' === get_option( 'account_funds_partial_payment' );

		if ( self::cart_contains_deposit() || self::cart_contains_subscription() || ! is_user_logged_in() ) {
			$can_apply = false;
		}

		if ( ! WC_Account_Funds::get_account_funds( get_current_user_id(), false ) ) {
			$can_apply = false;
		}

		return $can_apply;
	}

	/**
	 * Using funds right now?
	 */
	public static function using_funds() {
		return ! is_null( WC()->session ) && WC()->session->get( 'use-account-funds' ) && self::can_apply_funds();
	}

	/**
	 * Amount of funds being applied
	 * @return float
	 */
	public static function used_funds_amount() {
		return WC()->session->get( 'used-account-funds' );
	}

	/**
	 * Use funds
	 */
	public function maybe_use_funds() {
		if ( ! empty( $_POST['wc_account_funds_apply'] ) && self::can_apply_funds() ) {
			WC()->session->set( 'use-account-funds', true );
		}

		if ( ! empty( $_GET['remove_account_funds'] )  ) {
			WC()->session->set( 'use-account-funds', false );
			WC()->session->set( 'used-account-funds', false );
			wp_redirect( esc_url_raw( remove_query_arg( 'remove_account_funds' ) ) );
			exit;
		}

		if ( self::using_funds() ) {
			$this->apply_discount();
		}
	}

	/**
	 * Apply funds discount to cart
	 */
	public function apply_discount() {
		// bail if the discount has already been applied
                $current_user = wp_get_current_user();
                $wallet_roles = $current_user->roles;
                if( $wallet_roles[0] == 'trader' ) {
                    if ( ! WC()->cart || 'no' === get_option( 'account_funds_trader_enable' ) || WC()->cart->has_discount( self::get_discount_code() ) || ( ! self::can_apply_funds() && ! self::account_funds_gateway_chosen() ) ) {
                            return;
                    }
                }    
                if( $wallet_roles[0] == 'seller' ) {
                    if ( ! WC()->cart || 'no' === get_option( 'account_funds_seller_enable' ) || WC()->cart->has_discount( self::get_discount_code() ) || ( ! self::can_apply_funds() && ! self::account_funds_gateway_chosen() ) ) {
                            return;
                    }
                }    
		WC()->cart->add_discount( self::generate_discount_code() );
	}

	/**
	 * Show a notice to apply points towards your purchase
	 */
	public function output_use_funds_notice() {
		if ( self::using_funds() || ! self::can_apply_funds() ) {
			return;
		}

		$message  = '<div class="woocommerce-info wc-account-funds-apply-notice">';
		$message .= '<form class="wc-account-funds-apply" method="post">';
		$message .= '<input type="submit" class="button wc-account-funds-apply-button" name="wc_account_funds_apply" value="' . __( 'Use Account Discount', 'esbwoodemo' ) . '" />';
		$message .= sprintf( __( 'You have <strong>%s</strong> worth of funds on your account.', 'esbwoodemo' ), WC_Account_Funds::get_account_funds() );
		$current_user = wp_get_current_user();
                $wallet_roles = $current_user->roles;
                if( $wallet_roles[0] == 'trader' ) {
                    if ( 'yes' === get_option( 'account_funds_trader_enable' ) ) {
                            $message .= '<br/><em>' . sprintf( __( 'Use your account funds and get a %sdiscount on your order.', 'esbwoodemo' ), $this->display_discount_amount() ) . '</em>';
                    }
                }    
                if( $wallet_roles[0] == 'seller' ) {
                    if ( 'yes' === get_option( 'account_funds_seller_enable' ) ) {
                            $message .= '<br/><em>' . sprintf( __( 'Use your account funds and get a %sdiscount on your order.', 'esbwoodemo' ), $this->display_discount_amount() ) . '</em>';
                    }
                }    
		$message .= '</form>';
		$message .= '</div>';

		echo $message;
	}

	/**
	 * get discount amount
	 */
	public function display_discount_amount() {
            $current_user = wp_get_current_user();
            $wallet_roles = $current_user->roles;
            if( $wallet_roles[0] == 'trader' ) {
                $amount = floatval( get_option( 'account_funds_trader_dis_amount' ) );
                $amount = 'fixed' === get_option( 'account_funds_trader_dis_type' ) ? wc_price( $amount ) . ' ' : '';
                return $amount;
            }
            if( $wallet_roles[0] == 'seller' ) {
                $amount = floatval( get_option( 'account_funds_seller_des_amount' ) );
                $amount = 'fixed' === get_option( 'account_funds_seller_des_type' ) ? wc_price( $amount ) . ' ' : '';
                return $amount;
            }
	}

	/**
	 * See if an cart contains a deposit
	 * @param  int $order_id
	 * @return bool
	 */
	public static function cart_contains_deposit() {
		foreach ( WC()->cart->get_cart() as $item ) {
			if ( $item['data']->is_type( 'deposit' ) || $item['data']->is_type( 'topup' ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Subscription?
	 * @return bool
	 */
	public static function cart_contains_subscription() {
		return class_exists( 'WC_Subscriptions_Cart' ) && WC_Subscriptions_Cart::cart_contains_subscription();
	}

	/**
	 * Show amount of funds used
	 */
	public function display_used_funds() {
		if ( self::using_funds() ) {
			$funds_amount = self::used_funds_amount();
			if ( $funds_amount > 0 ) {
				?>
				<tr class="order-discount account-funds-discount">
					<th><?php _e( 'Account Discount', 'esbwoodemo' ); ?></th>
					<td>-<?php echo wc_price( $funds_amount ); ?> <a href="<?php echo esc_url( add_query_arg( 'remove_account_funds', true, get_permalink( is_cart() ? wc_get_page_id( 'cart' ) : wc_get_page_id( 'checkout' ) ) ) ); ?>"><?php _e( '[Remove]', 'esbwoodemo' ); ?></a></td>
				</tr>
				<?php
			}
		}
	}

	/**
	 * Calculated total
	 * @param  string $total
	 * @return string
	 */
	public function display_total( $total ) {
		if ( self::using_funds() ) {
			return wc_price( WC()->cart->total );
		}
		return $total;
	}

	/**
	 * Generate the coupon data required for the discount
	 *
	 * @since 1.0
	 * @param array $data the coupon data
	 * @param string $code the coupon code
	 * @return array the custom coupon data
	 */
	public function get_discount_data( $data, $code ) {
		if ( strtolower( $code ) != $this->get_discount_code() ) {
			return $data;
		}

		// note: we make our points discount "greedy" so as many points as possible are
		//   applied to the order.  However we also want to play nice with other discounts
		//   so if another coupon is applied we want to use less points than otherwise.
		//   The solution is to make this discount apply post-tax so that both pre-tax
		//   and post-tax discounts can be considered.  At the same time we use the cart
		//   subtotal excluding tax to calculate the maximum points discount, so it
		//   functions like a pre-tax discount in that sense.
                $current_user = wp_get_current_user();
                $wallet_roles = $current_user->roles;
                if( $wallet_roles[0] == 'trader' ) {
                    $data = array(
                            'id'                         => true,
                            'type'                       => 'fixed_cart',
                            'amount'                     => floatval( get_option( 'account_funds_trader_dis_amount' ) ),
                            'coupon_amount'              => floatval( get_option( 'account_funds_trader_dis_amount' ) ),
                            'individual_use'             => 'no',
                            'product_ids'                => '',
                            'exclude_product_ids'        => '',
                            'usage_limit'                => '',
                            'usage_count'                => '',
                            'expiry_date'                => '',
                            'apply_before_tax'           => 'yes',
                            'free_shipping'              => 'no',
                            'product_categories'         => array(),
                            'exclude_product_categories' => array(),
                            'exclude_sale_items'         => 'no',
                            'minimum_amount'             => '',
                            'maximum_amount'             => '',
                            'customer_email'             => ''
                    );
                }    
                if( $wallet_roles[0] == 'seller' ) {
                    $data = array(
                            'id'                         => true,
                            'type'                       => 'fixed_cart',
                            'amount'                     => floatval( get_option( 'account_funds_seller_des_amount' ) ),
                            'coupon_amount'              => floatval( get_option( 'account_funds_seller_des_amount' ) ),
                            'individual_use'             => 'no',
                            'product_ids'                => '',
                            'exclude_product_ids'        => '',
                            'usage_limit'                => '',
                            'usage_count'                => '',
                            'expiry_date'                => '',
                            'apply_before_tax'           => 'yes',
                            'free_shipping'              => 'no',
                            'product_categories'         => array(),
                            'exclude_product_categories' => array(),
                            'exclude_sale_items'         => 'no',
                            'minimum_amount'             => '',
                            'maximum_amount'             => '',
                            'customer_email'             => ''
                    );
                }    
		return $data;
	}

	/**
	 * Get coupon discount amount
	 * @param  float $discount
	 * @param  float $discounting_amount
	 * @param  object $cart_item
	 * @param  bool $single
	 * @param  WC_Coupon $coupon
	 * @return float
	 */
	public function get_discount_amount( $discount, $discounting_amount, $cart_item, $single, $coupon ) {
		if ( strtolower( $coupon->code ) != $this->get_discount_code() ) {
			return $discount;
		}
                $current_user = wp_get_current_user();
                $wallet_roles = $current_user->roles;
                if( $wallet_roles[0] == 'trader' ) {
                    if ( 'percentage' === get_option( 'account_funds_trader_dis_type' ) ) {
                            if ( WC_Account_Funds::get_account_funds( get_current_user_id(), false ) < WC()->cart->subtotal_ex_tax ) {
                                    $discount_percent = WC_Account_Funds::get_account_funds( get_current_user_id(), false ) / WC()->cart->subtotal_ex_tax;
                            } else {
                                    $discount_percent = 1;
                            }

                            $discount = round( ( ( $discounting_amount / 100 ) * $coupon->coupon_amount ) * $discount_percent, WC()->cart->dp );
                    }
                }
                if( $wallet_roles[0] == 'seller' ) {
                    if ( 'percentage' === get_option( 'account_funds_seller_des_type' ) ) {
                            if ( WC_Account_Funds::get_account_funds( get_current_user_id(), false ) < WC()->cart->subtotal_ex_tax ) {
                                    $discount_percent = WC_Account_Funds::get_account_funds( get_current_user_id(), false ) / WC()->cart->subtotal_ex_tax;
                            } else {
                                    $discount_percent = 1;
                            }

                            $discount = round( ( ( $discounting_amount / 100 ) * $coupon->coupon_amount ) * $discount_percent, WC()->cart->dp );
                    }
                }
		return $discount;
	}

	/**
	 * Change the "Coupon applied successfully" message to "Discount Applied Successfully"
	 *
	 * @since 1.0
	 * @param string $message the message text
	 * @param string $message_code the message code
	 * @param object $coupon the WC_Coupon instance
	 * @return string the modified messages
	 */
	public function get_discount_applied_message( $message, $message_code, $coupon ) {
		if ( $message_code === WC_Coupon::WC_COUPON_SUCCESS && $coupon->code === $this->get_discount_code() ) {
			return __( 'Discount applied for using account funds!', 'esbwoodemo' );
		} else {
			return $message;
		}
	}

	/**
	 * Make the label for the coupon look nicer
	 * @param  string $label
	 * @return string
	 */
	public function coupon_label( $label ) {
		if ( strstr( strtoupper( $label ), 'WC_ACCOUNT_FUNDS_DISCOUNT' ) ) {
			$label = esc_html( __( 'Discount', 'esbwoodemo' ) );
		}
		return $label;
	}

	/**
	 * Make the html for the coupon look nicer
	 * @param  string $html
	 * @return string
	 */
	public function coupon_html( $html, $coupon ) {
		if ( $coupon->code === $this->get_discount_code() ) {
			$html = current( explode( '<a ', $html ) );
		}
		return $html;
	}

	/**
	 * Generates a unique discount code tied to the current user ID and timestamp
	 * Made of current user ID + the current time in YYYY_MM_DD_H_M format
	 */
	public static function generate_discount_code() {
		$discount_code = sprintf( 'wc_account_funds_discount_%s_%s', get_current_user_id(), date( 'Y_m_d_h_i', current_time( 'timestamp' ) ) );
		WC()->session->set( 'wc_account_funds_discount_code', $discount_code );
		return $discount_code;
	}

	/**
	 * Returns the unique discount code generated for the applied discount if set
	 *
	 * @since 1.0
	 */
	public static function get_discount_code() {
		return WC()->session->get( 'wc_account_funds_discount_code' );
	}

	/**
	 * Calculated total
	 * @param  float $total
	 * @return float
	 */
	public function calculated_total( $total ) {
		if ( self::using_funds() ) {
			$funds_amount = min( $total, WC_Account_Funds::get_account_funds( get_current_user_id(), false ) );
			$total        = $total - $funds_amount;
			WC()->session->set( 'used-account-funds', $funds_amount );
		}
		return $total;
	}

	/**
	 * Calculate totals
	 */
	public function calculate_totals() {
		if ( self::account_funds_gateway_chosen() ) {
			$this->apply_discount();
			WC()->cart->calculate_totals();
		} elseif ( ! self::using_funds() && self::get_discount_code() && WC()->cart->has_discount( self::get_discount_code() ) ) {
			WC()->cart->remove_coupon( self::get_discount_code() );
		}
	}
}

new WC_Account_Funds_Cart_Manager();