<?php
global $thebigshop_options;
global $woocommerce;
/**
 * The template for displaying the header
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 */
$thebigshop_header_style = 1;
if (isset($thebigshop_options['td_header_style']))
    $thebigshop_header_style = $thebigshop_options['td_header_style'];
if (isset($_GET['header_style']))
    $thebigshop_header_style = $_GET['header_style'];
$thebigshop_page_id = 0;
if (is_front_page() && is_archive() && is_search()) {
    $thebigshop_page_id = get_option('page_for_posts');
} else {
    if (isset($post)) {
        $thebigshop_page_id = $post->ID;
    }
}
if (function_exists('is_woocommerce')) {
    if (is_shop() || is_product_category() || is_product_tag()) {
        $thebigshop_page_id = get_option('woocommerce_shop_page_id');
    }
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if (is_singular() && pings_open(get_queried_object())) : ?>
            <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php endif; ?>
        <?php if (isset($thebigshop_options['td_favicon']['url'])) { ?>
            <link rel="icon" href="<?php echo esc_url($thebigshop_options['td_favicon']['url']); ?>" type="image/x-icon" />
            <link rel="shortcut icon" href="<?php echo esc_url($thebigshop_options['td_favicon']['url']); ?>" type="image/x-icon" />
        <?php } ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="<?php if (isset($thebigshop_options['td_layout_style']) && ($thebigshop_options['td_layout_style'] == 1)) { ?>wrapper-wide <?php } else { ?> wrapper-box <?php } ?>" >
            <div id="header" class="<?php if ($thebigshop_header_style == 2) { ?> style2 <?php } elseif ($thebigshop_header_style == 3) { ?> style3 <?php } ?>" >

                <header class="header-row">
                    <div class="container">
                        <div class="table-container">
                            <nav class="htop col-md-9 pull-right flip inner" id="top">
                                <?php get_template_part('inc/header', 'top'); ?>
                            </nav>
                            <div class="col-table-cel col-md-3 col-sm-4 col-xs-12 inner">
                                <?php get_template_part('inc/header', 'logo'); ?>
                            </div>
                            <div class="col-md-4 col-md-push-5 col-sm-8 col-xs-12 inner">
                                <div class="links_contact pull-right flip">
                                    <ul>
                                        <?php if (isset($thebigshop_options['td-header-mobile'])) { ?><li class="mobile"><?php echo wp_kses_post($thebigshop_options['td-header-mobile']); ?></li><?php } ?>
                                        <?php if (isset($thebigshop_options['td-header-email'])) { ?><li class="email"><?php echo wp_kses_post($thebigshop_options['td-header-email']); ?></li><?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix visible-sm-block visible-xs-block"></div>
                            <div class="col-md-5 col-md-pull-4 col-sm-8 col-xs-12 inner2">
                                <div id="search" class="input-group">
                                    <?php
                                    if (class_exists('YITH_WCAS_Ajax_Search_Widget')) {
                                        echo do_shortcode('[yith_woocommerce_ajax_search]');
                                    } else {
                                        ?>
                                        <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">                              
                                            <div class="input-group btn-block">
                                                <input id="search" type="text" name="s" value="<?php the_search_query(); ?>" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'thebigshop'); ?>" class="form-control input-lg" />
                                                <button type="submit" class="button-search btn btn btn-primary"><i class="fa fa-search"></i></button>
                                            </div>                     
                                        </form> 
                                        <?php
                                    }
                                    ?> 
                                </div>
                            </div>
                            <div class="col-md-9 pull-right flip col-sm-4 col-xs-12 inner">  
                                <?php
                                if (function_exists('is_woocommerce')) {
                                    //thebigshop_top_cartblock();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </header>
                <?php
                $thebigshop_main_menu_style = 1;
                if (isset($thebigshop_options['td_main_menu_style']))
                    $thebigshop_main_menu_style = $thebigshop_options['td_main_menu_style'];
                if (isset($thebigshop_main_menu_style) && ($thebigshop_main_menu_style == 1)) {
                    ?>
                    <div class="container">
                    <?php } ?>
                    <?php if (has_nav_menu('primary')) { ?>

                        <nav id="menu" class="">
                              <div class="navbar-header"> <span class="visible-xs visible-sm">
                                    <?php esc_html_e('Menu', 'thebigshop'); ?> <i class="fa fa-align-justify pull-right flip"></i></span>
                              </div>
                            <?php if (isset($thebigshop_main_menu_style) && ($thebigshop_main_menu_style == 0)) { ?>
                                <div class="container">
                                <?php } ?>
                                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                                <?php
                                wp_nav_menu(array(
                                    'menu' => 'primary',
                                    'theme_location' => 'primary',
                                    'depth' => 0,
                                    'container' => '',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
                                    'container_class' => 'collapse navbar-collapse',
                                    'container_id' => 'bs-example-navbar-collapse-1',
                                    'menu_class' => 'nav navbar-nav',
                                    'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                                    'walker' => new wp_bootstrap_navwalker())
                                );
                                ?>
                                    </div>
                                <?php if (isset($thebigshop_main_menu_style) && ($thebigshop_main_menu_style == 0)) { ?>
                                </div>
                            <?php } ?>

                        </nav>
                    <?php } ?>
                    <?php if (isset($thebigshop_main_menu_style) && ($thebigshop_main_menu_style == 1)) { ?>
                    </div>
                <?php } ?>

            </div>   
            <div  <?php if (thebigshop_get_post_meta($thebigshop_page_id, "hide_page_margin") != "on"): ?> id="container" <?php endif; ?>>
                <?php
                if (is_front_page()) {
                    $header_custom_block = '';
                    if (isset($thebigshop_options['td-header-custom-feature']))
                        $header_custom_block = $thebigshop_options['td-header-custom-feature'];
                    if (isset($_GET['headercustomblock']))
                        $header_custom_block = $_GET['headercustomblock'];

                    if (isset($header_custom_block) && $header_custom_block == 1) {
                        if (isset($thebigshop_options['td-header-custom-feature-box'])) {
                            ?>
                            <div class="container">
                                <div class="custom-feature-box row">
                                    <?php echo wp_kses_post($thebigshop_options['td-header-custom-feature-box']); ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
                <?php if (thebigshop_get_post_meta($thebigshop_page_id, "hide_page_breadcrumb") != "on"): ?>
                    <?php thebigshop_breadcrumb(); ?>
                <?php endif; ?>
                <div id="content" class="site-content">