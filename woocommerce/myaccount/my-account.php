<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices(); ?>
<div class="my-account-container">
    <p class="myaccount_user">
        <?php
            $user_ID    = get_current_user_id();                            
            $user       = new WP_User( $user_ID );
            if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
                foreach ( $user->roles as $role ) {
                    //Admin And Trader Account Dashboard URL
                    if( $role == 'administrator' || $role == 'trader') {
                        $dash_url =  dokan_get_navigation_url( 'products' );
                    }
                    //Seller Account  Dashboard URL
                    if( $role == 'seller' ) {
                        $dash_url = dokan_get_navigation_url( 'orders' ); 
                    }
                }
            }
            printf(
                    __( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'esbwoodemo' ) . ' ',
                    $current_user->display_name,
                    wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
            );
            printf(
            __( 'Welcome to your Account Information. From <a href="%s"><strong>here</strong></a> you can manage your addresses, emails, passwords and preferences. You can also see your orders as well as sell products and manage all sales through your personal <a href="%s"><strong>Dashboard</strong></a>.', 'esbwoodemo' ), wc_customer_edit_account_url(), $dash_url
            );
        ?>
        <p>
            <?php    
                printf(
                        __( '<a href="%s" class="dokan-dashboard-sell-product-text"><strong>Dashboard</strong></a> - click here to see orders, sell products and see sales status.', 'esbwoodemo' ) . ' ',
                        $dash_url
                );	
            ?>
        </p>
        <p>
            <?php    
                printf(
                        __( '<a href="%s" class="dokan-dashboard-sell-product-text"><strong>Sell Products</strong></a>', 'esbwoodemo' ) . ' ',
                        $dash_url
                );	
            ?>
        </p>
    </p>

    <?php do_action( 'woocommerce_before_my_account' ); ?>

    <?php //wc_get_template( 'myaccount/my-downloads.php' ); ?>

    <?php //wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>
    <hr>
    <?php wc_get_template( 'myaccount/my-address.php' ); ?>
    <hr>
    <div class="blog-sub-section">
        <?php
            if ( is_active_sidebar( 'blogsubsidebar-1' ) ) {
                dynamic_sidebar( 'blogsubsidebar-1' );
            }
        ?>
    </div>
    <?php do_action( 'woocommerce_after_my_account' ); ?>
</div>
