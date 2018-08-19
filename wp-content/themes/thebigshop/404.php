<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
global $thebigshop_options;
$thebigshop_pagelayout = 3;
if (isset($thebigshop_options['td-error-sidebar-position'])) {
    $thebigshop_pagelayout = $thebigshop_options['td-error-sidebar-position'];
}
$thebigshop_page_layout = thebigshop_layout_position($thebigshop_pagelayout);

get_header();
?>
<div class="container">
    <div class="row" >
        <div class="<?php echo esc_attr($thebigshop_page_layout[0]); ?>">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">

                    <section class="error-404 not-found">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'thebigshop'); ?></h1>
                        </header><!-- .page-header -->

                        <div class="page-content">
                            <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'thebigshop'); ?></p>
                            <?php get_search_form(); ?>
                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->

                </main><!-- .site-main -->
            </div><!-- .content-area -->
        </div>
        <div class="<?php echo esc_attr($thebigshop_page_layout[1]); ?> hidden-xs" > 
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<div class="container"> 
    <?php get_sidebar('content-bottom'); ?>
</div><!-- container --> 
<?php get_footer(); ?>
