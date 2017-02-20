<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;


if ( empty( $product ) || ! $product->exists() ) {
	return;
}
$related = esbwoodemo_get_related_custom( $product->id , 8 );

if ( sizeof( $related ) === 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => 8,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>
    <div class="related-product-slider">
        <h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>
    </div>
    <div class="related-product-slider">
        <ul class="slides">
            <?php while ( $products->have_posts() ) : $products->the_post(); ?>
            <li>
                <div class="related-product-img">
                    <?php
                        $col_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium');
                    ?>
                    <?php if( !empty( $col_image_url[0] ) ) { ?>
                    <div class="feature-img"><a href="<?php the_permalink();?>"><img src="<?php echo $col_image_url[0]; ?>" alt="" /></a></div>
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
            </li>
            <?php endwhile; // end of the loop. ?>
        </ul>            
    </div>
<?php endif;

wp_reset_postdata();