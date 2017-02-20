<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
$upload_dir = wp_upload_dir();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//POST-TEXONOMY-META
if( !defined( 'ESBWOODEMO_POST_POST_TYPE' ) ) {
    define( 'ESBWOODEMO_POST_POST_TYPE', 'post' );
}
if( !defined( 'ESBWOODEMO_POST_CAT_TAX' ) ) {
    define( 'ESBWOODEMO_POST_CAT_TAX', 'category' );
}
if( !defined( 'ESBWOODEMO_PAGE_POST_TYPE' ) ) {
    define( 'ESBWOODEMO_PAGE_POST_TYPE', 'page' );
}
if( !defined( 'ESBWOODEMO_BANNER_POST_TYPE' ) ) {
    define( 'ESBWOODEMO_BANNER_POST_TYPE', 'banner' );
}
if( !defined( 'ESBWOODEMO_PRODUCT_POST_TYPE' ) ) {
    define( 'ESBWOODEMO_PRODUCT_POST_TYPE', 'product' );
}
if( !defined( 'ESBWOODEMO_ORDER_POST_TYPE' ) ) {
    define( 'ESBWOODEMO_ORDER_POST_TYPE', 'shop_order' );
}
if( !defined( 'ESBWOODEMO_CAT_POST_TAX' ) ) {
    define( 'ESBWOODEMO_CAT_POST_TAX', 'product_cat' );
}
if( !defined( 'ESBWOODEMO_ROOM_POST_TAX' ) ) {
    define( 'ESBWOODEMO_ROOM_POST_TAX', 'product_room_tax' );
}
if( !defined( 'ESBWOODEMO_LOOK_POST_TAX' ) ) {
    define( 'ESBWOODEMO_LOOK_POST_TAX', 'product_look_tax' );
}
if( !defined( 'ESBWOODEMO_COLLECTION_POST_TAX' ) ) {
    define( 'ESBWOODEMO_COLLECTION_POST_TAX', 'product_coll_tax' );
}
if( !defined( 'ESBWOODEMO_BRAND_POST_TAX' ) ) {
    define( 'ESBWOODEMO_BRAND_POST_TAX', 'product_brand' );
}
if( !defined( 'ESBWOODEMO_COLOR_POST_TAX' ) ) {
    define( 'ESBWOODEMO_COLOR_POST_TAX', 'product_color' );
}
if( !defined( 'ESBWOODEMO_CONDI_POST_TAX' ) ) {
    define( 'ESBWOODEMO_CONDI_POST_TAX', 'product_condition' );
}
if( !defined( 'ESBWOODEMO_PENSEL_POST_TYPE' ) ) {
    define( 'ESBWOODEMO_PENSEL_POST_TYPE', 'pending_sell' );
}
if( !defined( 'ESBWOODEMO_PENSEL_POST_TAX' ) ) {
    define( 'ESBWOODEMO_PENSEL_POST_TAX', 'pending_sell_tax' );
}
if( !defined( 'ESBWOODEMO_SERVICE_POST_TYPE' ) ) {
    define( 'ESBWOODEMO_SERVICE_POST_TYPE', 'esbwoodemo_service' );
}
if( !defined( 'ESBWOODEMO_META_PREFIX' ) ) {
    define( 'ESBWOODEMO_META_PREFIX', '_esbwoodemo_' );
}

