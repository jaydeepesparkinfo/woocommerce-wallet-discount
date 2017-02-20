<?php
/*
 * Plugin Name: WooCommerce Account Discount
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WC_Account_Funds
 */
class WC_Account_Funds {
        /**
         * Constructor
         */
        public function __construct() {
                add_action( 'init', array( $this, 'init' ) );
                add_action( 'init', array( $this, 'gateway_init' ), 0 );
                add_action( 'init', array( $this, 'admin_init' ) );
                add_filter( 'woocommerce_payment_gateways', array( $this, 'register_gateway' ) );
        }

        /**
         * Load classes
         */
        public function init() {                
                include_once( 'includes/class-wc-account-funds-cart-manager.php' );
                include_once( 'includes/class-wc-account-funds-order-manager.php' );
        }
        /**
         * Init Gateway
         */
        public function gateway_init() {
                if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
                        return;
                }
                include_once( 'includes/class-wc-gateway-account-funds.php' );
        }
        /**
         * Load admin
         */
        public function admin_init() {
                if ( is_admin() ) {
                        include_once( 'includes/class-wc-account-funds-admin.php' );
                }
        }



        /**
         * Get a users funds amount
         * @param  int  $user_id
         * @param  boolean $formatted
         * @return string
         */
        public static function get_account_funds( $user_id = null, $formatted = true, $exclude_order_id = 0 ) {
                $user_id = $user_id ? $user_id : get_current_user_id();

                if ( $user_id ) {
                        $funds = max( 0, get_user_meta( $user_id, 'account_funds', true ) );

                        // Account for pending orders
                        $orders_with_pending_funds = get_posts( array(
                                'numberposts' => -1,
                                'post_type'   => 'shop_order',
                                'post_status' => array_keys( wc_get_order_statuses() ),
                                'fields'      => 'ids',
                                'meta_query'  => array(
                                        array(
                                                'key'   => '_customer_user',
                                                'value' => $user_id
                                        ),
                                        array(
                                                'key'   => '_funds_removed',
                                                'value' => '0',
                                        ),
                                        array(
                                                'key'     => '_funds_used',
                                                'value'   => '0',
                                                'compare' => '>'
                                        )
                                )
                        ) );

                        foreach ( $orders_with_pending_funds as $order_id ) {
                                if ( null !== WC()->session && ! empty( WC()->session->order_awaiting_payment ) && $order_id == WC()->session->order_awaiting_payment ) {
                                        continue;
                                }
                                if ( $exclude_order_id === $order_id ) {
                                        continue;
                                }
                                $funds = $funds - floatval( get_post_meta( $order_id, '_funds_used', true ) );
                        }
                } else {
                        $funds = 0;
                }

                return $formatted ? wc_price( $funds ) : $funds;
        }

        /**
         * Add funds to user account
         * @param int $customer_id
         * @param float $amount
         */
        public static function add_funds( $customer_id, $amount ) {
                $funds = get_user_meta( $customer_id, 'account_funds', true );
                $funds = $funds ? $funds : 0;
                $funds += floatval( $amount );
                update_user_meta( $customer_id, 'account_funds', $funds );
        }

        /**
         * Remove funds from user account
         * @param int $customer_id
         * @param float $amount
         */
        public static function remove_funds( $customer_id, $amount ) {
                $funds = get_user_meta( $customer_id, 'account_funds', true );
                $funds = $funds ? $funds : 0;
                $funds = $funds - floatval( $amount );
                update_user_meta( $customer_id, 'account_funds', max( 0, $funds ) );
        }

        /**
         * Register the gateway for use
         */
        public function register_gateway( $methods ) {
                $methods[] = 'WC_Gateway_Account_Funds';
                return $methods;
        }

}

new WC_Account_Funds();