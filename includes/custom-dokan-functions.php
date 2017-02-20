<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/*
 * Unset URL Dokan
 */
function esbwoodemo_dokan_non_logged_redirect(){
    global $wp;
    if ( is_page( ESBWOODEMO_DASH_PAGE ) ) {
        if ( !current_user_can( ESBWOODEMO_ADMIN_ROLE ) && !current_user_can( ESBWOODEMO_TRADER_ROLE )  ){
            if ( isset( $wp->query_vars['products'] ) ) {
                wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
            }
        }
        if ( !current_user_can( ESBWOODEMO_ADMIN_ROLE )){
            if ( isset( $wp->query_vars['new-product'] ) ) {
                wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
            }
        }
        if ( isset( $wp->query_vars['reports'] ) ) {
            wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
        }
        if ( isset( $wp->query_vars['coupons'] ) ) {
            wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
        }
        if ( isset( $wp->query_vars['reviews'] ) ) {
            wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
        }
        if ( isset( $wp->query_vars['withdraw'] ) ) {
            wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
        }
        if ( isset( $wp->query_vars['announcement'] ) ) {
            wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
        }
        if ( isset( $wp->query_vars['single-announcement'] ) ) {
            wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
        }
        if ( isset( $wp->query_vars['shipping'] ) ) {
            wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
        }
        if ( isset( $wp->query_vars['settings'] ) ) {
            wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
        }
    }
}
/*
 * New Product Texonomy Add (Brand,Collection,Room,Look,Condition)
 */
function esbwoodemo_dokan_new_product_added_custom( $product_id, $post_data  ) {
    
    if( dokan_get_option( 'product_category_style', 'dokan_selling', 'single' ) == 'single' ) {
        wp_set_object_terms( $product_id, (int) $_POST[ESBWOODEMO_BRAND_POST_TAX], ESBWOODEMO_BRAND_POST_TAX );
        wp_set_object_terms( $product_id, (int) $_POST[ESBWOODEMO_COLLECTION_POST_TAX], ESBWOODEMO_COLLECTION_POST_TAX );
        wp_set_object_terms( $product_id, (int) $_POST[ESBWOODEMO_LOOK_POST_TAX], ESBWOODEMO_LOOK_POST_TAX );
        wp_set_object_terms( $product_id, (int) $_POST[ESBWOODEMO_ROOM_POST_TAX], ESBWOODEMO_ROOM_POST_TAX );
        wp_set_object_terms( $product_id, (int) $_POST[ESBWOODEMO_CONDI_POST_TAX], ESBWOODEMO_CONDI_POST_TAX );
    } else {
        if( isset( $_POST[ESBWOODEMO_BRAND_POST_TAX] ) && !empty( $_POST[ESBWOODEMO_BRAND_POST_TAX] ) ) {
            $cat_ids = array_map( 'intval', (array)$_POST[ESBWOODEMO_BRAND_POST_TAX] );
            wp_set_object_terms( $product_id, $cat_ids, ESBWOODEMO_BRAND_POST_TAX );
        }
        
        if( isset( $_POST[ESBWOODEMO_COLLECTION_POST_TAX] ) && !empty( $_POST[ESBWOODEMO_COLLECTION_POST_TAX] ) ) {
            $coll_ids = array_map( 'intval', (array)$_POST[ESBWOODEMO_COLLECTION_POST_TAX] );
            wp_set_object_terms( $product_id, $coll_ids, ESBWOODEMO_COLLECTION_POST_TAX );
        }
        
        if( isset( $_POST[ESBWOODEMO_LOOK_POST_TAX] ) && !empty( $_POST[ESBWOODEMO_LOOK_POST_TAX] ) ) {
            $look_ids = array_map( 'intval', (array)$_POST[ESBWOODEMO_LOOK_POST_TAX] );
            wp_set_object_terms( $product_id, $look_ids, ESBWOODEMO_LOOK_POST_TAX );
        }
        
        if( isset( $_POST[ESBWOODEMO_ROOM_POST_TAX] ) && !empty( $_POST[ESBWOODEMO_ROOM_POST_TAX] ) ) {
            $room_ids = array_map( 'intval', (array)$_POST[ESBWOODEMO_ROOM_POST_TAX] );
            wp_set_object_terms( $product_id, $room_ids, ESBWOODEMO_ROOM_POST_TAX );
        }
        
        if( isset( $_POST[ESBWOODEMO_CONDI_POST_TAX] ) && !empty( $_POST[ESBWOODEMO_CONDI_POST_TAX] ) ) {
            $cond_ids = array_map( 'intval', (array)$_POST[ESBWOODEMO_CONDI_POST_TAX] );
            wp_set_object_terms( $product_id, $cond_ids, ESBWOODEMO_CONDI_POST_TAX );
        }
    }
                        
}

/*
 * Edit Product Texonomy Update(Brand,Collection,Room,Look,Condition)
 */
