<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
global $thebigshop_options;

$thebigshop_pagelayout=3;
if(isset($thebigshop_options['td-blog-sidebar-position'])){
    $thebigshop_pagelayout=$thebigshop_options['td-blog-sidebar-position'];
}

if(isset($_GET['side'])){ $thebigshop_pagelayout=$_GET['side']; }
$thebigshop_page_layout = thebigshop_layout_position($thebigshop_pagelayout);

if(isset($thebigshop_options['td_blog_layout']) &&($thebigshop_options['td_blog_layout'] == 2)){
    $thebigshop_blog_layout="blog-second";
 }else{
    $thebigshop_blog_layout="blog-first";
 }
get_header(); ?>
<div class="container">
    <div class="row" >
        <div class="<?php echo esc_attr($thebigshop_page_layout[0]); ?>" >
	<div id="primary" class="content-area">
		<main id="main" class="site-main <?php echo esc_attr($thebigshop_blog_layout) ?>">

		<?php if ( have_posts() ) : ?>

			<?php if (!is_home() && !is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'inc/content', get_post_format() );


			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
                                'mid_size' => 2,
				'prev_text'          => '',
				'next_text'          => '',
     
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
        </div><!-- Col-9 -->   
        <div class="<?php echo esc_attr($thebigshop_page_layout[1]); ?> hidden-xs" > 
            <?php get_sidebar(); ?>
        </div>
       
    </div><!-- row-->
</div><!-- container -->  
<div class="container"> 
        <?php get_sidebar('content-bottom'); ?>
</div><!-- container --> 
<?php get_footer(); ?>
