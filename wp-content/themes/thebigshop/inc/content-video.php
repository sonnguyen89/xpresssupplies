<?php
/**
 * Template part for displaying video posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
global $thebigshop_options;
$thebigshop_blog_layout=1;
if(isset($thebigshop_options['td_blog_layout']) &&($thebigshop_options['td_blog_layout'] == 2))
    $thebigshop_blog_layout=2;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <?php
        $content = apply_filters('the_content', get_the_content());
        $video = false;

        // Only get video from the content if a playlist isn't present.
        if (false === strpos($content, 'wp-playlist-script')) {
            $video = get_media_embedded_in_content($content, array('video', 'object', 'embed', 'iframe'));
        }
        ?>
        <?php if (( '' !== get_the_post_thumbnail() && !is_single() && empty($video) ) || (!empty($video) )) { ?>
            <div class="<?php if(isset($thebigshop_blog_layout) && ($thebigshop_blog_layout==2)): ?>col-sm-5 <?php else: ?>col-sm-12<?php endif; ?> col-xs-12">
                <?php if ('' !== get_the_post_thumbnail() && !is_single() && empty($video)) : ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('thebigshop_featured_image'); ?>
                        </a>
                    </div><!-- .post-thumbnail -->
                <?php endif; ?>
                <?php
                if (!is_single()) :

                    // If not a single post, highlight the video file.
                    if (!empty($video)) :
                        foreach ($video as $video_html) {
                            echo '<div class="entry-video">';
                              echo wp_kses($video_html, array(
    'iframe' => array(
        'src' => array(),
        'width' => array(),
        'height' => array(),
        'allowfullscreen' => array(),
        'frameborder' => array(),
        ),
));
                            echo '</div>';
                        }
                    endif;

                endif;
                ?>
            </div>
<?php } ?>
        <div class="<?php if(isset($thebigshop_blog_layout) && ($thebigshop_blog_layout==2)): ?> col-sm-7 <?php else: ?>  col-xs-12 <?php endif; ?> col-xs-12">
            <header class="entry-header">
                <?php
                if (is_single()) {
                    the_title('<h1 class="entry-title">', '</h1>');
                } elseif (is_front_page() && is_home()) {
                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                } else {
                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
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

            <div class="entry-content">


                <?php
                if (is_single() || empty($video)) :

                    /* translators: %s: Name of current post */
                    the_content( esc_html__( 'Continue reading', 'thebigshop' ));

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'thebigshop'),
                        'after' => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after' => '</span>',
                    ));

                endif;
                ?>
                 <?php  thebigshop_post_edit_link(); ?>
            </div><!-- .entry-content -->
        </div>
    </div>
</article><!-- #post-## -->
