<?php
global $thebigshop_options;

if (has_nav_menu('toplinks') || function_exists('icl_get_languages') || class_exists('woocommerce_wpml')) : ?>
    <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
<?php endif; ?>     
<?php if (function_exists('is_woocommerce')) { ?>  
    <div id="top-links" class="nav pull-right flip">
        <ul>
            <?php
            $my_account_page_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
            if (is_user_logged_in()) :
                $current_user = wp_get_current_user();
                ?>
                <li><a href="<?php echo esc_url($my_account_page_url); ?>"><span><?php esc_html_e('Welcome', 'thebigshop'); ?></span> <?php echo esc_attr($current_user->display_name); ?></a></li>
                <li><a href="<?php echo esc_url($my_account_page_url); ?>"><?php esc_html_e('My Account', 'thebigshop'); ?></a></li>
                <li><a href="<?php echo esc_url(wp_logout_url(esc_url(home_url('/')))); ?>"><?php esc_html_e('Logout', 'thebigshop'); ?></a></li>
            <?php else: ?>
                <li><a href="<?php echo esc_url($my_account_page_url); ?>"><?php esc_html_e('Login', 'thebigshop'); ?> <span> / </span> <?php esc_html_e('Register', 'thebigshop'); ?></a></li>
            <?php
            endif;
            ?>
        </ul>
    </div>
<?php } ?>  
<?php if (has_nav_menu('toplinks') || function_exists('icl_get_languages') || class_exists('woocommerce_wpml') || isset($thebigshop_options['td-header-customblocks'])) { ?>
    <div class="pull-right flip left-top">
        <div class="links">
            <ul>
                <?php if (isset($thebigshop_options['td-header-customblocks'])) { ?>
                    <li class="dropdown wrap_custom_block hidden-sm hidden-xs">
                        <?php echo wp_kses_post($thebigshop_options['td-header-customblocks']); ?>
                    </li>
                <?php } ?>
                <?php
                if (has_nav_menu('toplinks')) :
                    wp_nav_menu(array(
                        'theme_location' => 'toplinks',
                        'menu' => '',
                        'container' => '',
                        'container_class' => '',
                        'container_id' => '',
                        'menu_class' => '',
                        'menu_id' => '',
                        'echo' => true,
                        'fallback_cb' => 'wp_page_menu',
                        'before' => '',
                        'after' => '',
                        'link_before' => '',
                        'link_after' => '',
                        'items_wrap' => '%3$s',
                        'depth' => 1,
                        'walker' => ''
                    ));
                endif;
                ?>
            </ul>
        </div>
        <?php if (function_exists('icl_get_languages') || class_exists('woocommerce_wpml')) { ?>
            <div class="langague-currency-switcher">
                <?php
                if (function_exists('icl_get_languages')) {
                    thebigshop_languages_block();
                }
                if (class_exists('woocommerce_wpml')) {
                    echo(do_shortcode('[currency_switcher]'));
                }
                ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>