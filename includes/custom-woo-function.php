<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/*
 * Customize Woo Product Serach Widget
 */
function esbwoodemo_woo_custom_product_searchform( $form ) {
	
	$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
                    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search...', 'esbwoodemo' ) . '" />
                    <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'esbwoodemo' ) .'" />
                    <input type="hidden" name="post_type" value="product" />
                </form>';
	
	return $form;
	
}

/*
 * Manage Custom Tabs 10/19
 * Remove Tab (reviews,seller) Or Remove Empty Tabs
 */
function esbwoodemo_remove_product_tabs( $tabs ) {
    $post_info  = get_queried_object();
    unset( $tabs['reviews'] );                  // Remove the reviews tab
    unset( $tabs['seller'] );                   // Remove the seller tab
    unset( $tabs['additional_information'] );	// Remove the Additional Information
    
    //Description
    $desc_content = get_the_content();
    if( empty( $content ) ) {
        unset( $tabs['description'] );
    }
    
    //Condition
    $report_content      = wp_get_post_terms( $post_info->ID, 'product_condition' );
    $report_content_desc = get_field( 'condition_report' , $post_info->ID);
    if( empty( $report_content ) && empty( $report_content_desc ) ) {
        unset( $tabs['con_report_tab'] );
    }
    
    $deesbwoo_content   = get_field('delivery_information');
    if( empty( $deesbwoo_content ) ) {
        unset( $tabs['del_info_tab'] );
    }
    
    $product_brand          = wp_get_post_terms( $post_info->ID, 'product_brand' );
    $product_brand_desc     = get_field( 'esbwoo_brand_information', $post_info->ID);
    if( empty( $product_brand ) && empty( $product_brand_desc)) {
        unset( $tabs['brand_info'] );
    }
    
    $product_cat = wp_get_post_terms( $post_info->ID, 'product_cat' );
    if( empty( $product_cat ) ) {
        unset( $tabs['product_cat_tab'] );
    }
    
    $product_coll_tax = wp_get_post_terms( $post_info->ID, 'product_coll_tax' );
    if( empty( $product_coll_tax ) ) {
        unset( $tabs['product_coll_tab'] );
    }
    
    $product_room_tax = wp_get_post_terms( $post_info->ID, 'product_room_tax' );
    if( empty( $product_room_tax ) ) {
        unset( $tabs['product_room_tab'] );
    }
    
    $product_look_tax = wp_get_post_terms( $post_info->ID, 'product_look_tax' );
    if( empty( $product_look_tax ) ) {
        unset( $tabs['product_look_tab'] );
    }
    
    $product_color = wp_get_post_terms( $post_info->ID, 'product_color' );
    if( empty( $product_color ) ) {
        unset( $tabs['product_col_tab'] );
    }
    
    return $tabs;
}

/*
 * Changes In Description
 */
function esbwoodemo_rename_tabs( $tabs ) {
    $tabs['description']['title']       = __( 'More Details' );// Rename the description tab
    $tabs['description']['callback']    = 'esbwoodemo_more_det_tab';
    return $tabs;
}

/*
 * Add Tabs
 */
function esbwoodemo_new_product_tab( $tabs ) {
    // Adds the new tab
    $tabs['con_report_tab'] = array(
            'title' 	=> __( 'Condition Report', 'esbwoodemo' ),
            'priority' 	=> 50,
            'callback' 	=> 'esbwoodemo_con_report_tab'
    );
    
    $tabs['del_info_tab'] = array(
            'title' 	=> __( 'Delivery Information', 'esbwoodemo' ),
            'priority' 	=> 60,
            'callback' 	=> 'esbwoodemo_del_info_tab'
    );
    
    $tabs['brand_info'] = array(
            'title' 	=> __( 'Brand', 'esbwoodemo' ),
            'priority' 	=> 70,
            'callback' 	=> 'esbwoodemo_brand_info'
    );
    return $tabs;
}

//Get Description (Callback Function)
function esbwoodemo_more_det_tab() {
   the_content();
}

//Get Condition Report (Callback Function)
function esbwoodemo_con_report_tab() {
    $post_info  = get_queried_object();
    $terms      = wp_get_post_terms( $post_info->ID, 'product_condition' );
    foreach ( $terms as $term){
        echo '<h4>'.$term->name.'</h4>';
        echo $term->description;
    }
    $product_con_desc     = get_field( 'condition_report', $post_info->ID);
    if( !empty( $product_con_desc) ){
        echo '<p>'.$product_con_desc.'</p>';
    }
}

