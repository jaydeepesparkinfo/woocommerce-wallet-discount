<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 *  Add a custom email to the list of emails WooCommerce should load
 *
 * @since 0.1
 * @param array $email_classes available email classes
 * @return array filtered available email classes
 */
function esbwoodemo_add_sold_product_email( $email_classes ) {
 
    // include our custom email class
    require get_stylesheet_directory() . '/includes/customemail/class-wc-sold-product-email.php' ;
    require get_stylesheet_directory() . '/includes/customemail/class-wc-sold-product-email-admin.php' ;
    //require get_stylesheet_directory() . '/includes/customemail/class-wc-sale-product-admin.php' ;
 
    // add the email class to the list of email classes that WooCommerce loads
    $email_classes['WC_Sold_Product_Email']     = new WC_Sold_Product_Email();
    $email_classes['WC_Notifi_Pro_Admin']       = new WC_Notifi_Pro_Admin();
    //$email_classes['LV_Email_Pending_Sales']    = new LV_Email_Pending_Sales();
    return $email_classes;
 
}
add_filter( 'woocommerce_email_classes', 'esbwoodemo_add_sold_product_email' );