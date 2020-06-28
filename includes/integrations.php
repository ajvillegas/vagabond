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
