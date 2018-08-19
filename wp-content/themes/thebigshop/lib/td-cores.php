<?php
add_action('after_setup_theme', 'thebigshop_theme_setup');
if (!function_exists('thebigshop_theme_setup')) :

    function thebigshop_theme_setup() {
        global $thebigshop_options;
        add_theme_support('woocommerce');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        //Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        //Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

        // Enable support for Post Formats.
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'));

        // Make theme available for translation.
        load_theme_textdomain('thebigshop', get_template_directory() . '/languages');
        load_child_theme_textdomain('thebigshop', get_template_directory() . '/languages');


        add_image_size('thebigshop_homedefault', 200, 200, true);
        add_image_size('thebigshop_featured_image', 340, 200, true);
        add_image_size('thebigshop_featured_image_full', 848, 450, array( 'left', 'top' ));
        add_image_size('thebigshop_post_slider', 400, 200, true);
        add_image_size('thebigshop_portfolio_grid', 590, 300, true);
        add_image_size('thebigshop_homecatslider', 208, 185, true);
        add_image_size('thebigshop_categories_thumb', 848, 301, true);
        add_image_size('thebigshop_quickview_images', 438, 657, true);

        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'thebigshop'),
            'toplinks' => esc_html__('Top Links Menu', 'thebigshop'),
        ));

        add_editor_style();

        if (isset($thebigshop_options['td_woo_num_products_per_page'])) {
            add_filter('loop_shop_per_page', create_function('$cols', 'return ' . $thebigshop_options['td_woo_num_products_per_page'] . ';'));
        }
    }

endif; // thebigshop_setup

function thebigshop_post_navigation() {
    ?>
    <div class="nav-links">
        <div class="row">
            <div class="nav-previous col-xs-6">
                <?php echo get_previous_post_link('%link', '<span class="screen-reader-text">' . esc_html__("Previous post:", 'thebigshop') . '</span><span class="post-title"> %title </span>'); ?>
            </div>
            <div class="nav-next text-right col-xs-6">
                <?php echo get_next_post_link('%link', '<span class="screen-reader-text">' . esc_html__("Next Post:", 'thebigshop') . '</span><span class="post-title"> %title </span>'); ?>
                </a>
            </div>
        </div>
    </div>
    <?php
}

function thebigshop_pagination_nav($query) {
    global $paged;
    ?>
    <nav role="navigation" class="navigation pagination">

        <div class="nav-links">
            <?php
            echo paginate_links(array(
                'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'format' => '',
                'total' => $query->max_num_pages,
                'current' => max(1, $paged),
                'show_all' => false,
                'end_size' => 1,
                'mid_size' => 2,
                'prev_next' => true,
                'prev_text' => '',
                'next_text' => '',
                'type' => 'plain',
                'add_args' => false,
                'add_fragment' => '',
                'before_page_number' => '',
                'after_page_number' => ''));
            ?>
        </div>
    </nav>
    <?php
}

function thebigshop_breadcrumb() {
    if (!is_front_page()) {
        ?>
        <div class="container"> 
            <div class="breadcrumb" typeof="BreadcrumbList" vocab="http://schema.org/">
                <?php
                if (function_exists('bcn_display')) {
                    bcn_display_list();
                }
                ?>
            </div>
        </div>
        <?php
    }
}

function thebigshop_video($id) {
    global $thebigshop_options;
    ?>
    <iframe height="315" width="560" src="//www.youtube.com/embed/<?php echo esc_attr($id); ?>" allowfullscreen></iframe>
    <?php
}

add_filter('excerpt_length', 'thebigshop_excerpt_length', 999);

function thebigshop_excerpt_length($length) {
    return 16;
}

add_filter('excerpt_more', 'thebigshop_excerpt_more');

function thebigshop_excerpt_more($more) {
    return ' [.....]';
}

function thebigshop_content_more() {

   $redemore_link = '<a class="btn btn-default" href="' . esc_url(get_permalink()) . '">' . esc_html__("Read More", 'thebigshop') . '</a>';
   return $redemore_link;
}
add_filter('the_content_more_link', 'thebigshop_content_more');