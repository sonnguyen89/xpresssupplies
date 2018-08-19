<?php

/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $post, $product;
if ($product->is_on_sale()) {

    if (!$product->is_in_stock())
        return;

    $sale_price = thebigshop_get_post_meta($product->get_id(), "_price");
    $regular_price = thebigshop_get_post_meta($product->get_id(), "_regular_price");
    if (empty($regular_price)) { //then this is a variable product
        $available_variations = $product->get_available_variations();
        $variation_id = $available_variations[0]['variation_id'];
        $variation = new WC_Product_Variation($variation_id);
        $regular_price = $variation->regular_price;
        $sale_price = $variation->sale_price;
    }
    $sale = ceil(( ($regular_price - $sale_price) / $regular_price ) * 100);
    if (!empty($regular_price) && !empty($sale_price) && $regular_price > $sale_price) {
        echo apply_filters('woocommerce_sale_flash', '<span class="saving">-' . $sale . '%</span>', $post, $product);
    }
} 