//Get Collection Report (Callback Function)
function esbwoodemo_product_coll_tab() {
    $post_info  = get_queried_object();
    $terms      = wp_get_post_terms( $post_info->ID, 'product_coll_tax' );
    foreach ( $terms as $term){
        echo '<h4>'.$term->name.'</h4>';
        echo $term->description;
    }
}

//Get Color Report (Callback Function)
function esbwoodemo_product_col_tab() {
    $post_info  = get_queried_object();
    $terms      = wp_get_post_terms( $post_info->ID, 'product_color' );
    foreach ( $terms as $term){
        echo '<h4>'.$term->name.'</h4>';
        echo $term->description;
    }
}

//Get Look Report (Callback Function)
function esbwoodemo_product_look_tab() {
    $post_info  = get_queried_object();
    $terms      = wp_get_post_terms( $post_info->ID, 'product_look_tax' );
    foreach ( $terms as $term){
        echo '<h4>'.$term->name.'</h4>';
        echo $term->description;
    }
}

//Get Look Report (Callback Function)
function esbwoodemo_product_room_tab() {
    $post_info  = get_queried_object();
    $terms      = wp_get_post_terms( $post_info->ID, 'product_room_tax' );
    foreach ( $terms as $term){
        echo '<h4>'.$term->name.'</h4>';
        echo $term->description;
    }
}

//Get Categories Report (Callback Function)
function esbwoodemo_product_cat_tab() {
    $post_info  = get_queried_object();
    $terms      = wp_get_post_terms( $post_info->ID, 'product_cat' );
    foreach ( $terms as $term){
        echo '<h4>'.$term->name.'</h4>';
        echo $term->description;
    }
}

//Get Delivery Information Tab (Callback Function)
function esbwoodemo_del_info_tab() {
   the_field('delivery_information');
}

//Get Brand Information Tab (Callback Function)
function esbwoodemo_brand_info() {
    $post_info  = get_queried_object();
    $terms      = wp_get_post_terms( $post_info->ID, 'product_brand' );
    foreach ( $terms as $term){
        echo '<h4>'.$term->name.'</h4>';
        echo $term->description;
    }
    $product_brand_desc     = get_field( 'esbwoo_brand_information', $post_info->ID);
    if( !empty( $product_brand_desc) ){
        echo '<p>'.$product_brand_desc.'</p>';
    }
}
/*
 * Woocommerce Share
 */
function esbwoodemo_woocommerce_share() {
?>
<div class="product-woo-share">
    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist icon="fa-heart"]');?>
    <script type="text/javascript" src="https://s7.addthis.com/js/250/addthis_widget.js"></script>
    <ul class="ul-shop-share-btn">
        <li><span class="share-social-icon-lable"><?php _e('Share : ','esbwoodemo');?></span> </li>
        <li><a href="javascript:void(0);" class="addthis_button_facebook" addthis:url="<?php echo get_permalink($post->ID); ?>" addthis:title="<?php echo get_the_title($post->ID); ?>"><i class="fa fa-facebook"></i></a></li>
        <li><a href="javascript:void(0);" class="addthis_button_pinterest_share" addthis:url="<?php echo get_permalink($post->ID); ?>" addthis:title="<?php echo get_the_title($post->ID); ?>"><i class="fa fa-pinterest-p"></i></a></li>
        <li><a href="javascript:void(0);" class="addthis_button_email" addthis:url="<?php echo get_permalink($post->ID); ?>" addthis:title="<?php echo get_the_title($post->ID); ?>"><i class="fa fa-envelope"></i></a></li>
    </ul>
</div>
<?php
}

/**
* Add form field to get video link URL for product image
**/
function esbwoodemo_woo_embed_video( $form_fields, $attachment ) {
    
    $post_id                        = (int) $_REQUEST[ 'post' ];
    $field_value                    = get_post_meta( $attachment->ID, 'videolink_url', true );
    $form_fields['videolink_url']   = array(    'value' => $field_value ? $field_value : '',
                                                'input' => "text",
                                                'label' => __( 'Video Link URL' )        
                                    );
    return $form_fields;
}

/*
 * Save form field of video link to display video on product image
 */
function esbwoodemo_woo_save_embed_video( $attachment_id ) {
    
    if ( isset( $_REQUEST['attachments'][$attachment_id]['videolink_url'] ) ) {
        $videolink_url = $_REQUEST['attachments'][$attachment_id]['videolink_url'];
        update_post_meta( $attachment_id, 'videolink_url', $videolink_url );
    }
}

/**
* Replace the single product thumbnail html with blank content 
*/
function esbwoodemo_remove_thumbnail_html($html){
    $html = '';
    return $html;
}

/*
 *  Custom redirect for users after logging in
 */
function esbwoodemo_login_redirect( $redirect ) {
     $redirect = get_permalink( get_option('woocommerce_myaccount_page_id') );
     return $redirect;
}

/*
 * Add new html layout of single product thumbnails
 */
function esbwoodemo_display_embed_video( $html ) {
    // Get WooCommerce Global
    global $woocommerce;
    global $product;    
     
    $attachment_ids     = $product->get_gallery_attachment_ids();
    $enable_lightbox    = get_option( 'woocommerce_enable_lightbox' );
    
    if ( $attachment_ids ) {
        $newhtml    = "";
        $loop       = 0;
        $columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 5 );
?>        
    <div id="slider" class="flexslider">
        <ul class="slides">
        <?php
            if ( has_post_thumbnail()) {
                $image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
                $image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
                //data-toggle="magnify"
                $newhtml .= '<li>';
                $newhtml .= '<img src="'.$image_link.'" alt="" />';
                $newhtml .= '</li>';
            }
            foreach ( $attachment_ids as $attachment_id ) {
                
                $classes    = array( 'zoom' );
                
                if ( $loop == 0 || $loop % $columns == 0 ){
                    $classes[] = 'first';
                }    
                if ( ( $loop + 1 ) % $columns == 0 ){
                   $classes[] = 'last';
                }
                
                $image_link = wp_get_attachment_url( $attachment_id );
                if ( ! $image_link )
                    continue;
                $video_link = '';

                $image_class    = esc_attr( implode( ' ', $classes ) );
                $image_title    = esc_attr( get_the_title( $attachment_id ) );
                $videolink_url  = get_post_meta( $attachment_id, 'videolink_url', true );
                
                if(!empty($videolink_url)){
                            $video_link = ($enable_lightbox == 'yes') ? $videolink_url : $videolink_url;
                }
                
                $video = '';
                if(!empty($video_link)){
                    $video = '<div class="play-overlay"></div>';
                }
                
                $link = (empty($video_link)) ? $image_link : $video_link;
                
                if( !empty( $video_link ) ){
                    if ( strpos($video_link,'youtube' ) !== false ) {
                            $video_embed_url    = str_replace('watch?v=', 'embed/', $video_link);
                            $video_id           = str_replace('http://www.youtube.com/embed/', '', $video_embed_url);
                            $video_id           = str_replace('https://www.youtube.com/embed/', '', $video_id);
                            $image_url          = 'http://i1.ytimg.com/vi/'. $video_id .'/mqdefault.jpg';
                            $videophoto_code    = '<iframe  src="'.$video_embed_url.'?rel=0" frameborder="0" allowfullscreen></iframe>';
                        } else if( strpos($video_link,'vimeo' ) !== false ) {
                            $video_embed_url    = str_replace('vimeo.com/', 'player.vimeo.com/video/', $video_link);
                            $video_id           = str_replace('http://vimeo.com/', '', $video_link);
                            $video_id           = str_replace('https://vimeo.com/', '', $video_id);
                            $video_embed_url    = str_replace('vimeo.com/', 'player.vimeo.com/video/', $video_link);

                            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video_id.php"));

                            if( !empty( $hash[0] ) && !empty( $hash[0]['thumbnail_large'] ) ) {
                                $image_url = $hash[0]['thumbnail_large'];
                            }
                            $videophoto_code = '<iframe src="'.$video_embed_url.'" frameborder="0" allowfullscreen></iframe>';
                        } else {
                            $videophoto_code = do_shortcode('[video  src='.$video_link.']');
                        }
                    $newhtml .= '<li>';
                    $newhtml .= $videophoto_code;
                    $newhtml .= '</li>';
                } else {
                $newhtml .= '<li>';
                $newhtml .= '<img src="'.$image_link.'" alt="" />'.$video;
                $newhtml .= '</li>';
                }
                $loop++;
            }
        echo $newhtml;
        ?>
        </ul>
    </div>
<?php            
    }
    if ( $attachment_ids ) {
        $newhtml    = "";
        $loop       = 0;
        $columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 5 );
