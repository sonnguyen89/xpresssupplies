<?php

function thebigshop_scripts() {
    global $thebigshop_options;

    wp_enqueue_style('bootstrap', THEBIGSHOP_THEME_JS . '/bootstrap/css/bootstrap.min.css', array(), '3.3.5', 'all');
    wp_enqueue_style('font-awesome', THEBIGSHOP_THEME_CSS . '/font-awesome/css/font-awesome.min.css', array(), '4.1.0', 'all');
    wp_enqueue_style('genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1');
    //Theme Custom CSS
    wp_enqueue_style('thebigshop-stylesheet', THEBIGSHOP_THEME_CSS . '/stylesheet.min.css');

    wp_enqueue_style('owl-transitions', THEBIGSHOP_THEME_JS . '/owl-carousel/owl.transitions.min.css', array(), '1.3.3', 'all');
    wp_enqueue_style('nivo-slider', THEBIGSHOP_THEME_CSS . '/nivo-slider.min.css', array(), '3.2', 'all');
    //Theme Custom CSS
    wp_enqueue_style('thebigshop-responsive', THEBIGSHOP_THEME_CSS . '/responsive.min.css');
    if (isset($thebigshop_options['td_precent_skin']) && ($thebigshop_options['td_precent_skin'] == 2)):
        wp_enqueue_style('thebigshop-stylesheet-skin2', THEBIGSHOP_THEME_CSS . '/stylesheet-skin2.min.css');
    elseif (isset($thebigshop_options['td_precent_skin']) && ($thebigshop_options['td_precent_skin'] == 3)):
        wp_enqueue_style('thebigshop-stylesheet-skin3', THEBIGSHOP_THEME_CSS . '/stylesheet-skin3.min.css');
    endif;
    if (is_rtl()) {
        wp_enqueue_style('bootstrap-rtl', THEBIGSHOP_THEME_JS . '/bootstrap/css/bootstrap-rtl.min.css', array(), '3.3.5', 'all');
        //Theme Custom CSS
        wp_enqueue_style('thebigshop-stylesheet-rtl', THEBIGSHOP_THEME_CSS . '/stylesheet-rtl.min.css');
        wp_enqueue_style('thebigshop-responsive-rtl', THEBIGSHOP_THEME_CSS . '/responsive-rtl.min.css');
    }

    wp_enqueue_style('owl-carousel', THEBIGSHOP_THEME_JS . '/owl-carousel/owl.carousel.min.css', array(), '1.3.3', 'all');
    wp_enqueue_style('flexslider', THEBIGSHOP_THEME_JS . '/flexslider/flexslider.css', array(), '2.6.0', 'all');
    wp_enqueue_style('select2', THEBIGSHOP_THEME_JS . '/select2/select2.min.css', array(), '4.0.2', 'all');
    wp_enqueue_style('thebigshop-style', get_stylesheet_uri());

    wp_enqueue_script('jquery-bootstrap', THEBIGSHOP_THEME_JS . '/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.5', true);
    wp_enqueue_script('jquery-easing', THEBIGSHOP_THEME_JS . '/jquery.easing-1.3.min.js', array('jquery'), '1.3', true);
    wp_enqueue_script('jquery-dcjqaccordion', THEBIGSHOP_THEME_JS . '/jquery.dcjqaccordion.min.js', array('jquery'), '2.6', true);
    wp_enqueue_script('jquery-nivo-slider', THEBIGSHOP_THEME_JS . '/jquery.nivo.slider.pack.js', array('jquery'), '3.2', true);
    wp_enqueue_script('jquery-flexslider', THEBIGSHOP_THEME_JS . '/flexslider/jquery.flexslider-min.js', array('jquery'), '2.6.0', true);
    wp_enqueue_script('select2-js', THEBIGSHOP_THEME_JS . '/select2/select2.min.js', array('jquery'), '4.0.2', true);
    wp_enqueue_script('owl-carousel-js', THEBIGSHOP_THEME_JS . '/owl-carousel/owl.carousel.min.js', array('jquery'), '1.3.3', true);
    wp_enqueue_script('filterable-js', THEBIGSHOP_THEME_JS . '/filterable/filterable.pack.js', array('jquery'), false, true);
    if (isset($thebigshop_options['td-woo-product-images-style']) && $thebigshop_options['td-woo-product-images-style'] == "cloudzoom") {
        wp_enqueue_script('jquery-elevateZoom', THEBIGSHOP_THEME_JS . '/jquery.elevateZoom-3.0.8.min.js', array('jquery'), '3.0.8', true);
        wp_enqueue_script('ios-orientationchange-fix', THEBIGSHOP_THEME_JS . '/swipebox/lib/ios-orientationchange-fix.js', array('jquery'), '1.5.25', true);
        wp_enqueue_script('jquery-swipebox', THEBIGSHOP_THEME_JS . '/swipebox/source/jquery.swipebox.min.js', array('jquery'), '1.2.9', true);
        wp_enqueue_style('swipebox', THEBIGSHOP_THEME_JS . '/swipebox/source/swipebox.min.css', array(), '1.2.9', 'all');
    } elseif (isset($thebigshop_options['td-woo-product-images-style']) && $thebigshop_options['td-woo-product-images-style'] == "magnific") {
        wp_enqueue_style('magnific-popup', THEBIGSHOP_THEME_JS . '/magnific-popup/magnific-popup.min.css', array(), '1.1.0', 'all');
        wp_enqueue_script('jquery-magnific-popup', THEBIGSHOP_THEME_JS . '/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', true);
    }
    //Theme Custom JS
    wp_enqueue_script('thebigshop-custom-js', THEBIGSHOP_THEME_JS . '/custom.js', array('jquery'), false, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    if (isset($thebigshop_options['td-sidebox-facebook-show']) && ($thebigshop_options['td-sidebox-facebook-show'] == 1)) {
        wp_enqueue_script('jquery-connect-facebook', '//connect.facebook.net/en_US/all.js#xfbml=1', array('jquery'), false, true);
    }
}

//tdthemes scripts
add_action('wp_enqueue_scripts', 'thebigshop_scripts', 10);

function thebigshop_register_widgets_init() {
    global $thebigshop_options;
    $thebigshop_widget_culumn = "col-sm-3";
    if (isset($thebigshop_options['td_column_co_bottom_widgets']) && ($thebigshop_options['td_column_co_bottom_widgets'] == 1)):
        $thebigshop_widget_culumn = "col-sm-12";
    elseif (isset($thebigshop_options['td_column_co_bottom_widgets']) && ($thebigshop_options['td_column_co_bottom_widgets'] == 2)):
        $thebigshop_widget_culumn = "col-sm-6";
    elseif (isset($thebigshop_options['td_column_co_bottom_widgets']) && ($thebigshop_options['td_column_co_bottom_widgets'] == 3)):
        $thebigshop_widget_culumn = "col-sm-4";
    endif;
    register_sidebar(array(
        'name' => esc_html__('Sidebar Block', 'thebigshop'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here to appear in your sidebar.', 'thebigshop'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Portfolio Page', 'thebigshop'),
        'id' => 'portfolio-sidebar',
        'description' => esc_html__('Add widgets here to appear in your Portfolio Page sidebar.', 'thebigshop'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Content Bottom', 'thebigshop'),
        'id' => 'sidebar-2',
        'description' => esc_html__('Appears at the bottom of the content on posts and pages.', 'thebigshop'),
        'before_widget' => '<div id="%1$s" class="widget %2$s ' . $thebigshop_widget_culumn . ' col-xs-12">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Block', 'thebigshop'),
        'id' => 'footer',
        'description' => esc_html__('Add widgets here to appear in your footer.', 'thebigshop'),
        'before_widget' => '<div id="%1$s" class="widget %2$s column col-lg-3 col-md-3 col-sm-3 col-xs-12">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
}

add_action('widgets_init', 'thebigshop_register_widgets_init');
/* ----------------------------------------------------------------------------------- */
/* Plugin recommendations
  /*----------------------------------------------------------------------------------- */
require_once THEBIGSHOP_LIB_PLUGINS_URI . '/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'thebigshop_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function thebigshop_register_required_plugins() {
    $plugins = array(
        array(
            'name' => 'WooCommerce',
            'slug' => 'woocommerce',
            'required' => false,
        ),
        array(
            'name' => 'YITH WooCommerce Wishlist',
            'slug' => 'yith-woocommerce-wishlist',
            'required' => false,
        ),
        array(
            'name' => 'YITH WooCommerce Compare',
            'slug' => 'yith-woocommerce-compare',
            'required' => false,
        ),
        array(
            'name' => 'YITH WooCommerce Brands Add-On',
            'slug' => 'yith-woocommerce-brands-add-on',
            'required' => false,
        ),
        array(
            'name' => 'YITH WooCommerce Ajax Search',
            'slug' => 'yith-woocommerce-ajax-search',
            'required' => true,
        ),
        array(
            'name' => 'YITH WooCommerce Quick View',
            'slug' => 'yith-woocommerce-quick-view',
            'required' => false,
        ),
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => false,
        ),
        array(
            'name' => 'Breadcrumb NavXT',
            'slug' => 'breadcrumb-navxt',
            'required' => false,
        ),
        array(
            'name' => 'MailChimp for WordPress',
            'slug' => 'mailchimp-for-wp',
            'required' => false,
        ),
        array(
            'name' => 'Regenerate Thumbnails',
            'slug' => 'regenerate-thumbnails',
            'required' => false,
        ),
        array(
            'name' => 'Redux Framework',
            'slug' => 'redux-framework',
            'required' => true,
        ),
        array(
            'name' => 'Envato Market',
            'slug' => 'envato-market',
            'source' => THEBIGSHOP_LIB_PLUGINS_URI . '/envato-market.zip',
            'required' => true,
        ),
        array(
            'name' => 'ThemesDeveloper TheBigshop Option',
            'slug' => 'themesdeveloper-thebigshop',
            'source' => THEBIGSHOP_LIB_PLUGINS_URI . '/themesdeveloper-thebigshop.zip',
            'required' => true,
        ),
        array(
            'name' => 'WPBakery Visual Composer',
            'slug' => 'js_composer',
            'source' => THEBIGSHOP_LIB_PLUGINS_URI . '/js_composer.zip',
            'required' => true,
        ),
    );

    $config = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
    );
    tgmpa($plugins, $config);
}

function thebigshop_socaial_button() {
    global $thebigshop_options;
    ?>
    <?php if (isset($thebigshop_options['td-social-facebook']) && ($thebigshop_options['td-social-facebook'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-facebook']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/facebook.png" alt="<?php esc_html_e('Facebook', 'thebigshop'); ?>" title="<?php esc_html_e('Facebook', 'thebigshop'); ?>"></a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-twitter']) && ($thebigshop_options['td-social-twitter'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-twitter']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/twitter.png" alt="<?php esc_html_e('Twitter', 'thebigshop'); ?>" title="<?php esc_html_e('Twitter', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-googleplus']) && ($thebigshop_options['td-social-googleplus'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-googleplus']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/google_plus.png" alt="<?php esc_html_e('Google+', 'thebigshop'); ?>" title="<?php esc_html_e('Google+', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-pinterest']) && ($thebigshop_options['td-social-pinterest'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-pinterest']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/pinterest.png" alt="<?php esc_html_e('Pinterest', 'thebigshop'); ?>" title="<?php esc_html_e('Pinterest', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-rss']) && ($thebigshop_options['td-social-rss'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-rss']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/rss.png" alt="<?php esc_html_e('RSS', 'thebigshop'); ?>" title="<?php esc_html_e('RSS', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-blogger']) && ($thebigshop_options['td-social-blogger'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-blogger']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/blogger.png" alt="<?php esc_html_e('Blogger', 'thebigshop'); ?>" title="<?php esc_html_e('Blogger', 'thebigshop'); ?>"></a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-myspace']) && ($thebigshop_options['td-social-myspace'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-myspace']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/myspace.png" alt="<?php esc_html_e('Byspace', 'thebigshop'); ?>" title="<?php esc_html_e('Byspace', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-linkedin']) && ($thebigshop_options['td-social-linkedin'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-linkedin']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/linkedin.png" alt="<?php esc_html_e('Linkedin', 'thebigshop'); ?>" title="<?php esc_html_e('Linkedin', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-evernote']) && ($thebigshop_options['td-social-evernote'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-evernote']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/evernote.png" alt="<?php esc_html_e('Evernote', 'thebigshop'); ?>" title="<?php esc_html_e('Evernote', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-dopplr']) && ($thebigshop_options['td-social-dopplr'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-dopplr']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/dopplr.png" alt="<?php esc_html_e('Dopplr', 'thebigshop'); ?>" title="<?php esc_html_e('Dopplr', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-ember']) && ($thebigshop_options['td-social-ember'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-ember']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/ember.png" alt="<?php esc_html_e('ember', 'thebigshop'); ?>" title="<?php esc_html_e('ember', 'thebigshop'); ?>"></a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-flickr']) && ($thebigshop_options['td-social-flickr'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-flickr']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/flickr.png" alt="<?php esc_html_e('Flickr', 'thebigshop'); ?>" title="<?php esc_html_e('Flickr', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-picasa_web']) && ($thebigshop_options['td-social-picasa_web'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-picasa_web']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/picasa.png" alt="<?php esc_html_e('Picasa', 'thebigshop'); ?>" title="<?php esc_html_e('Picasa', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-youtube']) && ($thebigshop_options['td-social-youtube'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-youtube']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/youtube.png" alt="<?php esc_html_e('YouTube', 'thebigshop'); ?>" title="<?php esc_html_e('YouTube', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-technorati']) && ($thebigshop_options['td-social-technorati'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-technorati']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/technorati.png" alt="<?php esc_html_e('technorati', 'thebigshop'); ?>" title="<?php esc_html_e('technorati', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-grooveshark']) && ($thebigshop_options['td-social-grooveshark'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-grooveshark']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/grooveshark.png" alt="<?php esc_html_e('grooveshark', 'thebigshop'); ?>" title="<?php esc_html_e('grooveshark', 'thebigshop'); ?>"></a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-vimeo']) && ($thebigshop_options['td-social-vimeo'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-vimeo']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/vimeo.png" alt="<?php esc_html_e('Vimeo', 'thebigshop'); ?>" title="<?php esc_html_e('Vimeo', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-sharethis']) && ($thebigshop_options['td-social-sharethis'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-sharethis']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/sharethis.png" alt="<?php esc_html_e('ShareThis', 'thebigshop'); ?>" title="<?php esc_html_e('ShareThis', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-yahoobuzz']) && ($thebigshop_options['td-social-yahoobuzz'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-yahoobuzz']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/yahoobuzz.png" alt="<?php esc_html_e('yahoobuzz', 'thebigshop'); ?>" title="<?php esc_html_e('yahoobuzz', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-viddler']) && ($thebigshop_options['td-social-viddler'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-viddler']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/viddler.png" alt="<?php esc_html_e('viddler', 'thebigshop'); ?>" title="<?php esc_html_e('viddler', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-skype']) && ($thebigshop_options['td-social-skype'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-skype']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/skype.png" alt="<?php esc_html_e('Skype', 'thebigshop'); ?>" title="<?php esc_html_e('Skype', 'thebigshop'); ?>"></a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-googletalk']) && ($thebigshop_options['td-social-googletalk'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-googletalk']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/googletalk.png" alt="<?php esc_html_e('googletalk', 'thebigshop'); ?>" title="<?php esc_html_e('googletalk', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-digg']) && ($thebigshop_options['td-social-digg'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-digg']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/digg.png" alt="<?php esc_html_e('Digg', 'thebigshop'); ?>" title="<?php esc_html_e('Digg', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-reddit']) && ($thebigshop_options['td-social-reddit'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-reddit']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/reddit.png" alt="<?php esc_html_e('Reddit', 'thebigshop'); ?>" title="<?php esc_html_e('Reddit', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-delicious']) && ($thebigshop_options['td-social-delicious'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-delicious']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/delicious.png" alt="<?php esc_html_e('Delicious', 'thebigshop'); ?>" title="<?php esc_html_e('Delicious', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-stumbleupon']) && ($thebigshop_options['td-social-stumbleupon'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-stumbleupon']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/stumbleupon.png" alt="<?php esc_html_e('StumbleUpon', 'thebigshop'); ?>" title="<?php esc_html_e('StumbleUpon', 'thebigshop'); ?>"></a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-friendfeed']) && ($thebigshop_options['td-social-friendfeed'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-friendfeed']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/friendfeed.png" alt="<?php esc_html_e('FriendFeed', 'thebigshop'); ?>" title="<?php esc_html_e('FriendFeed', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-tumblr']) && ($thebigshop_options['td-social-tumblr'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-tumblr']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/tumblr.png" alt="<?php esc_html_e('Tumblr', 'thebigshop'); ?>" title="<?php esc_html_e('Tumblr', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-yelp']) && ($thebigshop_options['td-social-yelp'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-yelp']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/yelp.png" alt="<?php esc_html_e('Yelp', 'thebigshop'); ?>" title="<?php esc_html_e('Yelp', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-posterous']) && ($thebigshop_options['td-social-posterous'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-posterous']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/posterous.png" alt="<?php esc_html_e('posterous', 'thebigshop'); ?>" title="<?php esc_html_e('posterous', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-bebo']) && ($thebigshop_options['td-social-bebo'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-bebo']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/bebo.png" alt="<?php esc_html_e('Bebo', 'thebigshop'); ?>" title="<?php esc_html_e('Bebo', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-virb']) && ($thebigshop_options['td-social-virb'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-virb']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/virb.png" alt="<?php esc_html_e('virb', 'thebigshop'); ?>" title="<?php esc_html_e('virb', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-last_fm']) && ($thebigshop_options['td-social-last_fm'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-last_fm']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/lastfm.png" alt="<?php esc_html_e('Lastfm', 'thebigshop'); ?>" title="<?php esc_html_e('Last.fm', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-pandora']) && ($thebigshop_options['td-social-pandora'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-pandora']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/pandora.png" alt="<?php esc_html_e('pandora', 'thebigshop'); ?>" title="<?php esc_html_e('pandora', 'thebigshop'); ?>"></a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-mixx']) && ($thebigshop_options['td-social-mixx'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-mixx']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/mixx.png" alt="<?php esc_html_e('mixx', 'thebigshop'); ?>" title="<?php esc_html_e('mixx', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-newsvine']) && ($thebigshop_options['td-social-newsvine'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-newsvine']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/newsvine.png" alt="<?php esc_html_e('Newsvine', 'thebigshop'); ?>" title="<?php esc_html_e('Newsvine', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-openid']) && ($thebigshop_options['td-social-openid'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-openid']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/openid.png" alt="<?php esc_html_e('openid', 'thebigshop'); ?>" title="<?php esc_html_e('openid', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-readernaut']) && ($thebigshop_options['td-social-readernaut'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-readernaut']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/readernaut.png" alt="<?php esc_html_e('readernaut', 'thebigshop'); ?>" title="<?php esc_html_e('readernaut', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-xing_me']) && ($thebigshop_options['td-social-xing_me'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-xing_me']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/xing.png" alt="<?php esc_html_e('xing', 'thebigshop'); ?>" title="<?php esc_html_e('xing.me', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-instagram']) && ($thebigshop_options['td-social-instagram'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-instagram']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/instagram.png" alt="<?php esc_html_e('Instagram', 'thebigshop'); ?>" title="<?php esc_html_e('Instagram', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-spotify']) && ($thebigshop_options['td-social-spotify'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-spotify']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/spotify.png" alt="<?php esc_html_e('Spotify', 'thebigshop'); ?>" title="<?php esc_html_e('Spotify', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-forrst']) && ($thebigshop_options['td-social-forrst'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-forrst']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/forrst.png" alt="<?php esc_html_e('Forrst', 'thebigshop'); ?>" title="<?php esc_html_e('Forrst', 'thebigshop'); ?>"></a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-viadeo']) && ($thebigshop_options['td-social-viadeo'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-viadeo']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/viadeo.png" alt="<?php esc_html_e('Viadeo', 'thebigshop'); ?>" title="<?php esc_html_e('Viadeo', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php if (isset($thebigshop_options['td-social-vk_com']) && ($thebigshop_options['td-social-vk_com'] != '')) { ?><a href="<?php echo esc_url($thebigshop_options['td-social-vk_com']); ?>" target="_blank"> <img data-toggle="tooltip" src="<?php echo THEBIGSHOP_THEME_IMAGES; ?>/socialicons/vk.png" alt="<?php esc_html_e('VK', 'thebigshop'); ?>" title="<?php esc_html_e('VK.com', 'thebigshop'); ?>"> </a> <?php } ?> 
    <?php
}

function thebigshop_layout_position($thebigshop_page_position) {
    if (($thebigshop_page_position == 2) || ($thebigshop_page_position == "left")) {
        if (is_rtl()) {
            $thebigshop_sidebarclass = 'col-sm-3 float-right';
            $thebigshop_contentclass = 'col-sm-9 col-xs-12 float-left';
        } else {
            $thebigshop_sidebarclass = 'col-sm-3 float-left';
            $thebigshop_contentclass = 'col-sm-9 col-xs-12 float-right';
        }
    } elseif (($thebigshop_page_position == 3) || ($thebigshop_page_position == "right")) {
        if (is_rtl()) {
            $thebigshop_sidebarclass = 'col-sm-3 float-left';
            $thebigshop_contentclass = 'col-sm-9 col-xs-12 float-right';
        } else {
            $thebigshop_sidebarclass = 'col-sm-3 float-right';
            $thebigshop_contentclass = 'col-sm-9 col-xs-12 float-left';
        }
    } else {
        $thebigshop_contentclass = 'col-sm-12';
        $thebigshop_sidebarclass = 'col-sm-3 display-none';
    }

    return array($thebigshop_contentclass, $thebigshop_sidebarclass);
}
