<?php
/**
 * Admin new order email (plain text)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/plain/admin-new-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author		WooThemes
 * @package 	WooCommerce/Templates/Emails/Plain
 * @version		2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

echo "= " . $email_heading . " =\n\n";
?>
<p>
    <?php
        $order_info = new WC_Order( $order->id );
        $items_info = $order_info->get_items();
        foreach ($items_info as $item_value) {
            $product_name = $item_value['name'];
        }
        $sch_mail = get_field('esbwoo_pro_sold_sch_mail','option');
        printf( __( 'Your product, %s has sold. Please contact The ESBWooDemo at <a href="%s">%s</a> to arrange for buyer pickup.', 'esbwoodemo' ) . ' ',$product_name,$sch_mail,$sch_mail);
    ?>
</p>
<p>
    <?php _e('Thank you for selling on The ESBWooDemo.','esbwoodemo'); ?>
</p>
<?php
echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );
?>