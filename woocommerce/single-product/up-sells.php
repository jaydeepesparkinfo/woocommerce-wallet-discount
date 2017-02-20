<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
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

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) === 0 ) {
	return;
}

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="upsells products">

		<h2><?php _e( 'You may also like&hellip;', 'woocommerce' ) ?></h2>

		

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<div class="upsells-product">
                                    <?php
                                        global $product;
                                        $col_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium');
                                    ?>
                                    <?php if( !empty( $col_image_url[0] ) ) { ?>
                                    <div class="feature-img"><a href="<?php echo get_the_permalink();?>"><img src="<?php echo $col_image_url[0]; ?>" alt="" /></a></div>
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

			<?php endwhile; // end of the loop. ?>

		

	</div>

<?php endif;

wp_reset_postdata();