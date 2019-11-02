<?php
/**
 * Customizer callback functions.
 *
 * Included by customizer.php.
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
 * Check if viewing front page of the site when using
 * a static page and front-page.php exists.
 *
 * Use in the active_callback when adding the Theme Homepage panel.
 *
 * @since 1.0.0
 * @return boolean
 */
function vagabond_is_front_page() {

	if ( 'page' === get_option( 'show_on_front' ) && file_exists( get_template_directory() . '/front-page.php' ) ) {

		return is_front_page();

	}

}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 * @return void
 */
function vagabond_customize_partial_blogname() {

	bloginfo( 'name' );

}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since 1.0.0
 * @return void
 */
function vagabond_customize_partial_blogdescription() {

	bloginfo( 'description' );

}
