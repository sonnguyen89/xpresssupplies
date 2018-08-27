<?php

/* Category Images */
add_action('woocommerce_archive_description', 'thebigshop_woocommerce_category_image', 1);

function thebigshop_woocommerce_category_image() {
    if (is_product_category()) {
        global $wp_query;
        $cat = $wp_query->get_queried_object();
        $thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
        $thumbnail_attributes = wp_get_attachment_image_src($thumbnail_id, 'thebigshop_categories_thumb');
        if ($thumbnail_attributes) :
            ?>
            <img class="category-images" src="<?php echo esc_url($thumbnail_attributes[0]); ?>" width="<?php echo esc_attr($thumbnail_attributes[1]); ?>" height="<?php echo esc_attr($thumbnail_attributes[2]); ?>" />
            <?php
        endif;
    }
}

/* Add Cart fragments */
add_filter('woocommerce_add_to_cart_fragments', 'thebigshop_woocommerce_header_add_to_cart_fragment');

function thebigshop_woocommerce_header_add_to_cart_fragment($fragments) {
    global $woocommerce;
    ob_start();
    ?>
    <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_html_e('View your shopping cart', 'thebigshop'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'thebigshop'), $woocommerce->cart->cart_contents_count); ?> - <?php echo wp_kses_post($woocommerce->cart->get_cart_total()); ?></a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}

remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display');

remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

global $pagenow;
if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {
    add_action('admin_init', 'thebigshop_default_image_size');

    function thebigshop_default_image_size() {
        update_option('shop_catalog_image_size', array('width' => 200, 'height' => 200, 1));
        update_option('shop_single_image_size', array('width' => 350, 'height' => 350, 1));
        update_option('shop_thumbnail_image_size', array('width' => 106, 'height' => 100, 1));
    }

}
if (class_exists('YITH_WCQV_Frontend')) {
    $quick_view = YITH_WCQV_Frontend();
    remove_action('woocommerce_after_shop_loop_item', array($quick_view, 'yith_add_quick_view_button'), 15);
}

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );