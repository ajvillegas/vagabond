<?php
/**
 * Theme white label functions for WordPress.
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

add_action( 'add_admin_bar_menus', 'vagabond_remove_wp_admin_bar_links' );
/**
 * Remove WordPress logo and links on admin bar.
 *
 * @since 1.0.0
 */
function vagabond_remove_wp_admin_bar_links() {

	remove_action( 'admin_bar_menu', 'wp_admin_bar_wp_menu' );

}

add_filter( 'gettext', 'vagabond_change_howdy', 10, 3 );
/**
 * Change default welcome message on admin bar.
 *
 * @since 1.0.0
 *
 * @param string $translation Translated text.
 * @param string $text Text to translate.
 * @param string $domain Text domain.
 *
 * @return string
 */
function vagabond_change_howdy( $translation, $text, $domain ) {

	// Apply changes to English language versions only.
	if ( 'Howdy, %s' === $text
		&& ( 'en-US' === get_bloginfo( 'language' )
			|| 'en-AU' === get_bloginfo( 'language' )
			|| 'en-CA' === get_bloginfo( 'language' )
			|| 'en-GB' === get_bloginfo( 'language' )
			|| 'en-NZ' === get_bloginfo( 'language' )
		)
	) {
		$translation = 'Welcome, %s';
	}

	return $translation;

}

add_action( 'login_head', 'vagabond_login_logo', 999 );
/**
 * Change WordPress login logo.
 *
 * @since 1.0.0
 */
function vagabond_login_logo() {

	if ( has_custom_logo() ) {

		$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );

		?>
		<style type="text/css">
			.login {
				background-color: #222;
			}

			.login h1 a {
				background-image: url(<?php echo esc_url( $logo[0] ); ?>);
				-webkit-background-size: 320px 60px;
				background-size: 320px 60px;
				width: 320px;
				height: 60px;
			}
		</style>
		<?php

	}

}

add_filter( 'login_headerurl', 'vagabond_login_logo_url' );
/**
 * Change WordPress login logo link URL.
 *
 * @since 1.0.0
 */
function vagabond_login_logo_url() {

	if ( has_custom_logo() ) {
		return home_url();
	}

}

add_filter( 'login_headertext', 'vagabond_login_logo_title' );
/**
 * Change WordPress login logo link name.
 *
 * @since 1.0.0
 */
function vagabond_login_logo_title() {

	if ( has_custom_logo() ) {
		return get_bloginfo( 'name' );
	}

}
