<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates/Emails
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<!DOCTYPE html>
<html dir="<?php echo is_rtl() ? 'rtl' : 'ltr'?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
    </head>
    <body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    	<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'?>">
        	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
                    <tr>
                	<td align="center" valign="top">
                            <div id="template_header_image">
                                <?php
                                        if ( $img = get_option( 'woocommerce_email_header_image' ) ) {
                                                echo '<p style="margin-top:0;"><img src="' . esc_url( $img ) . '" alt="' . get_bloginfo( 'name', 'display' ) . '" /></p>';
                                        }
                                ?>
                            </div>
                            <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container">
                        	<tr>
                                    <td align="center" valign="top">
                                        <!-- Header -->
                                            <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_header">
                                            <tr>
                                                <td id="header_wrapper">
                                                    <h1><?php echo $email_heading; ?></h1>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- End Header -->
                                    </td>
                                </tr>
                        	<tr>
                                    <td align="center" valign="top">
                                    <!-- Body -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
                                            <tr>
                                                <td valign="top" id="body_content">
                                                <!-- Content -->
                                                    <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td valign="top">
                                                                <div id="body_content_inner">
                                                                    <table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
                                                                            <tbody>
                                                                                <?php
                                                                                    $user_info = get_userdata( $seller_id );
                                                                                    
                                                                                    $d_name     = $user_info->display_name;
                                                                                    $e_mail     = $user_info->user_email;
                                                                                ?>
                                                                                <?php if( !empty( $d_name ) ){ ?>
                                                                                <tr>
                                                                                    <td><strong><?php _e('User Name','esbwoodemo'); ?></strong></td>
                                                                                    <td><?php echo $d_name; ?></td>
                                                                                </tr>
                                                                                <?php } ?>
                                                                                <?php if( !empty( $e_mail ) ){ ?>
                                                                                <tr>
                                                                                    <td><strong><?php _e('Email Address','esbwoodemo'); ?></strong></td>
                                                                                    <td><?php echo $e_mail; ?></td>
                                                                                </tr>
                                                                                <?php } ?>
                                                                                <?php
                                                                                    if(  $trade_account == 1 ){
                                                                                        $tax_no     = get_the_author_meta( 'tax_cer_no', $seller_id );
                                                                                        $tax_img    = get_the_author_meta( 'tax_cer_img', $seller_id );
                                                                                ?>
                                                                                    <?php if( !empty( $tax_no ) ){ ?>
                                                                                    <tr>
                                                                                        <td><strong><?php _e('Resale Certificate Number','esbwoodemo'); ?></strong></td>
                                                                                        <td><?php echo $tax_no; ?></td>
                                                                                    </tr>
                                                                                    <?php } ?>
                                                                                    <?php if( !empty( $tax_img ) ){ ?>
                                                                                    <tr>
                                                                                        <td><strong><?php _e('Resale Certificate','esbwoodemo'); ?></strong></td>
                                                                                        <td>
                                                                                            <a href="<?php echo $tax_img; ?>" target="_blank"><?php _e('View Certificate','esbwoodemo'); ?></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            </tbody>	
                                                                    </table>
                                                                </div>
                                                            </td>
                                                       </tr>
                                                    </table>
                                                <!-- End Content -->
                                                </td>
                                            </tr>
                                        </table>
                                    <!-- End Body -->
                                    </td>
                                </tr>
                        	<tr>
                                    <td align="center" valign="top">
                                        <!-- Footer -->
                                        <table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer">
                                            <tr>
                                                    <td valign="top">
                                                    <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td colspan="2" valign="middle" id="credit">
                                                                    <?php echo wpautop( wp_kses_post( wptexturize( apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) ) ) ) ); ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- End Footer -->
                                    </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>