<?php

if (!function_exists('thebigshop_custom_styles')) {

    function thebigshop_custom_styles() {
        global $thebigshop_options;
        // Option Panel Custom CSS /
        $custom_styles = '';

        if (isset($thebigshop_options['td_general_links_color']) && ($thebigshop_options['td_general_links_color'] != ''))
            $custom_styles .='.calendar_wrap #today, .widget_calendar tbody a, .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
background-color: ' . esc_attr($thebigshop_options['td_general_links_color']) . ';
border-color: ' . esc_attr($thebigshop_options['td_general_links_color']) . '; }';

        if (isset($thebigshop_options['td_general_links_color']) && ($thebigshop_options['td_general_links_color'] != ''))
            $custom_styles .='a, a b, .articleHeader span a, .pagination > li > a {
color: ' . esc_attr($thebigshop_options['td_general_links_color']) . '; }';

        if (isset($thebigshop_options['td_general_links_color']) && ($thebigshop_options['td_general_links_color'] != ''))
            $custom_styles .='.owl-carousel.slideshowhome .owl-controls .owl-buttons .owl-prev:hover, .owl-carousel.slideshowhome .owl-controls .owl-buttons .owl-next:hover, .nivo-directionNav .nivo-nextNav:hover, .nivo-directionNav .nivo-prevNav:hover {
background-color: ' . esc_attr($thebigshop_options['td_general_links_color']) . '; }';

        if (isset($thebigshop_options['td_general_links_hover_color']) && ($thebigshop_options['td_general_links_hover_color'] != ''))
            $custom_styles .='a:hover, a b:hover, .category .tabs li a:hover, .sitemap li a:hover, .pagination > li > a:hover, .breadcrumb a:hover, .login-content .right a:hover, .box-category a:hover, .list-item a:hover, #blogArticle .articleHeader h1 a:hover, #blogCatArticles .articleHeader h3 a:hover, .tags-update .tags a:hover, .articleHeader span a:hover {
color: ' . esc_attr($thebigshop_options['td_general_links_hover_color']) . '; }';

        if (isset($thebigshop_options['td_heading_color']) && ($thebigshop_options['td_heading_color'] != ''))
            $custom_styles .=' #container h1 {
color: ' . esc_attr($thebigshop_options['td_heading_color']) . '; }';

        if (isset($thebigshop_options['td_secondary_heading_color']) && ($thebigshop_options['td_secondary_heading_color'] != ''))
            $custom_styles .=' #container h2, #container h3, .product-tab .htabs a, .product-tab .tabs li a {
color: ' . esc_attr($thebigshop_options['td_secondary_heading_color']) . '; }';


        if (isset($thebigshop_options['td_secondary_heading_border_color']) && ($thebigshop_options['td_secondary_heading_border_color'] != ''))
            $custom_styles .='#container h2, #container h3, .product-tab .htabs a, .product-tab .tabs li.active a, .product-tab .tabs, .category .tabs li.active a {
border-color:  ' . esc_attr($thebigshop_options['td_secondary_heading_border_color']) . '; }';

        if (isset($thebigshop_options['td_top_bar_bg_color']) && ($thebigshop_options['td_top_bar_bg_color'] != ''))
            $custom_styles .='#header .htop, .left-top {
background-color: ' . esc_attr($thebigshop_options['td_top_bar_bg_color']) . '; }';

        if (isset($thebigshop_options['td_top_bar_link_color']) && ($thebigshop_options['td_top_bar_link_color'] != ''))
            $custom_styles .='#header .links > ul > li.mobile, #header .links > ul > li > a, #language span, #currency span, #header #top-links > ul > li > a, .drop-icon {
color:' . esc_attr($thebigshop_options['td_top_bar_link_color']) . '; }';

        if (isset($thebigshop_options['td_top_bar_link_color']) && ($thebigshop_options['td_top_bar_link_color'] != ''))
            $custom_styles .='#header .links > ul > li.wrap_custom_block a b {
border-top-color:' . esc_attr($thebigshop_options['td_top_bar_link_color']) . '; }';


        if (isset($thebigshop_options['td_top_bar_link_separator_color']) && ($thebigshop_options['td_top_bar_link_separator_color'] != ''))
            $custom_styles .='#header .links > ul > li, #header #top-links > ul > li {
