<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * WC_Account_Funds_Admin
 */
class WC_Account_Funds_Admin {

    /** @var Settings Tab ID */
    private $settings_tab_id = 'account_funds';

    /**
     * Constructor
     */
    public function __construct() {
        // Users
        add_filter( 'manage_users_columns', array( $this, 'wallet_users_col_title' ) );
        add_action( 'manage_users_custom_column', array( $this, 'wallet_users_col_value' ), 10, 3 );

        // Settings
        add_action( 'woocommerce_settings_tabs_array', array( $this, 'add_wc_wallet_settings_tab' ), 50 );
        add_action( 'woocommerce_settings_tabs_' . $this->settings_tab_id, array( $this, 'wc_wallet_settings_tab_action' ), 10 );
        add_action( 'woocommerce_update_options_' . $this->settings_tab_id, array( $this, 'wc_wallet_settings_save' ), 10 );
    }

    /**
     * Back End Users Table Columns Title Display
     * Add column
     * @param  array $columns
     * @return array
     */
    public function wallet_users_col_title( $columns ) {

        if ( current_user_can( 'manage_woocommerce' ) ) {
                $columns['account_funds'] = __( 'Balance', 'esbwoodemo' );
        }
        return $columns;
    }

    /**
     * Back End Users Table Columns Value(Wallet Balance) Display
     * @param  string $value
     * @param  string $column_name
     * @param  int $user_id
     * @return string
     */
    public function wallet_users_col_value( $value, $column_name, $user_id ) {
            if ( $column_name === 'account_funds' ) {
            $funds = get_user_meta( $user_id, 'account_funds', true );
            $funds = $funds ? $funds : 0;
            $value = wc_price( $funds );
            }
    return $value;
    }

    /**
     * Returns settings array.
     * @return array settings
     */
    public function get_settings() {
        $settings = array(
                        //Wallet Discount Settings Header Title
                        array(
                            'name'      => __( 'Wallet Discount Settings', 'esbwoodemo' ),
                            'type'      => 'title',
                            'desc'      => '',
                            'id'        => 'account_funds_title'
                        ),
                        array( 'type' => 'sectionend', 'id' => 'account_funds_title' ),
                        //End Wallet Discount Settings Header Title
                        //Trader Role Setting
                        array(
                            'name'      => __( 'Trader', 'esbwoodemo' ),
                            'type'      => 'title',
                            'desc'      => '',
                            'id'        => 'account_funds_trader_title'
                        ),
                        array(
                            'name'      => __( 'Enable', 'esbwoodemo' ),
                            'type'      => 'checkbox',
                            'desc'      => __( 'Enable Wallet For Trader', 'esbwoodemo' ),
                            'id'        => 'account_funds_trader_enable'
                        ),
                        array(
                            'name'      => __( 'Discount Type', 'esbwoodemo' ),
                            'type'      => 'select',
                            'options'   => array(
                                                'fixed'      => __( 'Fixed Price', 'esbwoodemo' ),
                                                'percentage' => __( 'Percentage', 'esbwoodemo' )
                                            ),
                            'desc'      => __( 'Percentage discounts will be based on the amount of funds used.', 'esbwoodemo' ),
                            'id'        => 'account_funds_trader_dis_type',
                            'desc_tip'  => false
                        ),
                        array(
                            'name'      => __( 'Discount Amount', 'esbwoodemo' ),
                            'type'      => 'text',
                            'desc'      => __( 'Enter numbers only. Do not include the percentage sign.', 'esbwoodemo' ),
                            'default'   => '',
                            'id'        => 'account_funds_trader_dis_amount',
                            'desc_tip'  => true
                        ),
                        array( 'type' => 'sectionend', 'id' => 'account_funds_trader_title' ),
                        //End Trader Role Setting
                        //Seller Role Setting
                        array(
                            'name'      => __( 'Seller', 'esbwoodemo' ),
                            'type'      => 'title',
                            'desc'      => '',
                            'id'        => 'account_funds_seller_title'
                        ),
                        array(
                            'name'      => __( 'Enable', 'esbwoodemo' ),
                            'type'      => 'checkbox',
                            'desc'      => __( 'Enable Wallet For Seller', 'esbwoodemo' ),
                            'id'        => 'account_funds_seller_enable'
                        ),
                        array(
                            'name'      => __( 'Discount Type', 'esbwoodemo' ),
                            'type'      => 'select',
                            'options'   => array(
                                    'fixed'      => __( 'Fixed Price', 'esbwoodemo' ),
                                    'percentage' => __( 'Percentage', 'esbwoodemo' )
                            ),
                            'desc'      => __( 'Percentage discounts will be based on the amount of funds used.', 'esbwoodemo' ),
                            'id'        => 'account_funds_seller_des_type',
                            'desc_tip'  => false
                        ),
                        array(
                            'name'      => __( 'Discount Amount', 'esbwoodemo' ),
                            'type'      => 'text',
                            'desc'      => __( 'Enter numbers only. Do not include the percentage sign.', 'esbwoodemo' ),
                            'default'   => '',
                            'id'        => 'account_funds_seller_des_amount',
                            'desc_tip'  => true
                        ),
                        array( 'type' => 'sectionend', 'id' => 'account_funds_seller_title' ),
                        //End Seller Role Setting
                        //Partial Amount Payment
                        array(
                                'name'      => __( 'Paying with Account Discount', 'esbwoodemo' ),
                                'type'      => 'title',
                                'desc'      => '',
                                'id'        => 'account_funds_payment_title'
                        ),
                        array(
                                'name'      => __( 'Partial Amount Payment', 'esbwoodemo' ),
                                'type'      => 'checkbox',
                                'desc'      => __( 'Allow customers to apply available funds and pay the difference via another gateway.', 'esbwoodemo' ),
                                'desc_tip'  => __( 'If disabled, users must pay for the entire order using the account funds payment gateway.', 'esbwoodemo' ),
                                'id'        => 'account_funds_partial_payment'
                        ),
                        array( 'type' => 'sectionend', 'id' => 'account_funds_payment_title' ),
                        //End Partial Amount Payment
        );
        return apply_filters( 'woocommerce_account_funds_get_settings', $settings );
    }

    /**
     * Add settings tab to woocommerce
     */
    public function add_wc_wallet_settings_tab( $settings_tabs ) {
            $settings_tabs[ $this->settings_tab_id ] = __( 'Wallet', 'esbwoodemo' );
            return $settings_tabs;
    }

    /**
     * Do this when viewing our custom settings tab(s). One function for all tabs.
     */
    public function wc_wallet_settings_tab_action() {
            woocommerce_admin_fields( $this->get_settings() );
    }

    /**
     * Save settings in a single field in the database for each tab's fields (one field per tab).
     */
    public function wc_wallet_settings_save() {
            woocommerce_update_options( $this->get_settings() );
    }
}

new WC_Account_Funds_Admin();