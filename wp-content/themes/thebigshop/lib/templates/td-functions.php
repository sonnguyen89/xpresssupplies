<?php
function thebigshop_languages_block() {
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if (!empty($languages)) {
        ?>
        <select class="wcml_language_switcher">
            <option><?php echo ICL_LANGUAGE_NAME; ?></option>
            <?php
            if (count($languages) > 1) {
                foreach ($languages as $l) {
                    if (!$l['active'])
                        $langs[] = '<option value="' . $l['url'] . '">' . $l['native_name'] . '</option>';
                }
                echo join(', ', $langs);
            }
            ?>
        </select>

        <?php
    }
}

function thebigshop_top_cartblock() {
    global $woocommerce;
    ?>
    <div id="cart">
        <div data-toggle="dropdown" class="heading dropdown-toggle ">
            <div class="pull-left flip block-content mini-products-list cart_list product_list_widget"><h4>&nbsp;</h4></div>
            <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_html_e('View your shopping cart', 'thebigshop'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'thebigshop'), $woocommerce->cart->cart_contents_count); ?> - <?php echo wp_kses_post($woocommerce->cart->get_cart_total()); ?></a>
        </div>
        <div class="dropdown-menu">
            <div class="block-cart">
                <div class="block-content slideTogglebox widget woocommerce widget_shopping_cart" id="cart-listing">
                    <div class="toptitle widget_shopping_cart_content">

                        <div class="tital">
                            <div class="hr"><div class="block-subtitle">
                                    <?php
                                    if (sizeof($woocommerce->cart->cart_contents) > 0) {
                                        esc_html_e('Recently added item(s)', 'thebigshop');
                                    } else {
                                        esc_html_e('You have no items in your shopping cart.', 'thebigshop');
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php get_template_part('woocommerce/cart/mini-cart') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