border-left:1px dotted ' . esc_attr($thebigshop_options['td_top_bar_link_separator_color']) . '; }';

        if (isset($thebigshop_options['td_top_bar_link_separator_color']) && ($thebigshop_options['td_top_bar_link_separator_color'] != ''))
            $custom_styles .='#header .links, #language, #currency, #header #top-links {
border-right:1px dotted ' . esc_attr($thebigshop_options['td_top_bar_link_separator_color']) . '; }';

        if (isset($thebigshop_options['td_top_bar_sub_link_color']) && ($thebigshop_options['td_top_bar_sub_link_color'] != ''))
            $custom_styles .='#top .dropdown-menu li a, #currency ul li .currency-select {
color:' . esc_attr($thebigshop_options['td_top_bar_sub_link_color']) . '; }';

        if (isset($thebigshop_options['td_top_bar_sub_link_hover_color']) && ($thebigshop_options['td_top_bar_sub_link_hover_color'] != ''))
            $custom_styles .='#top .dropdown-menu li a:hover, #currency ul li .currency-select:hover {
color: ' . esc_attr($thebigshop_options['td_top_bar_sub_link_hover_color']) . '; }';

        if (isset($thebigshop_options['td_header_bg_color']) && ($thebigshop_options['td_header_bg_color'] != ''))
            $custom_styles .='#header .header-row {
background-color:' . esc_attr($thebigshop_options['td_header_bg_color']) . '; }';

        if (isset($thebigshop_options['td_mini_cart_icon_color']) && ($thebigshop_options['td_mini_cart_icon_color'] != ''))
            $custom_styles .='#header #cart .heading h4 {
background-color:' . esc_attr($thebigshop_options['td_mini_cart_icon_color']) . '; }';

        if (isset($thebigshop_options['td_mini_cart_icon_color']) && ($thebigshop_options['td_mini_cart_icon_color'] != ''))
            $custom_styles .='#header #cart .heading h4:after, #header #cart .heading h4:before, #header #cart .dropdown-menu {
border-color:' . esc_attr($thebigshop_options['td_mini_cart_icon_color']) . '; }';

        if (isset($thebigshop_options['td_mini_cart_icon_color']) && ($thebigshop_options['td_mini_cart_icon_color'] != ''))
            $custom_styles .='#header #cart.open .heading span:after {
border-color:transparent transparent ' . esc_attr($thebigshop_options['td_mini_cart_icon_color']) . '; }';

        if (isset($thebigshop_options['td_mini_cart_link_color']) && ($thebigshop_options['td_mini_cart_link_color'] != ''))
            $custom_styles .='#header #cart .heading {
color:' . esc_attr($thebigshop_options['td_mini_cart_link_color']) . '; }';

        if (isset($thebigshop_options['td_mini_cart_active_link_color']) && ($thebigshop_options['td_mini_cart_active_link_color'] != ''))
            $custom_styles .='#header #cart.open .heading {
color:' . esc_attr($thebigshop_options['td_mini_cart_active_link_color']) . '; }';

        if (isset($thebigshop_options['td_search_bar_background_color']) && ($thebigshop_options['td_search_bar_background_color'] != ''))
            $custom_styles .='#header #search input {
background-color:' . esc_attr($thebigshop_options['td_search_bar_background_color']) . '; }';

        if (isset($thebigshop_options['td_search_bar_border_color']) && ($thebigshop_options['td_search_bar_border_color'] != ''))
            $custom_styles .='#header #search input {
border-color:' . esc_attr($thebigshop_options['td_search_bar_border_color']) . '; }';

        if (isset($thebigshop_options['td_search_bar_text_color']) && ($thebigshop_options['td_search_bar_text_color'] != ''))
            $custom_styles .='#header #search input {
color:' . esc_attr($thebigshop_options['td_search_bar_text_color']) . '; }';

        if (isset($thebigshop_options['td_search_bar_border_hover_color']) && ($thebigshop_options['td_search_bar_border_hover_color'] != ''))
            $custom_styles .='#header #search input:focus, #header #search input:hover {
border-color:' . esc_attr($thebigshop_options['td_search_bar_border_hover_color']) . '; }';

        if (isset($thebigshop_options['td_search_bar_icon_color']) && ($thebigshop_options['td_search_bar_icon_color'] != ''))
            $custom_styles .='#header .button-search {
