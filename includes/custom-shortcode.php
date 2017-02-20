<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
/*
 * Recent Blog Display In Slider
 */
function esbwoodemo_recent_blog(){
        $blog_arg   = array( 
                            'post_type'         =>  ESBWOODEMO_POST_POST_TYPE,
                            'posts_per_page'    => '3',
                            'orderby'           => 'post_date',
                            'order'             => 'DESC'
                    );
        $blog_loop = new WP_Query( $blog_arg );
        ob_start();
?>
        <?php if ( $blog_loop->have_posts() ) { ?>                
                <div class="blog-slider">
                    <ul class="slides">
                        
                        <?php while ( $blog_loop->have_posts() ) { $blog_loop->the_post() ; ?>
                            <?php
                                global $post;
                                $blog_cat   = get_the_category ($post->ID);
                                $image_id   = get_post_thumbnail_id();
                                $image_url  = wp_get_attachment_image_src($image_id,'medium');
                            ?>
                            <li>
                            <?php if( !empty( $image_url[0] ) ) { ?>
                                <div class="blog-img equal_height">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <img src="<?php echo $image_url[0]; ?>" alt="<?php the_title() ; ?>">
                                    </a>
                                </div>
                            <?php } ?>
                                <div class="blog-contain">
                                    <div class="blog-date">
                                        <span class="date"><?php echo get_the_date('d'); ?></span>
                                        <span class="month"><?php echo get_the_date('M'); ?></span>
                                    </div>
                                    <div class="blog-post-detail">
                                        <?php foreach ($blog_cat as $value_cat) {
                                            $term_link  = get_term_link($value_cat);                               
                                            if (is_wp_error($term_link)){
                                                continue;
                                            }
                                        ?>    
                                            <a href="<?php echo $term_link; ?>" class="post-title"><?php echo $value_cat->name; ?></a>
                                        <?php } ?>
                                        <h2><a href="<?php the_permalink();?>"><?php the_title() ; ?></a></h2>
                                        <div class="blog-text">
                                            <p><?php echo esbwoodemo_excerpt_word( get_the_content(), 12 ) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    <?php wp_reset_postdata(); ?>
                    </ul>
                </div>      

        <?php } ?>
<?php
    $recent_blog = ob_get_clean();
    return $recent_blog;
}// End Recent Blog Display In Slider
/*
 * Featured Product Display In Slider
 */
function esbwoodemo_fea_image(){
        $fea_meta_query[]   = array(
                                    'key'   => '_featured',
                                    'value' => 'yes'
                            );
        $fea_query_args     = array(
                                'post_type'           => 'product',
                                'post_status'         => 'publish',
                                'posts_per_page'      => 10,
                                'orderby'             => 'post_date',
                                'order'               => 'desc',
                                'meta_query'          => $fea_meta_query
                            );
        
        $fea_loop   = new WP_Query( $fea_query_args );
        ob_start();
        ?>
        <?php if ( $fea_loop->have_posts() ) { ?>
            <div class="feature-slider">
                <ul class="slides">
                <?php while ( $fea_loop->have_posts() ) { $fea_loop->the_post() ; ?>
                    <li>
                    <?php
                        global $product;
                        $image_id   = get_post_thumbnail_id();
                        $image_url  = wp_get_attachment_image_src($image_id,'medium');
                    ?>
                    <?php if( !empty( $image_url[0] ) ) { ?>
                        <div class="feature-img"><a href="<?php the_permalink();?>"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title() ; ?>"></a></div>
                    <?php } ?>
                        <div class="feature-name">
                            <h6><a href="<?php the_permalink();?>"><?php the_title() ; ?></a></h6>
                            <?php echo $product->get_price_html(); ?>
                        </div>
                    </li>    
                <?php } ?>
                <?php wp_reset_postdata(); ?>
                </ul>
            </div>
        <?php } ?>
<?php
    $feat_blog = ob_get_clean();
    return $feat_blog;
}//End Featured Product Display In Slider

/*
 * Blog Category Listing
 */
function esbwoodemo_blog_cat_list(){
    ob_start();
    $cat_args   = array('orderby'       => 'name', 
                        'order'         => 'ASC',
                        'hide_empty'    => 0
                ); 
    $terms  = get_terms(ESBWOODEMO_POST_CAT_TAX,$cat_args);
    if( !is_wp_error( $terms ) ) {
?>
    <ul>
        <?php
            foreach ($terms as $term){
                $termname   = strtolower($term->name);                
                $term_link  = get_term_link($term);                               
                if (is_wp_error($term_link)){
                    continue;
                }
        ?>
                <li><a href="<?php echo esc_url($term_link) ; ?>"><?php echo $term->name; ?></a></li>
            <?php  } ?>
    </ul>
        <?php }
        $blog_cat = ob_get_clean();
        return $blog_cat;
}
/*
 * Recent Products
 */
function esbwoodemo_new_arrival(){
        $product_arg   = array( 
                            'post_type'         =>  ESBWOODEMO_PRODUCT_POST_TYPE,
                            'posts_per_page'    => '10',
                            'orderby'           => 'post_date',
                            'order'             => 'DESC'
                    );
        $product_loop = new WP_Query( $product_arg );
        ob_start();
?>
        <?php if ( $product_loop->have_posts() ) { ?>
            <div class="new-arrival-wrap">
                <ul class="slides">
                    <?php while ( $product_loop->have_posts() ) { $product_loop->the_post() ; ?>
                        <li>
                        <?php
                            global $product;
                            $image_id   = get_post_thumbnail_id();
                            $image_url  = wp_get_attachment_image_src($image_id,'medium');
                        ?>
                        <?php if( !empty( $image_url[0] ) ) { ?>
                            <div class="feature-img"><a href="<?php echo get_the_permalink();?>"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title() ; ?>"></a></div>
                        <?php } ?>
                            <div class="feature-name">
                                <h6><a href="<?php the_permalink();?>"><?php the_title() ; ?></a></h6>
                                <?php echo $product->get_price_html(); ?>
                            </div>
                        </li>    
                    <?php } ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
            </div>
            <div class="coll-btn">
                <a href="<?php echo get_permalink( ESBWOODEMO_NEW_ARRIVAL_PAGE ) ?>"><?php _e( 'See All New Arrivals', 'esbwoodemo' );?></a>
            </div>

        <?php } ?>
<?php
    $recent_product = ob_get_clean();
    return $recent_product;
}// End Recent Product

/*
 * Retailer Discount
 */
function esbwoodemo_retail_dic(){
    global $product;
    $sale_price     = $product->sale_price ;
    $regular_price  = $product->regular_price ;
    $retail_price   = get_field('estimated_retail_price');
    $retail_price   = floatval($retail_price);
    $maximumper     = 0;
    if( !empty( $retail_price ) ){
?>
        <div class="feature-price">
            <?php $currency_symbol = get_woocommerce_currency_symbol(); ?>
            <?php echo sprintf( __('%s%s','esbwoodemo') , $currency_symbol ,$retail_price  ); ?>
            <?php if( !empty( $sale_price ) ) {
                    $percentage= round((100 - ( ( $sale_price * 100 ) / $retail_price )),0) ;
                    if ($percentage > $maximumper) {
                        $maximumper = $percentage;
            ?>
                        <h6 class="sale-offer"><?php echo $maximumper . '%' .' OFF' ; ?></h6>
                    <?php } ?>
            <?php } else {
                    $percentage= round((100 - ( ( $regular_price * 100 ) / $retail_price )),0) ;
                    if ($percentage > $maximumper) {
                            $maximumper = $percentage;
            ?>
                        <h6 class="sale-offer"><?php echo $maximumper . '%' .' OFF'; ?></h6>
                    <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>
<?php                       
}//End Retailer Discount

/*
 * Retailer Discount Product Loop Page
 */
function esbwoodemo_retail_dic_loop(){
    global $product;
    $sale_price     = $product->sale_price ;
    $regular_price  = $product->regular_price ;
    $retail_price   = get_field('estimated_retail_price');
    $retail_price   = floatval($retail_price);
    $maximumper     = 0;
?>
        <div class="feature-price feature-price-loop">
            <?php $currency_symbol = get_woocommerce_currency_symbol(); ?>
            <?php echo $product->get_price_html(); ?>
            <?php
                if( !empty( $retail_price ) ){
            ?>
            <div class="estimated_retail"><?php echo sprintf( __('Estimated Retail Price %s%s','esbwoodemo') , $currency_symbol ,$retail_price  );?></div>
            <?php if( !empty( $sale_price ) ) {
                    $percentage= round((100 - ( ( $sale_price * 100 ) / $retail_price )),0) ;
                    if ($percentage > $maximumper) {
                        $maximumper = $percentage;
            ?>
                        <h6 class="sale-offer"><?php echo $maximumper . '%' .' OFF' ; ?></h6>
                    <?php } ?>
            <?php } else {
                    $percentage= round((100 - ( ( $regular_price * 100 ) / $retail_price )),0) ;
                    if ($percentage > $maximumper) {
                            $maximumper = $percentage;
            ?>
                        <h6 class="sale-offer"><?php echo $maximumper . '%' .' OFF'; ?></h6>
                    <?php } ?>
            <?php } ?>
            <?php } ?>
        </div>
    
<?php                       
}//End Retailer Discount

//Recent Blog Display In Slider
add_shortcode('esbwoo_recent_blog', 'esbwoodemo_recent_blog');

//Featured Product Display In Slider
add_shortcode('esbwoo_feat_product', 'esbwoodemo_fea_image');

//Blog Category Listing
add_shortcode('esbwoo_blog_cat_list', 'esbwoodemo_blog_cat_list');

//Recent Blog Display In Slider
add_shortcode('esbwoo_new_arrival', 'esbwoodemo_new_arrival');

//Recent Retailer Discount
add_shortcode('esbwoo_retail_dic', 'esbwoodemo_retail_dic');

//Recent Retailer Discount Product Loop Page
add_shortcode('esbwoo_retail_dic_loop', 'esbwoodemo_retail_dic_loop');

function esbwoodemo_menu_terms( $atts ){
    ob_start();
    extract( shortcode_atts( array(
        'tax'           => 'product_brand',
        'display_count' => 'false',
        'columns'       => 5,
        'hide_empty'    => 'true',
        'exclude'       => array(),
        'exclude_tree'  => array(),
        'include'       => array(),
        'number'        => 5,
        'fields'        => 'all',
        'slug'          => '',
        'parent'        => 0,
        'hierarchical'  => 'true',
        'child_of'      => 0,
        'get'           => '',
        'name__like'    => '',
        'pad_counts'    => 'false',
        'offset'        => '',
        'search'        => '',
        'cache_domain'  => 'core',
    ), $atts ) );
 
    $display_count  = $display_count == 'true' ? true : false;
    $hide_empty     = $hide_empty == 'true' ? true : false;
    $hierarchical   = $hierarchical == 'false' ? false : true;
    $pad_counts     = $pad_counts == 'true' ? true : false;
 
    if( strpos( $tax , ',' ) ) $tax                 = explode( ',' , $tax );
    if( !is_array( $exclude ) ) $exclude            = explode( ',' , $exclude );
    if( !is_array( $exclude_tree ) ) $exclude_tree  = explode( ',' , $exclude_tree );
    if( !is_array( $include ) ) $include            = explode( ',' , $include );
 
    $term_args = compact(
            'orderby' , 'order' , 'hide_empty' , 'exclude' ,
            'exclude_tree' , 'include' , 'number' , 'slug' ,
            'parent' , 'hierarchical' , 'child_of' , 'get' ,
            'name__like' ,  'pad_counts' , 'offset' ,
            'search' , 'cache_domain' );
 
    $terms      = get_terms( $tax , $term_args );
    $n          = count( $terms );
    $per_column = ceil( $n / $columns );
 
    $html = '<div class="menu-terms submenu-listing menu-terms-col-'.$columns.'">';
 
    $html.= '<ul class="menu-terms-column ul-submenu-listing">';
    if($tax == ESBWOODEMO_COLLECTION_POST_TAX ){
        foreach( $terms as $i => $term ){
            $enable_tax = get_field('txt_taxocol_enable', "{$term->taxonomy}_{$term->term_id}");
            if( $enable_tax == 1 ){
                $html.= '<li class="term-'.$term->term_id.' term-slug-'.$term->slug.' term-taxonomy-'.$term->taxonomy.'">';
                $html.= '<a href="'.get_term_link($term).'">';
                $html.= $term->name;
                if( $display_count ) $html.= ' ('.$term->count. ')';
                $html.= '</a></li>';
                if( ($i+1) % $per_column == 0 ){
                    $html.= '</ul><ul class="menu-terms-column ul-submenu-listing">';
                }
            }
        }
    }  else
    {
        foreach( $terms as $i => $term ){
            //if( $term->parent == 0){
            $html.= '<li class="term-'.$term->term_id.' term-slug-'.$term->slug.' term-taxonomy-'.$term->taxonomy.'">';
            $html.= '<a href="'.get_term_link($term).'">';
            $html.= $term->name;
            if( $display_count ) $html.= ' ('.$term->count. ')';
            $html.= '</a></li>';
            //}
            if( ($i+1) % $per_column == 0 ){
                $html.= '</ul><ul class="menu-terms-column ul-submenu-listing">';
            }
        }
    }
    $html.= '</ul></div>';
    echo $html;
    $menuterms  = ob_get_clean();
    return $menuterms;
}
add_shortcode( 'menu-terms' , 'esbwoodemo_menu_terms' );

function esbwoodemo_cat_terms( $atts ){
    ob_start();
    extract( shortcode_atts( array(
        'tax'           => 'product_cat',
        'display_count' => 'false',
        'columns'       => '',
        'hide_empty'    => 'true',
        'exclude'       => array(),
        'exclude_tree'  => array(),
        'include'       => array(),
        'number'        => '',
        'fields'        => 'all',
        'slug'          => '',
        'parent'        => '',
        'hierarchical'  => 'true',
        'child_of'      => 0,
        'get'           => '',
        'name__like'    => '',
        'pad_counts'    => 'false',
        'offset'        => '',
        'search'        => '',
        'cache_domain'  => 'core',
    ), $atts ) );
 
    $display_count  = $display_count == 'true' ? true : false;
    $hide_empty     = $hide_empty == 'true' ? true : false;
    $hierarchical   = $hierarchical == 'false' ? false : true;
    $pad_counts     = $pad_counts == 'true' ? true : false;
 
    if( strpos( $tax , ',' ) ) $tax                 = explode( ',' , $tax );
    if( !is_array( $exclude ) ) $exclude            = explode( ',' , $exclude );
    if( !is_array( $exclude_tree ) ) $exclude_tree  = explode( ',' , $exclude_tree );
    if( !is_array( $include ) ) $include            = explode( ',' , $include );
 
    $term_args  = compact(
            'orderby' , 'order' , 'hide_empty' , 'exclude' ,
            'exclude_tree' , 'include' , 'number' , 'slug' ,
            'parent' , 'hierarchical' , 'child_of' , 'get' ,
            'name__like' ,  'pad_counts' , 'offset' ,
            'search' , 'cache_domain' );
 
    $terms      = get_terms( $tax , $term_args );
?>
<ul class="lv-cat-terms-list-parent">
    <?php foreach($terms as $key => $term) : ?>
        <?php
            $term_link  = get_term_link($term);                               
            if (is_wp_error($term_link)){
                continue;
            }
        ?>
        <li>
            <a href="<?php echo esc_url($term_link) ; ?>"><?php echo $term->name; ?></a>
            <?php $sterms = get_terms("product_cat", array("orderby" => "slug", "parent" => $term->term_id)); ?>
            <?php if($sterms) : ?>
            	<ul>
                    <?php foreach($sterms as $key => $sterm) : ?>
                        <?php
                            $sterm_link  = get_term_link($sterm);                               
                            if (is_wp_error($sterm_link)){
                                continue;
                            }
                        ?>
                    <li><a href="<?php echo esc_url($sterm_link) ; ?>"><?php echo $sterm->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
<?php
    $catterms  = ob_get_clean();
    return $catterms;
}
add_shortcode( 'lv-cat-terms-list' , 'esbwoodemo_cat_terms' );
/*
 * Recent Service List
 */
function esbwoodemo_recent_service(){
        $service_arg    = array( 
                            'post_type'         =>  ESBWOODEMO_SERVICE_POST_TYPE,
                            'posts_per_page'    => '4',
                            'orderby'           => 'title',
                            'order'             => 'ASC'
                        );
        $service_loop   = new WP_Query( $service_arg );
        ob_start();
?>
        <?php if ( $service_loop->have_posts() ) { ?>
                <ul class="menu-terms-column ul-submenu-listing submenu-listing">
                    <?php while ( $service_loop->have_posts() ) { $service_loop->the_post() ; ?>
                        <li><a href="<?php echo get_permalink( ESBWOODEMO_SERVICE_PAGE ) ?>"><?php echo get_the_title(); ?></a></li>
                    <?php } ?>
                </ul>
                    <?php wp_reset_postdata(); ?>

        <?php } ?>
<?php
    $recent_service = ob_get_clean();
    return $recent_service;
}//End Recent Service List

//Recent Service List
add_shortcode('esbwoo_recent_service', 'esbwoodemo_recent_service');

/*
 * Cart Count
 */
function esbwoodemo_cart_count(){
    ob_start();
    if( WC()->cart->get_cart_contents_count() == 0){
    ?>
    <span>
        <a href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><i class="fa fa-shopping-cart"></i> <?php echo sprintf (_n( ' %d ( Item )', ' %d ( Items )', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></a>
    </span>
    <?php
        } else {
    ?>
    <span class="header-chat-count">
        <a href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><i class="fa fa-shopping-cart"></i> <?php echo sprintf (_n( ' %d ( Item )', ' %d ( Items )', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></a>
        <div class="quick-cart-view">
            <div class="quick-cart-view-content">
                <ul>
                    <?php if ( ! WC()->cart->is_empty() ) : ?>
                        <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                    $product_name      =  $_product->get_title();
                                    $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                    $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                        ?>
                                    <li>
                                        <div class="header-cart-img">
                                            <a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo $thumbnail;?></a>
                                        </div>
                                        <div class="header-cart-name">
                                            <a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo $product_name;?></a>
                                        </div>
                                        <div class="header-cart-remove">
                                            <?php
                                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),__( 'Remove this item', 'esbwoodemo' ),esc_attr( $product_id ),esc_attr( $_product->get_sku() )), $cart_item_key );
                                            ?>
                                        </div>
                                        <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                                    </li>
                                <?php
                                                }
                                        }
                                ?>
                        <?php else : ?>
                                <li class="empty"><?php _e( 'Empty Cart', 'esbwoodemo' ); ?></li>
                        <?php endif; ?>
                </ul><!-- end product list -->
                <?php if ( ! WC()->cart->is_empty() ) : ?>
                        <p class="total"><strong><?php _e( 'Total', 'esbwoodemo' ); ?>:</strong> <?php echo WC()->cart->get_cart_total(); ?></p>
                        <p class="buttons">
                            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward"><?php _e( 'Checkout', 'esbwoodemo' ); ?></a>
                            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward"><?php _e( 'Go To Cart', 'esbwoodemo' ); ?></a>
                        </p>
                <?php endif; ?>
            </div>
        </div>
    </span>
    <?php
        }
    $cart_count_html = ob_get_clean();
    return $cart_count_html;
}
//Recent Service List
add_shortcode('esbwoo_cart_count', 'esbwoodemo_cart_count');