<?php
/**
 * Defines all the theme constants.
 *
 * Included by functions.php.
 *
 * @package    Vagabond
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get the theme object.
$theme = wp_get_theme();

/** Define Theme Constants */

// @type constant Theme Name, used in footer.
if ( ! defined( 'VAGABOND_THEME_NAME' ) ) {
	define( 'VAGABOND_THEME_NAME', $theme->get( 'Name' ) );
}

// @type constant Theme URL, used in footer.
if ( ! defined( 'VAGABOND_THEME_URL' ) ) {
	define( 'VAGABOND_THEME_URL', $theme->get( 'ThemeURI' ) );
}

// @type constant Theme Version.
if ( ! defined( 'VAGABOND_THEME_VERSION' ) ) {
	define( 'VAGABOND_THEME_VERSION', $theme->get( 'Version' ) );
}

// @type constant Text Domain.
if ( ! defined( 'VAGABOND_THEME_TEXTDOMAIN' ) ) {
	define( 'VAGABOND_THEME_TEXTDOMAIN', $theme->get( 'TextDomain' ) );
}

/** Define Developer Information */

// @type constant Theme Developer, used in footer.
if ( ! defined( 'VAGABOND_DEVELOPER' ) ) {
	define( 'VAGABOND_DEVELOPER', $theme->get( 'Author' ) );
}

// @type constant Theme Developer URL, used in footer.
if ( ! defined( 'VAGABOND_DEVELOPER_URL' ) ) {
	define( 'VAGABOND_DEVELOPER_URL', $theme->{'Author URI'} );
}

// Theme Developer Email, used in dashboard widget (optional).
if ( ! defined( 'VAGABOND_DEVELOPER_EMAIL' ) ) {
	define( 'VAGABOND_DEVELOPER_EMAIL', 'support@ajvillegas.com' );
}

// Theme Developer Logo, used in dashboard widget (optional).
if ( ! defined( 'VAGABOND_DEVELOPER_LOGO' ) ) {
	define( 'VAGABOND_DEVELOPER_LOGO', get_template_directory_uri() . '/assets/images/dev-logo.svg' );
}

/** Define Directory Location Constants */

// @type constant Theme lib folder location.
if ( ! defined( 'VAGABOND_INC_DIR' ) ) {
	define( 'VAGABOND_INC_DIR', get_template_directory() . '/includes' );
}

// @type constant Theme images folder location.
if ( ! defined( 'VAGABOND_IMAGES_DIR' ) ) {
	define( 'VAGABOND_IMAGES_DIR', get_template_directory() . '/assets/images' );
}

// @type constant Theme js folder location.
if ( ! defined( 'VAGABOND_JS_DIR' ) ) {
	define( 'VAGABOND_JS_DIR', get_template_directory() . '/assets/js' );
}

// @type constant Theme css folder location.
if ( ! defined( 'VAGABOND_CSS_DIR' ) ) {
	define( 'VAGABOND_CSS_DIR', get_template_directory() . '/assets/css' );
}

/** Define URL Location Constants */

// @type constant Theme lib URL location.
if ( ! defined( 'VAGABOND_INC' ) ) {
	define( 'VAGABOND_INC', get_template_directory_uri() . '/includes' );
}

// @type constant Theme images URL location.
if ( ! defined( 'VAGABOND_IMAGES' ) ) {
	define( 'VAGABOND_IMAGES', get_template_directory_uri() . '/assets/images' );
}

// @type constant Theme js URL location.
if ( ! defined( 'VAGABOND_JS' ) ) {
	define( 'VAGABOND_JS', get_template_directory_uri() . '/assets/js' );
}

// @type constant Theme css URL location.
if ( ! defined( 'VAGABOND_CSS' ) ) {
	define( 'VAGABOND_CSS', get_template_directory_uri() . '/assets/css' );
}
