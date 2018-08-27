<?php
global $thebigshop_options;

if (has_nav_menu('toplinks') || function_exists('icl_get_languages') || class_exists('woocommerce_wpml')) : ?>
    <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
<?php endif; ?>

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