//PAGE
if( !defined( 'ESBWOODEMO_ABOUT_PAGE' ) ) {
    define( 'ESBWOODEMO_ABOUT_PAGE', '60' );
}
if( !defined( 'ESBWOODEMO_BLOG_PAGE' ) ) {
    define( 'ESBWOODEMO_BLOG_PAGE', '62' );
}
if( !defined( 'ESBWOODEMO_NEW_ARRIVAL_PAGE' ) ) {
    define( 'ESBWOODEMO_NEW_ARRIVAL_PAGE', '381' );
}
if( !defined( 'ESBWOODEMO_COLLECTION_PAGE' ) ) {
    define( 'ESBWOODEMO_COLLECTION_PAGE', '291' );
}
if( !defined( 'ESBWOODEMO_TERMSCON_PAGE' ) ) {
    define( 'ESBWOODEMO_TERMSCON_PAGE', '68' );
}
if( !defined( 'ESBWOODEMO_PRIVACY_PAGE' ) ) {
    define( 'ESBWOODEMO_PRIVACY_PAGE', '552' );
}
if( !defined( 'ESBWOODEMO_PENSEL_PAGE' ) ) {
    define( 'ESBWOODEMO_PENSEL_PAGE', '46682' );
}
if( !defined( 'ESBWOODEMO_CONSIGN_PAGE' ) ) {
    define( 'ESBWOODEMO_CONSIGN_PAGE', '55661' );
}
if( !defined( 'ESBWOODEMO_PROLIST_PAGE' ) ) {
    define( 'ESBWOODEMO_PROLIST_PAGE', '55415' );
}
if( !defined( 'ESBWOODEMO_PROSELL_PAGE' ) ) {
    define( 'ESBWOODEMO_PROSELL_PAGE', '60532' );
}
if( !defined( 'ESBWOODEMO_DASH_PAGE' ) ) {
    define( 'ESBWOODEMO_DASH_PAGE', '15' );
}
if( !defined( 'ESBWOODEMO_STORE_PAGE' ) ) {
    define( 'ESBWOODEMO_STORE_PAGE', '16' );
}
if( !defined( 'ESBWOODEMO_SERVICE_PAGE' ) ) {
    define( 'ESBWOODEMO_SERVICE_PAGE', '55788' );
}
if( !defined( 'ESBWOODEMO_PAGENOT_PAGE' ) ) {
    define( 'ESBWOODEMO_PAGENOT_PAGE', '55902' );
}
if( !defined( 'ESBWOODEMO_WISH_PAGE' ) ) {
    define( 'ESBWOODEMO_WISH_PAGE', '511' );
}
if( !defined( 'ESBWOODEMO_ORDERS_PLACED_PAGE' ) ) {
    define( 'ESBWOODEMO_ORDERS_PLACED_PAGE', '70587' );
}
//ROLE
if( !defined( 'ESBWOODEMO_ADMIN_ROLE' ) ) {
    define( 'ESBWOODEMO_ADMIN_ROLE', 'administrator' );
}
if( !defined( 'ESBWOODEMO_TRADER_ROLE' ) ) {
    define( 'ESBWOODEMO_TRADER_ROLE', 'trader' );
}
if( !defined( 'ESBWOODEMO_SELLER_ROLE' ) ) {
    define( 'ESBWOODEMO_SELLER_ROLE', 'seller' );
}

if( !defined( 'ESBWOODEMO_CONTENT_DIR' ) ) {
    define( 'ESBWOODEMO_CONTENT_DIR', $upload_dir['basedir'] );
}

// Include custom register required plugins
require get_stylesheet_directory() . '/lib/custom-register-required-plugins.php';
 
// Include custom post types & taxonomies
require get_stylesheet_directory() . '/includes/custom-posttypes.php';

// Include Custom Function For Woocommerce,Dokan
require get_stylesheet_directory() . '/includes/custom-woo-function.php';
require get_stylesheet_directory() . '/includes/custom-dokan-functions.php';
require get_stylesheet_directory() . '/includes/customemail/woocommerce-sold-product-email.php';

// Include Wallet Discount
//require get_stylesheet_directory() . '/woocommerce-wallet-discount/woocommerce-account-funds.php';
//require get_stylesheet_directory() . '/woocommerce-wallet-discount/includes/wallet-function.php';

//include custom scripts file 
include( get_stylesheet_directory() . '/includes/custom-scripts.php' );

//Ajax File Include
include( get_stylesheet_directory() . '/ajax/cart-count-ajax.php' );

//include shortcode file
include( get_stylesheet_directory() . '/includes/custom-shortcode.php' );

//include custom widget file 
include( get_stylesheet_directory() . '/widgets/custom-contact-info.php' );

