<?php
/**
 * Enqueue scripts and styles.
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

/**
 * Build the Google fonts URL to enqueue in a translator friendly manner.
 *
 * When adding font families replace the '+' (plus) sign in the string
 * with a space, otherwise the URL will be encoded with the '%2B' entity
 * and generate a request error.
 *
 * @since 1.0.0
 * @return string Google Fonts URL
 * @link http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 */
function vagabond_google_fonts_url() {

	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by this font type, translate to 'off'. Do not translate
	 * into your own language.
	 */
	$playfair = esc_html_x( 'on', 'Playfair Display font: on or off?', 'vagabond' );
	$roboto   = esc_html_x( 'on', 'Roboto font: on or off?', 'vagabond' );

	if ( 'off' !== $playfair || 'off' !== $roboto ) {
		$font_families = array();

		if ( 'off' !== $playfair ) {
			$font_families[] = 'Playfair Display:400,700';
		}

		if ( 'off' !== $roboto ) {
			$font_families[] = 'Roboto:400,700';
		}

		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );

}

add_action( 'wp_enqueue_scripts', 'vagabond_scripts_and_styles' );
/**
 * Enqueue scripts and styles.
 *
 * @since  1.0.0
 */
function vagabond_scripts_and_styles() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Bootstrap CSS.
	wp_enqueue_style( 'vagabond-bootstrap', VAGABOND_CSS . '/bootstrap.css', array(), '4.3.1', 'all' );

	// Main Stylesheet.
	wp_enqueue_style( 'vagabond-style', get_stylesheet_uri(), array( 'vagabond-bootstrap' ), VAGABOND_THEME_VERSION, 'all' );

	// Google Fonts.
	wp_enqueue_style( 'vagabond-google-fonts', vagabond_google_fonts_url(), array(), VAGABOND_THEME_VERSION, 'all' );

	// Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Bootstrap JS.
	wp_enqueue_script( 'vagabond-bootstrapjs', VAGABOND_JS . '/bootstrap.min.js', array( 'jquery' ), '4.3.1', true );

	// Sitewide JS.
	wp_enqueue_script( 'vagabond-site-js', VAGABOND_JS . "/custom{$suffix}.js", array( 'jquery', 'vagabond-bootstrapjs' ), VAGABOND_THEME_VERSION, true );

}

add_action( 'admin_enqueue_scripts', 'vagabond_admin_scripts_and_styles' );
/**
 * Enqueue admin scripts and styles.
 *
 * @since  1.0.0
 */
function vagabond_admin_scripts_and_styles() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Admin CSS.
	wp_enqueue_style( 'vagabond-admin-style', VAGABOND_CSS . "/admin{$suffix}.css", array(), VAGABOND_THEME_VERSION, 'all' );

	// Admin JS.
	wp_enqueue_script( 'vagabond-admin-script', VAGABOND_JS . "/admin{$suffix}.js", array( 'jquery' ), 'VAGABOND_THEME_VERSION', true );

}