?>        
    <div id="carousel" class="flexslider">
        <ul class="slides">
        <?php    
            if ( has_post_thumbnail()) {
                $image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
                $image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
                
                $newhtml .= '<li>';
                $newhtml .= '<a href="'. $image_link .'"  title="'. $image_title.'"><img src="'.$image_link.'" alt="" /></a>';
                $newhtml .= '</li>';
            }
            foreach ( $attachment_ids as $attachment_id ) {
                $classes = array( 'zoom' );
                if ( $loop == 0 || $loop % $columns == 0 ){
                    $classes[] = 'first';
                }
                
                if ( ( $loop + 1 ) % $columns == 0 ){
                   $classes[] = 'last';
                }
                
                $image_link = wp_get_attachment_image_src( $attachment_id, 'thumbnail');
                if ( ! $image_link ){
                    continue;
                }    
                $video_link     = '';
                $image_class    = esc_attr( implode( ' ', $classes ) );
                $image_title    = esc_attr( get_the_title( $attachment_id ) );
                $videolink_url  = get_post_meta( $attachment_id, 'videolink_url', true );
                
                if(!empty($videolink_url)){
                            $video_link = ($enable_lightbox == 'yes') ? $videolink_url : $videolink_url;
                }
                
                $video = '';
                if(!empty($video_link)){
                    $video = '<div class="play-overlay"></div>';
                }
                
                $link     = (empty($video_link)) ? $image_link[0] : $video_link;
                $newhtml .= '<li>';
                $newhtml .= '<a href="'.$link.'" title="'. $image_title.'"><img src="'.$image_link[0].'" alt="" />'.$video.'</a>';
                $newhtml .= '</li>';
                $loop++;
            }
        echo $newhtml;
        ?>
        </ul>
    </div>
<?php            
    }
}

/*
 * Billing And Shipping Address Update
 */
function esbwoodemo_save_additional_account_details( $user_ID ){
    $tax_cer_no  = ! empty( $_POST['tax_cer_no'] ) ? wc_clean( $_POST['tax_cer_no'] ) : '';
    $tax_cer_img = ! empty( $_POST['tax_cer_img'] ) ? wc_clean( $_POST['tax_cer_img'] ) : '';
    if( isset( $_POST['tax_cer_no'] ) ){
        update_user_meta( $user_ID, 'tax_cer_no', $tax_cer_no );
    }
    if( isset( $_POST['tax_cer_img'] ) ){
        update_user_meta( $user_ID, 'tax_cer_img', $tax_cer_img );
    }    
    
    //Billing Address
    if( isset( $_POST['billing_first_name'] ) ){
        update_user_meta( $user_ID, 'billing_first_name', $_POST['billing_first_name'] );
    }
    if( isset( $_POST['billing_last_name'] ) ){
        update_user_meta( $user_ID, 'billing_last_name', $_POST['billing_last_name'] );
    }
    if( isset( $_POST['billing_company'] ) ){
        update_user_meta( $user_ID, 'billing_company', $_POST['billing_company'] );
    }
    if( isset( $_POST['billing_email'] ) ){
        update_user_meta( $user_ID, 'billing_email', $_POST['billing_email'] );
    }
    if( isset( $_POST['billing_address_1'] ) ){
        update_user_meta( $user_ID, 'billing_address_1', $_POST['billing_address_1'] );
    }
    if( isset( $_POST['billing_address_2'] ) ){
        update_user_meta( $user_ID, 'billing_address_2', $_POST['billing_address_2'] );
    }
    if( isset( $_POST['billing_city'] ) ){
        update_user_meta( $user_ID, 'billing_city', $_POST['billing_city'] );
    }
    if( isset( $_POST['billing_postcode'] ) ){
        update_user_meta( $user_ID, 'billing_postcode', $_POST['billing_postcode'] );
    }
    if( isset( $_POST['billing_country'] ) ){
        update_user_meta( $user_ID, 'billing_country', $_POST['billing_country'] );
    }
    if( isset( $_POST['billing_state'] ) ){
        update_user_meta( $user_ID, 'billing_state', $_POST['billing_state'] );
    }
    if( isset( $_POST['billing_phone'] ) ){
        update_user_meta( $user_ID, 'billing_phone', $_POST['billing_phone'] );
    }
    //Shipping Address
    if( isset( $_POST['shipping_first_name'] ) ){
        update_user_meta( $user_ID, 'shipping_first_name', $_POST['shipping_first_name'] );
    }
    if( isset( $_POST['shipping_last_name'] ) ){
        update_user_meta( $user_ID, 'shipping_last_name', $_POST['shipping_last_name'] );
    }
    if( isset( $_POST['shipping_company'] ) ){
        update_user_meta( $user_ID, 'shipping_company', $_POST['shipping_company'] );
    }
    if( isset( $_POST['shipping_email'] ) ){
        update_user_meta( $user_ID, 'shipping_email', $_POST['shipping_email'] );
    }
    if( isset( $_POST['shipping_address_1'] ) ){
        update_user_meta( $user_ID, 'shipping_address_1', $_POST['shipping_address_1'] );
    }
    if( isset( $_POST['shipping_address_2'] ) ){
        update_user_meta( $user_ID, 'shipping_address_2', $_POST['shipping_address_2'] );
    }
    if( isset( $_POST['shipping_city'] ) ){
        update_user_meta( $user_ID, 'shipping_city', $_POST['shipping_city'] );
    }
    if( isset( $_POST['shipping_postcode'] ) ){
        update_user_meta( $user_ID, 'shipping_postcode', $_POST['shipping_postcode'] );
    }
    if( isset( $_POST['shipping_country'] ) ){
        update_user_meta( $user_ID, 'shipping_country', $_POST['shipping_country'] );
    }
}
/*
 * Text Change
 */
