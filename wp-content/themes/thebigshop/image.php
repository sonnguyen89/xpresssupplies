<?php
/**
 * The template for displaying image attachments
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
global $thebigshop_options;

$thebigshop_pagelayout = 3;
if (isset($thebigshop_options['td-image-attachments-sidebar-position'])) {
    $thebigshop_pagelayout = $thebigshop_options['td-image-attachments-sidebar-position'];
}
$thebigshop_page_layout = thebigshop_layout_position($thebigshop_pagelayout);
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

                            <nav id="image-navigation" class="navigation image-navigation">
                                <div class="nav-links">
                                    <div class="nav-previous"><?php previous_image_link(false, esc_html__('Previous Image', 'thebigshop')); ?></div><div class="nav-next"><?php next_image_link(false, esc_html__('Next Image', 'thebigshop')); ?></div>
                                </div><!-- .nav-links -->
                            </nav><!-- .image-navigation -->

                            <header class="entry-header">
                                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            </header><!-- .entry-header -->

                            <div class="entry-content">

                                <div class="entry-attachment">
                                    <?php
                                    /**
                                     * Filter the default thebigshop image attachment size.
                                     *
                                     * @since TheBigshop 1.0
                                     *
                                     * @param string $image_size Image size. Default 'large'.
                                     */
                                    $image_size = apply_filters('thebigshop_attachment_size', 'large');

                                    echo wp_get_attachment_image(get_the_ID(), $image_size);
                                    ?>

                                    <?php if (has_excerpt()) : ?>
                                        <div class="entry-caption">
                                            <?php the_excerpt(); ?>
                                        </div><!-- .entry-caption -->
                                    <?php endif; ?>

                                </div><!-- .entry-attachment -->

                                <?php
                                the_content();
                                wp_link_pages(array(
                                    'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'thebigshop') . '</span>',
                                    'after' => '</div>',
                                    'link_before' => '<span>',
                                    'link_after' => '</span>',
                                    'pagelink' => '<span class="screen-reader-text">' . esc_html__('Page', 'thebigshop') . ' </span>%',
                                    'separator' => '<span class="screen-reader-text">, </span>',
                                ));
                                ?>
                            </div><!-- .entry-content -->

                            <footer class="entry-footer">
                                <?php thebigshop_entry_meta(); ?>
                                <?php thebigshop_post_edit_link(); ?>
                            </footer><!-- .entry-footer -->

                        </article><!-- #post-## -->

                        <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;

                        // Previous/next post navigation.
                        the_post_navigation(array(
                            'prev_text' => _x('<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'thebigshop'),
                        ));

                    // End the loop.
                    endwhile;
                    ?>

                </main><!-- .site-main -->
            </div><!-- .content-area -->
        </div><!-- Col-9 -->   
        <div class="<?php echo esc_attr($thebigshop_page_layout[1]); ?> hidden-xs"  >  
            <?php get_sidebar(); ?>
        </div>
    </div><!-- row-->
</div><!-- container -->  
<div class="container"> 
        <?php get_sidebar('content-bottom'); ?>
</div><!-- container -->
<?php get_footer(); ?>
