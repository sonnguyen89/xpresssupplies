<?php
/**
  Template Name: Portfolio

 * The template for displaying the portfolio
 *
 *
 * @package ThemesDeveloper
 * @subpackage thebigshop
 * @since 1.0
 * @TheBigshop 1.0
 * 
 */
global $thebigshop_options, $paged;

$thebigshop_pagelayout = thebigshop_get_post_meta($post->ID,"tdtheme_page_sidebar_position");
if(isset($_GET['side'])){ $thebigshop_pagelayout=$_GET['side']; }
$thebigshop_page_layout = thebigshop_layout_position($thebigshop_pagelayout);

// TheBigshop Post PerPage
$thebigshop_posts_per_page = get_option('posts_per_page');
if (isset($thebigshop_options['td_portfolio_par_pages'])){
    $thebigshop_posts_per_page = $thebigshop_options['td_portfolio_par_pages'];
}
// TheBigshop portfolio Column manage
$thebigshop_portfolio_col = 2;
if (isset($thebigshop_options['td-portfolio-col-per-row'])){
    $thebigshop_portfolio_col = $thebigshop_options['td-portfolio-col-per-row'];
}

if(isset($_GET['col'])){ $thebigshop_portfolio_col=$_GET['col']; }

if ($thebigshop_portfolio_col == 1) {
    $thebigshop_parrow_class = 'col-sm-12';
} elseif ($thebigshop_portfolio_col == 3) {
    $thebigshop_parrow_class = 'col-sm-4';
} elseif ($thebigshop_portfolio_col == 4) {
    $thebigshop_parrow_class = 'col-sm-3';
} else {
    $thebigshop_parrow_class = 'col-sm-6';
}

get_header();
?>
<div class="container">
    <div class="row" >
        <div class="<?php echo esc_attr($thebigshop_page_layout[0]); ?>" >
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <?php if (thebigshop_get_post_meta($post->ID,"hide_page_title") != "on"): ?>
                        <header class="entry-header">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        </header><!-- .entry-header -->
                    <?php endif; ?>
                    <?php
                    if (isset($thebigshop_options['td_portfolio_category']) && ($thebigshop_options['td_portfolio_category'] == 1)) {
                        $args = array( 'hide_empty=0' );
                        $terms = get_terms("td_portfolio_tag",$args);
                        $count = count($terms);
                        //print_r($terms);
                        ?>
                        <ul id="portfolio-filter">
                            <li><a href="#all" title=""><?php esc_html_e('All', 'thebigshop'); ?></a></li>
                            <?php
                            if ($count > 0) {
                                foreach ($terms as $term) {
                                    $termname = strtolower($term->name);
                                    $termname = str_replace(' ', '-', $termname);
                                    echo '<li><a href="#' . $termname . '" title="" rel="' . $termname . '">' . $term->name . '</a></li>';
                                }
                            }
                            echo "</ul>";
                        }
                        $query_portfolio = new WP_Query(array('post_type' => 'td_portfolio', 'posts_per_page' => $thebigshop_posts_per_page, 'paged' => $paged, 'tax_query' => array()));
                        $count = 0;
                        ?>       
                        <div id="portfolio-wrapper">
                            <ul id="portfolio-list" class="clearfix">
                                <?php
                                if ($query_portfolio) :
                                    while ($query_portfolio->have_posts()) : $query_portfolio->the_post();
                                        ?>
                                        <?php
                                        $terms = get_the_terms($post->ID, 'td_portfolio_tag');
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
                                        ?>
                                        <li class="portfolio-item <?php echo strtolower($tax); ?> all <?php echo esc_attr($thebigshop_parrow_class); ?>">
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
                                            $tags = get_the_term_list($post->ID, 'td_portfolio_tag', '', ', ', '');
                                            if (isset($tags)) {
                                                echo '<p class="portfolio_tags small-size">' . $tags . '</p>';
                                            }}
                                            if (isset($thebigshop_options['td_portfolio_excerpt']) && ($thebigshop_options['td_portfolio_excerpt'] == 1)) {
                                                ?>
                                                <p class="excerpt"><a href="<?php the_permalink() ?>"><?php echo get_the_excerpt(); ?></a></p>
                                            <?php } ?>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                                <?php
                            else:
                                get_template_part('content', 'none');
                            endif;
                            ?>                 
                        </div>
                        <?php
                        if ($query_portfolio->max_num_pages > 1) {
                            thebigshop_pagination_nav($query_portfolio);
                        }
                        ?>
                </main><!-- .site-main -->
            </div><!-- .content-area -->
        </div>
        <div class="<?php echo esc_attr($thebigshop_page_layout[1]); ?> hidden-xs" > 
            <?php get_sidebar('portfolio'); ?>
        </div>
    </div><!-- row-->
</div><!-- container --> 
<div class="container"> 
        <?php get_sidebar('content-bottom'); ?>
</div><!-- container -->  
<?php get_footer(); ?>