function esbwoodemo_dokan_product_custom_meta( $post_id )
{
    if( isset( $_POST[ESBWOODEMO_BRAND_POST_TAX] ) ){
        $tag =  $_POST[ESBWOODEMO_BRAND_POST_TAX];
        wp_set_post_terms( $post_id, $tag, ESBWOODEMO_BRAND_POST_TAX );
    }
    
    if( isset( $_POST[ESBWOODEMO_COLLECTION_POST_TAX] ) ){
        $tag =  $_POST[ESBWOODEMO_COLLECTION_POST_TAX];
        wp_set_post_terms( $post_id, $tag, ESBWOODEMO_COLLECTION_POST_TAX );
    }
    
    if( isset( $_POST[ESBWOODEMO_ROOM_POST_TAX] ) ){
        $tag =  $_POST[ESBWOODEMO_ROOM_POST_TAX];
        wp_set_post_terms( $post_id, $tag, ESBWOODEMO_ROOM_POST_TAX );
    }
    
    if( isset( $_POST[ESBWOODEMO_LOOK_POST_TAX] ) ){
        $tag =  $_POST[ESBWOODEMO_LOOK_POST_TAX];
        wp_set_post_terms( $post_id, $tag, ESBWOODEMO_LOOK_POST_TAX );
    }
    
    if( isset( $_POST[ESBWOODEMO_CONDI_POST_TAX] ) ){
        $tag =  $_POST[ESBWOODEMO_CONDI_POST_TAX];
        wp_set_post_terms( $post_id, $tag, ESBWOODEMO_CONDI_POST_TAX );
    }
}

/*
 * Recipient Email Add Seller Email (Array To String)
 */
function esbwoodemo_wc_email_recipient_add_seller( $esbwoodemo_admin, $order ) {
    
    if( is_array( $esbwoodemo_admin ) ) {
        $esbwoodemo_admin = implode( ',', $esbwoodemo_admin );
    }
    return $esbwoodemo_admin;
}

//New Product Texonomy Add
add_action( 'dokan_new_product_added', 'esbwoodemo_dokan_new_product_added_custom',10,2 );

//Edit Product Texonomy Update
add_action( 'dokan_process_product_meta', 'esbwoodemo_dokan_product_custom_meta' );

//Recipient Email Add Seller Email
add_filter( 'woocommerce_email_recipient_new_order', 'esbwoodemo_wc_email_recipient_add_seller', 10, 2 );

//Remove Migrate Button(Become A Seller)
remove_action( 'woocommerce_after_my_account', 'dokan_account_migration_button' );

/**
 * Save the extra fields.
 *
 * @param  int  $customer_id Current customer ID.
 *
 * @return void
 */
function esbwoodemo_save_extra_tax_field( $store_id, $dokan_settings ) {
	if ( isset( $_POST['tax_cer_no'] ) ) {
            update_user_meta( $store_id, 'tax_cer_no', $_POST['tax_cer_no'] );
	}
	if( isset( $_FILES ) ) {
            foreach( $_FILES as $file ) {
              if( is_array( $file ) ) {
                $attachment_id = esbwoodemo_upload_user_file( $file );
                update_user_meta( $store_id, 'tax_cer_img', sanitize_text_field( $attachment_id ) );
              }
            }
        }
}

//add_action( 'dokan_store_profile_saved', 'esbwoodemo_save_extra_tax_field', 10, 2 );

function esbwoodemo_remove_reviews_shipping_menu( $menus ) {
    unset($menus['dashboard']);
    unset($menus['reviews']);
    unset($menus['shipping']);  
    unset($menus['coupon']);
    unset($menus['withdraw']);
    unset($menus['shipping']);
    unset($menus['report']);
    unset($menus['settings']);
    unset($menus['product']);
        
    return $menus;
}
 
add_filter( 'dokan_get_dashboard_nav', 'esbwoodemo_remove_reviews_shipping_menu' );

