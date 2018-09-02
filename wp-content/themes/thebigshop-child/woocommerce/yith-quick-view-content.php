<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

while ( have_posts() ) : the_post(); ?>

 <div class="product">

	<div itemscope id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>>

            
            <?php
		global $post, $woocommerce, $product;

?>
<?php wc_get_template('single-product/sale-flash.php');?>
<div class="images">
     
	<?php
     
		if ( has_post_thumbnail() ) {
			$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
			$image         = get_the_post_thumbnail( $post->ID, 'thebigshop_quickview_images', array(
				'title'	=> get_the_title( get_post_thumbnail_id() )
			) );

			$attachment_count = count( $product->get_gallery_image_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'woocommerce' ) ), $post->ID );

		}
	?>
</div>
            

		<div class="summary entry-summary">
			<div class="summary-content">
				<?php do_action( 'yith_wcqv_product_summary' ); ?>
			</div>
		</div>

	</div>

</div>

<?php endwhile; // end of the loop.