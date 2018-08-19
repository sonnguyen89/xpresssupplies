<?php
/**
 * The template for displaying all single portfolio
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
global $thebigshop_options;
$thebigshop_pagelayout=3;
if(isset($thebigshop_options['td-protfolio-sidebar-position'])){
    $thebigshop_pagelayout=$thebigshop_options['td-protfolio-sidebar-position'];
}
$thebigshop_page_layout = thebigshop_layout_position($thebigshop_pagelayout);
get_header();
?>
<div class="container">
    <div class="row" >
        <div class="<?php echo esc_attr($thebigshop_page_layout[0]); ?>">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <?php
                    // Start the loop.
                    while (have_posts()) : the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            </header><!-- .entry-header -->

                            <?php thebigshop_excerpt(); ?>

                            <?php thebigshop_post_thumbnail(); ?>

                            <div class="entry-content">
                                <?php
                                the_content();
                                ?>
                                <?php
                                $infos = get_post_custom_values('portfolio_links');
                                if (isset($infos)) {
                                    ?><p class="portfolio-links"><a class="btn btn-primary" href="<?php echo  esc_url($infos[0]); ?>" target="_blank"><?php esc_html_e('Live Preview', 'thebigshop'); ?></a> <?php } ?>
                                   <?php do_action('thebigshop_portfolio_social_share'); ?>
                            </div><!-- .entry-content -->
                            <footer class="entry-footer">
                                <div class="tags-links">
                                    <?php
                                    $tags = get_the_term_list(get_the_ID(), 'td_portfolio_tag', '', ', ', '');
                                    if (isset($tags)) {
                                        ?>
                                        <span class="screen-reader-text"><?php esc_html_e('Tags', 'thebigshop'); ?>:</span> <?php echo wp_kses_post($tags); ?>
                                    <?php } ?>
                                </div>
                            </footer>
                            <?php
                            if (isset($thebigshop_options['td_portfolio_author']) && ($thebigshop_options['td_portfolio_author'] == 1)) {
                                if ('' !== get_the_author_meta('description')) {
                                    get_template_part('inc/biography');
                                }
                            }
                            ?>
                        <?php thebigshop_post_navigation(); ?>
                        </article><!-- #post-## -->
                        <?php
                        if (isset($thebigshop_options['td_portfolio_comments']) && ($thebigshop_options['td_portfolio_comments'] == 1)) {
                            comments_template();
                        }
                    endwhile;
                    ?>
                </main><!-- .site-main -->
            </div><!-- .content-area -->
        </div><!-- Col-9 -->
        <div class="<?php echo esc_attr($thebigshop_page_layout[1]); ?> hidden-xs" >
 <?php get_sidebar('portfolio'); ?>
        </div>
    </div><!-- row-->
</div><!-- container -->
<div class="container"> 
        <?php get_sidebar('content-bottom'); ?>
</div><!-- container -->  
<?php get_footer(); ?>
