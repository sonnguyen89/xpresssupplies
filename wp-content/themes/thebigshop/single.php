<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
global $thebigshop_options;
$thebigshop_pagelayout = 3;
if (is_singular('post')) {
    if (isset($thebigshop_options['td-blog-sidebar-position'])) {
        $thebigshop_pagelayout = $thebigshop_options['td-blog-sidebar-position'];
    }
} elseif (is_singular('attachment')) {
    if (isset($thebigshop_options['td-image-attachments-sidebar-position'])) {
        $thebigshop_pagelayout = $thebigshop_options['td-image-attachments-sidebar-position'];
    }
}
$thebigshop_page_layout = thebigshop_layout_position($thebigshop_pagelayout);

$thebigshop_blog_comments = 1;
if (isset($thebigshop_options['td_blog_comments']) && ($thebigshop_options['td_blog_comments'] == 1)) {
    $thebigshop_blog_comments = $thebigshop_options['td_blog_comments'];
}
get_header();
?>
<div class="container">
    <div class="row" >
        <div class="<?php echo esc_attr($thebigshop_page_layout[0]); ?>" >
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <?php
                    // Start the loop.
                    while (have_posts()) : the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part('inc/content', 'single');

                            if (is_singular('attachment')) {
                                // Parent post navigation.
                                the_post_navigation(array(
                                    'prev_text' => _x('<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'thebigshop'),
                                ));
                            } elseif (is_singular('post')) {
                                if (isset($thebigshop_options['td_blog_nextpre_pagination']) && ($thebigshop_options['td_blog_nextpre_pagination'] == 1)) {
                                    thebigshop_post_navigation();
                                }
                            }
                            ?>
                        </article>
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if (isset($thebigshop_blog_comments) && ($thebigshop_blog_comments == 1)) {
                            if (comments_open() || get_comments_number()) :
                                comments_template();
                            endif;
                        }
                        ?>
                        <?php
                    // End the loop.
                    endwhile;
                    ?>
                </main><!-- .site-main -->
            </div><!-- .content-area -->
        </div><!-- Col-9 -->   
        <div class="<?php echo esc_attr($thebigshop_page_layout[1]); ?> hidden-xs" > 
            <?php
                get_sidebar();
            ?>
        </div>
    </div><!-- row-->
</div><!-- container -->  
<div class="container"> 
<?php get_sidebar('content-bottom'); ?>
</div><!-- container -->  
<?php get_footer(); ?>
