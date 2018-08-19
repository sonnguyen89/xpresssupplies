<?php
global $product, $post, $thebigshop_options;
?>

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
         * woocommerce_after_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_rating - 5
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
            <?php endif; ?>  
        </div>
    </div>
</div>