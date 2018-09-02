<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $post, $product, $woocommerce, $thebigshop_options;

$attachment_ids = $product->get_gallery_image_ids();

$classes = array('thumbimg','thumbnail');
$thebigshop_single_product_images = "default";
if (isset($thebigshop_options['td-woo-product-images-style'])) {
    $thebigshop_single_product_images = $thebigshop_options['td-woo-product-images-style'];
}
if (isset($thebigshop_single_product_images) && ($thebigshop_single_product_images == "default")) {
    if ( $attachment_ids && has_post_thumbnail() ) {
	foreach ( $attachment_ids as $attachment_id ) {
		$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
		$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
		$attributes      = array(
			'title'                   => get_post_field( 'post_title', $attachment_id ),
			'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
			'data-src'                => $full_size_image[0],
			'data-large_image'        => $full_size_image[0],
			'data-large_image_width'  => $full_size_image[1],
			'data-large_image_height' => $full_size_image[2],
		);

		$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
		$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
 		$html .= '</a></div>';

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
	}
}
}else {
?>
<div id="carousel" class="flexslider thumbnails">
    <ul class="slides image-additional" id="gallery_01" > 
        <?php
        if (has_post_thumbnail()) {
            $image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
            $image_caption = get_post(get_post_thumbnail_id())->post_excerpt;
            $image_link = wp_get_attachment_url(get_post_thumbnail_id());
            $image_thumb_link = wp_get_attachment_thumb_url(get_post_thumbnail_id());
            $image = get_the_post_thumbnail($post->ID, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'), array(
                'title' => $image_title,
                'alt' => $image_title
            ));
            $image_class = esc_attr(implode(' ', $classes));
            if (isset($thebigshop_single_product_images) && $thebigshop_single_product_images == "cloudzoom") {
                echo "<li><a title='$image_title' data-image='$image_link' data-zoom-image='$image_link' href='#' class='thumbnail'><img alt='$image_title' title='$image_title' src='$image_thumb_link'></a></li>";
            } else {
                echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<li><a href="%s" class="%s" title="%s" >%s</a></li>', $image_link, $image_class, $image_caption, $image), $post->ID);
            }
        }
        if ( $attachment_ids && has_post_thumbnail() ) {
            foreach ($attachment_ids as $attachment_id) {
                $image_link = wp_get_attachment_url($attachment_id);
                $image_thumb_link = wp_get_attachment_thumb_url($attachment_id);
                if (!$image_link)
                    continue;
                $image_title = esc_attr(get_the_title($attachment_id));
                $image_caption = esc_attr(get_post_field('post_excerpt', $attachment_id));
                $image = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'), 0, $attr = array(
                    'title' => $image_title,
                    'alt' => $image_title
                ));
                $image_class = esc_attr(implode(' ', $classes));
                if (isset($thebigshop_single_product_images) && $thebigshop_single_product_images == "cloudzoom") {
                    echo "<li> <a title='$image_title' data-image='$image_link' data-zoom-image='$image_link' href='#' class='thumbnail'><img alt='$image_title' title='$image_title' src='$image_thumb_link'></a></li>";
                } else {
                    echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<li><a href="%s" class="%s" title="%s">%s</a></li>', $image_link, $image_class, $image_caption, $image), $attachment_id, $post->ID, $image_class);
                }
            }
        }
        ?>
    </ul>
</div>
<?php }