color:' . esc_attr($thebigshop_options['td_search_bar_icon_color']) . '; }';

        /* ===== FOOTER ===== */
        if (isset($thebigshop_options['td_footer_bg_color']) && ($thebigshop_options['td_footer_bg_color'] != ''))
            $custom_styles .='#footer .fpart-first {
background-color: ' . esc_attr($thebigshop_options['td_footer_bg_color']) . '; }';

        if (isset($thebigshop_options['td_footer_titles_color']) && ($thebigshop_options['td_footer_titles_color'] != ''))
            $custom_styles .='#footer h5 {
color: ' . esc_attr($thebigshop_options['td_footer_titles_color']) . '; }';

        if (isset($thebigshop_options['td_footer_text_color']) && ($thebigshop_options['td_footer_text_color'] != ''))
            $custom_styles .='#footer .fpart-first {
color: ' . esc_attr($thebigshop_options['td_footer_text_color']) . '; }';

        if (isset($thebigshop_options['td_footer_link_color']) && ($thebigshop_options['td_footer_link_color'] != ''))
            $custom_styles .='#footer .fpart-first a {
color: ' . esc_attr($thebigshop_options['td_footer_link_color']) . '; }';

        if (isset($thebigshop_options['td_footer_link_hover_color']) && ($thebigshop_options['td_footer_link_hover_color'] != ''))
            $custom_styles .='#footer .fpart-first a:hover {
color: ' . esc_attr($thebigshop_options['td_footer_link_hover_color']) . '; }';

        if (isset($thebigshop_options['td_contact_icon_color']) && ($thebigshop_options['td_contact_icon_color'] != ''))
            $custom_styles .='#footer .contact > ul > li > .fa {
color: ' . esc_attr($thebigshop_options['td_contact_icon_color']) . '; }';

        if (isset($thebigshop_options['td_footer_second_bg_color']) && ($thebigshop_options['td_footer_second_bg_color'] != ''))
            $custom_styles .='#footer .fpart-second {
background-color: ' . esc_attr($thebigshop_options['td_footer_second_bg_color']) . '; }';

        if (isset($thebigshop_options['td_footer_second_text_color']) && ($thebigshop_options['td_footer_second_text_color'] != ''))
            $custom_styles .='#footer .fpart-second {
color: ' . esc_attr($thebigshop_options['td_footer_second_text_color']) . '; }';

        if (isset($thebigshop_options['td_footer_second_link_color']) && ($thebigshop_options['td_footer_second_link_color'] != ''))
            $custom_styles .='#footer .fpart-second a {
color: ' . esc_attr($thebigshop_options['td_footer_second_link_color']) . '; }';

        if (isset($thebigshop_options['td_footer_second_link_hover_color']) && ($thebigshop_options['td_footer_second_link_hover_color'] != ''))
            $custom_styles .='#footer .fpart-second a:hover {
color: ' . esc_attr($thebigshop_options['td_footer_second_link_hover_color']) . '; }';

        if (isset($thebigshop_options['td_footer_second_separator_color']) && ($thebigshop_options['td_footer_second_separator_color'] != ''))
            $custom_styles .='#footer #powered {
border-bottom:1px solid ' . esc_attr($thebigshop_options['td_footer_second_separator_color']) . '; }';

        if (isset($thebigshop_options['td_footer_backtotop_bg_color']) && ($thebigshop_options['td_footer_backtotop_bg_color'] != ''))
            $custom_styles .='#back-top a:hover {
background-color: ' . esc_attr($thebigshop_options['td_footer_backtotop_bg_color']) . '; }';

        if (isset($thebigshop_options['td_custom_block_bg_color']) && ($thebigshop_options['td_custom_block_bg_color'] != ''))
            $custom_styles .=' .custom_side_block_icon {
background-color: ' . esc_attr($thebigshop_options['td_custom_block_bg_color']) . '; }';

        if (isset($thebigshop_options['td_custom_block_bg_color']) && ($thebigshop_options['td_custom_block_bg_color'] != ''))
            $custom_styles .=' #custom_side_block {
border-color: ' . esc_attr($thebigshop_options['td_custom_block_bg_color']) . '; }';

        /* ===== PRICE ===== */
        if (isset($thebigshop_options['td_price_color']) && ($thebigshop_options['td_price_color'] != ''))
            $custom_styles .='.product-thumb .price, .product-info .price, .amount, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce ul.product_list_widget li ins, .widget .woocommerce-Price-amount.amount {
