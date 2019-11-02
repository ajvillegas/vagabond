<?php
/**
 * Theme third-party plugin integrations.
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

/** AJV Portfolio */

// Remove AJV Portfolio custom meta box.
add_filter( 'ajv_portfolio_register_meta_box', '__return_false' );

/** Easy Widget Columns*/

add_filter( 'ewc_include_widgets', 'vagabond_add_ewc_field' );
/**
 * Filter to add the EWC field to specified widgets.
 *
 * @param array $ewc_widgets An empty array.
 * @return array $ewc_widgets An array containing the widget's ID base.
 */
function vagabond_add_ewc_field( $ewc_widgets ) {

	$ewc_widgets = array(
		'meta', // WP Meta widget.
		'nav_menu', // WP Custom Menu widget.
		'archives', // WP Archives widget.
		'calendar', // WP Calendar widget.
		'categories', // WP Categories widget.
		'links', // WP Links widget.
		'pages', // WP Pages widget.
		'recent-comments', // WP Recent Comments widget.
		'recent-posts', // WP Recent Posts widget.
		'rss', // WP RSS widget.
		'search', // WP Search widget.
		'tag_cloud', // WP Tag Cloud widget.
		'text', // WP Text widget.
	);

	return $ewc_widgets;

}

add_filter( 'ewc_exclude_widgets', 'vagabond_remove_ewc_field' );
/**
 * Filter to remove the EWC field from specified widgets.
 *
 * @param array $ewc_widgets An empty array.
 * @return array $ewc_widgets An array containing the widget's ID base.
 */
function vagabond_remove_ewc_field( $ewc_widgets ) {

	$ewc_widgets = array(
		'meta', // WP Meta widget.
		'nav_menu', // WP Custom Menu widget.
		'archives', // WP Archives widget.
		'calendar', // WP Calendar widget.
		'categories', // WP Categories widget.
		'links', // WP Links widget.
		'pages', // WP Pages widget.
		'recent-comments', // WP Recent Comments widget.
		'recent-posts', // WP Recent Posts widget.
		'rss', // WP RSS widget.
		'search', // WP Search widget.
		'tag_cloud', // WP Tag Cloud widget.
		'text', // WP Text widget.
	);

	return $ewc_widgets;

}

add_filter( 'ewc_color_palette', 'vagabond_ewc_color_palette' );
/**
 * Filter to edit the color palette in the color picker control.
 *
 * @param array $color_palette An empty array.
 * @return array $color_palette An array containing hex color values.
 */
function vagabond_ewc_color_palette( $color_palette ) {

	$color_palette = array(
		'#252724',
		'#ce6b36',
		'#31284b',
		'#a03327',
		'#3b3e3e',
		'#67b183',
	);

	return $color_palette;

}

add_filter( 'ewc_preset_classes', 'vagabond_ewc_preset_classes' );
/**
 * Filter for predefining EWC Widget Row classes.
 *
 * @param array $classes An empty array.
 * @return array $classes An array containing new values.
 */
function vagabond_ewc_preset_classes( $classes ) {

	$classes = array(
		'hero',
		'parallax',
		'slider',
		'content',
		'full-columns',
		'footer-widgets',
	);

	return $classes;

}

// Remove advanced options from the Widget Row widget.
add_filter( 'ewc_advanced_options', '__return_false' );

add_filter( 'ewc_advanced_options', 'vagabond_ewc_display_advanced_options' );
/**
 * Filter to display specific EWC advanced options.
 *
 * @param array $display The default display values.
 * @return array $display The new display  values.
 */
function vagabond_ewc_display_advanced_options( $display ) {

	$display = array(
		'ewc_background' => array(
			'display' => true,
			'active'  => 0,
		),
		'ewc_margin'     => array(
			'display' => false,
			'active'  => 0,
		),
		'ewc_padding'    => array(
			'display' => false,
			'active'  => 0,
		),
		'ewc_class'      => array(
			'display' => true,
			'active'  => 1,
		),
	);

	return $display;

}

/** Image Gallery Metabox */

add_filter( 'igmb_display_meta_box', 'vagabond_display_gallery_meta_box' );
/**
 * Filter to add the image gallery meta box to specific screens.
 *
 * @param array $display An array containing default values.
 * @return array $display An array containing new values.
 */
function vagabond_display_gallery_meta_box( $display ) {

	$display = array(
		'title'          => esc_html__( 'Image Slider', 'vagabond' ),
		'post_type'      => array( 'post', 'ajv_portfolio' ),
		'post_id'        => array( '3159' ),
		'page_template'  => array( 'page_landing.php' ),
		'page_on_front'  => true,
		'page_for_posts' => true,
		'priority'       => 'default',
	);

	return $display;

}

/** Gravity Forms */

// Enable Gravity Forms label visibility settings.
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

add_filter( 'gform_validation_message', 'vagabond_gform_validation_message', 10, 2 );
/**
 * Modify Gravity Forms validation message.
 *
 * @since 1.0.0
 * @param string $message The validation message to be filtered.
 * @param array  $form The current form.
 */
function vagabond_gform_validation_message( $message, $form ) {

	return '';

}

/** Jetpack */

add_action( 'after_setup_theme', 'vagabond_jetpack_setup' );
/**
 * Jetpack setup function.
 *
 * @since  1.0.0
 * @link   https://jetpack.com/support/infinite-scroll/
 * @link   https://jetpack.com/support/responsive-videos/
 * @link   https://jetpack.com/support/content-options/
 */
function vagabond_jetpack_setup() {

	// Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'main',
			'render'    => 'vagabond_infinite_scroll_render',
			'footer'    => 'page',
		)
	);

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support(
		'jetpack-content-options',
		array(
			'post-details'    => array(
				'stylesheet' => 'vagabond-style',
				'date'       => '.posted-on',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline',
				'comment'    => '.comments-link',
			),
			'featured-images' => array(
				'archive' => true,
				'post'    => true,
				'page'    => true,
			),
		)
	);

}

/**
 * Custom render function for Infinite Scroll.
 *
 * @since  1.0.0
 */
function vagabond_infinite_scroll_render() {

	while ( have_posts() ) {
		the_post();

		if ( is_search() ) {
			get_template_part( 'template-parts/content', 'search' );
		} else {
			get_template_part( 'template-parts/content', get_post_type() );
		}
	}

}
