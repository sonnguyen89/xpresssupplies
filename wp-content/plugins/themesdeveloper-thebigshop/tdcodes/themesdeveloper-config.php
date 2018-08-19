<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "thebigshop_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'thebigshop' ),
        'page_title'           => esc_html__( 'Theme Options', 'thebigshop' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => esc_html__( 'Documentation', 'thebigshop' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => esc_html__( 'Support', 'thebigshop' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => esc_html__( 'Extensions', 'thebigshop' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
       //$args['intro_text'] = sprintf( esc_html__( 'TheBigshop', 'thebigshop' ), $v );
    } else {
        //$args['intro_text'] = esc_html__( 'TheBigshop', 'thebigshop' );
    }

    // Add content after the form.
    //$args['footer_text'] = esc_html__( '', 'thebigshop' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'thebigshop' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'thebigshop' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'thebigshop' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'thebigshop' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'thebigshop' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'thebigshop' ),
        'id'               => 'basic-general',
        'desc'             => esc_html__( 'Theme General Setting can manage from here.', 'thebigshop' ),
        'customizer_width' => '400px',
        'icon'  => 'el el-cogs',
        'fields'           => array(
            array(
                'id'       => 'td_layout_style',
                'type'     => 'switch',
                'title'    => esc_html__( 'Layout Style', 'thebigshop' ),
                'subtitle' => esc_html__( 'Select theme Layout Style!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Full width', 'thebigshop' ),
                'off'      => esc_html__( 'Boxed', 'thebigshop' ),
            ),
            array(
                'id'       => 'td-switch-logo',
                'type'     => 'switch',
                'title'    => esc_html__( 'Text Logo', 'thebigshop' ),
                'subtitle' => esc_html__( 'Disable it, if you want to upload your own logo!', 'thebigshop' ),
                'default'  => true,
            ),
             array(
                'id'       => 'td_mainlogo',
                'type'     => 'media',
                'required' => array( 'td-switch-logo', '=', '0' ),
                'url'      => true,
                'title'    => esc_html__( 'Upload Your Logo', 'thebigshop' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc'     => esc_html__( 'The default size is 217x47 px.', 'thebigshop' ),
                'subtitle' => esc_html__( 'Upload Your site Logo from here.', 'thebigshop' ),
                'default'  => array( 'url' => '' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
            array(
                'id'       => 'td-textlogo',
                'required' => array( 'td-switch-logo', '=', '1' ),
                'type'     => 'text',
                'title'    => esc_html__( 'Logo Text', 'thebigshop' ),
                'subtitle' => esc_html__( 'Insert, your logo Text here!', 'thebigshop' ),
                'default'  => 'The Bigshop',
            ),
              array(
                'id'       => 'td-site-description',
                'type'     => 'switch',
                'title'    => esc_html__( 'Description', 'thebigshop' ),
                'subtitle' => esc_html__( 'Tagline for your site should be displayed next to a logo.', 'thebigshop' ),
                'default'  => false,
            ),
             array(
                'id'       => 'td_favicon',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Favicon Icon', 'thebigshop' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc'     => esc_html__( 'The default size is 16x16px px.', 'thebigshop' ),
                'subtitle' => esc_html__( 'Upload your Favicon icon from here!', 'thebigshop' ),
                'default'  => array( 'url' => TDTHEME_IMAGES_PATH.'/icon.jpg' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
             array(
                'id'       => 'td-backtoptopbutton',
                'type'     => 'switch',
                'title'    => esc_html__( 'Back To Top Button', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to use "back to top" button on your page!', 'thebigshop' ),
                'default'  => true,
            ),
          
        )
    ) );

             // -> START Header Selection
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'thebigshop' ),
        'id'               => 'basic-Header',
        'customizer_width' => '500px',
        'desc'             => esc_html__( 'For manage Header layout style and custom HTML blocks!', 'thebigshop' ),
        'icon'  => 'el el-pause',
        'fields'           => array(
            /* array(
                'id'       => 'td_header_style',
                'type'     => 'select',
                'title'    => esc_html__( 'Header Style', 'thebigshop' ),
                'subtitle' => esc_html__( 'Select theme Header Layout Style!', 'thebigshop' ),
                'options'  => array( '1' => 'Style1 - ( Logo Left & Search Right )', '2' => 'Style2 - ( Logo Center & Search Right )', '3' => 'Style3 - ( Logo Left & Search Center )'),
                'default'  => '1',
            ),*/
             array(
                'id'    => 'td-header-mobile',
                'type'  => 'textarea',
                'title' => esc_html__( 'Phone Number', 'thebigshop' ),
                'desc'  => esc_html__( 'Insert Phone Number for header Top bar!', 'thebigshop' ),
                'default'  => '<i class="fa fa-phone"></i>+91 9898777656'
            ),
            array(
                'id'       => 'td-header-email',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Email', 'thebigshop' ),
                'subtitle' => esc_html__( 'Insert Email for header Top bar!', 'thebigshop' ),
                'default'  => '<a href="mailto:info@thebigshop.com"><i class="fa fa-envelope"></i>info@thebigshop.com</a>'
            ),
           array(
                'id'       => 'td-header-customblocks',
                'type'     => 'editor',
                'title'    => esc_html__( 'Custom HTML Blocks', 'thebigshop' ),
                'subtitle' => esc_html__( 'Insert Custom HTML for header Top bar Custom Block!', 'thebigshop' ),
                'default'  => '<a>Custom Block<b></b></a>
                    <div class="custom_block" style="margin-left: -530.883px; display: none;">
                  <ul>
                    <li><table style="width:825px; height: 250px;"><tbody>
                    <tr>
                        <td><h3>Custom Block</h3></td>
                        <td><h3>Custom Block</h3></td>
                        <td><h3>Custom Block</h3></td>
                    </tr>
                    <tr>
                    <td><img src="'.TDTHEME_IMAGES_PATH.'/banners/sb.jpg"></td>
                    <td><img src="'.TDTHEME_IMAGES_PATH.'/banners/sb2.jpg"></td>
                    <td><img src="'.TDTHEME_IMAGES_PATH.'/banners/sb.jpg"></td>
                    </tr>
                    <tr>
                    <td><p>This is a CMS block edited from theme admin panel. You can insert any content (HTML, Text, Images) Here. Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p><p><a target="" href="http://#">Read More</a><br></p></td>
                    <td><p>This is a CMS block edited from theme admin panel. You can insert any content (HTML, Text, Images) Here. Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p><p><a target="" href="http://#">Read More</a><br></p></td>
                    <td><p>This is a CMS block edited from theme admin panel. You can insert any content (HTML, Text, Images) Here. Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p><p><a target="" href="http://#">Read More</a><br></p></td>
                    </tr>
                    </tbody>
                    </table>
                    </li>
                  </ul>
                </div>',
            ),
             array(
                'id'       => 'td-header-custom-feature',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Custom HTML Block', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to use header Custom Feature options for Home Pages!', 'thebigshop' ),
                'default'  => false,
            ),
            array(
                'id'       => 'td-header-custom-feature-box',
                'type'     => 'editor',
                'title'    => esc_html__( 'Custom HTML Blocks', 'thebigshop' ),
                'subtitle' => esc_html__( 'Use any of the features of WordPress editor inside your Bottom of Menu Section!', 'thebigshop' ),
                'default'  => '<div class="col-sm-4 col-xs-12">
                        <div class="feature-box fbox_1">
                          <div class="title">100% Assurance</div>
                          <p>If you have any issue, Immediately refunded.</p>
                        </div>
                      </div>
                                  <div class="col-sm-4 col-xs-12">
                        <div class="feature-box fbox_2">
                          <div class="title">24X7 Care</div>
                          <p>Happy to help 24X7, call us on 0120-3062244</p>
                        </div>
                      </div>
                                  <div class="col-sm-4 col-xs-12">
                        <div class="feature-box fbox_3">
                          <div class="title">Our Promise</div>
                          <p>If we fall short of your expectations, give us a shout.</p>
                        </div>
                      </div>',
            ),
            array(
                'id'       => 'td_main_menu_style',
                'type'     => 'switch',
                'title'    => esc_html__( 'Main Menu Wrapper Style', 'thebigshop' ),
                'subtitle' => esc_html__( 'Select your themes Main Menu Wrapper Style.', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Boxed', 'thebigshop' ),
                'off'      => esc_html__( 'Full width', 'thebigshop' ),
            ),
            array(
                'id'       => 'td_logo_padding',
                'type'     => 'select',
                'title'    => esc_html__( 'Logo Top Padding', 'thebigshop' ),
                'subtitle' => esc_html__( 'Header Logo top Padding set.', 'thebigshop' ),
                'options'  => array(
                    '0' => '0px',
                    '1' => '1px',
                    '2' => '2px',
                    '3' => '3px',
                    '4' => '4px',
                    '5' => '5px',
                    '6' => '6px',
                    '7' => '7px',
                    '8' => '8px',
                    '9' => '9px',
                    '10' => '10px',
                    '11' => '11px',
                    '12' => '12px',
                    '13' => '13px',
                    '14' => '14px',
                    '15' => '15px',
                    '16' => '16px',
                    '17' => '17px',
                    '18' => '18px',
                    '19' => '19px',
                    '20' => '20px',
                    '21' => '21px',
                    '22' => '22px',
                    '23' => '23px',
                    '24' => '24px',
                    '25' => '25px',
                    '26' => '26px',
                    '27' => '27px',
                    '28' => '28px',
                    '29' => '29px',
                    '30' => '30px',
                    '31' => '31px',
                    '32' => '32px',
                    '33' => '33px',
                    '34' => '34px',
                    '35' => '35px',
                    '36' => '36px',
                    '37' => '37px',
                    '38' => '39px',
                    '39' => '39px',
                    '40' => '40px',
                ),
                'default'  => ''
            ),
        )
    ) );

// -> START Sidebar Selection
  Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Sidebar', 'thebigshop' ),
        'id'               => 'basic-Layout',
        'customizer_width' => '500px',
        'desc'             => esc_html__( 'To manage Some page of side from here!', 'thebigshop' ),
        'icon'  => 'el el-website',
        'fields'           => array(
             array(
                'id'       => 'td-search-sidebar-position',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Search Sidebar Position', 'thebigshop' ),
                //'subtitle' => esc_html__( '', 'thebigshop' ),
                'desc'     => esc_html__( 'Set the Search sidebar position for Search pages!', 'thebigshop' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => '2'
            ),
               array(
                'id'       => 'td-archive-sidebar-position',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Archive Sidebar Position', 'thebigshop' ),
                //'subtitle' => esc_html__( '', 'thebigshop' ),
                'desc'     => esc_html__( 'Set the Archive sidebar position for Archive pages!', 'thebigshop' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => '2'
            ),
            array(
                'id'       => 'td-error-sidebar-position',
                'type'     => 'image_select',
                'title'    => esc_html__( '404 Sidebar Position', 'thebigshop' ),
                //'subtitle' => esc_html__( '', 'thebigshop' ),
                'desc'     => esc_html__( 'Set the 404 sidebar position for 404 error page!', 'thebigshop' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => '2'
            ),
             array(
                'id'       => 'td-image-attachments-sidebar-position',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Image Attachments Page Sidebar Position', 'thebigshop' ),
                //'subtitle' => esc_html__( '', 'thebigshop' ),
                'desc'     => esc_html__( 'Set the Image Attachments sidebar position for Image page!', 'thebigshop' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => '2'
            ),
        )
    ) );
    // -> START Color Selection
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Styling', 'thebigshop' ),
        'id'         => 'color-Color',
        'desc'       => esc_html__( 'To manage Custom Theme Colors and Background options from here!', 'thebigshop' ),
        'icon'  => 'el el-brush',
        'fields'     => array(
            array(
                'id'       => 'td_precent_skin',
                'type'     => 'select',
                'title'    => esc_html__( 'Theme Skin', 'thebigshop' ),
                'subtitle' => esc_html__( 'Select your themes alternative color scheme.', 'thebigshop' ),
                'options'  => array( '1' => 'TheBigshop 1', '2' => 'TheBigshop 2' ,'3' => 'TheBigshop 3'),
                'default'  => '1',
            ),
            array(
                'id'       => 'td_body_background',
                'type'     => 'background',
                'output'   => array( 'body' ),
                'title'    => esc_html__( 'Body Background', 'thebigshop' ),
                'subtitle' => esc_html__( 'Body background with image, color, etc.', 'thebigshop' ),
                'default'   => '',
            ),
            array(
                'id'       => 'td_general_links_color',
                'type'     => 'color',
                'title'    => esc_html__( 'General Links Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a General Links color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_general_links_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'General Links Hover Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a General Links Hover color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
             array(
                'id'       => 'td_heading_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Titles Text Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Titles Text color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
             array(
                'id'       => 'td_secondary_heading_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Secondary Titles Text Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Secondary Titles Text color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
             array(
                'id'       => 'td_secondary_heading_border_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Secondary Titles Border Bottom Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Secondary Titles Border Bottom color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'section-topbar',
                'type'     => 'section',
                'title'    => esc_html__( 'Top Bar', 'thebigshop' ),
                'subtitle' => esc_html__( 'With the "section" field you can manage Header Top Bar background/colors Options.', 'thebigshop' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'td_top_bar_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Top Bar Background Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Top Bar Background color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_top_bar_link_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Top Bar link Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Top Bar link color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_top_bar_link_separator_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Top Bar link Separator Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Top Bar link Separator color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_top_bar_sub_link_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Top Bar Sub Link Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Top Bar Sub Link color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_top_bar_sub_link_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Top Bar Sub Link Hover Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Top Bar Sub Link Hover color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'section-header',
                'type'     => 'section',
                'title'    => esc_html__( 'Header', 'thebigshop' ),
                'subtitle' => esc_html__( 'With the "section" field you can manage Header background/colors Options.', 'thebigshop' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'td_header_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Header Background Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Header Background color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_mini_cart_icon_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Mini Cart Icon Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Mini Cart Icon color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_mini_cart_link_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Mini Cart Link Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Mini Cart Link color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_mini_cart_active_link_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Mini Cart Active Link Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Mini Cart Active Link color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_search_bar_background_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Search Background Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Search Background Color color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_search_bar_border_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Search Border Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Search Border color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_search_bar_border_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Search Border Hover Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Search Border Hover color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_search_bar_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Search Text Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Search Text color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td_search_bar_icon_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Search Icon Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Search Icon color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'section-footer1',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Part 1', 'thebigshop' ),
                'subtitle' => esc_html__( 'With the "section" field you can manage Footer Part 1 background/colors Options.', 'thebigshop' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'td_footer_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Background Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Footer Background color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'td_footer_titles_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Titles Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Footer Titles color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'td_footer_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Text Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Footer Text color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'td_footer_link_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Links Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Footer Links color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
              array(
                'id'       => 'td_footer_link_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Links Hover Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Footer Links Hover color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
              array(
                'id'       => 'td_contact_icon_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Content Icon Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Footer Content Icon color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'section-footer2',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Part 2', 'thebigshop' ),
                'subtitle' => esc_html__( 'With the "section" field you can manage Footer Part 2 background/colors Options.', 'thebigshop' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
              array(
                'id'       => 'td_footer_second_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Second Background Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Footer Second Background color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
              array(
                'id'       => 'td_footer_second_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Second Text Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Footer Second Text color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
              array(
                'id'       => 'td_footer_second_link_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Second Links Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Footer Second Links color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
              array(
                'id'       => 'td_footer_second_link_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Second Links Hover Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Footer Second Links Hover color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
             array(
                'id'       => 'td_footer_second_separator_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Second Separator Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Footer Second Separator color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'td_footer_backtotop_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer BacktoTop Background Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Footer BacktoTop Background color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'section-button',
                'type'     => 'section',
                'title'    => esc_html__( 'General Buttons', 'thebigshop' ),
                'subtitle' => esc_html__( 'With the "section" field you can manage General Buttons background/colors Options.', 'thebigshop' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'td_button_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Background Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Button Background color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
              array(
                'id'       => 'td_button_bg_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Background Hover Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Button Background Hover color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
              array(
                'id'       => 'td_button_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Text Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Button Text color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
              array(
                'id'       => 'td_button_text_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Text Hover Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Button Text Hover color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'section-cartbutton',
                'type'     => 'section',
                'title'    => esc_html__( 'Add to Cart Buttons', 'thebigshop' ),
                'subtitle' => esc_html__( 'With the "section" field you can manage Add to Cart Buttons background/colors Options.', 'thebigshop' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
             array(
                'id'       => 'td_cart_button_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Cart Button Background Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Cart Button Background color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
             array(
                'id'       => 'td_cart_button_bg_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Cart Button Background Hover Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Cart Button Background Hover color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
              array(
                'id'       => 'td_cart_button_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Cart Button Text Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Cart Button Text color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
              array(
                'id'       => 'td_cart_button_text_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Cart Button Text Hover Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Cart Button Text Hover color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'section-customblock',
                'type'     => 'section',
                'title'    => esc_html__( 'Custom Block', 'thebigshop' ),
                'subtitle' => esc_html__( 'With the "section" field you can manage Custom Block background/colors Options.', 'thebigshop' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
              array(
                'id'       => 'td_custom_block_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Custom Block Background Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Custom Block Background color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'section-percentage',
                'type'     => 'section',
                'title'    => esc_html__( 'Saving Percentage', 'thebigshop' ),
                'subtitle' => esc_html__( 'With the "section" field you can manage Saving Percentage background/colors Options.', 'thebigshop' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
              array(
                'id'       => 'td_saving_percentage_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Background Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a background color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'td_saving_percentage_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Text Color color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'section-price',
                'type'     => 'section',
                'title'    => esc_html__( 'Price Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'With the "section" field you can manage Price background/colors Options.', 'thebigshop' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
             array(
                'id'       => 'td_price_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Price Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Price color for the theme (default: #3e7cb4).', 'thebigshop' ),
                'default'  => '#3e7cb4',
                'validate' => 'color',
            ),
            array(
                'id'       => 'td_old_price_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Old Price Color', 'thebigshop' ),
                'subtitle' => esc_html__( 'Pick a Old Price color for the theme (default: #).', 'thebigshop' ),
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'td_custom_css',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Custom CSS', 'thebigshop' ),
                'subtitle' => esc_html__( 'Insert Custom CSS Codes here!', 'thebigshop' ),
                'default'  => '',
            ),
            
        ),
    ) );
// -> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Typography', 'thebigshop' ),
        'id'     => 'typography',
        //'desc'   => esc_html__( 'For full documentation on this field, visit: ', 'thebigshop' ) . '<a href="//docs.reduxframework.com/core/fields/typography/" target="_blank">docs.reduxframework.com/core/fields/typography/</a>',
        'desc'   => esc_html__( 'To manage Typography options for the theme from here!', 'thebigshop' ),
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'       => 'td-typography-body',
                'type'     => 'typography',
                'line-height'   => false,
                'text-align' => false,
                'output'    => array('body'), 
                'title'    => esc_html__( 'Body Font', 'thebigshop' ),
                'subtitle' => esc_html__( 'Specify the body font properties.', 'thebigshop' ),
                'google'   => true,
                'default'  => array(
                    'color'       => '',
                    'font-size'   => '',
                    'font-family' => '',
                    'font-weight' => '',
                ),
            ),
            array(
                'id'       => 'td_titles_font',
                'type'     => 'typography',
                'line-height'   => false,
                'text-align' => false,
                'color'=>false,
                'output'    => array('#container h1'), 
                'text-transform'=>true,
                'title'    => esc_html__( 'Title Font', 'thebigshop' ),
                'subtitle' => esc_html__( 'Specify the Title font properties.', 'thebigshop' ),
                'google'   => true,
                'default'  => array(
                    'font-size'   => '',
                    'font-family' => '',
                    'font-weight' => '',
                    'text-transform'=>'',
                ),
            ),
            array(
                'id'       => 'td-typography-top-bar',
                'type'     => 'typography',
                'line-height'   => false,
                'text-align' => false,
                'output'    => array('#header .links > ul > li.mobile, #header #top-links > ul > li > a, #header .links ul li a, #language span, #currency span, #header .links .wrap_custom_block > a'), 
                'color'=>false,
                'text-transform'=>true,
                'title'    => esc_html__( 'Top Bar Font', 'thebigshop' ),
                'subtitle' => esc_html__( 'Specify the Top Bar font properties.', 'thebigshop' ),
                'google'   => true,
                'default'  => array(
                    'font-size'   => '',
                    'font-family' => '',
                    'font-weight' => '',
                    'text-transform'=>'',
                ),
            ),
            array(
                'id'       => 'td_secondary_titles_font',
                'type'     => 'typography',
                'line-height'   => false,
                'text-align' => false,
                'color'=>false,
                'output'    => array('#container h2, #container h3, .product-tab .htabs a, .product-tab .tabs li a'), 
                'text-transform'=>true,
                'title'    => esc_html__( 'Secondary Titles Font', 'thebigshop' ),
                'subtitle' => esc_html__( 'Specify the Secondary Titles font properties.', 'thebigshop' ),
                'google'   => true,
                'default'  => array(
                    'font-size'   => '',
                    'font-family' => '',
                    'font-weight' => '',
                    'text-transform'=>'',
                ),
            ),
            array(
                'id'       => 'td_footer_titles_font',
                'type'     => 'typography',
                'line-height'   => false,
                'text-align' => false,
                'color'=>false,
                'output'    => array('#footer h5'), 
                'text-transform'=>true,
                'title'    => esc_html__( 'Footer Titles Font', 'thebigshop' ),
                'subtitle' => esc_html__( 'Specify the Footer Titles font properties.', 'thebigshop' ),
                'google'   => true,
                'default'  => array(
                    'font-size'   => '',
                    'font-family' => '',
                    'font-weight' => '',
                    'text-transform'=>'',
                ),
            ),
        )
    ) );
             // -> START Social Selection
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social', 'thebigshop' ),
        'id'         => 'Social-Options',
        'desc'       => esc_html__( 'To manage Social options for the theme! ', 'thebigshop' ),
        'icon'  => 'el el-share',
        'fields'     => array(
            array(
                'id'       => 'td-social-facebook',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook Links', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Facebook Links here!', 'thebigshop' ),
                'default'  => 'https://facebook.com/themesdeveloper',
            ),
            array(
                'id'       => 'td-social-twitter',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter Links', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Twitter Links here!', 'thebigshop' ),
                'default'  => 'https://twitter.com/themesdeveloper',
            ),
            array(
                'id'       => 'td-social-googleplus',
                'type'     => 'text',
                'title'    => esc_html__( 'Google+', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Google+ Links here!', 'thebigshop' ),
                'default'  => '#',
            ),
            array(
                'id'       => 'td-social-pinterest',
                'type'     => 'text',
                'title'    => esc_html__( 'Pinterest', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Pinterest Links here!', 'thebigshop' ),
                'default'  => '#',
            ),
            array(
                'id'       => 'td-social-rss',
                'type'     => 'text',
                'title'    => esc_html__( 'RSS', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social RSS Links here!', 'thebigshop' ),
                'default'  => '#',
            ),
             array(
                'id'       => 'td-social-blogger',
                'type'     => 'text',
                'title'    => esc_html__( 'Blogger Links', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Blogger Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-myspace',
                'type'     => 'text',
                'title'    => esc_html__( 'Myspace Links', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Myspace Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-linkedin',
                'type'     => 'text',
                'title'    => esc_html__( 'Linkedin', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Linkedin Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-evernote',
                'type'     => 'text',
                'title'    => esc_html__( 'Evernote', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Evernote Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-dopplr',
                'type'     => 'text',
                'title'    => esc_html__( 'Dopplr', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Dopplr Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-ember',
                'type'     => 'text',
                'title'    => esc_html__( 'Ember', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Ember Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-flickr',
                'type'     => 'text',
                'title'    => esc_html__( 'Flickr Links', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Flickr Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-picasa_web',
                'type'     => 'text',
                'title'    => esc_html__( 'Picasa Web', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Facebook Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-youtube',
                'type'     => 'text',
                'title'    => esc_html__( 'Youtube', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Youtube Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-technorati',
                'type'     => 'text',
                'title'    => esc_html__( 'Technorati', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Technorati Links here!', 'thebigshop' ),
                'default'  => '',
            ),
             array(
                'id'       => 'td-social-grooveshark',
                'type'     => 'text',
                'title'    => esc_html__( 'Grooveshark Links', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Grooveshark Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-vimeo',
                'type'     => 'text',
                'title'    => esc_html__( 'Vimeo Links', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Vimeo Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-sharethis',
                'type'     => 'text',
                'title'    => esc_html__( 'Sharethis', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Sharethis Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-yahoobuzz',
                'type'     => 'text',
                'title'    => esc_html__( 'Yahoobuzz', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Yahoobuzz Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-viddler',
                'type'     => 'text',
                'title'    => esc_html__( 'Viddler', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Viddler Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-skype',
                'type'     => 'text',
                'title'    => esc_html__( 'Skype', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Skype Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-googletalk',
                'type'     => 'text',
                'title'    => esc_html__( 'Google Talk', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Google Talk Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-digg',
                'type'     => 'text',
                'title'    => esc_html__( 'Digg', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Digg Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-reddit',
                'type'     => 'text',
                'title'    => esc_html__( 'Reddit', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Reddit Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-delicious',
                'type'     => 'text',
                'title'    => esc_html__( 'Delicious', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Delicious Links here!', 'thebigshop' ),
                'default'  => '',
            ),
             array(
                'id'       => 'td-social-stumbleupon',
                'type'     => 'text',
                'title'    => esc_html__( 'Stumbleupon', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Stumbleupon Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-friendfeed',
                'type'     => 'text',
                'title'    => esc_html__( 'Friendfeed Links', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Friendfeed Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-tumblr',
                'type'     => 'text',
                'title'    => esc_html__( 'Tumblr', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Tumblr Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-yelp',
                'type'     => 'text',
                'title'    => esc_html__( 'Yelp', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Yelp Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-posterous',
                'type'     => 'text',
                'title'    => esc_html__( 'Posterous', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Posterous Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            /* ***************************/
             array(
                'id'       => 'td-social-bebo',
                'type'     => 'text',
                'title'    => esc_html__( 'Bebo', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Bebo Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-virb',
                'type'     => 'text',
                'title'    => esc_html__( 'Virb', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Virb Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-last_fm',
                'type'     => 'text',
                'title'    => esc_html__( 'Last FM', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Last FM Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-pandora',
                'type'     => 'text',
                'title'    => esc_html__( 'Pandora', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Pandora Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-mixx',
                'type'     => 'text',
                'title'    => esc_html__( 'Mixx', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Mixx Links here!', 'thebigshop' ),
                'default'  => '',
            ),
             array(
                'id'       => 'td-social-newsvine',
                'type'     => 'text',
                'title'    => esc_html__( 'Newsvine', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Newsvine Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-openid',
                'type'     => 'text',
                'title'    => esc_html__( 'Openid', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Openid Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-readernaut',
                'type'     => 'text',
                'title'    => esc_html__( 'Readernaut', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Readernaut Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-xing_me',
                'type'     => 'text',
                'title'    => esc_html__( 'Xing Me', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Xing Me Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-instagram',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Instagram Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-spotify',
                'type'     => 'text',
                'title'    => esc_html__( 'Spotify', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Spotify Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-forrst',
                'type'     => 'text',
                'title'    => esc_html__( 'Forrst', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Forrst Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-viadeo',
                'type'     => 'text',
                'title'    => esc_html__( 'Viadeo', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social Viadeo Links here!', 'thebigshop' ),
                'default'  => '',
            ),
            array(
                'id'       => 'td-social-vk_com',
                'type'     => 'text',
                'title'    => esc_html__( 'VK Com', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Social VK Com Links here!', 'thebigshop' ),
                'default'  => '',
            ),
        ),
    ) );
    // -> START Blog Selection
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom Side Block', 'thebigshop' ),
        'id'         => 'blog-custom-sidebox',
        'desc'       => esc_html__( 'To manage Custom Side Block for the theme!', 'thebigshop' ),
        'icon'  => 'el el-eye-close',
      'fields'     => array(
             array(
                'id'       => 'td-sidebox-facebook-show',
                'type'     => 'switch',
                'title'    => esc_html__( 'Facebook Likebox Show', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to use Facebook Likebox in theme side block!', 'thebigshop' ),
                'default'  => false,
            ),
           array(
                'id'       => 'td_facebook_box_align',
                'type'     => 'switch',
                'title'    => esc_html__( 'Facebook Side Block Position', 'thebigshop' ),
                'subtitle' => esc_html__( 'Select Facebook Side Block Position for the theme!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Left', 'thebigshop' ),
                'off'      => esc_html__( 'Right', 'thebigshop' ),
            ),
            array(
                'id'       => 'td_facebook_id_box',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook Page URL', 'thebigshop' ),
                'subtitle' => esc_html__( 'Facebook Page URL, like https://www.facebook.com/themesdeveloper', 'thebigshop' ),
                'default'  => 'https://www.facebook.com/themesdeveloper',
            ),
            array(
                'id'       => 'td-sidebox-twitter-show',
                'type'     => 'switch',
                'title'    => esc_html__( 'Twitter Block Show', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to use Twitter Block in theme Side Block!', 'thebigshop' ),
                'default'  => false,
            ),
            array(
                'id'       => 'td_twitter_box_align',
                'type'     => 'switch',
                'title'    => esc_html__( 'Twitter Side Block Position', 'thebigshop' ),
                'subtitle' => esc_html__( 'Select Twitter Side Block Position for the theme!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Left', 'thebigshop' ),
                'off'      => esc_html__( 'Right', 'thebigshop' ),
            ),
               array(
                'id'       => 'td_sidebox_twitter_username',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter UserName', 'thebigshop' ),
                'subtitle' => esc_html__( 'Insert your twitter UserName Here!', 'thebigshop' ),
                'default'  => 'HarnishDesign',
            ),
          array(
                'id'       => 'td_sidebox_twitter_widget_id',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter Widget ID', 'thebigshop' ),
                'subtitle' => esc_html__( '<a class="link" target="_blank" href="http://demo.harnishdesign.net/opencart/thebigshop/twitter-widget-id.jpg">Find your Widget ID >></a>', 'thebigshop' ),
                'default'  => '347621595801608192',
            ),
            array(
                'id'       => 'td-sidebox-video-show',
                'type'     => 'switch',
                'title'    => esc_html__( 'Video Block Show', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to use Video Block in theme side block!', 'thebigshop' ),
                'default'  => false,
            ),
            array(
                'id'       => 'td_video_box_align',
                'type'     => 'switch',
                'title'    => esc_html__( 'Video Side Block Position', 'thebigshop' ),
                'subtitle' => esc_html__( 'Select Video Side Block Position for the theme!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Left', 'thebigshop' ),
                'off'      => esc_html__( 'Right', 'thebigshop' ),
            ),
            array(
                'id'       => 'td-sidebox-video',
                'type'     => 'text',
                'title'    => esc_html__( 'Youtube Video ID ', 'thebigshop' ),
                'subtitle' => esc_html__( 'Insert Youtube Video ID here for the theme!', 'thebigshop' ),
                'default'  => 'SZEflIVnhH8',
            ),
       array(
                'id'       => 'td-sidebox-customhtml-show',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom HTML Blocks Show', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to use Custom HTML Blocks in theme side block!', 'thebigshop' ),
                'default'  => false,
            ),
            array(
                'id'       => 'td_customhtml_box_align',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom HTML Side Block Position', 'thebigshop' ),
                'subtitle' => esc_html__( 'Select Custom HTML Side Block Position for the theme!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Left', 'thebigshop' ),
                'off'      => esc_html__( 'Right', 'thebigshop' ),
            ),
            array(
                'id'       => 'td-sidebox-customhtml',
                'type'     => 'editor',
                'title'    => esc_html__( 'Custom HTML Blocks', 'thebigshop' ),
                'subtitle' => esc_html__( 'Use any of the HTML features here for the theme custom side block!', 'thebigshop' ),
                'default'  => '<table style="border-spacing: 5; padding:0; border:0; text-align:left;">
    <tbody>		
        <tr>			
            <td>			
                <h2>CMS Blocks</h2>			
            </td>		
        </tr>			
        <tr>			
            <td>You can add any HTML content to this block or turn it off in Theme Admin panel!</td>		
        </tr>		
        <tr>			
            <td><strong><a href="#">Read More</a></strong></td>		
        </tr>	
    </tbody>
</table>',
            ),
        ),
    ) );
            

         // -> START Blog Selection
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'thebigshop' ),
        'id'         => 'blog-Options',
        'desc'       => esc_html__( 'To manage Blog Options for the theme!', 'thebigshop' ),
        'icon'  => 'el el-th-large',
        'fields'     => array(
             array(
                'id'       => 'td-blog-sidebar-position',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Blog Sidebar Position', 'thebigshop' ),
                //'subtitle' => esc_html__( '', 'thebigshop' ),
                'desc'     => esc_html__( 'Set the Blog sidebar position for blog pages.', 'thebigshop' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'td_blog_layout',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog Layout', 'thebigshop' ),
                'subtitle' => esc_html__( 'Select your themes alternative color scheme.', 'thebigshop' ),
                'options'  => array( '1' => 'Blog Layout-1', '2' => 'Blog Layout-2'),
                'default'  => '1',
            ),
          array(
                'id'       => 'section-tdsinglepost',
                'type'     => 'section',
                'title'    => esc_html__( 'Single Post Page', 'thebigshop' ),
                'subtitle' => esc_html__( 'With the "section" field you can manage Single Post Page!', 'thebigshop' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'td_blog_social',
                'type'     => 'switch',
                'title'    => esc_html__( 'Social Icons', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Social Sharing Icons Block in single blog page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
             array(
                'id'       => 'td_blog_nextpre_pagination',
                'type'     => 'switch',
                'title'    => esc_html__( 'Next/Previous Pagination', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Next/Previous Pagination in single Post page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
             array(
                'id'       => 'td_blog_author_info',
                'type'     => 'switch',
                'title'    => esc_html__( 'Author Info Block', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Author Info Block in single Post page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
              array(
                'id'       => 'td_blog_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Comments Block', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Comments Block in single Post page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
              array(
                'id'       => 'td_blog_meta',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Meta Info', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Post Meta Info in single Post page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
                array(
                'id'       => 'td_blog_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Meta Date Info', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Post Meta Date Info in single Post page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),  array(
                'id'       => 'td_blog_bylink',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post By Author Info', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Post By Author Info in single Post page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
        ),
    ) );
         // -> START Portfolio Selection
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Portfolio', 'thebigshop' ),
        'id'         => 'Portfolio-Options',
        'desc'       => esc_html__( 'To manage Portfolio Options for the theme!', 'thebigshop' ),
        'icon'  => 'el el-leaf',
        'fields'     => array(
            array(
                'id'       => 'td-protfolio-sidebar-position',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Portfolio Sidebar Position', 'thebigshop' ),
                //'subtitle' => esc_html__( '', 'thebigshop' ),
                'desc'     => esc_html__( 'Set the Portfolio sidebar position for the Portfolio pages!', 'thebigshop' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => '2'
            ),
            array(
                'id'       => 'td-portfolio-col-per-row',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Portfolio Show Per Column', 'thebigshop' ),
                //'subtitle' => esc_html__( '', 'thebigshop' ),
                'desc'     => esc_html__( 'Set the Portfolio Show Per Column for the Portfolio pages!', 'thebigshop' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    )
                    
                ),
                'default'  => '2'
            ),
            array(
                'id'       => 'td_portfolio_par_pages',
                'type'     => 'text',
                'title'    => esc_html__( 'Portfolio pages show at most', 'thebigshop' ),
                'subtitle' => esc_html__( 'Show number of portfolio in pages.', 'thebigshop' ),
                'default'  => '10',
            ),
             array(
                'id'       => 'td_portfolio_category',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Filter Categories', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Portfolio Filter Categories in the Portfolio page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
            array(
                'id'       => 'td_portfolio_title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Items Title', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Portfolio Items Title in the Portfolio page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
              array(
                'id'       => 'td_portfolio_cat',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Items Tag', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Portfolio Items Tag in the Portfolio page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
          array(
                'id'       => 'td_portfolio_excerpt',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Items Excerpt', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Portfolio Items Excerpt in the Portfolio page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
             array(
                'id'       => 'section-tdportfoliosingle',
                'type'     => 'section',
                'title'    => esc_html__( 'Single Pages', 'thebigshop' ),
                'subtitle' => esc_html__( 'With the "section" field you can manage Single Portfolio Page sections!', 'thebigshop' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
             array(
                'id'       => 'td_portfolio_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Comments', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Portfolio Comments in the Portfolio single page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
            array(
                'id'       => 'td_portfolio_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Author', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Portfolio Author info in the Portfolio single page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
             array(
                'id'       => 'td_portfolio_social',
                'type'     => 'switch',
                'title'    => esc_html__( 'Social Icons', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Social Icons info in the Portfolio single page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
        ),
    ) );
             // -> START WooCommerce Selection
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'WooCommerce', 'thebigshop' ),
        'id'         => 'WooCommerce-Options',
        'desc'       => esc_html__( 'To manage WooCommerce Archive/Category and Single Product pages Options for the theme!', 'thebigshop' ),
        'icon'  => 'el el-shopping-cart',
        'fields'     => array(
             array(
                'id'       => 'td-shop-sidebar-position',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Archive/Category Sidebar Position', 'thebigshop' ),
                //'subtitle' => esc_html__( '', 'thebigshop' ),
                'desc'     => esc_html__( 'Set the Archive/Category sidebar position for the theme!', 'thebigshop' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => '2'
            ),
             array(
                'id'       => 'td-product-sidebar-position',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Single Product Page Sidebar Position', 'thebigshop' ),
                //'subtitle' => esc_html__( '', 'thebigshop' ),
                'desc'     => esc_html__( 'Set the Single Product Page sidebar position for the theme!', 'thebigshop' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => '2'
            ),
            array(
                'id'       => 'td-woo-categories-number-of-column',
                'type'     => 'select',
                'title'    => esc_html__( 'Number Of Products Per Row', 'thebigshop' ),
                'subtitle' => esc_html__( 'Archive/Category Pages.', 'thebigshop' ),
                'desc'     => esc_html__( 'Selete number of product per column for Archive/Category Pages!', 'thebigshop' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                ),
                'default'  => '4'
            ),
            array(
                'id'       => 'td-woo-product-images-style',
                'type'     => 'select',
                'title'    => esc_html__( 'Zoom Style', 'thebigshop' ),
                'subtitle' => esc_html__( 'Single Product page zoom style', 'thebigshop' ),
                'desc'     => esc_html__( 'Selete image zoom style of single products Pages!', 'thebigshop' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'default' => esc_html__( 'Default WooCommerce Style', 'thebigshop' ),
                    'magnific' => esc_html__( 'TheBigshop ( Magnific Popup )', 'thebigshop' ),
                    'cloudzoom' => esc_html__( 'TheBigshop ( Zoom with Popup ) ', 'thebigshop' ),
                ),
                'default'  => 'default'
            ),
            array(
                'id'       => 'td_woo_num_products_per_page',
                'type'     => 'text',
                'title'    => esc_html__( 'Products Per Page', 'thebigshop' ),
                'subtitle' => esc_html__( 'Products Per Page for Archive/Category Pages', 'thebigshop' ),
                'default'  => '18',
            ),
            array(
                'id'       => 'td-woo-related-number-of-column',
                'type'     => 'select',
                'title'    => esc_html__( 'Number Of Products Per Row', 'thebigshop' ),
                'subtitle' => esc_html__( 'Releted/Cross-sells/Upsells Products.', 'thebigshop' ),
                'desc'     => esc_html__( 'Selete number of product per column for Releted/Cross-sells/Upsells Products!', 'thebigshop' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                ),
                'default'  => '4'
            ),
             array(
                'id'       => 'td_single_product_social',
                'type'     => 'switch',
                'title'    => esc_html__( 'Social Icons', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Social Icons in the Products single page!', 'thebigshop' ),
                'default'  => '1',
                'on'       => esc_html__( 'Enable', 'thebigshop' ),
                'off'      => esc_html__( 'Disable', 'thebigshop' ),
            ),
        ),
    ) ); 


             // -> START WooCommerce Selection
/*Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Slider', 'thebigshop' ),
        'id'         => 'Slider-Options',
        'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'thebigshop' ) . '<a href="//docs.reduxframework.com/core/fields/color/" target="_blank">docs.reduxframework.com/core/fields/color/</a>',
        'icon'  => 'el el-brush',
        'fields'     => array(
             array(
                'id'       => 'td_products_social',
                'type'     => 'switch',
                'title'    => esc_html__( 'Single Product Social', 'thebigshop' ),
                'subtitle' => esc_html__( 'Blog Social in single blog  page.', 'thebigshop' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
        ),
    ) );*/
         // -> START Footer Selection
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Footer', 'thebigshop' ),
        'id'               => 'basic-Footer',
        'customizer_width' => '500px',
        'desc'             => esc_html__( 'To manage Footer section for the theme!', 'thebigshop' ),
        'icon'  => 'el el-pause',
        'fields'           => array(
            array(
                'id'       => 'td-footer-custom-feature',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Custom HTML Block', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to use footer Custom Feature options for Home Pages!', 'thebigshop' ),
                'default'  => false,
            ),
            array(
                'id'       => 'td-footer-custom-feature-box',
                'type'     => 'editor',
                'title'    => esc_html__( 'Custom HTML Blocks', 'thebigshop' ),
                'subtitle' => esc_html__( 'Use any of the features of WordPress editor inside your Bottom of Menu Section!', 'thebigshop' ),
                'default'  => '<div class="col-sm-4 col-xs-12">
                        <div class="feature-box fbox_1">
                          <div class="title">100% Assurance</div>
                          <p>If you have any issue, Immediately refunded.</p>
                        </div>
                      </div>
                                  <div class="col-sm-4 col-xs-12">
                        <div class="feature-box fbox_2">
                          <div class="title">24X7 Care</div>
                          <p>Happy to help 24X7, call us on 0120-3062244</p>
                        </div>
                      </div>
                                  <div class="col-sm-4 col-xs-12">
                        <div class="feature-box fbox_3">
                          <div class="title">Our Promise</div>
                          <p>If we fall short of your expectations, give us a shout.</p>
                        </div>
                      </div>',
            ),
              array(
                'id'       => 'td-footer-contactinfo-show',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Contact Info Block', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to show Footer Contact Info Block in the theme Pages Footer section!', 'thebigshop' ),
                'default'  => true,
            ),
             array(
                'id'       => 'td-footer-contactinfo',
                'type'     => 'editor',
                'title'    => esc_html__( 'Footer Contact Info', 'thebigshop' ),
                'subtitle' => esc_html__( 'Insert, Footer Contact details Info!', 'thebigshop' ),
                'default'  => '<div class="contact col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h5>Contact Details</h5>
                                        <ul>
                        <li class="address"><i class="fa fa-map-marker"></i>TheBigshop Plaza, 22 Hoi Wing Road, Delhi, India.</li>
                                                <li class="mobile"><i class="fa fa-phone"></i>+91 9898989898</li>
                                                <li class="email"><i class="fa fa-envelope"></i><a href="mailto:info@thebigshop.com">info@thebigshop.com</a>
                                      </li></ul>
                  </div>',
            ),
            
     array(
                'id'       => 'td-footer-poweredby',
                'type'     => 'editor',
                'title'    => esc_html__( 'Copyright Info ', 'thebigshop' ),
                'subtitle' => esc_html__( 'Insert, Footer Copyright Info for the theme!', 'thebigshop' ),
                'default'  => '<p>TheBigshop Theme &copy; 2017 | Theme By <a href="http://themesdeveloper.com" target="_blank">ThemesDeveloper</a></p>  ',
            ),
            array(
                'id'       => 'td-footer-textblock-feature',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom HTML Text Blocks', 'thebigshop' ),
                'subtitle' => esc_html__( 'Enable it, if you want to use footer Custom HTML Text Blocks on theme footer!', 'thebigshop' ),
                'default'  => false,
            ),
            array(
                'id'       => 'td-footer-textblock',
                'type'     => 'editor',
                'title'    => esc_html__( 'Custom HTML Text Blocks', 'thebigshop' ),
                'subtitle' => esc_html__( 'Insert, Footer Custom HTML Text Blocks for the theme!', 'thebigshop' ),
                'default'  => '<p>This is a CMS block edited from theme admin panel. You can insert any content (HTML, Text, Images) Here. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>',
            ),
            array(
                'id'       => 'td-footer-paymentlogo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload Your Payment Logo', 'thebigshop' ),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc'     => esc_html__( 'The default size is 327x30 px.', 'thebigshop' ),
                'subtitle' => esc_html__( 'Upload your payment Method logo for theme footer section.', 'thebigshop' ),
                'default'  => array( 'url' => TDTHEME_IMAGES_PATH.'/payment.png' ),
                //'hint'      => array(
                //    'title'     => 'Hint Title',
                //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                //)
            ),
            array(
                'id'       => 'td-footer-paymentlinks',
                'type'     => 'text',
                'title'    => esc_html__( 'Payment Logo Links', 'thebigshop' ),
                'subtitle' => esc_html__( 'Add Your Payment Logo Links here!', 'thebigshop' ),
                'default'  => '#',
            ),
             array(
                'id'       => 'td_column_co_bottom_widgets',
                'type'     => 'select',
                'title'    => esc_html__( 'Number of Column Content Bottom Widgets Section', 'thebigshop' ),
                'subtitle' => esc_html__( 'Number of Column Pages Content Bottom Widgets Section', 'thebigshop' ),
                //'desc'     => esc_html__( 'Selete number of product per column for Releted/Cross-sells/Upsells Products!', 'thebigshop' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                ),
                'default'  => '4'
            ),
           
               
        )
    ) );

    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => esc_html__( 'Documentation', 'thebigshop' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'thebigshop' ),
                'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'thebigshop' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }