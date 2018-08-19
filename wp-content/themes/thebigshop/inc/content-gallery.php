<?php
/**
 * Template part for displaying gallery posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} elseif ( is_front_page() && is_home() ) {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
                  <p class="entry-meta">
                    <?php 
                    thebigshop_entry_date();
                    thebigshop_entry_byline();
                    thebigshop_entry_meta();
                    ?>
                </p> 
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() && ! get_post_gallery() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'thebigshop_featured_image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">

		<?php if ( ! is_single() ) :

			// If not a single post, highlight the gallery.
			if ( get_post_gallery() ) :
				echo '<div class="entry-gallery">';
					echo get_post_gallery();
				echo '</div>';
			endif;

		endif;

		if ( is_single() || ! get_post_gallery() ) :

			/* translators: %s: Name of current post */
			the_content( esc_html__( 'Continue reading', 'thebigshop' ));


			wp_link_pages( array(
				'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'thebigshop' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );

		endif; ?>
 <?php  thebigshop_post_edit_link(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
