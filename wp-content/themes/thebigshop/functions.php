<?php
define('THEBIGSHOP_THEME_DIR', get_template_directory() );
define('THEBIGSHOP_THEME_DIR_URI', get_template_directory_uri());
define('THEBIGSHOP_THEME_NAME', 'thebigshop');
define('THEBIGSHOP_THEME_CSS',THEBIGSHOP_THEME_DIR_URI.'/assets/css');
define('THEBIGSHOP_THEME_JS',THEBIGSHOP_THEME_DIR_URI.'/assets/js');
define('THEBIGSHOP_THEME_IMAGES',THEBIGSHOP_THEME_DIR_URI.'/assets/images');
define('THEBIGSHOP_LIB_URI',THEBIGSHOP_THEME_DIR.'/lib');
define('THEBIGSHOP_LIB_ASSETS_URI',THEBIGSHOP_THEME_DIR_URI.'/lib/assets');
define('THEBIGSHOP_LIB_PLUGINS_URI',THEBIGSHOP_THEME_DIR.'/lib/plugins');
define('THEBIGSHOP_LIB_THEMES_URI',THEBIGSHOP_THEME_DIR.'/lib/templates');
include( THEBIGSHOP_LIB_URI . '/td-base.php' );

/**
 * Converts a HEX value to RGB.
 *
 * @since TheBigshop 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function thebigshop_theme_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

function thebigshop_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'thebigshop_content_width', 1170 );
}
add_action( 'after_setup_theme', 'thebigshop_content_width', 0 );


$arr_params = array( 'side' => false, 'col' => false);
esc_url( add_query_arg( $arr_params ) );

function thebigshop_get_post_meta($post_id, $custom_post_class){
    return get_post_meta( $post_id, $custom_post_class, true );
}
