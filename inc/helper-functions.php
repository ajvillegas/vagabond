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

add_action( 'wp_footer', 'vagabond_grid_overlay' );
/**
 * Display a column grid overlay.
 *
 * This function displays a column grid overlay when adding
 * '?grid=true' to the end of any URL in the front-end.
 *
 * @since 1.0.0
 * @author Bill Erickson
 * @link http://www.billerickson.net/overlay-css-grid
 */
function vagabond_grid_overlay() {

	if ( ! isset( $_GET['grid'] ) || 'true' !== $_GET['grid'] ) { // phpcs:ignore WordPress.Security.NonceVerification
		return;
	}

	$columns = 12;

	?>
	<div class="grid-overlay">
		<div class="wrap">
			<div class="col"></div>
			<?php for ( $i = 0; $i < ( $columns - 1 ); $i++ ) : ?>
				<div class="gutter"></div>
				<div class="col"></div>
			<?php endfor; ?>
		</div>
	</div>
	<?php

}
