<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $post;
$order_id            = $post->ID;
$order_item_tables   = get_field( 'esbwoo_order_commission' , $order_id );
?>
<table class="order-com-info">
    <thead>
        <tr>
            <th><?php _e('Seller','esbwoodemo'); ?></th>
            <th><?php _e('Product','esbwoodemo'); ?></th>
	    <th><?php _e('Sale Price','esbwoodemo'); ?></th>
            <th><?php _e('Discounter Price(include Coupons)','esbwoodemo'); echo '(' . get_woocommerce_currency_symbol().')'; ?></th>
            <th><?php _e('Commission(%)','esbwoodemo'); ?></th>
            <th><?php _e('Total','esbwoodemo'); echo '(' . get_woocommerce_currency_symbol().')'; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ( $order_item_tables as $order_item_table){ ?>
            <tr>
                <td><?php echo $order_item_table['esbwoo_order_comm_seller']; ?></td>
                <td><?php echo $order_item_table['esbwoo_order_comm_product']; ?></td>
                <td><?php echo $order_item_table['esbwoo_order_orignal_total']; ?></td>
                <td><?php echo $order_item_table['esbwoo_order_comm_sub_total']; ?></td>
                <td><?php echo $order_item_table['esbwoo_order_comm_commission']; _e(' %','esbwoodemo'); ?></td>
                <td><?php echo $order_item_table['esbwoo_order_comm_total']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>