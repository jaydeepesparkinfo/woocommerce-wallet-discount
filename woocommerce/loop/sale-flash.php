<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
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


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    global $post, $product;
?>
<?php if ($product->is_on_sale() && $product->product_type == 'variable') { ?>
	<div class="bubble">
            <div class="inside">
                <div class="inside-text">
                <?php
                    $available_variations = $product->get_available_variations();								
                    $maximumper = 0;
                    for ($i = 0; $i < count($available_variations); ++$i) {
                            $variation_id=$available_variations[$i]['variation_id'];
                            $variable_product1= new WC_Product_Variation( $variation_id );
                            $regular_price = $variable_product1 ->regular_price;
                            $sales_price = $variable_product1 ->sale_price;
                            $percentage= round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),1) ;
                                    if ($percentage > $maximumper) {
                                            $maximumper = $percentage;
                                    }
                            }
                            echo $price . sprintf( __('%s', 'woocommerce' ), $maximumper . '%' );
                ?>
                </div>
            </div>
     </div><!-- end callout -->
<?php } elseif ($product->is_on_sale() && $product->product_type == 'simple') { ?>
    <div class="bubble">
        <div class="inside">
            <div class="inside-text">
                <?php 
                    $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
                    echo $price . sprintf( __('%s', 'woocommerce' ), $percentage . '%' );
                ?>
            </div>
        </div>
    </div><!-- end bubble -->
<?php } ?>