//include custom role file
include( get_stylesheet_directory() . '/includes/customrole/upload-image.php' );
include( get_stylesheet_directory() . '/includes/customrole/custom-user-meta.php' );
include( get_stylesheet_directory() . '/includes/customrole/custom-regi-hook.php' );

/**
* Escape Tags & Slashes
*
* Handles escapping the slashes and tags
*/
function esbwoodemo_escape_attr($data){
    return !empty( $data ) ? esc_attr( stripslashes( $data ) ) : '';
}

/**
* Strip Slashes From Array
*/
function esbwoodemo_escape_slashes_deep($data = array(),$flag=true){
    
    if($flag != true) {
         $data = esbwoodemo_nohtml_kses($data);
    }
    $data = stripslashes_deep($data);
    return $data;
}

/**
* Strip Html Tags 
* 
* It will sanitize text input (strip html tags, and escape characters)
*/
function esbwoodemo_nohtml_kses($data = array()) {
    
    if ( is_array($data) ) {
        $data = array_map(array($this,'esbwoodemo_nohtml_kses'), $data);
    } elseif ( is_string( $data ) ) {
        $data = wp_filter_nohtml_kses($data);
    }
   return $data;
}

/**
 * Display Short Content By Character
 */
function esbwoodemo_excerpt_char( $content, $length = 40 ) {
    
    $text = '';
    
    if( !empty( $content ) ) {
        $text           = strip_shortcodes( $content );
        $text           = str_replace(']]>', ']]&gt;', $text);
        $text           = strip_tags($text);
        $excerpt_more   = apply_filters('excerpt_more', ' ' . ' ...');
        $text           = substr($text, 0, $length);
        $text           = $text . $excerpt_more;
    }
    return $text;
}
/**
 *Display Short Content By Word
 */
function esbwoodemo_excerpt_word( $content, $length = 40 ) {
    
    $text           = strip_shortcodes( $content );
    $text           = str_replace(']]>', ']]&gt;', $text);
    $text           = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', $length);
    $excerpt_more   = apply_filters('excerpt_more', ' ' . ' ...');
    $words          = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    
    if ( count($words) > $excerpt_length ) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text . $excerpt_more;
    } else {
        $text = implode(' ', $words);
    }        
    return $text;
}

/**
 * search in posts and pages
 */
function esbwoodemo_filter_pre_get_posts( $query ) {
    if( !current_user_can( ESBWOODEMO_ADMIN_ROLE ) &&  !is_admin() ){
        $query->set('edit', FALSE);
    }
    if( ( is_shop() || is_tax() ) &&  !is_admin() ){
        if(array_key_exists( 'tax_query' , $query->query)) {
            foreach ( $query->query['tax_query'] as $tkey => $tvalue){
                 if(is_array($tvalue) == 1){
                     if(array_key_exists( 'taxonomy' ,$tvalue)){
                         if( $tvalue['taxonomy'] == ESBWOODEMO_BRAND_POST_TAX ){
                             $metaquery = array(
                                             'relation' => 'AND', 
                                             array(
                                                 'key' => 'post_author_override',
                                                 'value' => 'instock'
                                             ),
                                             array(
                                                 'key' => '_visibility',
                                                 'value' => array('catalog', 'visible','search'),
                                                 'compare' => 'IN'
                                             )
                                     );
                             $query->set( 'meta_query', $metaquery );
                         }
                     }
                 }
             }
        }
        add_filter('get_terms', 'esbwoodemo_get_terms_filter', 10, 3);
        if(array_key_exists( ESBWOODEMO_BRAND_POST_TAX , $query->query)) {
            add_filter( 'woocommerce_product_is_visible', 'esbwoodemo_show_backorders', 10, 2 );
        }
    }
    if( !is_admin() && $query->is_search ) {
	$query->set( 'post_type', array( ESBWOODEMO_PRODUCT_POST_TYPE ) );
    }
    return $query;
};

//ACF Function Theme Setting
if( function_exists('acf_add_options_page') ) {
    
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'	=> true
	));
        
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'General',
		'parent_slug'	=> 'theme-general-settings',
	));
        
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Social Settings',
		'menu_title'	=> 'Social',
		'parent_slug'	=> 'theme-general-settings',
	));
        
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Mail Notification Settings',
		'menu_title'	=> 'mail Notification',
		'parent_slug'	=> 'theme-general-settings',
	));
}