function esbwoodemo_shipping_field_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) { 
        case 'Shipping Address' : $translated_text = __( 'Delivery Address', 'woocommerce' ); 
            break; 
    } 
    return $translated_text;
}
//Customize Woo Product Serach Widget
add_filter( 'get_product_search_form' , 'esbwoodemo_woo_custom_product_searchform' );

//Remove Tab (reviews,seller)
add_filter( 'woocommerce_product_tabs', 'esbwoodemo_remove_product_tabs', 98 );

//Changes In Description
add_filter( 'woocommerce_product_tabs', 'esbwoodemo_rename_tabs', 98 );

//Add Tabs
add_filter( 'woocommerce_product_tabs', 'esbwoodemo_new_product_tab' );

//Woocommerce Share
add_action( 'woocommerce_share', 'esbwoodemo_woocommerce_share', 10 );

/*
 * Remove Action And Chnage Priority Single Product Page Hook And Shop Page
 * Remove Sale Lable
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

//Remove Meta
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

//Priority Set Woocommerce Share
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 20 );

// Add form field to get video link URL for product image
add_filter( 'attachment_fields_to_edit', 'esbwoodemo_woo_embed_video', 20, 2);

// Save form field of video link to display video on product image
add_action( 'edit_attachment', 'esbwoodemo_woo_save_embed_video' );

// Replace the single product thumbnail html with blank content 
add_filter('woocommerce_single_product_image_thumbnail_html', 'esbwoodemo_remove_thumbnail_html');

// Custom redirect for users after logging in
add_filter('woocommerce_login_redirect', 'esbwoodemo_login_redirect');

// Add new html layout of single product thumbnails
add_action( 'woocommerce_product_thumbnails', 'esbwoodemo_display_embed_video', 20 );

// Shop Page Remove Add Chart Button
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

// Billing And Shipping Address Update
add_action( 'woocommerce_save_account_details', 'esbwoodemo_save_additional_account_details' );

// Text Change
add_filter( 'gettext', 'esbwoodemo_shipping_field_strings', 20, 3 );

//woocommerce_before_main_content hook
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_filter( 'woocommerce_show_page_title', '__return_false' );
add_action( 'woocommerce_before_shop_loop', 'esbwoodemo_before_shop_loop', 30 );
function esbwoodemo_before_shop_loop(){
    $post_info  = get_queried_object();
    if( !empty( $post_info->description ) && !is_search() ){
        echo '<p class>'. $post_info->description .'</p>';
    }
    
}

// add custom column headers
function wc_csv_export_modify_column_headers( $column_headers ) { 
	$new_headers = array(
		'order_details'     => 'Per Product Count',
		'seller_details'    => 'Seller Name',
		'total_pri'         => 'Total Price',
		'custom_comm_col'   => 'Total Commission',
		'has_sub_order'     => 'Has Sub Order',
		'item_count'        => 'Item Count',
	);
	return array_merge( $column_headers, $new_headers );
}
add_filter( 'wc_customer_order_csv_export_order_headers', 'wc_csv_export_modify_column_headers' );

// set the data for each for custom columns
function wc_csv_export_modify_row_data( $order_data, $order, $csv_generator ) {
    
        $esbwoo_trade_count     = 0;
        $item_count         = 0;
        $esbwoo_customer_id     = get_post_meta( $order->id , '_customer_user', true );
        $has_sub_order      = get_post_meta( $order->id , 'has_sub_order', true);
        $has_sub_order      = !empty( $has_sub_order ) ? '1' : '0' ;
        $esbwoo_order_data      = new WC_Order( $order->id );   
        $esbwoo_items_data      = $esbwoo_order_data->get_items();
        $max_count          = $esbwoo_order_data->get_item_count();
        $seller_pay         = '';
        $comm_order_val     = 0;
        $seller_details     = '';
        $comm_cal_total     = 0;
        $comm_order_det     = '';
        $comm_cal_subt_to   = 0;
        if( $has_sub_order == '0' ){
            if( have_rows('esbwoo_order_commission' , $order->id ) ){
                while ( have_rows('esbwoo_order_commission' ,  $order->id) ){ the_row();
                    $counter            = 1 ;
                    $comm_cal           = 0;
                    $comm_cal_comm      = 0;
                    $comm_cal_stotal    = 0;
                    $comm_cal           = get_sub_field('esbwoo_order_comm_total');
                    $comm_cal_seller    = get_sub_field('esbwoo_order_comm_seller');
                    $comm_cal_pro       = get_sub_field('esbwoo_order_comm_product');
                    $comm_cal_subt      = get_sub_field('esbwoo_order_comm_sub_total');
                    $comm_cal_comm      = get_sub_field('esbwoo_order_comm_commission');
                    $comm_cal_stotal    = get_sub_field('esbwoo_order_orignal_total');
                    $comm_cal_total     = $comm_cal + $comm_cal_total ;
                    $comm_cal_subt_to   = $comm_cal_subt_to + $comm_cal_stotal;
                    $comm_order_val     = $comm_cal_comm + $comm_order_val ;
                    if( $item_count !=0 || $item_count != $max_count - 1 ){
                        $comm_order_det     .= 'Seller : '. $comm_cal_seller.' | Product : '.$comm_cal_pro.' | Price Total : '.$comm_cal_subt.' | Commission : '.$comm_cal_comm.'% | ';
                        
                    }  else {
                        $comm_order_det     .= 'Seller : '. $comm_cal_seller.' | Product : '.$comm_cal_pro.' | Price Total : '.$comm_cal_subt.' | Commission : '.$comm_cal_comm.'%' ;
                       
                    }
                    $item_count++;
                }
                $seller_pay = $comm_cal_seller ;
            }
        }
	$custom_data = array(
		'order_details'     => $comm_order_det,
		'seller_details'    => $seller_pay,
		'total_pri'         => $comm_cal_subt_to,
		'custom_comm_col'   => $comm_cal_total,
		'has_sub_order'     => $has_sub_order,
                'item_count'        => $max_count
	);
	$new_order_data   = array();
	$one_row_per_item = false;
	
	if ( version_compare( wc_customer_order_csv_export()->get_version(), '4.0.0', '<' ) ) {
		// pre 4.0 compatibility
		$one_row_per_item = ( 'default_one_row_per_item' === $csv_generator->order_format || 'legacy_one_row_per_item' === $csv_generator->order_format );
	} elseif ( isset( $csv_generator->format_definition ) ) {
		// post 4.0 (requires 4.0.3+)
		$one_row_per_item = 'item' === $csv_generator->format_definition['row_type'];
	}
	if ( $one_row_per_item ) {
		foreach ( $order_data as $data ) {
			$new_order_data[] = array_merge( (array) $data, $custom_data );
		}
	} else {
		$new_order_data = array_merge( $order_data, $custom_data );
	}
	return $new_order_data;
}
add_filter( 'wc_customer_order_csv_export_order_row', 'wc_csv_export_modify_row_data', 10, 3 );

// define the woocommerce_new_order callback�
function esbwoo_action_woocommerce_new_order( $order_id ) {
    $trade_count    = 0;
    $repeater_value = array();
    $order          = new WC_Order( $order_id );
    $items          = $order->get_items();
    $customer_id    = get_post_meta( $order_id , '_customer_user', true );
    if( !empty( $customer_id ) ){
        $user_data = get_userdata( $customer_id );
        if( !empty( $user_data->roles ) ){
            if( in_array('trader',$user_data->roles) ){
                $trade_count = 1;
            }
        }
    }
    foreach ($items as $item_key => $value) {
        $comm_cal       = 0;
        $product_ID     = $value['product_id'];
        $product_total  = $value['line_subtotal'];
        $product        = new WC_product($product_ID);
        $pro_qulity     = $value['qty'];
        $product_info   = $product->post ;
        $commison_val   = get_field('txt_pro_commission',$product_info->ID);
        //if( $trade_count == 1 ){
            $re_price       = get_post_meta( $product_info->ID , '_regular_price', true);
            $sel_price      = get_post_meta( $product_info->ID , '_sale_price', true);
            $pro_price      = !empty( $sel_price ) ? $sel_price : $re_price;
            
            $pr_total       = $pro_price * $pro_qulity;
           // $comm_cal       = $pr_total - (( $pr_total * ( 100 - $commison_val ) )/100);
        //}else{
            $comm_cal       = $product_total - (( $product_total * ( 100 - $commison_val ) )/100);
        //}
        $array_push_data     = array(
              // an element for each field
              'esbwoo_order_item_id'            => $item_key,
              'esbwoo_order_comm_seller'        => get_the_author_meta( 'display_name', $product_info->post_author ),
              'esbwoo_order_comm_product'       => $product_info->post_title ,
              'esbwoo_no_of_items'              => $pro_qulity,
              'esbwoo_order_orignal_total'      => $product_total ,
              'esbwoo_order_comm_sub_total'     => $value['line_total'] ,
              'esbwoo_order_comm_commission'    => $commison_val,
              'esbwoo_order_comm_total'         => $comm_cal,
        );
        array_push($repeater_value, $array_push_data);
    }
    update_field('field_5806fa28c6d57', $repeater_value ,$order_id);
    ?>
    </tbody>
</table>
<?php 
    };
add_action( 'woocommerce_thankyou', 'esbwoo_action_woocommerce_new_order', 10, 1 );

// resubmit renew order handler
add_action('save_post', 'esbwoo_admin_order_update', 10, 3);
function esbwoo_admin_order_update($order_id, $post, $update){
    $slug = 'shop_order';
    if( is_admin() ){
        // If this isn't a 'woocommercer order' post, don't update it.
        if ( $slug != $post->post_type ) {
                return;
        }
        global $post;
        $trade_count    = 0;
        $repeater_value = array();
        $prefix         = ESBWOODEMO_META_PREFIX;
        $order          = new WC_Order( $order_id );
        $items          = $order->get_items();
        
        $customer_id    = get_post_meta( $order_id , '_customer_user', true );
        if( !empty( $customer_id ) ){
            $user_data = get_userdata( $customer_id );            
            if( !empty( $user_data->roles ) ){
                if( in_array('trader',$user_data->roles) ){
                    $trade_count = 1;
                }
            }
        }
        $esbwoo_count = 1 ;
        $field_count = 0;
        foreach ($items as $item_key => $value) {
            $product_ID         = $value['product_id'];
            $product_total      = $value['line_subtotal'];
            $product            = new WC_product($product_ID);
            $order_item_tables   = get_field( 'esbwoo_order_commission' , $order_id );
            $product_info       = $product->post ;
            $commison_val       = get_field('txt_pro_commission',$product_info->ID);
            $pro_qulity         = $value['qty'];
            
                $re_price       = get_post_meta( $product_info->ID , '_regular_price', true);
                $sel_price      = get_post_meta( $product_info->ID , '_sale_price', true);
                $pro_price      = !empty( $sel_price ) ? $sel_price : $re_price;
                $pr_total       = $pro_price * $pro_qulity;
                //$comm_cal       = $pr_total - (( $pr_total * ( 100 - $commison_val ) )/100);
           
                $comm_cal       = $product_total - (( $product_total * ( 100 - $commison_val ) )/100);
            
            $order_item_table_key = array();
            foreach ( $order_item_tables as $order_item_table){
                array_push( $order_item_table_key , $order_item_table['esbwoo_order_item_id'] );                
            }
            if( in_array( $item_key, $order_item_table_key ) ){
                foreach ( $order_item_tables as $order_item_table){
                    if( $order_item_table['esbwoo_order_item_id'] == $item_key &&  $order_item_table['esbwoo_no_of_items'] != $pro_qulity ){
                        $comm_cal       = $pr_total - (( $pr_total * ( 100 -  $order_item_table['esbwoo_order_comm_commission'] ) )/100);
                        update_post_meta( $order_id, 'esbwoo_order_commission', $esbwoo_count  );
                        update_post_meta( $order_id, '_esbwoo_order_commission', 'field_5806fa28c6d57'  );

                        update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_item_id', $item_key );
                        update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_item_id', 'field_5806fa4ec6d58' );

                        update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_seller', get_the_author_meta( 'display_name', $product_info->post_author )  );
                        update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_seller', 'field_5806fa56c6d59' );

                        update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_product', $product_info->post_title  );
                        update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_product', 'field_5806fa76c6d5b' );

                        update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_no_of_items', $pro_qulity  );
                        update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_no_of_items', 'field_5806fa83c6d5c' );
                        
                        update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_orignal_total', $product_total  );
                        update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_orignal_total', 'field_58086f4f8b758' );
                        
                        update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_sub_total', $value['line_total']  );
                        update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_sub_total', 'field_5806fa96c6d5d' );

                        update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_commission', $commison_val  );
                        update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_commission', 'field_5806faa3c6d5e' );

                        update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_total', $comm_cal  );
                        update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_total', 'field_5806fab5c6d5f' );
                    }               
                }
            }else{
                update_post_meta( $order_id, 'esbwoo_order_commission', $esbwoo_count  );
                update_post_meta( $order_id, '_esbwoo_order_commission', 'field_5806fa28c6d57'  );

                update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_item_id', $item_key );
                update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_item_id', 'field_5806fa4ec6d58' );

                update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_seller', get_the_author_meta( 'display_name', $product_info->post_author )  );
                update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_seller', 'field_5806fa56c6d59' );

                update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_product', $product_info->post_title  );
                update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_product', 'field_5806fa76c6d5b' );

                update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_no_of_items', $pro_qulity  );
                update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_no_of_items', 'field_5806fa83c6d5c' );
                
                update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_orignal_total', $product_total );
                update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_orignal_total', 'field_58086f4f8b758' );

                update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_sub_total', $value['line_total']  );
                update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_sub_total', 'field_5806fa96c6d5d' );

                update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_commission', $commison_val  );
                update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_commission', 'field_5806faa3c6d5e' );

                update_post_meta( $order_id, 'esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_total', $comm_cal  );
                update_post_meta( $order_id, '_esbwoo_order_commission_'.$field_count.'_esbwoo_order_comm_total', 'field_5806fab5c6d5f' );
                
            }
            $field_count++;
            $esbwoo_count++;

        }
    }
}
function esbwoo_woocommerce_coupons_enabled(){
    $user = wp_get_current_user();
    if ( in_array( 'trader', (array) $user->roles ) ) {
        return ;
    }  else
    {
        return  ( 'yes' === get_option( 'woocommerce_enable_coupons' ) ) ? '1' : '';
    }
    
}
add_filter('woocommerce_coupons_enabled','esbwoo_woocommerce_coupons_enabled');

add_action( 'wp_head', 'esbwoo_apply_matched_coupons' );
function esbwoo_apply_matched_coupons() {
    $user = wp_get_current_user();
    if ( in_array( 'trader', (array) $user->roles ) ) {
        if( WC()->cart->remove_coupons()){            
        }        
    }
}
?>