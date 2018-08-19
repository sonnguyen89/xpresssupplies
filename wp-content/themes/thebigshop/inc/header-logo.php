<?php 
global $thebigshop_options;
?>
<div id="logo">
    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"  class="logo">
        <?php
        if (isset($thebigshop_options['td-switch-logo']) && ($thebigshop_options['td-switch-logo']==1)) {
            if (isset($thebigshop_options['td-textlogo'])){ echo esc_attr($thebigshop_options['td-textlogo']); }
        } else {
            if (isset($thebigshop_options['td_mainlogo']['url'])) {
                ?>
                <img class="img-responsive" src="<?php echo esc_url($thebigshop_options['td_mainlogo']['url']); ?>" alt="<?php bloginfo('name'); ?>" />
                <?php
            } else {
                 ?>
                <h1><?php bloginfo('name'); ?></h1> 
                <?php
            }
        }
        ?>
    </a>
    <?php
    if (isset($thebigshop_options['td-site-description']) && ($thebigshop_options['td-site-description']==1)) {
        $description = get_bloginfo('description', 'display');
        if ($description || is_customize_preview()) :
            ?>
            <p class="site-description"><?php echo wp_kses_post($description); ?></p>
            <?php
        endif;
    }
    ?>
</div>