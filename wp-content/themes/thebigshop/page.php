<?php
$thebigshop_pagelayout = "left";
$thebigshop_pagelayout = thebigshop_get_post_meta($post->ID, "tdtheme_page_sidebar_position");

if (isset($_GET['side'])) { $thebigshop_pagelayout = $_GET['side']; }
$thebigshop_page_layout = thebigshop_layout_position($thebigshop_pagelayout);


get_header();
?>
<div class="container"> 
    <div class="row" >
        <div class="<?php echo esc_attr($thebigshop_page_layout[0]); ?>">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">  
                    <?php if (!is_home() && !is_front_page()) : ?>
                        <?php if (thebigshop_get_post_meta($post->ID, "hide_page_title") != "on"): ?>
                            <header class="entry-header">
                                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            </header><!-- .entry-header -->
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php
                    // Start the loop.
                    while (have_posts()) : the_post();
                        // Include the page content template.
                        get_template_part('inc/content', 'page');

                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                    // End the loop.
                    endwhile;
                    ?>
                </main><!-- .site-main -->
            </div><!-- .content-area -->
        </div><!-- Col-9 -->   
        <div class="<?php echo esc_attr($thebigshop_page_layout[1]); ?> hidden-xs" > 
            <?php get_sidebar(); ?>
        </div>
    </div><!-- row-->
</div><!-- container --> 
<?php if (is_front_page()) { ?>
<div class="container"> 
        <?php get_sidebar('content-bottom'); ?>
</div><!-- container --> 
<?php } ?>
<?php get_footer(); ?>