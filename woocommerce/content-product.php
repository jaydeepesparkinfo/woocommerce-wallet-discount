<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>
<div class="shop-product">
    <?php
        $col_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium');
    ?>
    <?php
        global $product;
        $attachment_ids = $product->get_gallery_attachment_ids();
        if( !empty( $attachment_ids[0] )){
            $attachment_src = wp_get_attachment_image_src( $attachment_ids[0],'medium');
        }
    ?>
    <?php if( !empty( $col_image_url[0] ) ) { ?>
        <div id="shop-pro-img" class="feature-img">
            <a href="<?php the_permalink();?>">
                <?php if( !empty(  $attachment_src[0] )){ ?>
                <img class="<?php echo !empty( $col_image_url ) ? 'bottom' : '' ; ?>" src="<?php echo $attachment_src[0]; ?>" alt="<?php echo 'product-img-'.get_post_thumbnail_id(); ?>" />
                <?php } ?>
                    <img class="<?php echo !empty( $attachment_src[0] ) ? 'top' :'' ?>" src="<?php echo $col_image_url[0]; ?>" alt="<?php echo 'product-img-'.get_post_thumbnail_id(); ?>" />
            </a>
        </div>
    <?php } ?>
    <div class="feature-name">
        <h6><a href="<?php the_permalink();?>"><?php the_title() ; ?></a></h6>
        <?php
            $stock = $product->is_in_stock() ? 1 : 0 ;
            //$stockamount = $product->get_stock_quantity();
            $pricelabel = "SOLD";
            if( $stock == 0 ) {
        ?>
            <p class="product-out-of-stock"><?php echo $pricelabel; ?></p>
        <?php
            } else {
        ?>
            <?php echo do_shortcode('[esbwoo_retail_dic_loop]'); ?>
        <?php } ?>
    </div>
</div>
