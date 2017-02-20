<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Enqueue scripts and styles for the back end.
 */
function esbwoodemo_admin_scripts() {
    
        global $wp_version;
    
        // Load our admin stylesheet.
	wp_enqueue_style( 'esbwoodemo-admin-style', get_template_directory_uri() . '/css/admin-style.css' );
        
        // Load our admin script.
	wp_enqueue_script( 'esbwoodemo-admin-script', get_template_directory_uri() . '/js/admin-script.js' );
	wp_enqueue_script( 'esbwoodemo-admin-custom', get_template_directory_uri() . '/js/admin-custom.js' );

        //localize script
        $newui = $wp_version >= '3.5' ? '1' : '0'; //check wp version for showing media uploader
        wp_localize_script( 'esbwoodemo-admin-script', 'ESBWOODEMOADMIN', array(
                                                                        'new_media_ui'	=>  $newui,
                                                                        'one_file_min'	=>  __('You must have at least one file.','esbwoodemo' )
                                                                    ));
        wp_enqueue_media();

}

/**
 * Enqueue scripts and styles for the front end.
 */
function esbwoodemo_public_scripts() {
        global $wp_version;
     //wp_enqueue_style( 'esbwoodemo-bootstrapselect-style', get_template_directory_uri() . '/css/bootstrap-select.css', array(), NULL );
	wp_enqueue_style( 'esbwoodemo-bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css', array(), NULL );
	wp_enqueue_style( 'esbwoodemo-fontawesome-style', get_template_directory_uri() . '/css/font-awesome.css', array(), NULL );
	wp_enqueue_style( 'esbwoodemo-flexslider-style', get_template_directory_uri() . '/css/flexslider.css', array(), NULL );
	wp_enqueue_style( 'esbwoodemo-fancybox-style', get_template_directory_uri() . '/css/jquery.fancybox.css', array(), NULL );
	wp_enqueue_style( 'esbwoodemo-style', get_stylesheet_uri(), array(), NULL );
	wp_enqueue_style( 'esbwoodemo-public-style', get_template_directory_uri() . '/css/public-style.css', array(), NULL );

        // Load main jquery
        wp_enqueue_script( 'jquery', array(), NULL );
        
        // Load public script
	wp_enqueue_script( 'esbwoodemo-bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array(), NULL );
	wp_enqueue_script( 'esbwoodemo-fancybox-script', get_template_directory_uri() . '/js/jquery.fancybox.js', array(), NULL );
	wp_enqueue_script( 'esbwoodemo-flexslider-script', get_template_directory_uri() . '/js/jquery.flexslider.js', array(), NULL );
	wp_enqueue_script( 'esbwoodemo-fileuplod-script', get_template_directory_uri() . '/js/fileuplod.js', array(), NULL );
	wp_enqueue_script( 'esbwoodemo-public-script', get_template_directory_uri() . '/js/public-script.js', array(), NULL );
        
        $newui = $wp_version >= '3.5' ? '1' : '0'; //check wp version for showing media uploader
        wp_localize_script( 'esbwoodemo-public-script', 'ESBWOODEMOPUBLIC', array(
                                                            'new_media_ui'	=>  $newui,
                                                            'url'	=>  get_stylesheet_directory_uri().'/includes/',
                                                            'ajaxurl'   => admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) )
                                                        ) 
        );
         wp_enqueue_media();
}

//add action to load scripts and styles for the back end
add_action( 'admin_enqueue_scripts', 'esbwoodemo_admin_scripts' );

//add action load scripts and styles for the front end
add_action( 'wp_enqueue_scripts', 'esbwoodemo_public_scripts' );

?>