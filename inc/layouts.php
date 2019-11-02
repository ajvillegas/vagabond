<?php
/**
 * The theme post content layout functionality.
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
 * Get the default content layout.
 *
 * @since 1.0.0
 */
function vagabond_get_default_layout() {

	$layouts = array(
		'content-sidebar',
		'sidebar-content',
		'full-width-content',
		'full-width-padded',
	);

	$default_layout = sanitize_title_with_dashes( apply_filters( 'vagabond_default_content_layout', 'content-sidebar' ) );

	if ( in_array( $default_layout, $layouts, true ) ) {
		return $default_layout;
	} else {
		return 'content-sidebar';
	}

}

add_action( 'admin_menu', 'vagabond_add_layout_meta_box' );
/**
 * Register the Layout Settings meta box.
 *
 * @since 1.0.0
 */
function vagabond_add_layout_meta_box() {

	foreach ( (array) get_post_types(
		array(
			'public' => true,
		)
	) as $type ) {
		if ( post_type_supports( $type, 'vagabond-layouts' ) ) {
			add_meta_box( 'vagabond-layout-meta-box', esc_html__( 'Layout Settings', 'vagabond' ), 'vagabond_layout_meta_box', $type, 'normal', 'high' );
		}
	}

}

/**
 * Define the Layout Settings meta box.
 *
 * @since 1.0.0
 * @param object $post The post object.
 */
function vagabond_layout_meta_box( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'vagabond_layout_settings_nonce' );
	$post_layout_stored_meta = get_post_meta( $post->ID );

	// Get the default layout.
	$default_layout = vagabond_get_default_layout();

	?>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row">
					<label for="_vagabond_post_layout"><?php esc_html_e( 'Select Layout', 'vagabond' ); ?></label>
				</th>
				<td class="layout-selector">
					<label for="content-sidebar" class="box">
						<span class="screen-reader-text"><?php esc_html_e( 'Content, Primary Sidebar', 'vagabond' ); ?></span>
						<img src="<?php echo esc_attr( VAGABOND_IMAGES ) . '/post-layouts/content-sidebar.gif'; ?>" alt="Content, Primary Sidebar">
						<input type="radio" name="_vagabond_post_layout" id="content-sidebar" value="content-sidebar" class="screen-reader-text"
							<?php
							if ( isset( $post_layout_stored_meta['_vagabond_post_layout'] ) ) {
								checked( $post_layout_stored_meta['_vagabond_post_layout'][0], 'content-sidebar' );
							} else {
								checked( $default_layout, 'content-sidebar' );
							}
							?>
						>
					</label>

					<label for="sidebar-content" class="box">
						<span class="screen-reader-text"><?php esc_html_e( 'Primary Sidebar, Content', 'vagabond' ); ?></span>
						<img src="<?php echo esc_attr( VAGABOND_IMAGES ) . '/post-layouts/sidebar-content.gif'; ?>" alt="Primary Sidebar, Content">
						<input type="radio" name="_vagabond_post_layout" id="sidebar-content" value="sidebar-content" class="screen-reader-text"
							<?php
							if ( isset( $post_layout_stored_meta['_vagabond_post_layout'] ) ) {
								checked( $post_layout_stored_meta['_vagabond_post_layout'][0], 'sidebar-content' );
							} else {
								checked( $default_layout, 'sidebar-content' );
							}
							?>
						>
					</label>

					<label for="full-width-padded" class="box">
						<span class="screen-reader-text"><?php esc_html_e( 'Full Width Padded', 'vagabond' ); ?></span>
						<img src="<?php echo esc_attr( VAGABOND_IMAGES ) . '/post-layouts/full-width-padded.gif'; ?>" alt="Full Width Padded">
						<input type="radio" name="_vagabond_post_layout" id="full-width-padded" value="full-width-padded" class="screen-reader-text"
							<?php
							if ( isset( $post_layout_stored_meta['_vagabond_post_layout'] ) ) {
								checked( $post_layout_stored_meta['_vagabond_post_layout'][0], 'full-width-padded' );
							} else {
								checked( $default_layout, 'full-width-padded' );
							}
							?>
						>
					</label>

					<label for="full-width-content" class="box">
						<span class="screen-reader-text"><?php esc_html_e( 'Full Width Content', 'vagabond' ); ?></span>
						<img src="<?php echo esc_attr( VAGABOND_IMAGES ) . '/post-layouts/full-width-content.gif'; ?>" alt="Full Width Content">
						<input type="radio" name="_vagabond_post_layout" id="full-width-content" value="full-width-content" class="screen-reader-text"
							<?php
							if ( isset( $post_layout_stored_meta['_vagabond_post_layout'] ) ) {
								checked( $post_layout_stored_meta['_vagabond_post_layout'][0], 'full-width-content' );
							} else {
								checked( $default_layout, 'full-width-content' );
							}
							?>
						>
					</label>
				</td>
			</tr>
		</tbody>
	</table>
	<?php

}

add_action( 'save_post', 'vagabond_save_layout_meta_box_value' );
/**
 * Save the Layout Settings meta box value.
 *
 * @since 1.0.0
 * @param int $post_id The post ID number.
 */
function vagabond_save_layout_meta_box_value( $post_id ) {

	// Check save status.
	$is_autosave    = wp_is_post_autosave( $post_id );
	$is_revision    = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['vagabond_layout_settings_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['vagabond_layout_settings_nonce'], basename( __FILE__ ) ) ) ) ? 'true' : 'false'; // WPCS: input var ok.

	// Exit depending on save status.
	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}

	// Check for input and sanitize/save if needed.
	if ( isset( $_POST['_vagabond_post_layout'] ) ) { // WPCS: input var ok.
		update_post_meta( $post_id, '_vagabond_post_layout', sanitize_text_field( wp_unslash( $_POST['_vagabond_post_layout'] ) ) ); // WPCS: input var ok.
	}

}

add_filter( 'body_class', 'vagabond_add_layout_body_classes' );
/**
 * Add the content layout classes to the array of body classes.
 *
 * @since 1.0.0
 * @param array $classes Array of classes applied to the body class attribute.
 * @return array $classes The updated array of classes applied to the body class attribute.
 */
function vagabond_add_layout_body_classes( $classes ) {

	global $post;

	// Get post layout meta data.
	$layout = isset( $post ) ? get_post_meta( $post->ID, '_vagabond_post_layout', true ) : '';

	// Add the default layout body class.
	if ( empty( $layout ) ) {
		$classes[] = vagabond_get_default_layout();
	}

	// Add the content-sidebar layout body class.
	if ( 'content-sidebar' === $layout ) {
		$classes[] = 'content-sidebar';
	}

	// Add the sidebar-content layout body class.
	if ( 'sidebar-content' === $layout ) {
		$classes[] = 'sidebar-content';
	}

	// Add the full-width-content layout body class.
	if ( 'full-width-content' === $layout ) {
		$classes[] = 'full-width-content';
	}

	// Add the full-width-padded layout body class.
	if ( 'full-width-padded' === $layout ) {
		$classes[] = 'full-width-padded';
	}

	return $classes;

}