color: ' . esc_attr($thebigshop_options['td_price_color']) . '; }';

        if (isset($thebigshop_options['td_old_price_color']) && ($thebigshop_options['td_old_price_color'] != ''))
            $custom_styles .='.product-thumb .price-old, .product-info .price-old, .product-thumb .price del, .woocommerce div.product p.price del, .woocommerce div.product span.price del, .woocommerce ul.product_list_widget li del, .widget del .woocommerce-Price-amount.amount {
color: ' . esc_attr($thebigshop_options['td_old_price_color']) . '; }';

        if (isset($thebigshop_options['td_saving_percentage_bg_color']) && ($thebigshop_options['td_saving_percentage_bg_color'] != ''))
            $custom_styles .=' .saving {
background-color: ' . esc_attr($thebigshop_options['td_saving_percentage_bg_color']) . '; }';

        if (isset($thebigshop_options['td_saving_percentage_text_color']) && ($thebigshop_options['td_saving_percentage_text_color'] != ''))
            $custom_styles .='.saving {
color: ' . esc_attr($thebigshop_options['td_saving_percentage_text_color']) . '; }';

        /* ===== BUTTON ===== */
        if (isset($thebigshop_options['td_button_bg_color']) && ($thebigshop_options['td_button_bg_color'] != ''))
            $custom_styles .=' .btn-primary {
background-color: ' . esc_attr($thebigshop_options['td_button_bg_color']) . '; }';

        if (isset($thebigshop_options['td_button_bg_hover_color']) && ($thebigshop_options['td_button_bg_hover_color'] != ''))
            $custom_styles .=' .btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] {
background-color: ' . esc_attr($thebigshop_options['td_button_bg_hover_color']) . '; }';

        if (isset($thebigshop_options['td_button_text_color']) && ($thebigshop_options['td_button_text_color'] != ''))
            $custom_styles .=' .btn-primary {
color: ' . esc_attr($thebigshop_options['td_button_text_color']) . '; }';

        if (isset($thebigshop_options['td_button_text_hover_color']) && ($thebigshop_options['td_button_text_hover_color'] != ''))
            $custom_styles .='.btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] {
color: ' . esc_attr($thebigshop_options['td_button_text_hover_color']) . '; }';

        /* ===== AddToCart BUTTONS ===== */
        if (isset($thebigshop_options['td_cart_button_bg_color']) && ($thebigshop_options['td_cart_button_bg_color'] != ''))
            $custom_styles .='.product-thumb .button-group > button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
background-color: ' . esc_attr($thebigshop_options['td_cart_button_bg_color']) . '; }';

        if (isset($thebigshop_options['td_cart_button_bg_hover_color']) && ($thebigshop_options['td_cart_button_bg_hover_color'] != ''))
            $custom_styles .=' .product-thumb .button-group > button:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {
background-color: ' . esc_attr($thebigshop_options['td_cart_button_bg_hover_color']) . '; }';

        if (isset($thebigshop_options['td_cart_button_text_color']) && ($thebigshop_options['td_cart_button_text_color'] != ''))
            $custom_styles .=' .product-thumb .button-group > button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
color: ' . esc_attr($thebigshop_options['td_cart_button_text_color']) . '; }';

        if (isset($thebigshop_options['td_cart_button_text_hover_color']) && ($thebigshop_options['td_cart_button_text_hover_color'] != ''))
            $custom_styles .='.product-thumb .button-group > button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {
color: ' . esc_attr($thebigshop_options['td_cart_button_text_hover_color']) . '; }';

        /* ===== FONTS ===== */
        if (isset($thebigshop_options['td-typography-top-bar']['font-family']) && ($thebigshop_options['td-typography-top-bar']['font-family'] != ''))
            $custom_styles .=' #header .htop {
font-family: ' . esc_attr($thebigshop_options['td-typography-top-bar']['font-family']) . '; }';


        $custom_styles .='#header #logo {
    font-size: 30px;
    line-height: 1.1;
    padding-top: 20px;
}';

        if (isset($thebigshop_options['td-switch-logo']) && ($thebigshop_options['td-switch-logo'] == 1))
            $custom_styles .='#header #logo {
    padding-top: 27px;
}';

        if (isset($thebigshop_options['td_logo_padding']) && ($thebigshop_options['td_logo_padding'] != ''))
            $custom_styles .='#header #logo {
         padding-top: ' . esc_attr($thebigshop_options['td_logo_padding']) . 'px; }';

        $custom_styles .='
