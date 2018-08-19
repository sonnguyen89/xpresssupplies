<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
global $thebigshop_options;
$thebigshop_pagelayout = 3;
if (isset($thebigshop_options['td-archive-sidebar-position'])) {
    $thebigshop_pagelayout = $thebigshop_options['td-archive-sidebar-position'];
}
$thebigshop_page_layout = thebigshop_layout_position($thebigshop_pagelayout);
get_header();
?>
<div class="container">
    <div class="row" >
        <div class="<?php echo esc_attr($thebigshop_page_layout[0]); ?>">
            <section id="primary" class="content-area">
                <main id="main" class="site-main">

                    <?php if (have_posts()) : ?>

                        <header class="page-header">
                            <?php
                            the_archive_title('<h1 class="page-title">', '</h1>');
                            the_archive_description('<div class="taxonomy-description">', '</div>');
                            ?>
                        </header><!-- .page-header -->

                        <?php
                        // Start the Loop.
                        while (have_posts()) : the_post();

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part('inc/content', get_post_format());

                        // End the loop.
                        endwhile;

                        // Previous/next page navigation.
                        the_posts_pagination(array(
                            'prev_text' => esc_html__('Previous page', 'thebigshop'),
                            'next_text' => esc_html__('Next page', 'thebigshop'),
                            'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__('Page', 'thebigshop') . ' </span>',
                        ));

                    // If no content, include the "No posts found" template.
                    else :
                        get_template_part('inc/content', 'none');

                    endif;
                    ?>

                </main><!-- .site-main -->
            </section><!-- .content-area -->
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