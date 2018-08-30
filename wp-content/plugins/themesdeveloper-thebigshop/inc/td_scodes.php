<?php

//[td_product_categories]
function td_product_categories_block($atts, $content = "") {
    $atts = shortcode_atts(array(
        "title" => esc_html__('Top Categories', 'thebigshop'),
        'number' => null,
        'orderby' => 'name',
        'order' => 'ASC',
        'columns' => '4',
        'hide_empty' => 1,
        'parent' => '',
        'ids' => ''
            ), $atts);
    global $woocommerce_loop;

    if (isset($atts['ids'])) {
        $ids = explode(',', $atts['ids']);
        $ids = array_map('trim', $ids);
    } else {
        $ids = array();
    }

    $hide_empty = ( $atts['hide_empty'] == true || $atts['hide_empty'] == 1 ) ? 1 : 0;

    // get terms and workaround WP bug with parents/pad counts
    $args = array(
        'orderby' => $atts['orderby'],
        'order' => $atts['order'],
        'hide_empty' => $hide_empty,
        'include' => $ids,
        'pad_counts' => true,
        'child_of' => $atts['parent'],
        'meta_query' => array(
            array(
                'compare' => 'IN'
            )
        )
    );

    $product_categories = get_terms('product_cat', $args);
//print_r($product_categories);
    if ('' !== $atts['parent']) {
        $product_categories = wp_list_filter($product_categories, array('parent' => $atts['parent']));
    }

    if ($hide_empty) {
        foreach ($product_categories as $key => $category) {
            if ($category->count == 0) {
                unset($product_categories[$key]);
            }
        }
    }

    if ($atts['number']) {
        $product_categories = array_slice($product_categories, 0, $atts['number']);
    }

    $columns = absint($atts['columns']);
    $woocommerce_loop['columns'] = $columns;

    ob_start();

    // Reset loop/columns globals when starting a new loop
    $woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';

    if ($product_categories) {
        //woocommerce_product_loop_start();
        ?>
        <h3 class="small-title"><span><?php echo esc_attr($atts['title']); ?></span></h3>
        <div id="products-category" class="products-category owl-carousel">
            <?php
            foreach ($product_categories as $category) {
                /* wc_get_template( 'content-product_cat.php', array(
                  'category' => $category
                  ) ); */
                ?>
                <div <?php wc_product_cat_class(); ?>>
                    <a href="<?php echo esc_url(get_term_link($category->slug, 'product_cat')); ?>">

                        <?php
                        $small_thumbnail_size = apply_filters('single_product_small_thumbnail_size', 'thebigshop_homecatslider');
                        $dimensions = wc_get_image_size($small_thumbnail_size);
                        $thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);

                        if ($thumbnail_id) {
                            $image = wp_get_attachment_image_src($thumbnail_id, $small_thumbnail_size);
                            $image = $image[0];
                        } else {
                            $image = wc_placeholder_img_src();
                        }

                        if ($image) {
                            // Prevent esc_url from breaking spaces in urls for image embeds
                            // Ref: http://core.trac.wordpress.org/ticket/23605
                            $image = str_replace(' ', '%20', $image);

                            echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($category->name) . '" width="220" height="220" />';
                        }
                        ?>

                        <h3>
                            <?php
                            echo esc_attr($category->name);

                            if ($category->count > 0)
                                echo apply_filters('woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category);
                            ?>
                        </h3>
                    </a>
                </div><?php
            }
            ?>
        </div>
        <?php
        //woocommerce_product_loop_end();
    }
    ?>
    <script type="text/javascript">
        (function ($) {
            "use strict";
            $(document).ready(function ($) {
                $("#products-category").owlCarousel({
                    itemsCustom: [
                        [0, 1],
                        [380, 2],
                        [943, 3],
                        [1263, <?php echo esc_attr($columns); ?>],
                        [1360, <?php echo esc_attr($columns); ?>],
                        [1440, <?php echo esc_attr($columns); ?>],
                        [1680, <?php echo esc_attr($columns); ?>]
                    ], slideSpeed: 1000, rewindSpeed: 1000, autoPlay: false, stopOnHover: true, rewindNav: true, scrollPerPage: true, lazyLoad: true, navigation: true, pagination: true, navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']});
            });
        })(jQuery);
    </script>
    <?php
    woocommerce_reset_loop();


    return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
}

add_shortcode('td_product_categories', 'td_product_categories_block');

//[td_products_by_cat]
function td_products_by_slug_block($atts, $content = "") {
    extract(shortcode_atts(array(
        'per_page' => '8',
        'columns' => '4',
        'orderby' => 'date',
        'order' => 'ASC',
        'slug' => '', // Category Slugs
        'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    ), $atts));
    $term = array_map('sanitize_title', explode(',', $slug));
    $terms = get_term_by('slug', $slug, 'product_cat');
    $term_link = '';
    if (isset($terms->name)):
        $term_link = get_term_link($slug, 'product_cat');
    endif
    ?>
    <?php ob_start(); ?>
    <div>
        <div class="woocommerce recent-slider">
            <?php if ($terms->name != '') { ?><h3 class="small-title"><span><?php echo esc_attr($terms->name); ?> - <a href="<?php echo esc_url($term_link); ?>" class="viewall"><?php esc_html_e('view all', 'thebigshop') ?></a></span></h3> <?php } ?>
            <?php foreach ($term as $catterm) { ?>
                <div id="category-slider_<?php echo esc_attr($catterm); ?>" class="products-grid itemslider owl-carousel">
                <?php } ?>

                <?php
                $ordering_args = WC()->query->get_catalog_ordering_args($orderby, $order);
                $meta_query = WC()->query->get_meta_query();
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => 1,
                    'orderby' => $orderby,
                    'order' => $order,
                    'posts_per_page' => $per_page,
                    'meta_query' => $meta_query,
                    'tax_query' => array(
                        array(
                            'key' => '_visibility',
                            'value' => array('catalog', 'visible'),
                            'taxonomy' => 'product_cat',
                            'terms' => array_map('sanitize_title', explode(',', $slug)),
                            'field' => 'slug',
                            'operator' => $operator
                        )
                    )
                );
                $recent_products = new WP_Query($args);
                if ($recent_products->have_posts()) :
                    while ($recent_products->have_posts()) : $recent_products->the_post();
                        //wc_get_template_part('content', 'product');
                        get_template_part('inc/content', 'product');
                    endwhile;
                else :
                    ?>
                <?php
                endif;
                ?>
            </div>
            <?php //woocommerce_product_loop_end();   ?>
        </div>
    </div>
    <?php foreach ($term as $catterm) { ?>
        <script type="text/javascript">
            (function ($) {
                "use strict";
                $(document).ready(function ($) {
                    $("#category-slider_<?php echo esc_attr($catterm); ?>").owlCarousel({
                        itemsCustom: [
                            [0, 1],
                            [380, 2],
                            [943, 3],
                            [1263, <?php echo esc_attr($columns); ?>],
                            [1360, <?php echo esc_attr($columns); ?>],
                            [1440, <?php echo esc_attr($columns); ?>],
                            [1680, <?php echo esc_attr($columns); ?>]
                        ], slideSpeed: 1000, rewindSpeed: 1000, autoPlay: false, stopOnHover: true, rewindNav: true, scrollPerPage: true, lazyLoad: true, navigation: true, pagination: true, navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']});
                });
            })(jQuery);
        </script>
    <?php } ?>
    <?php wp_reset_postdata(); ?>
    <?php
    return ob_get_clean();
}

add_shortcode('td_products_by_category', 'td_products_by_slug_block');

//[td_best_selling_products]
function td_best_selling_products_block($atts, $content = "") {
    extract(shortcode_atts(array(
        "title" => esc_html__('Best Selling', 'thebigshop'),
        'per_page' => '8',
        'columns' => '4',
                    ), $atts));
    ?>
    <?php ob_start(); ?>
    <div>
        <div class="woocommerce recent-slider">
            <?php if ($title != '') { ?><h3 class="small-title"><span><?php echo esc_attr($title); ?></span></h3><?php } ?>
            <?php //woocommerce_product_loop_start();   ?>
            <div id="best-slider" class="products-grid itemslider owl-carousel">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'meta_key' => 'total_sales',
                    'ignore_sticky_posts' => 1,
                    'posts_per_page' => $per_page,
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                    'meta_query' => array(
                        array(
                            'key' => '_visibility',
                            'value' => array('catalog', 'visible'),
                            'compare' => 'IN'
                        )
                    )
                );

                $recent_products = new WP_Query($args);
                if ($recent_products->have_posts()) :
                    while ($recent_products->have_posts()) : $recent_products->the_post();
                        //wc_get_template_part('content', 'product');
                        get_template_part('inc/content', 'product');
                    endwhile;
                else :
                    ?>

                <?php
                endif;
                ?>
            </div>
            <?php //woocommerce_product_loop_end();   ?>
        </div>
    </div>
    <script type="text/javascript">
        (function ($) {
            "use strict";
            $(document).ready(function ($) {
                $("#best-slider").owlCarousel({
                    itemsCustom: [
                        [0, 1],
                        [380, 2],
                        [943, 3],
                        [1263, <?php echo esc_attr($columns); ?>],
                        [1360, <?php echo esc_attr($columns); ?>],
                        [1440, <?php echo esc_attr($columns); ?>],
                        [1680, <?php echo esc_attr($columns); ?>]
                    ], slideSpeed: 1000, rewindSpeed: 1000, autoPlay: false, stopOnHover: true, rewindNav: true, scrollPerPage: true, lazyLoad: true, navigation: true, pagination: true, navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']});
            });
        })(jQuery);
    </script>
    <?php wp_reset_postdata(); ?>
    <?php
    return ob_get_clean();
}

add_shortcode('td_best_selling_products', 'td_best_selling_products_block');

//[td_recent_products]
function td_recent_products_block($atts, $content = "") {
    extract(shortcode_atts(array(
        "title" => esc_html__('Recent Products', 'thebigshop'),
        'per_page' => '8',
        'columns' => '4',
        'category' => '', // Slugs
        'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    ), $atts));
    ?>
    <?php ob_start(); ?>
    <div>
        <div class="woocommerce recent-slider">

            <h3  class="small-title"><span><?php echo esc_attr($title); ?></span></h3>
            <div id="new-slider" class="products-grid itemslider owl-carousel">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => 1,
                    'posts_per_page' => $per_page,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'meta_query' => array(
                        array(
                            'key' => '_visibility',
                            'value' => array('catalog', 'visible'),
                            'compare' => 'IN'
                        )
                    )
                );

                $recent_products = new WP_Query($args);
                if ($recent_products->have_posts()) :
                    while ($recent_products->have_posts()) : $recent_products->the_post();
                        // wc_get_template_part('content', 'product');
                        get_template_part('inc/content', 'product');
                    endwhile;
                else :
                    ?>

                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        (function ($) {
            "use strict";
            $(document).ready(function ($) {
                $("#new-slider").owlCarousel({
                    itemsCustom: [
                        [0, 1],
                        [380, 2],
                        [943, 3],
                        [1263, <?php echo esc_attr($columns); ?>],
                        [1360, <?php echo esc_attr($columns); ?>],
                        [1440, <?php echo esc_attr($columns); ?>],
                        [1680, <?php echo esc_attr($columns); ?>]
                    ], slideSpeed: 1000, rewindSpeed: 1000, autoPlay: false, stopOnHover: true, rewindNav: true, scrollPerPage: true, lazyLoad: true, navigation: true, pagination: true, navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']});
            });
        })(jQuery);
    </script>
    <?php wp_reset_postdata(); ?>
    <?php
    return ob_get_clean();
}

add_shortcode('td_recent_products', 'td_recent_products_block');

//[td_featured_products]
function td_featured_products_block($atts, $content = "") {
    extract(shortcode_atts(array(
        "title" => esc_html__('Featured Products', 'thebigshop'),
        'per_page' => '8',
        'columns' => '4',
        'orderby' => 'date',
        'order' => 'DESC'
                    ), $atts));
    ?>
    <?php ob_start(); ?>


    <h3  class="small-title"><span><?php echo esc_attr($title); ?></span></h3>
    <div class="woocommerce owl-carousel" id="featured_slider">

        <?php
        //customize the function BEIGINING
        /*
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'meta_key' => '_featured',
            'meta_value' => 'yes',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => $per_page,
            'orderby' => $orderby,
            'order' => $order,
            'meta_query' => array(
                array(
                    'key' => '_visibility',
                    'value' => array('catalog', 'visible'),
                    'compare' => 'IN'
                )
            )
        );
        */

        $tax_query   = WC()->query->get_tax_query();
        $tax_query[] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
            'operator' => 'IN',
        );
         $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => $per_page,
            'orderby' => $orderby,
            'order' => $order,
            'tax_query' => $tax_query
        );

         //customize the function - END


        $featured_products = new WP_Query($args);
        if ($featured_products->have_posts()) :
            while ($featured_products->have_posts()) : $featured_products->the_post();
                //wc_get_template_part('content', 'product');
                get_template_part('inc/content', 'product');
            endwhile;
        else :
            ?>
        <?php
        endif;
        ?>
        <?php wp_reset_postdata(); ?>
    </div>
    <script type="text/javascript">
        (function ($) {
            "use strict";
            $(document).ready(function ($) {
                $("#featured_slider").owlCarousel({
                    itemsCustom: [
                        [0, 1],
                        [380, 2],
                        [943, 3],
                        [1263, <?php echo esc_attr($columns); ?>],
                        [1360, <?php echo esc_attr($columns); ?>],
                        [1440, <?php echo esc_attr($columns); ?>],
                        [1680, <?php echo esc_attr($columns); ?>]
                    ], slideSpeed: 1000, rewindSpeed: 1000, autoPlay: false, stopOnHover: true, rewindNav: true, scrollPerPage: true, lazyLoad: true, navigation: true, pagination: true, navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']});
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('td_featured_products', 'td_featured_products_block');

//[td_top_rated_products]
function td_top_rated_products_block($atts, $content = "") {
    global $woocommerce;
    global $woocommerce_loop;
    extract(shortcode_atts(array(
        "title" => esc_html__('Top Rated Products', 'thebigshop'),
        'per_page' => '8',
        'columns' => '4',
        'orderby' => 'title',
        'order' => 'asc'
                    ), $atts));
    ?>
    <?php ob_start(); ?>


    <h3  class="small-title"><span><?php echo esc_attr($title); ?></span></h3>
    <div class="woocommerce owl-carousel" id="toprated_slider">
        <?php
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => $per_page,
            'orderby' => $orderby,
            'order' => $order,
            'meta_query' => $woocommerce->query->get_meta_query()
        );
        add_filter('posts_clauses', array($woocommerce->query, 'order_by_rating_post_clauses'));
        $featured_products = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $args, $atts, 'top_rated_products'));
        //$featured_products = new WP_Query($args);
        if ($featured_products->have_posts()) :
            do_action("woocommerce_shortcode_before_top_rated_products_loop");
            while ($featured_products->have_posts()) : $featured_products->the_post();
                //wc_get_template_part('content', 'product');
                get_template_part('inc/content', 'product');
            endwhile;
            woocommerce_product_loop_end();
            do_action("woocommerce_shortcode_after_top_rated_products_loop");
        else :
            ?>

        <?php
        endif;
        // wp_reset_query();

        remove_filter('posts_clauses', array($woocommerce->query, 'order_by_rating_post_clauses'));
        ?>
    </div>
    <script type="text/javascript">
        (function ($) {
            "use strict";
            $(document).ready(function ($) {
                $("#toprated_slider").owlCarousel({
                    itemsCustom: [
                        [0, 1],
                        [380, 2],
                        [943, 3],
                        [1263, <?php echo esc_attr($columns); ?>],
                        [1360, <?php echo esc_attr($columns); ?>],
                        [1440, <?php echo esc_attr($columns); ?>],
                        [1680, <?php echo esc_attr($columns); ?>]
                    ], slideSpeed: 1000, rewindSpeed: 1000, autoPlay: false, stopOnHover: true, rewindNav: true, scrollPerPage: true, lazyLoad: true, navigation: true, pagination: true, navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']});
            });
        })(jQuery);
    </script>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

add_shortcode('td_top_rated_products', 'td_top_rated_products_block');

//[td_slider type="flaxslider/nivoslider" per_page="" cat="" order="" orderby=""]
function td_slider_blocks($atts, $content = "") {
    extract(shortcode_atts(array(
        'cat' => '',
        'type' => 'nivoslider',
        'per_page' => '8',
        'orderby' => 'date',
        'order' => 'ASC',
        'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    ), $atts));
    if (!empty($cat)) {
        $args = array(
            'post_type' => 'td_slider',
            'post_status' => 'publish',
            'posts_per_page' => $per_page,
            'orderby' => $orderby,
            'order' => $order,
            'tax_query' => array(
                array(
                    'taxonomy' => 'td_slider_cat',
                    'terms' => array_map('sanitize_title', explode(',', $cat)),
                    'field' => 'slug',
                    'operator' => $operator
                )
            )
        );
    } else {
        $args = array(
            'post_type' => 'td_slider',
            'post_status' => 'publish',
            'posts_per_page' => $per_page,
            'orderby' => $orderby,
            'order' => $order
        );
    }
    $slider_query = new WP_Query($args);
    ?>
    <?php ob_start(); ?>
    <?php if ($slider_query->have_posts()) : ?>
        <?php if (isset($type) && $type == 'flaxslider') { ?>
            <div class="slider-wrapper">
                <!-- Place somewhere in the <body> of your page -->
                <div class="flexslider">
                    <ul class="slides">
                        <?php while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
                            <?php if (has_post_thumbnail()): ?>
                                <li>

                                    <a class="slider-image" href="<?php echo get_post_meta(get_the_ID(), 'sliderlinks', true); ?> ">
                                        <?php the_post_thumbnail('full'); ?> 
                                    </a>
                                    <!--<h2 class="slider-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                                    <div class="slider-content"><?php the_content(); ?></div>-->
                                </li>
                            <?php endif; ?>
                        <?php endwhile; ?>  
                        <?php wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
        <?php }elseif(isset($type) && $type == 'owlslider'){ ?>   
                <div id="slideshowowl" class="owl-carousel slideshowhome">
                    <?php while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
                        <?php if (has_post_thumbnail()): ?>
                        <div class="item">
                            <a href="<?php echo get_post_meta(get_the_ID(), 'sliderlinks', true); ?>">
                                 <?php the_post_thumbnail('full'); ?> 
                            </a>
                        </div>
                        <?php endif; ?>
                    <?php endwhile; ?>  
                    <?php wp_reset_postdata(); ?>
                </div>
        <?php  }else { ?>
                <div class="slider-wrapper">
                    <div id="slideshownivo" class="nivoSlider">
                        <?php while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php echo get_post_meta(get_the_ID(), 'sliderlinks', true); ?> ">
                                    <?php //the_post_thumbnail('full', array('title'=> trim(strip_tags( get_the_title() ))));  ?> 
                                    <?php the_post_thumbnail('full'); ?> 
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>  
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
        <?php } ?>
    <?php else : ?>
        <p><?php esc_html__('Sorry, no posts matched your criteria.', 'moderns'); ?></p>
    <?php endif; ?>

    <?php
    return ob_get_clean();
}

add_shortcode('td_slider', 'td_slider_blocks');

//[td_posts title="" columns="" per_page="" order="" orderby=""]
function td_recent_post($atts, $content = "") {
    extract(shortcode_atts(array(
        "title" => esc_html__('Latest News', 'thebigshop'),
        'columns' => '4',
        'per_page' => '12',
        'orderby' => 'date',
        'order' => 'DESC'
                    ), $atts));
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page' => $per_page,
        'orderby' => $orderby,
        'order' => $order,
    );
    ?>
    <?php ob_start(); ?>
    <?php
    $getlatestpost = new WP_Query($args);
    if ($getlatestpost->have_posts()) :
        ?>
        <h3 class="small-title"><span><?php echo esc_attr($title); ?></span></h3>
        <div id="home-recent-post" class="home-recent-post owl-carousel">
            <?php while ($getlatestpost->have_posts()) : $getlatestpost->the_post(); ?>

                <div class="product-thumb clearfix">
                    <div class="image"><a href="<?php the_permalink() ?>"> <?php the_post_thumbnail('thebigshop_post_slider', array('class' => 'img-responsive')); ?></a></div>
                    <div class="caption">
                        <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                    </div>
                    <?php the_excerpt(); ?>
                    <div class="post-date">
                        <span class="post-date-day"><?php echo get_the_date('d', get_the_ID()); ?></span>
                        <span class="post-date-month"><?php echo get_the_date('M', get_the_ID()); ?></span>
                    </div>

                    <p class="comments-link">
                        <?php
                        $comments_count = wp_count_comments(get_the_ID());
                        echo $comments_count->total_comments . '&nbsp;' . esc_html__('Comments', 'thebigshop');
                        ?>
                    </p>


                </div>
            <?php endwhile; ?>

        </div>

    <?php else : ?>
        <p><?php esc_html__('Sorry, no Post matched your criteria.', 'thebigshop'); ?></p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    <script type="text/javascript">
        (function ($) {
            "use strict";
            $(document).ready(function ($) {
                $("#home-recent-post").owlCarousel({
                    itemsCustom: [
                        [0, 1],
                        [380, 2],
                        [943, 3],
                        [1263, <?php echo esc_attr($columns); ?>],
                        [1360, <?php echo esc_attr($columns); ?>],
                        [1440, <?php echo esc_attr($columns); ?>],
                        [1680, <?php echo esc_attr($columns); ?>]
                    ], slideSpeed: 1000, rewindSpeed: 1000, autoPlay: false, stopOnHover: true, rewindNav: true, scrollPerPage: true, lazyLoad: true, navigation: true, pagination: true, navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']});
            });
        })(jQuery);
    </script>
    <?php
    //wp_reset_query();
    return ob_get_clean();
}

add_shortcode('td_posts', 'td_recent_post');

//[td_portfolio_grid_slider]
//[td_portfolio_grid_slider cat="" title="" columns="" per_page="" order="" orderby=""]
function td_portfolio($atts, $content = "") {
    extract(shortcode_atts(array(
        "title" => esc_html__('Latest Works', 'thebigshop'),
        'columns' => '4',
        'per_page' => '8',
        'cat' => '',
        'orderby' => 'date',
        'order' => 'DESC'
                    ), $atts));
    ?>
    <?php ob_start(); ?>
    <?php
    global $thebigshop_options, $paged;
    ///$portfolio = new WP_Query("post_type=td_portfolio&post_status=publish&order='" . $order . "'");
    $portfolio_cat = array_map('sanitize_title', explode(',', $cat));
    $relation = array();
    if ($cat != '') {
        $relation = array('relation' => 'OR', array('taxonomy' => "td_portfolio_tag", 'field' => 'slug', 'terms' => $portfolio_cat), array('taxonomy' => "td_portfolio_tag", 'field' => 'id', 'terms' => $portfolio_cat));
    }
    //print_r($relation);
    $query_portfolio = new WP_Query(array('post_type' => 'td_portfolio', 'posts_per_page' => $per_page, 'paged' => $paged, 'tax_query' => $relation));
    if ($query_portfolio->have_posts()) :
        ?>
        <?php if ($title != '') { ?> <h3 class="small-title"><span><?php echo esc_attr($title); ?></span></h3><?php } ?>
        <div class="portfolio-list owl-carousel" id="portfolio-list">
            <?php while ($query_portfolio->have_posts()) : $query_portfolio->the_post(); ?>
                <?php
                $infos = get_post_custom_values('portfolio_links');
                // print_r($infos);
                ?>
                <div class="portfolio-item product-thumb">
                    <div class="thumb">
                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thebigshop_post_slider', array('class' => 'img-responsive')); ?></a>
                        <p class="links">
                            <?php if (isset($infos)) { ?>
                                <a class="btn btn-primary" href="<?php echo esc_url($infos[0]); ?>" target="_blank"><?php esc_html_e('Live Preview', 'thebigshop'); ?></a>
                            <?php } ?>
                            <a href="<?php the_permalink() ?>" class="btn btn-primary"><?php esc_html_e('More Details', 'thebigshop'); ?></a>
                        </p>
                    </div>
                    <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                    <?php
                    $tags = get_the_term_list(get_the_ID(), 'td_portfolio_tag', '', ', ', '');
                    if (isset($tags)) {
                        echo '<p class="portfolio_tags small-size">' . $tags . '</p>';
                    }
                    ?>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    <?php else : ?>
        <p><?php esc_html__('Sorry, no portfolio matched your criteria.', 'thebigshop'); ?></p>
    <?php endif; ?>
    <script type="text/javascript">
        (function ($) {
            "use strict";
            $(document).ready(function ($) {
                $(".portfolio-list").owlCarousel({
                    itemsCustom: [
                        [0, 1],
                        [380, 2],
                        [943, 3],
                        [1263, <?php echo esc_attr($columns); ?>],
                        [1360, <?php echo esc_attr($columns); ?>],
                        [1440, <?php echo esc_attr($columns); ?>],
                        [1680, <?php echo esc_attr($columns); ?>]
                    ], slideSpeed: 1000, rewindSpeed: 1000, autoPlay: false, stopOnHover: true, rewindNav: true, scrollPerPage: true, lazyLoad: true, navigation: true, pagination: true, navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']});
            });
        })(jQuery);
    </script>

    <?php
    return ob_get_clean();
}

add_shortcode('td_portfolio_grid_slider', 'td_portfolio');

//[td_portfolio_grid]
//[td_portfolio_grid cat="" title="" columns="" per_page="" order="" orderby=""]
function td_portfolio_grid_layout($atts, $content = "") {
    extract(shortcode_atts(array(
        "title" => '',
        'cat' => '',
        'per_page' => '10',
        'col' => '',
        'orderby' => 'date',
        'order' => 'DESC',
        'filter' => '0',
        'filter_align' => 'center'
                    ), $atts));
    ?>
    <?php ob_start(); ?>
    <?php
    global $thebigshop_options, $paged;
    $td_portfolio_col = 4;
    if (isset($thebigshop_options['td-portfolio-col-per-row'])) {
        $td_portfolio_col = $thebigshop_options['td-portfolio-col-per-row'];
    }
    if (isset($col)) {
        $td_portfolio_col = $col;
    }
    if ($td_portfolio_col == 1) {
        $parrow_class = 'col-sm-12';
    } elseif ($td_portfolio_col == 3) {
        $parrow_class = 'col-sm-4';
    } elseif ($td_portfolio_col == 4) {
        $parrow_class = 'col-sm-3';
    } else {
        $parrow_class = 'col-sm-6';
    }

    $portfolio_cat = array_map('sanitize_title', explode(',', $cat));
    $relation = array();
    if ($cat != '') {
        $relation = array('relation' => 'OR', array('taxonomy' => "td_portfolio_tag", 'field' => 'slug', 'terms' => $portfolio_cat), array('taxonomy' => "td_portfolio_tag", 'field' => 'id', 'terms' => $portfolio_cat));
    }
    //print_r($relation);
    $query_portfolio = new WP_Query(array('post_type' => 'td_portfolio', 'posts_per_page' => $per_page, 'paged' => $paged, 'tax_query' => $relation));
    // $query_portfolio = new WP_Query(array('post_type' => 'td_portfolio', 'posts_per_page' => $per_page, 'paged' => $paged, 'tax_query' => array(array('taxonomy' => "td_portfolio_tag", 'field' => 'slug', 'terms' => $portfolio_cat))));

    if ($query_portfolio) :
        ?>

        <?php if ($title != '') { ?> <h3 class="small-title"><span><?php echo esc_attr($title); ?></span></h3><?php } ?>
        <?php
        if (isset($filter) && ($filter == 1)) {
            $terms = get_terms("td_portfolio_tag");
            $count = count($terms);
            //print_r($terms);
            ?>
            <ul id="portfolio-filter" style="text-align:<?php echo esc_attr($filter_align); ?>!important;">
                <li><a href="#all" title=""><?php esc_html_e('All', 'thebigshop'); ?></a></li>
                <?php
                if ($count > 0) {
                    foreach ($terms as $term) {
                        $termname = strtolower($term->name);
                        $termname = str_replace(' ', '-', $termname);
                        foreach ($portfolio_cat as $portfolio_selcat) {
                            if ($termname == $portfolio_selcat) {
                                echo '<li><a href="#' . $termname . '" title="" rel="' . $termname . '">' . $term->name . '</a></li>';
                            }
                        }
                    }
                }
                echo "</ul>";
            }
            ?>
            <div class="portfolio-wrapper">
                <div id="portfolio-wrapper">
                    <ul id="portfolio-list">
                        <?php
                        while ($query_portfolio->have_posts()) : $query_portfolio->the_post();

                            $terms = get_the_terms($query_portfolio->ID, 'td_portfolio_tag');
                            $tax = '';
                            if ($terms && !is_wp_error($terms)) :
                                $links = array();
                                foreach ($terms as $term) {
                                    $links[] = $term->name;
                                }
                                $links = str_replace(' ', '-', $links);
                                $tax = join(" ", $links);

                            endif;
                            $infos = get_post_custom_values('portfolio_links');
                            // print_r($infos);
                            ?>
                            <li class="portfolio-item <?php echo strtolower($tax); ?> all <?php echo esc_attr($parrow_class); ?>">
                                <div class="thumb">
                                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thebigshop_portfolio_grid', array('class' => 'img-responsive')); ?></a>
                                    <p class="links">
                                        <?php if (isset($infos)) { ?>
                                            <a class="btn btn-primary" href="<?php echo esc_url($infos[0]); ?>" target="_blank"><?php esc_html_e('Live Preview', 'thebigshop'); ?></a>
                                        <?php } ?>
                                        <a href="<?php the_permalink() ?>" class="btn btn-primary"><?php esc_html_e('More Details', 'thebigshop'); ?></a>
                                    </p>
                                </div>
                                <?php if (isset($thebigshop_options['td_portfolio_title']) && ($thebigshop_options['td_portfolio_title'] == 1)) { ?>
                                    <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                                    <?php
                                }if (isset($thebigshop_options['td_portfolio_cat']) && ($thebigshop_options['td_portfolio_cat'] == 1)) {
                                    $tags = get_the_term_list(get_the_ID(), 'td_portfolio_tag', '', ', ', '');
                                    if (isset($tags)) {
                                        echo '<p class="portfolio_tags small-size">' . $tags . '</p>';
                                    }
                                }
                                if (isset($thebigshop_options['td_portfolio_excerpt']) && ($thebigshop_options['td_portfolio_excerpt'] == 1)) {
                                    ?>
                                    <p class="excerpt"><a href="<?php the_permalink() ?>"><?php echo get_the_excerpt(); ?></a></p>
                                <?php } ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        <?php else : ?>
            <p><?php esc_html__('Sorry, no portfolio matched your criteria.', 'thebigshop'); ?></p>
        <?php endif; ?>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_portfolio_grid', 'td_portfolio_grid_layout');

    function td_our_team_members($atts, $content = "") {
        extract(shortcode_atts(array(
            "avater" => '',
            'name' => '',
            'role' => '',
            'link' => '#',
            'biography' => '',
            'class' => 'col-md-4 col-sm-6',
            'id' => ''
                        ), $atts));
        ob_start();
        if (wp_get_attachment_image_src($avater, "large")):
            $img = wp_get_attachment_image_src($avater, "large");
            $avater = $img[0];
        endif;
        ?>
        <div class="<?php echo esc_attr($class); ?>" id="<?php echo esc_attr($id); ?>">
            <div class="our-team">
                <div class="pic">
                    <img src="<?php echo esc_url($avater); ?>" alt="<?php echo esc_attr($name); ?>">
                    <div class="social_media_team">
                        <p class="description">
                            <?php echo esc_attr($biography); ?>
                        </p>
                        <ul class="team_social">
                            <?php echo do_shortcode($content); ?>
                        </ul>
                    </div>
                </div>
                <div class="team-prof">
                    <h3 class="post-title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_attr($name); ?></a></h3>
                    <span class="post"><?php echo esc_attr($role); ?></span>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_team', 'td_our_team_members');

    function td_testimonial_slider_block($atts, $content = "") {
        ob_start();
        ?>
        <div id="testimonial-slider" class="owl-carousel ">
            <?php echo do_shortcode($content); ?>
        </div>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_testimonial_slide', 'td_testimonial_slider_block');

    function td_testimonial($atts, $content = "") {
        extract(shortcode_atts(array(
            "avater" => '',
            'name' => '',
            'role' => '',
            'link' => '#',
            'biography' => '',
            'class' => 'col-md-4 col-sm-6',
            'id' => ''
                        ), $atts));
        ob_start();
        if (wp_get_attachment_image_src($avater, "large")):
            $img = wp_get_attachment_image_src($avater, "large");
            $avater = $img[0];
        endif;
        ?>
        <div class="testimonial">
            <div class="testimonial-profile">
                <a href="<?php echo esc_url($link); ?>"><img src="<?php echo esc_url($avater); ?>" alt="<?php echo esc_attr($name); ?>"></a>
            </div>
            <div class="testimonial-content">
                <p class="testimonial-description">
                    <?php echo esc_attr($biography); ?>
                </p>
                <h3 class="testimonial-title"><a href="<?php echo esc_url($link); ?>"><?php echo esc_attr($name); ?></a></h3>
                <span class="testimonial-post"><?php echo esc_attr($role); ?></span>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_testimonial', 'td_testimonial');

    function td_pricing_column($atts, $content = "") {
        extract(shortcode_atts(array(
            "title" => '',
            'short' => '',
            'class' => 'col-md-3 col-sm-6',
            'hclass' => '',
            'id' => ''
                        ), $atts));
        ob_start();
        ?>
        <div class="<?php echo esc_attr($class); ?>">
            <div class="pricingTable <?php echo esc_attr($hclass); ?>">
                <div class="pricingTable-header">
                    <span class="heading">
                        <h3><?php echo esc_attr($title); ?></h3>
                        <span><?php echo esc_attr($short); ?></span>
                    </span>
                </div>
                <?php echo do_shortcode($content); ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_pricing_column', 'td_pricing_column');

    function td_price_info($atts, $content = "") {
        extract(shortcode_atts(array(
            "cost" => '',
                        ), $atts));
        ob_start();
        ?>
        <span class="price-value"><span><?php echo esc_attr($cost); ?></span><span class="mo"><?php echo do_shortcode($content); ?></span></span>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_price_info', 'td_price_info');

    function td_serviceBox($atts, $content = "") {
        extract(shortcode_atts(array(
            "title" => esc_html__('Web Development', 'thebigshop'),
            "col" => 'col-sm-4',
            "class" => 'text-center',
            "style" => 'style-01',
            "icon" => '',
            "icon_color" => '',
            "button_text" => esc_html__('Read More', 'thebigshop'),
            'button_class' => 'btn-primary',
            'link' => '#',
                        ), $atts));
        ob_start();
        ?>
        <div class="<?php echo esc_attr($col); ?>">
            <div class="featured-box <?php echo esc_attr($class); ?>"> <i style='color:<?php echo esc_attr($icon_color); ?>' class="featured-icon fa <?php echo esc_attr($icon); ?>"></i>
                <?php if (isset($style) && ($style == 'style-01')) { ?><div class="feature-content"> <?php } ?>
                    <h4><?php echo esc_attr($title); ?></h4>
                    <p><?php echo do_shortcode($content); ?></p>
                    <a class="btn btn-sm <?php echo esc_url($button_class); ?>" href="<?php echo esc_url($link); ?>"><?php echo esc_attr($button_text); ?></a>
                    <?php if (isset($style) && ($style == 'style-01')) { ?></div><?php } ?>
            </div>
        </div>
        <?php
    }

    add_shortcode('td_service', 'td_serviceBox');

    function td_brand_carousel($atts, $content = "") {
        ob_start();
        ?>
        <!-- Brand Logo Carousel Start-->
        <div id="brand-slider" class="owl-carousel nxt">
            <?php echo do_shortcode($content); ?>
        </div>
        <!-- Brand Logo Carousel End -->
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_brand_carousel', 'td_brand_carousel');

    function td_brand_logo($atts, $content = "") {
        extract(shortcode_atts(array(
            "img" => '',
            'name' => '',
            'link' => '#',
                        ), $atts));
        ob_start();
        if (wp_get_attachment_image_src($img, "large")):
            $imges = wp_get_attachment_image_src($img, "large");
            $img = $imges[0];
        endif;
        ?>
        <div class="item text-center">
            <a href="<?php echo esc_url($link); ?>"><img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($name); ?>" class="img-responsive" /></a>
        </div>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_brand', 'td_brand_logo');

    function td_container($atts, $content = "") {
        ob_start();
        ?>
        <div class="container">
            <?php echo do_shortcode($content); ?>
        </div>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_container', 'td_container');

    function td_row($atts, $content = "") {
        ob_start();
        ?>
        <div class="row">
            <?php echo do_shortcode($content); ?>
        </div>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_row', 'td_row');

    function td_column($atts, $content = "") {
        extract(shortcode_atts(array(
            'col' => '',
            'class' => '',
                        ), $atts));
        ob_start();
        ?>
        <div class="col-sm-<?php echo esc_attr($col); ?> <?php echo esc_attr($class); ?>">
            <?php echo do_shortcode($content); ?>
        </div>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_column', 'td_column');

    function td_social_icons($atts, $content = "") {
        extract(shortcode_atts(array(
            'link' => 'http://facebook.com/themesdeveloper',
            'icon' => 'fa-facebook',
                        ), $atts));
        ob_start();
        ?>
        <li><a href="<?php echo esc_url($link); ?>"><i class="fa <?php echo esc_attr($icon); ?>"></i></a></li>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_social_icon', 'td_social_icons');

//[td_banner_grid]
    function td_banner_grid_wrap($atts, $content = "") {
        ob_start();
        ?>
        <div class="bigshop-banner">
            <div class="row">
                <?php echo do_shortcode($content); ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_banner_grid', 'td_banner_grid_wrap');

//[td_banner]
    function td_image_banner($atts, $content = "") {
        extract(shortcode_atts(array(
            "title" => '',
            'link' => '#',
            'col' => 'col-md-4',
            'style' => 'style-01',
            'img_url' => '',
            'text_button' => '',
                        ), $atts));
        ob_start();
        if (wp_get_attachment_image_src($img_url, "large")):
            $img = wp_get_attachment_image_src($img_url, "large");
            $img_url = $img[0];
        endif;
        ?>
        <?php if (isset($style) && ($style == 'style-01')) { ?>
            <div class="col-lg-<?php echo esc_attr($col); ?> col-md-<?php echo esc_attr($col); ?> col-sm-6 col-xs-12 moderns"><a href="<?php echo esc_url($link); ?>"><img title="<?php echo esc_attr($title); ?>" alt="<?php echo esc_attr($title); ?>" src="<?php echo esc_url($img_url); ?>"></a></div>
        <?php } elseif (isset($style) && ($style == 'style-02')) { ?>
            <div class="<?php echo esc_attr($col); ?> col-sm-6 col-xs-12 <?php echo esc_attr($style); ?>">
                <div class="box">
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>">
                    <div class="box-content">
                        <h3 class="title"><?php echo esc_attr($title); ?></h3>
                        <p class="description">  <?php echo do_shortcode($content); ?></p>
                        <a href="<?php echo esc_url($link); ?>" class="read"><?php echo esc_attr($text_button); ?></a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_banner', 'td_image_banner');

    function td_button($atts, $content = "") {
        extract(shortcode_atts(array(
            "link" => '#',
            "class" => 'button-primary',
            "style" => '',
                        ), $atts));
        ob_start();
        ?>
        <a class="btn <?php echo esc_attr($class); ?> <?php echo esc_attr($style); ?>" href="<?php echo esc_url($link); ?>"><?php echo do_shortcode($content); ?></a>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_button', 'td_button');

    function td_heading_title($atts, $content = "") {
        extract(shortcode_atts(array(
            "class" => 'small-title',
                        ), $atts));
        ob_start();
        ?>
        <h3 class="<?php echo esc_attr($class); ?>"><?php echo do_shortcode($content); ?></h3>
        <?php
        return ob_get_clean();
    }

    add_shortcode('td_heading', 'td_heading_title');


/* Tabs Shortcodes --- */

if (!function_exists('td_tabs')) {
	function td_tabs( $atts, $content = null ) {
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );

		STATIC $i = 0;
		$i++;

		// Extract the tab titles for use in the tab widget.
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );

		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }

		$output = '';

		if( count($tab_titles) ){
		    $output .= '<div id="product-tab-'. $i .'" class="product-tab">';
			$output .= '<ul id="tabs-'. $i .'" class="tabs clearfix">';

			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#td-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}

		    $output .= '</ul>';
		    $output .= do_shortcode( $content );
		    $output .= '</div>
<script>
(function ($) {
    "use strict";   

 jQuery(function ($) {
 
    $("#product-tab-'. $i .' .tab_content").addClass("deactive");
    $("#product-tab-'. $i .' .tab_content:first").show();
    //Default Action
    $("ul#tabs-'. $i .' li:first").addClass("active").show(); //Activate first tab
    //On Click Event
    $("ul#tabs-'. $i .' li").click(function() {
        $("ul#tabs-'. $i .' li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
	$("#product-tab-'. $i .' .tab_content").hide(); 
        var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
        $(activeTab).fadeIn(); //Fade in the active content
        return false;
    });
});
})(jQuery);</script>';
		} else {
			$output .= do_shortcode( $content );
		}

		return $output;
	}
	add_shortcode( 'td_tabs', 'td_tabs' );
}

if (!function_exists('td_tab')) {
	function td_tab( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		return '<div id="td-tab-'. sanitize_title( $title ) .'" class="tab_content">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'td_tab', 'td_tab' );
}

    