.float-right{ float:right!important; }
.float-left{ float:left!important; }
.display-none {display:none!important;}
';
        if (isset($thebigshop_options['td_custom_css']) && ($thebigshop_options['td_custom_css'] != ''))
            $custom_styles .= html_entity_decode(stripslashes($thebigshop_options['td_custom_css']));
        wp_enqueue_style(
                'thebigshop-option-styles', THEBIGSHOP_THEME_CSS . '/custom_style.css'
        );
        wp_add_inline_style('thebigshop-option-styles', $custom_styles);
    }

}
add_action('wp_enqueue_scripts', 'thebigshop_custom_styles', 99);

function thebigshop_javascript() {
    global $thebigshop_options;

    $thebigshop_number_of_column = "";
    if (isset($thebigshop_options['td-woo-categories-number-of-column'])) {
        $thebigshop_number_of_column = $thebigshop_options['td-woo-categories-number-of-column'];
    }
    if (isset($_GET['col'])) {
        $thebigshop_number_of_column = $_GET['col'];
    }

    $numberrow = $thebigshop_number_of_column ? $thebigshop_number_of_column . 'n' : '4n';
    $clearnmber = '4n';

    if (isset($thebigshop_number_of_column) && $thebigshop_number_of_column == 3) {
        $class = "col-lg-4 col-md-6 col-sm-4 col-xs-12";
        $clearnmber = '2n';
    } elseif (isset($thebigshop_number_of_column) && $thebigshop_number_of_column == 5) {
        $class = "col-lg-5ths col-md-5ths col-sm-3 col-xs-12";
        $clearnmber = '4n';
    } elseif (isset($thebigshop_number_of_column) && $thebigshop_number_of_column == 6) {
        $class = "col-lg-2 col-md-2 col-sm-3 col-xs-12";
        $clearnmber = '4n';
    } else {
        $class = "col-lg-3 col-md-3 col-sm-3 col-xs-12";
    }

    $columns = 4;
    if (isset($thebigshop_options['td-woo-related-number-of-column']) && $thebigshop_options['td-woo-related-number-of-column']) {
        $columns = $thebigshop_options['td-woo-related-number-of-column'];
    }

    $custom_script = '';
    if (isset($thebigshop_options['td-woo-product-images-style']) && $thebigshop_options['td-woo-product-images-style'] == "cloudzoom") {
        /* ---------------------------------------------------
          elevateZoom
          ----------------------------------------------------- */
        $custom_script .= 'jQuery("#zoom_01").elevateZoom({
                    gallery: "gallery_01",
                    cursor: "pointer",
                    galleryActiveClass: "active",
                    imageCrossfade: true,
                    zoomWindowFadeIn: 500,
                    zoomWindowFadeOut: 500,
                    lensFadeIn: 500,
                    lensFadeOut: 500
                });
                jQuery("#zoom_01").bind("click", function (e) {
                    var ez = jQuery("#zoom_01").data("elevateZoom");
                    jQuery.swipebox(ez.getGalleryList());
                    return false;
                });';
    } elseif (isset($thebigshop_options['td-woo-product-images-style']) && $thebigshop_options['td-woo-product-images-style'] == "magnific") {
        $custom_script .='jQuery(".td-main-image").magnificPopup({
                    type: "image",
                    gallery: {
                        enabled: true,
                        preload: [0, 2],
                        navigateByImgClick: true,
                        arrowMarkup: \'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>\', /* markup of an arrow button*/
                        tPrev: "Previous (Left arrow key)",
                        tNext: "Next (Right arrow key)",
                        tCounter: \'<span class="mfp-counter">%curr% of %total%</span>\'
                    }
                }); ';
    }

    $custom_script .='jQuery("#related_products").owlCarousel({
                itemsCustom: [
                    [0, 1],
                    [380, 2],
                    [943, 3],
                    [1263, ' . esc_attr($columns) . '],
                    [1360, ' . esc_attr($columns) . '],
                    [1440, ' . esc_attr($columns) . '],
                    [1680, ' . esc_attr($columns) . ']
                ], slideSpeed: 1000, rewindSpeed: 1000, autoPlay: false, stopOnHover: true, rewindNav: true, scrollPerPage: true, lazyLoad: true, navigation: true, pagination: true, navigationText: [\'<i class="fa fa-angle-left"></i>\', \'<i class="fa fa-angle-right"></i>\']});
            
            jQuery(".cross-sells").owlCarousel({
                itemsCustom: [
                    [0, 1],
                    [380, 2],
                    [943, 3],
                    [1263, ' . esc_attr($columns) . '],
                    [1360, ' . esc_attr($columns) . '],
                    [1440, ' . esc_attr($columns) . '],
                    [1680, ' . esc_attr($columns) . ']
                ], slideSpeed: 1000, rewindSpeed: 1000, autoPlay: false, stopOnHover: true, rewindNav: true, scrollPerPage: true, lazyLoad: true, navigation: true, pagination: true, navigationText: [\'<i class="fa fa-angle-left"></i>\', \'<i class="fa fa-angle-right"></i>\']});
           
           jQuery(".upsells.products").owlCarousel({
                itemsCustom: [
                    [0, 1],
                    [380, 2],
                    [943, 3],
                    [1263, ' . esc_attr($columns) . '],
                    [1360, ' . esc_attr($columns) . '],
                    [1440, ' . esc_attr($columns) . '],
                    [1680, ' . esc_attr($columns) . ']
                ], slideSpeed: 1000, rewindSpeed: 1000, autoPlay: false, stopOnHover: true, rewindNav: true, scrollPerPage: true, lazyLoad: true, navigation: true, pagination: true, navigationText: [\'<i class="fa fa-angle-left"></i>\', \'<i class="fa fa-angle-right"></i>\']});
     ';

    $custom_script .='jQuery(document).on("click", "#grid-view", function (e) {
                    var screensize = jQuery(window).width();
                    jQuery("#content .product-layout").attr("class", "product-layout product-grid ' . esc_attr($class) . '");

                    if (screensize > 1199) {
                        jQuery(".products-category > .clearfix").remove();
                        jQuery(\'.product-grid:nth-child(' . esc_attr($numberrow) . ')\').after(\'<span class="clearfix visible-lg-block"></span>\');
                    }
                    if (screensize < 1199) {
                        jQuery(".products-category > .clearfix").remove();
                        jQuery(\'.product-grid:nth-child(' . esc_attr($numberrow) . ')\').after(\'<span class="clearfix visible-lg-block visible-md-block"></span>\');
                    }
                    if (screensize < 991) {
                        jQuery(".products-category > .clearfix").remove();
                        jQuery(\'.product-grid:nth-child(' . esc_attr($clearnmber) . ')\').after(\'<span class="clearfix visible-lg-block visible-sm-block"></span>\');
                    }

                    jQuery(window).resize(function () {
                        var screensize = jQuery(window).width();
                        if (screensize > 1199) {
                            jQuery(".products-category > .clearfix").remove();
                            jQuery(\'.product-grid:nth-child(' . esc_attr($numberrow) . ')\').after(\'<span class="clearfix visible-lg-block"></span>\');
                        }
                        if (screensize < 1199) {
                            jQuery(".products-category > .clearfix").remove();
                            jQuery(\'.product-grid:nth-child(' . esc_attr($numberrow) . ')\').after(\'<span class="clearfix visible-lg-block visible-md-block"></span>\');
                        }
                        if (screensize < 991) {
                            jQuery(".products-category > .clearfix").remove();
                            jQuery(\'.product-grid:nth-child(' . esc_attr($clearnmber) . ')\').after(\'<span class="clearfix visible-lg-block visible-sm-block"></span>\');
                        }
                        if (screensize < 767) {
                            jQuery(".products-category > .clearfix").remove();
                        }
                    });

                    localStorage.setItem("display", "grid");
                    jQuery(".btn-group").find("#grid-view").addClass("selected");
                    jQuery(".btn-group").find("#list-view").removeClass("selected");

                });

                if (localStorage.getItem("display") == "list") {
                    jQuery("#list-view").trigger("click");
                } else {
                    jQuery("#grid-view").trigger("click");
                } 
            ';
    wp_enqueue_script('thebigshop-option-script', THEBIGSHOP_THEME_JS . '/custom_script.js', array('jquery'), false, true);
    wp_add_inline_script('thebigshop-option-script', $custom_script);
}

add_action('wp_enqueue_scripts', 'thebigshop_javascript', 20);
