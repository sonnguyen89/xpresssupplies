<?php
/**
 Template Name: Full Width
 * 
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" >

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'inc/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
 <?php if (is_front_page()) { ?>
<div class="container"> 
        <?php get_sidebar('content-bottom'); ?>
</div><!-- container --> 
<?php } ?>       
<?php get_footer(); ?>


