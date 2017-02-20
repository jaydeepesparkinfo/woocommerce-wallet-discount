<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Register Custom Post Type
 */
function esbwoodemo_register_post_types() {
    //Custom Banner Post Type
    // Register Custom Post Type
    $banner_labels = array(
                                'name'               => _x( 'Banner', 'esbwoodemo_banner', 'esbwoodemo' ),
                                'singular_name'      => _x( 'Banner', 'esbwoodemo_banner', 'esbwoodemo' ),
                                'menu_name'          => _x( 'Banner', 'esbwoodemo_banner', 'esbwoodemo' ),
                                'name_admin_bar'     => _x( 'Banner', 'esbwoodemo_banner', 'esbwoodemo' ),
                                'add_new'            => _x( 'Add New', 'esbwoodemo_banner', 'esbwoodemo' ),
                                'add_new_item'       => __( 'Add New Banner', 'esbwoodemo' ),
                                'new_item'           => __( 'New Banner', 'esbwoodemo' ),
                                'edit_item'          => __( 'Edit Banner', 'esbwoodemo' ),
                                'view_item'          => __( 'View Banner', 'esbwoodemo' ),
                                'all_items'          => __( 'All Banner', 'esbwoodemo' ),
                                'search_items'       => __( 'Search Banner', 'esbwoodemo' ),
                                'parent_item_colon'  => __( 'Parent Banner:', 'esbwoodemo' ),
                                'not_found'          => __( 'No banners found.', 'esbwoodemo' ),
                                'not_found_in_trash' => __( 'No banners found in Trash.', 'esbwoodemo' ),
                            );

    $banner_args   = array(
                            'labels'             => $banner_labels,
                            'public'             => true,
                            'publicly_queryable' => false,
                            'show_ui'            => true,
                            'show_in_menu'       => true,
                            'query_var'          => false,
                            'rewrite'            => array( 'slug'=>'banner', 'with_front' => false ),
                            'capability_type'    => 'post',
                            'has_archive'        => false,
                            'hierarchical'       => false,
                            'menu_position'      => null,
                            'supports'           => array( 'title', 'editor',)
                    );
    register_post_type( ESBWOODEMO_BANNER_POST_TYPE , $banner_args );
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
                        'name'              => _x( 'Collection', 'taxonomy general name', 'esbwoodemo'),
                        'singular_name'     => _x( 'Collection', 'taxonomy singular name','esbwoodemo' ),
                        'search_items'      => __( 'Search Collection','esbwoodemo' ),
                        'all_items'         => __( 'All Collection','esbwoodemo' ),
                        'parent_item'       => __( 'Parent Collection','esbwoodemo' ),
                        'parent_item_colon' => __( 'Parent Collection:','esbwoodemo' ),
                        'edit_item'         => __( 'Edit Collection' ,'esbwoodemo'), 
                        'update_item'       => __( 'Update Collection' ,'esbwoodemo'),
                        'add_new_item'      => __( 'Add New Collection' ,'esbwoodemo'),
                        'new_item_name'     => __( 'New Collection Name' ,'esbwoodemo'),
                        'menu_name'         => __( 'Collection' ,'esbwoodemo')
                );

    $args = array(
                                    'hierarchical'      => true,
                                    'labels'            => $labels,
                                    'show_ui'           => true,
                                    'show_admin_column' => true,
                                    'query_var'         => true,
                                    'rewrite'           => array( 'slug'=> 'collection' )
                            );

    register_taxonomy( ESBWOODEMO_COLLECTION_POST_TAX, ESBWOODEMO_PRODUCT_POST_TYPE, $args );
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
                        'name'              => _x( 'Room', 'taxonomy general name', 'esbwoodemo'),
                        'singular_name'     => _x( 'Room', 'taxonomy singular name','esbwoodemo' ),
                        'search_items'      => __( 'Search Room','esbwoodemo' ),
                        'all_items'         => __( 'All Room','esbwoodemo' ),
                        'parent_item'       => __( 'Parent Room','esbwoodemo' ),
                        'parent_item_colon' => __( 'Parent Room:','esbwoodemo' ),
                        'edit_item'         => __( 'Edit Room' ,'esbwoodemo'), 
                        'update_item'       => __( 'Update Room' ,'esbwoodemo'),
                        'add_new_item'      => __( 'Add New Room' ,'esbwoodemo'),
                        'new_item_name'     => __( 'New Room Name' ,'esbwoodemo'),
                        'menu_name'         => __( 'Room' ,'esbwoodemo')
                    );

    $args = array(
                    'hierarchical'      => true,
                    'labels'            => $labels,
                    'show_ui'           => true,
                    'show_admin_column' => true,
                    'query_var'         => true,
                    'rewrite'           => array( 'slug'=> 'room' )
                );
	
    register_taxonomy( ESBWOODEMO_ROOM_POST_TAX, ESBWOODEMO_PRODUCT_POST_TYPE, $args );
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
                        'name'              => _x( 'Look', 'taxonomy general name', 'esbwoodemo'),
                        'singular_name'     => _x( 'Look', 'taxonomy singular name','esbwoodemo' ),
                        'search_items'      => __( 'Search Look','esbwoodemo' ),
                        'all_items'         => __( 'All Look','esbwoodemo' ),
                        'parent_item'       => __( 'Parent Look','esbwoodemo' ),
                        'parent_item_colon' => __( 'Parent Look:','esbwoodemo' ),
                        'edit_item'         => __( 'Edit Look' ,'esbwoodemo'), 
                        'update_item'       => __( 'Update Look' ,'esbwoodemo'),
                        'add_new_item'      => __( 'Add New Look' ,'esbwoodemo'),
                        'new_item_name'     => __( 'New Look Name' ,'esbwoodemo'),
                        'menu_name'         => __( 'Look' ,'esbwoodemo')
                );

    $args = array(
                                    'hierarchical'      => true,
                                    'labels'            => $labels,
                                    'show_ui'           => true,
                                    'show_admin_column' => true,
                                    'query_var'         => true,
                                    'rewrite'           => array( 'slug'=> 'look' )
                            );

    register_taxonomy( ESBWOODEMO_LOOK_POST_TAX, ESBWOODEMO_PRODUCT_POST_TYPE, $args );
    // Add new taxonomy, make it hierarchical (like categories)
    $color_labels = array(
                        'name'              => _x( 'Color', 'taxonomy general name', 'esbwoodemo'),
                        'singular_name'     => _x( 'Color', 'taxonomy singular name','esbwoodemo' ),
                        'search_items'      => __( 'Search Color','esbwoodemo' ),
                        'all_items'         => __( 'All Color','esbwoodemo' ),
                        'parent_item'       => __( 'Parent Color','esbwoodemo' ),
                        'parent_item_colon' => __( 'Parent Color:','esbwoodemo' ),
                        'edit_item'         => __( 'Edit Color' ,'esbwoodemo'), 
                        'update_item'       => __( 'Update Color' ,'esbwoodemo'),
                        'add_new_item'      => __( 'Add New Color' ,'esbwoodemo'),
                        'new_item_name'     => __( 'New Color Name' ,'esbwoodemo'),
                        'menu_name'         => __( 'Color' ,'esbwoodemo')
                );

    $color_args = array(
                                    'hierarchical'      => true,
                                    'labels'            => $color_labels,
                                    'show_ui'           => true,
                                    'show_admin_column' => true,
                                    'query_var'         => true,
                                    'rewrite'           => array( 'slug'=> 'color' )
                            );

    register_taxonomy( ESBWOODEMO_COLOR_POST_TAX, ESBWOODEMO_PRODUCT_POST_TYPE, $color_args );
    // Add new taxonomy, make it hierarchical (like categories)
    $condition_labels = array(
                        'name'              => _x( 'Condition', 'taxonomy general name', 'esbwoodemo'),
                        'singular_name'     => _x( 'Condition', 'taxonomy singular name','esbwoodemo' ),
                        'search_items'      => __( 'Search Condition','esbwoodemo' ),
                        'all_items'         => __( 'All Condition','esbwoodemo' ),
                        'parent_item'       => __( 'Parent Condition','esbwoodemo' ),
                        'parent_item_colon' => __( 'Parent Condition:','esbwoodemo' ),
                        'edit_item'         => __( 'Edit Condition' ,'esbwoodemo'), 
                        'update_item'       => __( 'Update Condition' ,'esbwoodemo'),
                        'add_new_item'      => __( 'Add New Condition' ,'esbwoodemo'),
                        'new_item_name'     => __( 'New Condition Name' ,'esbwoodemo'),
                        'menu_name'         => __( 'Condition' ,'esbwoodemo')
                );

    $condition_args = array(
                                    'hierarchical'      => true,
                                    'labels'            => $condition_labels,
                                    'show_ui'           => true,
                                    'show_admin_column' => true,
                                    'query_var'         => true,
                                    'rewrite'           => array( 'slug'=> 'condition' )
                            );

    register_taxonomy( ESBWOODEMO_CONDI_POST_TAX, ESBWOODEMO_PRODUCT_POST_TYPE, $condition_args );
    /*
     * Pending Sales
     */
    $pending_sell_labels = array(
                                'name'               => _x( 'Pending Sales', 'esbwoodemo_pending_sell', 'esbwoodemo' ),
                                'singular_name'      => _x( 'Pending Sales', 'esbwoodemo_pending_sell', 'esbwoodemo' ),
                                'menu_name'          => _x( 'Pending Sales', 'esbwoodemo_pending_sell', 'esbwoodemo' ),
                                'name_admin_bar'     => _x( 'Pending Sales', 'esbwoodemo_pending_sell', 'esbwoodemo' ),
                                'add_new'            => _x( 'Add New', 'esbwoodemo_pending_sell', 'esbwoodemo' ),
                                'add_new_item'       => __( 'Add New Pending Sales', 'esbwoodemo' ),
                                'new_item'           => __( 'New Pending Sales', 'esbwoodemo' ),
                                'edit_item'          => __( 'Edit Pending Sales', 'esbwoodemo' ),
                                'view_item'          => __( 'View Pending Sales', 'esbwoodemo' ),
                                'all_items'          => __( 'All Pending Sales', 'esbwoodemo' ),
                                'search_items'       => __( 'Search Pending Sales', 'esbwoodemo' ),
                                'parent_item_colon'  => __( 'Parent Pending Sales:', 'esbwoodemo' ),
                                'not_found'          => __( 'No pending_sells found.', 'esbwoodemo' ),
                                'not_found_in_trash' => __( 'No pending_sells found in Trash.', 'esbwoodemo' ),
                            );

    $pending_sell_args = array(
                            'labels'             => $pending_sell_labels,
                            'public'             => true,
                            'publicly_queryable' => false,
                            'show_ui'            => true,
                            'show_in_menu'       => true,
                            'query_var'          => false,
                            'rewrite'            => array( 'slug'=> 'pending_sells', 'with_front' => false ),
                            'capability_type'    => 'post',
                            'has_archive'        => false,
                            'hierarchical'       => false,
                            'menu_position'      => null,
                            'menu_icon'          => 'dashicons-pressthis', // Menu Icon from https://developer.wordpress.org/resource/dashicons/
                            'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' )
                        );

    register_post_type( ESBWOODEMO_PENSEL_POST_TYPE, $pending_sell_args );
    
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
                        'name'              => _x( 'Categories', 'taxonomy general name', 'esbwoodemo'),
                        'singular_name'     => _x( 'Category', 'taxonomy singular name','esbwoodemo' ),
                        'search_items'      => __( 'Search Categories','esbwoodemo' ),
                        'all_items'         => __( 'All Categories','esbwoodemo' ),
                        'parent_item'       => __( 'Parent Category','esbwoodemo' ),
                        'parent_item_colon' => __( 'Parent Category:','esbwoodemo' ),
                        'edit_item'         => __( 'Edit Category' ,'esbwoodemo'), 
                        'update_item'       => __( 'Update Category' ,'esbwoodemo'),
                        'add_new_item'      => __( 'Add New Category' ,'esbwoodemo'),
                        'new_item_name'     => __( 'New Category Name' ,'esbwoodemo'),
                        'menu_name'         => __( 'Categories' ,'esbwoodemo')
                    );

    $args = array(
                    'hierarchical'      => true,
                    'labels'            => $labels,
                    'show_ui'           => true,
                    'show_admin_column' => true,
                    'query_var'         => true,
                    'rewrite'           => array( 'slug'=> 'pending_sell' )
                );
	
    register_taxonomy( ESBWOODEMO_PENSEL_POST_TAX, ESBWOODEMO_PENSEL_POST_TYPE, $args );
    
    /*
     * Services Post Type
     */
    $services_labels = array(
                            'name'               => _x( 'Services', 'esbwoodemo_service', 'esbwoodemo' ),
                            'singular_name'      => _x( 'Service', 'esbwoodemo_service', 'esbwoodemo' ),
                            'menu_name'          => _x( 'Services', 'esbwoodemo_service', 'esbwoodemo' ),
                            'name_admin_bar'     => _x( 'Services', 'esbwoodemo_service', 'esbwoodemo' ),
                            'add_new'            => _x( 'Add New', 'esbwoodemo_service', 'esbwoodemo' ),
                            'add_new_item'       => __( 'Add New Service', 'esbwoodemo' ),
                            'new_item'           => __( 'New Service', 'esbwoodemo' ),
                            'edit_item'          => __( 'Edit Service', 'esbwoodemo' ),
                            'view_item'          => __( 'View Service', 'esbwoodemo' ),
                            'all_items'          => __( 'All Services', 'esbwoodemo' ),
                            'search_items'       => __( 'Search Service', 'esbwoodemo' ),
                            'parent_item_colon'  => __( 'Parent Service:', 'esbwoodemo' ),
                            'not_found'          => __( 'No Services found.', 'esbwoodemo' ),
                            'not_found_in_trash' => __( 'No Services found in Trash.', 'esbwoodemo' ),
                        );

    $services_args = array(
                            'labels'             => $services_labels,
                            'public'             => true,
                            'publicly_queryable' => true,
                            'show_ui'            => true,
                            'show_in_menu'       => true,
                            'query_var'          => true,
                            'rewrite'            => array( 'slug'=> 'services', 'with_front' => false ),
                            'capability_type'    => 'post',
                            'has_archive'        => false,
                            'hierarchical'       => false,
                            'menu_position'      => null,
                            'menu_icon'          => 'dashicons-grid-view', // Menu Icon from https://developer.wordpress.org/resource/dashicons/
                            'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' )
                        );

    register_post_type( ESBWOODEMO_SERVICE_POST_TYPE, $services_args );
    
    //flush rewrite rules
    flush_rewrite_rules();
}

//add action to create custom post type
add_action( 'init', 'esbwoodemo_register_post_types' );

?>