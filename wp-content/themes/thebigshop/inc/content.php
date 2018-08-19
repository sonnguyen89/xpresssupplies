<?php
/**
 * The template part for displaying content
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
        <?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?> 
            <div class="<?php if(isset($thebigshop_blog_layout) && ($thebigshop_blog_layout==2)): ?>col-sm-5 <?php else: ?>col-sm-12<?php endif; ?> col-xs-12">
                
                <div class="post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php if(isset($thebigshop_blog_layout) && ($thebigshop_blog_layout==2)){ ?>
                        <?php the_post_thumbnail('thebigshop_featured_image'); ?>
                        <?php }else{ ?>
                         <?php the_post_thumbnail('thebigshop_featured_image_full'); ?>
                         <?php } ?>
                    </a>
                </div><!-- .post-thumbnail -->
            </div>  
        <?php endif; ?>
        <div class="<?php if(isset($thebigshop_blog_layout) && ($thebigshop_blog_layout==2)): ?> col-sm-7 <?php else: ?>  col-xs-12 <?php endif; ?> col-xs-12">
            <header class="entry-header">
                <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                <p class="entry-meta">
                     <?php
                    if ( is_sticky() && is_home() && ! is_paged() )
                    echo '<span class="featured-post">' . esc_html__( 'Featured', 'thebigshop' ) . '</span>';
                    ?>
                    <?php 
                    thebigshop_entry_date();
                    thebigshop_entry_byline();
                    thebigshop_entry_meta();
                    ?>
                </p>         
            </header><!-- .entry-header -->
               
            <?php thebigshop_excerpt(); ?>

            <div class="entry-content">
                <?php
                /* translators: %s: Name of current post */
                the_content( esc_html__( 'Read More', 'thebigshop' ));

                wp_link_pages(array(
                    'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'thebigshop') . '</span>',
                    'after' => '</div>',
                    'link_before' => '<span>',
                    'link_after' => '</span>',
                    'pagelink' => '<span class="screen-reader-text">' . esc_html__('Page', 'thebigshop') . ' </span>%',
                    'separator' => '<span class="screen-reader-text">, </span>',
                ));
                ?>
                <?php  thebigshop_post_edit_link(); ?>
            </div><!-- .entry-content -->
        </div>
         
    </div>
</article><!-- #post-## -->