/*
 * Remove wp logo from admin bar
 */
function esbwoodemo_remove_wp_logo() {
    
    global $wp_admin_bar;
    $wp_help    = get_field('txt_wp_help_logo', 'option');
    
    if( $wp_help == FALSE ) {
        $wp_admin_bar->remove_menu('wp-logo');
    }
}

/*
 * Custom login logo
 */
function esbwoodemo_custom_login_logo() {
    $admin_logo   = get_field('txt_wp_admin_logo', 'option');
    if( !empty( $admin_logo ) ) {
?>
        <style type="text/css">
                .login h1 a{ background-image: url('<?php echo $admin_logo; ?>') !important; background-size: 300px auto !important; height: 170px !important; width: 100% !important; }
        </style>
<?php
    }
}

/*
 * Remove Admin Bar
 */
function esbwoodemo_remove_admin_bar() {
    if (!current_user_can( ESBWOODEMO_ADMIN_ROLE ) && !is_admin()) {
      show_admin_bar(false);
    }
}

/*
 * Is Blog Page Check
 */
function esbwoodemo_is_blog() {
	global  $post;
	$posttype = get_post_type($post );
	return ( $posttype == 'post')  ? true : false ;
}

/*
 * Override theme default specification for product # per row
 */
function esbwoodemo_loop_columns() {
    return 3;
}

/*
 * admin login logo url
 */
function esbwoodemo_logo_url() {
    return home_url();
}
/*
*   Restrict non logged users to certain pages
*/
function esbwoodemo_non_logged_redirect()
{
    if ( is_page( ESBWOODEMO_PENSEL_PAGE ) && !is_user_logged_in() ){
        wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
        die();
    }
    if ( is_page( ESBWOODEMO_STORE_PAGE ) ){
        wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
        die();
    }
    if ( is_page( ESBWOODEMO_PROLIST_PAGE ) && !is_user_logged_in() ){
        wp_redirect( get_the_permalink( ESBWOODEMO_PAGENOT_PAGE ) );
        die();
    }
}
/**
 * Custom Meta box for post types.
 */
function esbwoodemo_meta_box() {
    
    add_meta_box( 'esbwoodemo_product_meta', __( 'Commission Information', 'esbwoodemo' ), 'esbwoodemo_order_meta_options_page',ESBWOODEMO_ORDER_POST_TYPE );
}

/**
 * Custom Meta box page.
 */
function esbwoodemo_order_meta_options_page() {
    
    include get_stylesheet_directory() . '/includes/custom-order-meta.php';
}

/*
 * Unregister product tags
 */
function esbwoodemo_unregister_taxonomy() {
    register_taxonomy( 'product_tag', array() );
}

/*
 * Remove product tags menu
 */
function esbwoodemo_remove_product_tags_menu() {
    remove_menu_page('edit-tags.php?taxonomy=product_tag&post_type=product'); // Post tags
}

/*
 * Change Out of Stock Text
 */
function esbwoodemo_custom_get_availability( $availability, $_product ) {
   
    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
    	$availability['availability'] = __('SOLD', 'esbwoodemo');
    }
    return $availability;
}

/*
 * add action for admin side product filter
 */
function esbwoodemo_admin_product_filter() {
	global $typenow;
        //Look Type Product
	$post_type = ESBWOODEMO_PRODUCT_POST_TYPE ; // change to your post type
	$taxonomy  = ESBWOODEMO_LOOK_POST_TAX ; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
        
        //Room Type Product
	$taxonomy1  = ESBWOODEMO_ROOM_POST_TAX ; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy1]) ? $_GET[$taxonomy1] : '';
		$info_taxonomy = get_taxonomy($taxonomy1);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy1,
			'name'            => $taxonomy1,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
        
        //Collection Type Product
	$taxonomy2  = ESBWOODEMO_COLLECTION_POST_TAX ; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy2]) ? $_GET[$taxonomy2] : '';
		$info_taxonomy = get_taxonomy($taxonomy2);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy2,
			'name'            => $taxonomy2,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}

