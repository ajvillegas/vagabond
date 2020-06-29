<?php
/**
 * Theme helper functions.
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
 * Get inline SVG icon.
 *
 * Uses the WordPress Filesystem API to avoid
 * using file_get_contents( $file ).
 *
 * @since 1.0.0
 * @param string $slug The SVG icon file name without extension.
 * @link https://codex.wordpress.org/Filesystem_API
 */
function vagabond_get_icon( $slug = '' ) {

	// Load the Filesystem API in the front-end.
	include_once 'wp-admin/includes/file.php';

	// Initialize the WP_Filesystem class.
	WP_Filesystem();

	// Define the global $wp_filesystem variable.
	global $wp_filesystem;

	$icon_dir  = $wp_filesystem->find_folder( get_template_directory() . '/assets/images/icon' );
	$icon_path = trailingslashit( $icon_dir ) . $slug . '.svg';

	if ( $wp_filesystem->exists( $icon_path ) ) {
		return $wp_filesystem->get_contents( $icon_path );
	}

}
