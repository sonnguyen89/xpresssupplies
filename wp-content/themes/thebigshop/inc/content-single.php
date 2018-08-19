<?php
/**
 * The template part for displaying single posts
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
global $thebigshop_options;
$thebigshop_blog_date=1;
$thebigshop_blog_bylink=1;
$thebigshop_blog_meta=1;
if (isset($thebigshop_options['td_blog_date']) && ($thebigshop_options['td_blog_date'] == 1)) {
    $thebigshop_blog_date=$thebigshop_options['td_blog_date'];
}
if (isset($thebigshop_options['td_blog_bylink']) && ($thebigshop_options['td_blog_bylink'] == 1)) {
     $thebigshop_blog_bylink=$thebigshop_options['td_blog_bylink'];
}
 if (isset($thebigshop_options['td_blog_meta']) && ($thebigshop_options['td_blog_meta'] == 1)) {
     $thebigshop_blog_meta=$thebigshop_options['td_blog_meta'];
 }
?>
<header class="entry-header">
    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    <p class="entry-meta">
        <?php
        if (isset($thebigshop_blog_date) && ($thebigshop_blog_date == 1)) {
        thebigshop_entry_date();
         }
         if (isset($thebigshop_blog_bylink) && ($thebigshop_blog_bylink == 1)) {
        thebigshop_entry_byline();
         }
           if (isset($thebigshop_blog_meta) && ($thebigshop_blog_meta == 1)) {
    thebigshop_entry_meta();
     } 
        ?>
    </p>  
</header><!-- .entry-header -->
<?php thebigshop_excerpt(); ?>
<?php thebigshop_post_thumbnail(); ?>
<div class="entry-content">
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
    <?php do_action('thebigshop_blog_social_share'); ?>
    <?php thebigshop_post_edit_link(); ?>
</div><!-- .entry-content -->

<?php
if (isset($thebigshop_options['td_blog_author_info']) && ($thebigshop_options['td_blog_author_info'] == 1)) {
    if ('' !== get_the_author_meta('description')) {
        get_template_part('inc/biography');
    }
}