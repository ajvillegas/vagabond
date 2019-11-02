<?php
/**
 * Theme Customizer related functionality.
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

add_action( 'customize_preview_init', 'vagabond_customizer_live_preview' );
/**
 * Enqueue the Customizer live preview script.
 *
 * @since 1.0.0
 */
function vagabond_customizer_live_preview() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script( 'prototipo-customizer-preview', VAGABOND_INC . "/customizer/assets/js/customizer-preview{$suffix}.js", array( 'jquery', 'customize-preview' ), VAGABOND_THEME_VERSION, true );

}

/**
 * Load custom Customizer controls.
 */
require_once VAGABOND_INC_DIR . '/customizer/load-controls.php';

/**
 * Define Customizer sanitization functions.
 */
require_once VAGABOND_INC_DIR . '/customizer/sanitization.php';

/**
 * Define Customizer callback functions.
 */
require_once VAGABOND_INC_DIR . '/customizer/callback.php';

/**
 * Register Customizer panels, sections and controls.
 */
require_once VAGABOND_INC_DIR . '/customizer/register-settings.php';

add_action( 'init', 'vagabond_remove_front_page_editor' );
/**
 * Conditionally remove the editor.
 *
 * This function removes the page editor from the edit post screen
 * when editing the front page.
 *
 * @since 1.0.0
 */
function vagabond_remove_front_page_editor() {

	$post_id       = isset( $_GET['post'] ) ? sanitize_text_field( wp_unslash( $_GET['post'] ) ) : isset( $_POST['post_ID'] ); // WPCS: input var ok, CSRF ok.
	$frontpage_id  = get_option( 'page_on_front' );
	$page_template = isset( $post_id ) ? get_post_meta( $post_id, '_wp_page_template', true ) : '';

	if ( ! isset( $post_id ) || 'page' !== get_option( 'show_on_front' ) ) {
		return;
	}

	if ( $post_id === $frontpage_id && file_exists( get_stylesheet_directory() . '/front-page.php' ) ) {

		// Remove the classic editor.
		remove_post_type_support( 'page', 'editor' );

		// Add admin notice.
		add_action( 'edit_form_after_title', 'vagabond_add_front_page_admin_notice' );

	}

}

/**
 * Add admin notice to page edit screen.
 *
 * @since 1.0.0
 */
function vagabond_add_front_page_admin_notice() {

	global $post;

	$query['url']              = rawurlencode( get_permalink( $post->ID ) );
	$query['autofocus[panel]'] = 'vagabond_homepage_panel'; // Customizer panel ID.
	$panel_link                = add_query_arg( $query, wp_customize_url() );
	$button_text               = esc_html__( 'Cick Here to Edit Live', 'vagabond' );

	?>
	<div class="notice notice-warning inline">
		<p>
			<?php echo esc_html__( 'You are currently editing the page that dislays your theme\'s custom homepage. To edit the homepage content, click the button below to start editing live.', 'vagabond' ); ?>
		</p>
		<p>
			<a class="button button-secondary" href="<?php echo esc_url( $panel_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
		</p>
	</div>
	<?php

}