function dokan_add_dashboard_menu( $menus ) {
    $prolist_id = ESBWOODEMO_PROLIST_PAGE;
    
    if ( current_user_can( ESBWOODEMO_ADMIN_ROLE ) || current_user_can( ESBWOODEMO_TRADER_ROLE )  ){ 
        $menus['product'] = array(
            'title' => __( 'Sneak peek', 'esbwoodemo'),
            'icon' => '<i class="fa fa-briefcase"></i>',
            'url' => dokan_get_navigation_url( 'products' )
        );
    }
    
    $sell_id = ESBWOODEMO_ORDERS_PLACED_PAGE;
    $menus['orders_placed'] = array(
        'title' => __( 'Orders Placed', 'esbwoodemo'),
        'icon' => '<i class="fa fa-shopping-cart"></i>',
        'url' => get_permalink( $sell_id )
    );
    
    $menus['product_list'] = array(
        'title' => __( 'Products Sold', 'esbwoodemo'),
        'icon' => '<i class="fa fa-th-list"></i>',
        'url' => get_permalink( $prolist_id )
    );
    
    $sell_id = ESBWOODEMO_PENSEL_PAGE;
    $menus['sell_product'] = array(
        'title' => __( 'Sell Products', 'esbwoodemo'),
        'icon' => '<i class="fa fa-plus-square"></i>',
        'url' => get_permalink( $sell_id )
    );
    
    $prosell_id = ESBWOODEMO_PROSELL_PAGE;
    $menus['prosell_product'] = array(
        'title' => __( 'Products For Sale', 'esbwoodemo'),
        'icon' => '<i class="fa fa-dot-circle-o"></i>',
        'url' => get_permalink( $prosell_id )
    );
    
    $wish_id = ESBWOODEMO_WISH_PAGE ;
    $menus['wishlist'] = array(
        'title' => __( 'My Wishlist', 'esbwoodemo'),
        'icon' => '<i class="fa fa-heart"></i>',
        'url' => get_permalink( $wish_id )
    );
      
    $menus['order']['title'] = __( 'Orders Received', 'esbwoodemo');
    $menus['order']['icon'] = '<i class="fa fa-cart-arrow-down"></i>';
    
    $new_keys = array('product', 'order', 'orders_placed','product_list','sell_product','prosell_product','wishlist');
    $menus_re = array();
    foreach ($new_keys as $key) {
        if(key_exists($key, $menus) ){
            $menus_re[$key] = $menus[$key];
        }
    }
    $menus = $menus_re;
    return $menus;
}
  
add_filter( 'dokan_get_dashboard_nav', 'dokan_add_dashboard_menu',10);

//Custom Mail Function
function esbwoodemo_dokan_on_create_seller( $user_id, $data ) {
    if ( $data['role'] != 'seller' && $data['role'] != 'trader' ) {
        return;
    }

    $dokan_settings = array(
        'store_name'     => strip_tags( $_POST['shopname'] ),
        'social'         => array(),
        'payment'        => array(),
        'phone'          => $_POST['phone'],
        'show_email'     => 'no',
        'address'        => strip_tags( $_POST['address'] ),
        'location'       => '',
        'find_address'   => '',
        'dokan_category' => '',
        'banner'         => 0,
    );

    update_user_meta( $user_id, 'dokan_profile_settings', $dokan_settings );
    esbwoodemo_new_seller_registered_mail( $user_id , $data );
}

remove_action( 'woocommerce_created_customer', 'dokan_on_create_seller');
add_action( 'woocommerce_created_customer', 'esbwoodemo_dokan_on_create_seller',20 ,2);

function esbwoodemo_new_seller_registered_mail( $seller_id , $user_data) {
    if( ( $seller_id != 0 ) || ( ! empty( $seller_id )) ){
        $user_role      = '';
        $trade_account  = 0;
        if ( $user_data['role'] == 'seller' ) {
                $trade_account  = 0;
                $user_role      = 'Customer Account';
                $reg_rec_mail   = get_field('esbwoo_seller_reg_rec_mail', 'option');
        }
        if ( $user_data['role'] == 'trader' ) {
                $trade_account  = 1;
                $user_role      = 'Trade Account';
                $reg_rec_mail   = get_field('esbwoo_trader_reg_rec_mail', 'option');
        }
        if(empty( $reg_rec_mail )){
            $reg_rec_mail = get_option( 'admin_email' );
        }
        
        function esbwoodemo_dokan_get_content( $seller_id , $user_role , $trade_account){
            $email_content = esbwoodemo_dokan_get_content_html($seller_id , $user_role, $trade_account );
            return wordwrap( $email_content, 70 );
        }
                        
        function esbwoodemo_dokan_get_content_html( $seller_id , $user_role, $trade_account ){
            return wc_get_template_html( 'emails/new-seller-registered.php', array(
                                                                        'email_heading'  => __( $user_role ,'esbwoodemo'),
                                                                        'seller_id'      =>  $seller_id ,
                                                                        'user_role'      =>  $user_role ,
                                                                        'trade_account'      =>  $trade_account ,
                                                                    )
                                        );
        }
                        
                        function esbwoodemo_dokan_get_headers() {
                            return apply_filters( 'woocommerce_email_headers', "Content-Type: text/html\r\n", $current_user->id );
                        }
                        
                        function esbwoodemo_dokan_get_subject( $seller_id, $user_role) {
                            return apply_filters( 'woocommerce_email_subject_' .$seller_id , $user_role );
                        }

                        wc_mail( $reg_rec_mail ,esbwoodemo_dokan_get_subject( $seller_id, $user_role ), esbwoodemo_dokan_get_content( $seller_id , $user_role, $trade_account ),esbwoodemo_dokan_get_headers() );
            }
    
    }
    
//Restrict non logged users
add_action('template_redirect','esbwoodemo_dokan_non_logged_redirect');

remove_action( 'pending_to_publish', 'dokan_send_notification_on_product_publish', 10 );