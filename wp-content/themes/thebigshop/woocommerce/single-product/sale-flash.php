<?php

/**
 * Single Product Sale Flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/sale-flash.php.
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
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $post, $product;
if ($product->is_on_sale()) {
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
        echo apply_filters('woocommerce_sale_flash', '<span class="onsale saving">-' . $sale . '%</span>', $post, $product);
    }
} 