/*
 * add action for admin side product filter
 */
function esbwoodemo_admin_product_filter_query($query) {
	global $pagenow;
	$post_type  = ESBWOODEMO_PRODUCT_POST_TYPE ; // change to your post type
	$taxonomy   = ESBWOODEMO_LOOK_POST_TAX ; // change to your taxonomy
	$taxonomy1  = ESBWOODEMO_ROOM_POST_TAX ; // change to your taxonomy
	$taxonomy2  = ESBWOODEMO_COLLECTION_POST_TAX ; // change to your taxonomy
	$q_vars     = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy1]) && is_numeric($q_vars[$taxonomy1]) && $q_vars[$taxonomy1] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy1], $taxonomy1);
		$q_vars[$taxonomy1] = $term->slug;
	}
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy2]) && is_numeric($q_vars[$taxonomy2]) && $q_vars[$taxonomy2] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy2], $taxonomy2);
		$q_vars[$taxonomy2] = $term->slug;
	}
}
/*
 * For Pre Get Post Get_Terms Method Filter
 */
function esbwoodemo_get_terms_filter( $terms, $taxonomies, $args )
{
    global $wpdb;
    $taxonomy = $taxonomies[0];
    
    if ( ! is_array($terms) && count($terms) < 1 ){
        return $terms;
    }
    
    $filtered_terms = array();
        
    foreach ( $terms as $term ){
        $count_one  = 0;
        if($taxonomy == ESBWOODEMO_BRAND_POST_TAX){
            if( $term->count > 0 ){
                $args = array(
                        'post_type'         => 'product', 
                        'posts_per_page'    => -1,
                        'meta_query'        => array(   'relation' => 'OR', 
                                                        array( 'key'       => '_stock',
                                                               'value'     => '0',
                                                               'compare'   => '>'
                                                        ),
                                                        array(
                                                            'key' => '_visibility',
                                                            'value' => array('search', 'visible'),
                                                            'compare' => 'IN'
                                                        )
                                               ),
                        'tax_query'         => array(   array( 'taxonomy'   => $taxonomy,
                                                               'field'      => 'slug',
                                                               'terms'      => $term->slug
                                                        )
                                            )
                    );
                $counter_loop   = new WP_Query( $args );
                $count_one      = $counter_loop->post_count;

                if( $count_one > 0  ){
                    $filtered_terms[] = $term;
                }
            }
        }else{
            if( $term->count > 0 ){
                $filtered_terms[] = $term;
            }
        }
    }
    return $filtered_terms;
}

function esbwoodemo_show_backorders( $is_visible, $id ) {
    $product = new WC_Product( $id );
    if ( ! $product->is_in_stock() && ! $product->backorders_allowed() ) {
        $is_visible = FALSE;
    }
    return $is_visible;
}

/*
 * remove update notice for forked plugins
 */
function esbwoo_remove_update_notifications( $value ) {

    if ( isset( $value ) && is_object( $value ) ) {
        unset( $value->response[ 'woocommerce-products-filter/index.php' ] );
    }

    return $value;
}

//Restrict non logged users
add_action('template_redirect','esbwoodemo_non_logged_redirect');

//remove admin bar
add_action('after_setup_theme', 'esbwoodemo_remove_admin_bar');

//add filter to search in posts and pages
add_filter( 'pre_get_posts', 'esbwoodemo_filter_pre_get_posts' );

//add filter to add shortcode in widget
add_filter( 'widget_text', 'do_shortcode' );

//add action to modify the wp admin bar
add_action( 'wp_before_admin_bar_render', 'esbwoodemo_remove_wp_logo' );

//add action for custom logo
add_action( 'login_enqueue_scripts', 'esbwoodemo_custom_login_logo' );

//loop_shop_columns
add_filter('loop_shop_columns', 'esbwoodemo_loop_columns', 999);

//admin login logo url
add_filter( 'login_headerurl', 'esbwoodemo_logo_url' );

