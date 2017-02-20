<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/*
 * Set Getway For Perticuler
 */
function esbwoodemo_pay_role_enable_seller( $available_gateways ) {
    global $woocommerce;
    if ( isset( $available_gateways['accountfunds'] )) {
        if( !current_user_can('seller') && !current_user_can('trader') ) {
            unset( $available_gateways['accountfunds'] );
        }
    } 
    return $available_gateways;
}
add_filter( 'woocommerce_available_payment_gateways', 'esbwoodemo_pay_role_enable_seller' );

/*
 * Seller Balance Add In Account Balance
 */
function esbwoodemo_account_fund_update_seller_balance(){
    
    $user_search    = new WP_User_Query( array( 'role__in' => [ 'trader' , 'seller' , 'administrator' ] ) );
    $sellers        = (array) $user_search->get_results();
    if ( $sellers ) {
        foreach ($sellers as $user) {
            global $wpdb;
            $fund           = dokan_get_seller_balance( $user->ID ) ;
            $status         = dokan_withdraw_get_active_order_status_in_comma();
            $cache_key      = 'dokan_seller_balance_' . $user->ID;
            $earning        = wp_cache_get( $cache_key, 'dokan' );
            if ( false === $earning ) {
                $sql        = "SELECT SUM(net_amount) as earnings,(SELECT SUM(amount) FROM {$wpdb->prefix}dokan_withdraw WHERE user_id = %d AND status = 1) as withdraw FROM {$wpdb->prefix}dokan_orders as do LEFT JOIN {$wpdb->prefix}posts as p ON do.order_id = p.ID WHERE seller_id = %d AND DATE(p.post_date) <= %s AND order_status IN({$status})";
                $result     = $wpdb->get_row( $wpdb->prepare( $sql, $user->ID, $user->ID ) );
                $earning    = $result->earnings - $result->withdraw;
                wp_cache_set( $cache_key, $earning, 'dokan' );                
            }
            $num_decimals   = get_option( 'woocommerce_price_num_decimals', '2' );
            if( !empty( $num_decimals ) ){
                $accont_bal = number_format_i18n( $earning, $num_decimals );
            }else
            {
                $accont_bal = number_format_i18n( $earning, 2 );
            }
            update_user_meta( $user->ID , 'account_funds', $accont_bal ) ;
        }
    }
}
add_action('init','esbwoodemo_account_fund_update_seller_balance');

/*
 * After Payment Complate Add Amount In Wallet
 */
function esbwoodemo_custom_process_order( $order_id ) {
    
    $order      = new WC_Order( $order_id );
    $total      = $order->get_total();
    $myuser_id  = $order->user_id;
    $user_info  = get_userdata($myuser_id);
    $items      = $order->get_items();
    
    $pay_method = get_post_meta( $order->id, '_payment_method', true );
    global $wpdb;
    if($pay_method == 'accountfunds')
    {
        $wpdb->dokan_withdraw = $wpdb->prefix . 'dokan_withdraw';
        $data = array(
            'user_id' => $myuser_id,
            'amount'  => $total,
            'date'    => current_time( 'mysql' ),
            'status'  => 1,
            'method'  => 'lw_'.$order_id.'_'.$myuser_id,
            'note'    => '',
            'ip'      => ''
        );
        $format = array( '%d', '%f', '%s', '%d', '%s', '%s', '%s' );
        $wpdb->insert( $wpdb->dokan_withdraw, $data, $format );
    }
}
add_action('woocommerce_payment_complete', 'esbwoodemo_custom_process_order', 10, 1);

/*
 * Cancelled Order Deduct Ammount 
 */
function esbwoodemo_mysite_cancelled( $order_id ) {
    
    global $wpdb;
    $order                  = new WC_Order( $order_id );
    $myuser_id              = $order->user_id;
    $wpdb->dokan_withdraw   = $wpdb->prefix . 'dokan_withdraw';
    $wpdb->query("DELETE FROM ". $wpdb->dokan_withdraw ." WHERE method = 'lw_".$order_id."_".$myuser_id."';");
    error_log("$order_id set to CANCELLED", 0);
}
add_action( 'woocommerce_order_status_cancelled', 'esbwoodemo_mysite_cancelled', 10, 1);