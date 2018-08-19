<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $post, $thebigshop_options;

 if(isset($thebigshop_options['td-woo-categories-number-of-column'])){
     $thebigshop_number_of_column=$thebigshop_options['td-woo-categories-number-of-column'];
 }
 if(isset($_GET['col'])){ $thebigshop_number_of_column=$_GET['col']; }
$classes = array();
 if(isset($thebigshop_number_of_column) && $thebigshop_number_of_column==3){
    $classes[] ="product-layout product-grid col-lg-4 col-md-6 col-sm-4 col-xs-12";
}elseif(isset($thebigshop_number_of_column) && $thebigshop_number_of_column==5){
     $classes[] ="product-layout product-grid col-lg-5ths col-md-5ths col-sm-3 col-xs-12";
}elseif(isset($thebigshop_number_of_column) && $thebigshop_number_of_column==6){
    $classes[] ="product-layout product-grid col-lg-2 col-md-2 col-sm-3 col-xs-12";
}else{
    $classes[] ="product-layout product-grid col-lg-3 col-md-3 col-sm-3 col-xs-12";
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}
?>

<li <?php post_class( $classes ); ?>>
    <div class="product-thumb clearfix">
        <?php do_action('woocommerce_before_shop_loop_item'); ?>
        <div class="image">
             <a class="product-image" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
            <?php echo get_the_post_thumbnail($post->ID, 'thebigshop_homedefault', array( 'class' => 'img-responsive lazyOwl' )) ?>
        </a>
        </div>
        <div class="caption">
            <h4><a class="product-title" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
            <div class="description"><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?></div>
                <?php
                /**
                 * woocommerce_after_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action('woocommerce_after_shop_loop_item_title');

                wc_get_template('loop/sale-flash.php');
                wc_get_template('loop/rating.php'); 
                ?>	
        </div>
        <div class="button-group">
            <?php do_action('woocommerce_after_shop_loop_item'); ?>
            <div class="add-to-links">
                <?php
               if( class_exists( 'YITH_WCQV_Frontend' ) ){
                        $label = esc_html( get_option( 'yith-wcqv-button-label' ) );
			echo '<a href="#" class="quick-view yith-wcqv-button" data-product_id="' . $product->get_id() . '">' . $label . '</a>';
                   }
                ?>
                <?php if (in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins')))) : ?>            
                    <?php if (in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins')))) { ?> 
                        <?php
                        echo do_shortcode('[yith_compare_button]');
                        ?>                
                    <?php } ?>               
                    <?php if (in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins')))) { ?> 
                        <?php
                        echo do_shortcode('[yith_wcwl_add_to_wishlist]');
                        ?> 
                    <?php } ?>           
                <?php endif;  ?>  
            </div>
        </div>
    </div>
</li>