//add action to create custom meta box
add_action( 'admin_init', 'esbwoodemo_meta_box' );

//add action to unregister product tags
add_action( 'init', 'esbwoodemo_unregister_taxonomy' );

//add action to remove product tags menu
add_action( 'admin_menu', 'esbwoodemo_remove_product_tags_menu' );

//add action to change out of stock text
add_filter( 'woocommerce_get_availability', 'esbwoodemo_custom_get_availability', 1, 2);

//add action for admin side product filter
add_action('restrict_manage_posts', 'esbwoodemo_admin_product_filter');
add_filter('parse_query', 'esbwoodemo_admin_product_filter_query');

function esbwoodemo_registration_redirect(){
        $redirect = get_permalink( get_option('woocommerce_myaccount_page_id') );
        return $redirect;
}
function esbwoodemo_registration_redirect_dash(){
        $redirect =  dokan_get_navigation_url( 'products' );
        return $redirect;
}

function esbwoodemo_approve_customer_user( $customer_id ) {
	
	$roles = get_userdata( $customer_id )->roles;

	if ( in_array( 'seller', $roles ) ) {
		
		update_user_meta( $customer_id , 'wp-approve-user' ,1);
                add_filter( 'woocommerce_registration_redirect', 'esbwoodemo_registration_redirect' );
	}
	if ( in_array( 'customer', $roles ) ) {
		
		update_user_meta( $customer_id , 'wp-approve-user' ,1);
                add_filter( 'woocommerce_registration_redirect', 'esbwoodemo_registration_redirect' );
	}
	if ( in_array( 'trader', $roles ) ) {
		
		update_user_meta( $customer_id , 'wp-approve-user' ,1);
                add_filter( 'woocommerce_registration_redirect', 'esbwoodemo_registration_redirect' );
	}
}
add_action( 'woocommerce_created_customer', 'esbwoodemo_approve_customer_user',30 , 1 );

function esbwoodemo_wc_diff_rate_for_user( $tax_class, $product ) {
	if ( is_user_logged_in() && !is_admin() ) {
            if( current_user_can( ESBWOODEMO_ADMIN_ROLE ) || current_user_can( ESBWOODEMO_TRADER_ROLE )){
                $tax_class = 'Zero Rate';
            }
	}
	return $tax_class;
}
add_filter( 'woocommerce_product_tax_class', 'esbwoodemo_wc_diff_rate_for_user', 1, 2 );

//New "Related Products" function for WooCommerce
function esbwoodemo_get_related_custom( $id, $limit = 4 ) {
    global $woocommerce;

    // Related products are found from category and tag
    $tags_array = array(0);
    $cats_array = array(0);

    // Get tags
    $terms = wp_get_post_terms($id, 'product_tag');
    foreach ( $terms as $term ) $tags_array[] = $term->term_id;

    // Get categories (removed by NerdyMind)
/*
    $terms = wp_get_post_terms($id, 'product_cat');
    foreach ( $terms as $term ) $cats_array[] = $term->term_id;
*/

    // Don't bother if none are set
    if ( sizeof($cats_array)==1 && sizeof($tags_array)==1 ) return array();

    // Meta query
    $meta_query = array();
    $meta_query[] = $woocommerce->query->visibility_meta_query();
    $meta_query[] = array( 'key' => 'post_author_override', 'value' => 'instock' );
    
    // Get the posts
    $related_posts = get_posts( apply_filters('woocommerce_product_related_posts', array(
        'orderby'        => 'rand',
        'posts_per_page' => $limit,
        'post_type'      => 'product',
        'fields'         => 'ids',
        'meta_query'     => $meta_query,
        'tax_query'      => array(
            'relation'      => 'OR',
            array(
                'taxonomy'     => 'product_cat',
                'field'        => 'id',
                'terms'        => $cats_array
            ),
            array(
                'taxonomy'     => 'product_tag',
                'field'        => 'id',
                'terms'        => $tags_array
            )
        )
    ) ) );
    $related_posts = array_diff( $related_posts, array( $id ));
    return $related_posts;
}
add_action('init','esbwoodemo_get_related_custom');

