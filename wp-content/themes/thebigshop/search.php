<?php
/**
 * The template for displaying search results pages
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
global $thebigshop_options;
$thebigshop_pagelayout=3;
if(isset($thebigshop_options['td-search-sidebar-position'])){
    $thebigshop_pagelayout=$thebigshop_options['td-search-sidebar-position'];
}
$thebigshop_page_layout = thebigshop_layout_position($thebigshop_pagelayout);

get_header(); ?>
<div class="container">
    <div class="row" >
        <div class="<?php echo esc_attr($thebigshop_page_layout[0]); ?>" >
	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'thebigshop' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>

				<?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'inc/content', 'search' );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => esc_html__( 'Previous page', 'thebigshop' ),
				'next_text'          => esc_html__( 'Next page', 'thebigshop' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'thebigshop' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'inc/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->
        </div><!-- Col-9 -->   
        <div class="<?php echo esc_attr($thebigshop_page_layout[1]); ?> hidden-xs"> 
            <?php get_sidebar(); ?>
        </div>
    </div><!-- row-->
</div><!-- container --> 
<?php get_footer(); ?>
