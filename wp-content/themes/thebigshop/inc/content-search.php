<?php
/**
 * The template part for displaying results in search pages
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
    </header><!-- .entry-header -->
    <?php thebigshop_post_thumbnail(); ?>
    <?php thebigshop_excerpt(); ?>
    <?php if ('post' === get_post_type()) : ?>
        <footer class="entry-footer">
            <?php thebigshop_entry_meta(); ?>
            <?php thebigshop_post_edit_link(); ?>
        </footer><!-- .entry-footer -->
    <?php else : ?>
        <?php thebigshop_post_edit_link(); ?>
    <?php endif; ?>
</article><!-- #post-## -->