function localvualt_quick_editpost_author_override() {
?>
        <div class="seller-field">
                <label class="alignleft">
                    <span class="title"><?php _e( 'Seller', 'esbwoodemo' ); ?></span>
                    <span class="input-text-wrap">
                        <?php
                            wp_dropdown_users( array(
                                    'role'  => 'seller',
                                    'name'  => 'post_author_override',
                                    'class' => 'post_author_override',
                                    'id'    => 'post_author_override'
                                    ) );
                        ?>
                        </span>
                </label>
        </div>
<?php
	}
// Add select to bulk edit
add_action( 'woocommerce_product_quick_edit_end', 'localvualt_quick_editpost_author_override' );

function esbwoodemo_quick_edit_save( $product ) {
    if ( ! empty( $_REQUEST['post_author_override'] ) ) :        
        update_post_meta( $product->id, 'post_author', wc_clean( $_REQUEST['post_author_override'] ) );
    endif;
}
// Save bulk edit availability chart setting
add_action( 'woocommerce_product_quick_edit_save', 'esbwoodemo_quick_edit_save' );
add_filter( 'manage_edit-product_columns', 'esbwoodemo_product_header_columns', 10, 1);

add_action( 'manage_posts_custom_column', 'esbwoodemo_post_data_row', 10, 2);



function esbwoodemo_product_header_columns($columns){

    if (!isset($columns['post_author_override'])){
        $columns['post_author_override'] = "Seller";
    }
    return $columns;
}
function esbwoodemo_post_data_row($column_name, $post_id){

    switch( $column_name ) {
        case 'post_author_override':
                $post_tmp = get_post($post_id);
                $author_id = $post_tmp->post_author;
                echo '<input type="hidden" value="'. $author_id .'" id="post_author_override-'. $post_id .'">';
                echo '<div>' .  get_the_author_meta('display_name', $author_id) . '</div>';
                break;
    }

}

//remove update notice for forked plugins
add_filter( 'site_transient_update_plugins', 'esbwoo_remove_update_notifications' );

function esbwoo_restrict_post_deletion($post_ID){
    if( !current_user_can( ESBWOODEMO_ADMIN_ROLE ) && !is_admin() ){
        $url = get_the_permalink( ESBWOODEMO_PAGENOT_PAGE );
        wp_redirect( $url );
        exit;
    }
}
add_action('wp_trash_post', 'esbwoo_restrict_post_deletion', 10, 1);
add_action('before_delete_post', 'esbwoo_restrict_post_deletion', 10, 1);

function esbwoo_edit_pending_sell_columns( $columns ) {
    
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = __('Title');
    $new_columns['taxonomy-pending_sell_tax'] = __('Categories');
    $new_columns['seller_name'] = __('Seller Name');
    $new_columns['city'] = __('City');
    $new_columns['state'] = __('State');
    $new_columns['date'] = __('Date');
    $new_columns['gadwp_stats'] = __('Analytics');
    
    return $new_columns;
}

add_filter( 'manage_edit-pending_sell_columns', 'esbwoo_edit_pending_sell_columns' );

function esbwoo_manage_pending_sell_columns( $column, $post_id ) {
    switch( $column ) {
        case 'seller_name' :
                    $seller_name    = get_field('txt_pen_seller_name',$post_id);
                    $seller_name    = !empty( $seller_name ) ? $seller_name : 'N/A';
                    echo $seller_name;
                    break;
        case 'city' :
                    $city_name    = get_field('txt_pen_seller_city',$post_id);
                    $city_name    = !empty( $city_name ) ? $city_name : 'N/A';
                    echo $city_name;
                    break;
        case 'state' :
                    $state_name    = get_field('txt_pen_seller_state',$post_id);
                    $state_name    = !empty( $state_name ) ? $state_name : 'N/A';
                    echo $state_name;
                    break;
        default :
                    break;
    }
}

add_action( 'manage_pending_sell_posts_custom_column', 'esbwoo_manage_pending_sell_columns', 10, 2 );