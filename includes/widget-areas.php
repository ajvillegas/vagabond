<?php
/**
 * Theme widget areas.
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

add_action( 'widgets_init', 'vagabond_register_widget_areas' );
/**
 * Register theme widget areas.
 *
 * @since 1.0.0
 */
function vagabond_register_widget_areas() {

	$sidebars = array(
		array(
			'id'          => 'primary-sidebar',
			'name'        => esc_html__( 'Primary Sidebar', 'vagabond' ),
			'description' => esc_html__( 'This is the primary sidebar widget area.', 'vagabond' ),
		),
		array(
			'id'          => 'footer-widgets-1',
			'name'        => esc_html__( 'Footer Widget 1', 'vagabond' ),
			'description' => esc_html__( 'This is the top left footer widget area.', 'vagabond' ),
		),
		array(
			'id'          => 'footer-widgets-2',
			'name'        => esc_html__( 'Footer Widget 2', 'vagabond' ),
			'description' => esc_html__( 'This is the top middle footer widget area.', 'vagabond' ),
		),
		array(
			'id'          => 'footer-widgets-3',
			'name'        => esc_html__( 'Footer Widget 3', 'vagabond' ),
			'description' => esc_html__( 'This is the top right footer widget area.', 'vagabond' ),
		),
		array(
			'id'          => 'footer-widgets-4',
			'name'        => esc_html__( 'Footer Widget 4', 'vagabond' ),
			'description' => esc_html__( 'This is the bottom footer widget area.', 'vagabond' ),
		),
	);

	foreach ( $sidebars as $sidebar ) {

		register_sidebar(
			array(
				'id'            => $sidebar['id'],
				'name'          => $sidebar['name'],
				'description'   => $sidebar['description'],
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widgettitle widget-title">',
				'after_title'   => '</h3>',
			)
		);

	}

}
