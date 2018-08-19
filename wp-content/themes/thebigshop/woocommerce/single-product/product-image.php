<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 3.3.2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $post, $woocommerce, $product, $thebigshop_options;
$attachment_ids = $product->get_gallery_image_ids();


$thebigshop_single_product_images = "default";
if (isset($thebigshop_options['td-woo-product-images-style'])) {
    $thebigshop_single_product_images = $thebigshop_options['td-woo-product-images-style'];
}
 if (isset($thebigshop_single_product_images) && ($thebigshop_single_product_images =="default")) {
     
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
?>

<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">
		<?php
		$attributes = array(
			'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
			'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
			'data-src'                => $full_size_image[0],
			'data-large_image'        => $full_size_image[0],
			'data-large_image_width'  => $full_size_image[1],
			'data-large_image_height' => $full_size_image[2],
		);

		if ( has_post_thumbnail() ) {
			$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
			$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
			$html .= '</a></div>';
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
</div>
 <?php }else{ ?>
<div class="images">
    <div id="slider" class="flexslider">
        <ul class="slides">
            <?php
            if (has_post_thumbnail()) {
                $attachment_count = count($product->get_gallery_image_ids());
                $gallery = $attachment_count > 0 ? '[product-gallery]' : '';
                $image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
                $image_caption = get_post(get_post_thumbnail_id())->post_excerpt;
                $image_link = wp_get_attachment_url(get_post_thumbnail_id());
                $image = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'), array(
                    'title' => $image_title,
                    'alt' => $image_title
                ));
                if (isset($thebigshop_single_product_images) && $thebigshop_single_product_images == "cloudzoom") {
                    echo "<img src='$image_link' id='zoom_01' class='thumbnail' width='50' height='50' alt='' data-zoom-image='$image_link' />";
                } else {
                    echo apply_filters('woocommerce_single_product_image_html', sprintf('<li><a href="%s" itemprop="image" class="woocommerce-main-image td-main-image img-responsive" title="%s" >%s</a></li>', $image_link, $image_caption, $image), $post->ID);
                }
            }
            if ($attachment_ids && (isset($thebigshop_single_product_images) && ($thebigshop_single_product_images == "magnific"))) {
                foreach ($attachment_ids as $attachment_id) {
                    $attachment_count = count($product->get_gallery_image_ids());
                    $gallery = $attachment_count > 0 ? '[product-gallery]' : '';
                    $classes = array('td-main-image', 'img-responsive');
                    $image_link = wp_get_attachment_url($attachment_id);
                    if (!$image_link)
                        continue;
                    $image_title = esc_attr(get_the_title($attachment_id));
                    $image_caption = esc_attr(get_post_field('post_excerpt', $attachment_id));

                    $image = wp_get_attachment_image($attachment_id, apply_filters('single_product_large_thumbnail_size', 'shop_single'), 0, $attr = array(
                        'title' => $image_title,
                        'alt' => $image_title
                    ));

                    $image_class = esc_attr(implode(' ', $classes));
                    echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<li><a href="%s" class="%s" title="%s" >%s</a></li>', $image_link, $image_class, $image_caption, $image), $attachment_id, $post->ID, $image_class);
                }
            }
            if (!has_post_thumbnail() && !$attachment_ids) {
                echo apply_filters('woocommerce_single_product_image_html', sprintf('<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__('Placeholder', 'woocommerce')), $post->ID);
            }
            ?>
        </ul>
    </div>
    <?php do_action('woocommerce_product_thumbnails'); ?>
</div>
 <?php }?>