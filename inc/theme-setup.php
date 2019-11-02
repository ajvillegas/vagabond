<?php
/**
 * Theme setup and main functions.
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

if ( ! function_exists( 'vagabond_theme_setup' ) ) {
	add_action( 'after_setup_theme', 'vagabond_theme_setup' );
	/**
	 * Setup theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 1.0.0
	 */
	function vagabond_theme_setup() {

		// Set theme localizations.
		load_theme_textdomain( 'vagabond', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress provide the document <title> tag.
		add_theme_support( 'title-tag' );

		// Add support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Register wp_nav_menu() locations.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'vagabond' ),
				'footer'  => esc_html__( 'Footer', 'vagabond' ),
			)
		);

		// Enable HTML5 markup for search form, comment form, and comments.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Enable selective refresh for widgets in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for theme logo.
		add_theme_support(
			'custom-logo',
			array(
				'width'       => 146,
				'height'      => 35,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add support for editor styles.
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		add_editor_style( "assets/css/editor-style{$suffix}.css" );

		// Add image sizes.
		add_image_size( 'hero-image', 1500, 1000, true );
		add_image_size( 'featured-image', 800, 400, true );

		// Add support for the Layout Settings meta box.
		add_post_type_support( 'post', 'vagabond-layouts' );
		add_post_type_support( 'page', 'vagabond-layouts' );

		// Add support for Bootstrap 4 navigation menus.
		require_once VAGABOND_INC_DIR . '/class-wp-bootstrap-navwalker.php';

	}
}

add_action( 'after_setup_theme', 'vagabond_content_width', 0 );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since 1.0.0
 * @global int $content_width
 */
function vagabond_content_width() {

	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound.
	$GLOBALS['content_width'] = apply_filters( 'vagabond_content_width', 1024 );

}

add_filter( 'get_custom_logo', 'change_logo_class' );
/**
 * Filter the custom logo output.
 *
 * Add the 'navbar-brand' class to make it compatible with Bootstrap 4.
 *
 * @since 1.0.0
 *
 * @param string $html Custom logo HTML output.
 *
 * @return string $html Amended logo HTML output.
 */
function change_logo_class( $html ) {

	$html = str_replace( 'custom-logo-link', 'navbar-brand custom-logo-link', $html );

	return $html;

}

add_filter( 'document_title_separator', 'vagabond_title_tag_separator' );
/**
 * Filter the WordPress document <title> separator.
 *
 * Might not be necessary when using an SEO plugin.
 *
 * @since 1.0.0
 *
 * @param string $separator Default document title separator.
 *
 * @return string $separator Amended document title separator.
 */
function vagabond_title_tag_separator( $separator ) {

	$separator = '|';

	return $separator;

}

add_filter( 'vagabond_default_content_layout', 'vagabond_set_default_layout' );
/**
 * Set the default theme content layout.
 *
 * See /inc/layouts.php.
 *
 * @since 1.0.0
 *
 * @param string $layout The current default layout.
 *
 * @return string $layout The new default layout.
 */
function vagabond_set_default_layout( $layout ) {

	$layout = 'content-sidebar';

	return $layout;

}

add_filter( 'body_class', 'vagabond_body_classes' );
/**
 * Add custom classes to the array of body classes.
 *
 * @since 1.0.0
 *
 * @param array $classes Array of classes applied to the body class attribute.
 *
 * @return array $classes The updated array of classes applied to the body class attribute.
 */
function vagabond_body_classes( $classes ) {

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;

}

add_action( 'wp_head', 'vagabond_pingback_header' );
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 *
 * @since 1.0.0
 */
function vagabond_pingback_header() {

	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}

}

add_filter( 'frontpage_template', 'vagabond_front_page_template' );
/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since 1.0.0
 * @link https://codex.wordpress.org/Creating_a_Static_Front_Page
 *
 * @param string $template front-page.php.
 *
 * @return string $template The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function vagabond_front_page_template( $template ) {

	return is_home() ? '' : $template;

}

add_filter( 'comment_form_defaults', 'vagabond_filter_comment_form_args' );
/**
 * Filter the comment form default arguments.
 *
 * @since 1.0.0
 * @link https://codex.wordpress.org/Function_Reference/comment_form
 *
 * @param array $defaults Existing array of comment form options.
 *
 * @return array $defaults Amended array of comment form options.
 */
function vagabond_filter_comment_form_args( $defaults ) {

	$defaults['comment_notes_after'] = ''; // Comment form allowed tags.
	$defaults['title_reply']         = esc_html__( 'Add a Comment', 'vagabond' ); // Reply title.

	return $defaults;

}

add_action( 'get_the_archive_title', 'vagabond_filter_archive_title' );
/**
 * Remove the default prefix from archive titles.
 *
 * @since 1.0.0
 *
 * @param string $title The current archive title.
 *
 * @return string $title The amended archive title.
 */
function vagabond_filter_archive_title( $title ) {

	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	}

	return $title;

}

add_filter( 'excerpt_more', 'vagabond_excerpt_more' );
/**
 * Filter the excerpt's "read more" link anchor text.
 *
 * @since 1.0.0
 *
 * @param string $more Current "read more" excerpt string.
 *
 * @return string $more Amended "read more" excerpt string.
 */
function vagabond_excerpt_more( $more ) {

	$more = '... ' . sprintf(
		'<a class="more-link" href="%1$s">%2$s</a>',
		get_permalink( get_the_ID() ),
		esc_html__( 'Continue Reading', 'vagabond' )
	);

	return $more;

}

add_filter( 'nav_menu_css_class', 'vagabond_blog_menu_item_classes', 10, 3 );
/**
 * Customize menu item classes for blog pots.
 *
 * @since 1.0.0
 *
 * @param array  $classes Current menu classes.
 * @param object $item Current menu item.
 * @param object $args Menu arguments.
 *
 * @return array $classes Modified menu classes.
 */
function vagabond_blog_menu_item_classes( $classes, $item, $args ) {

	if ( ( ( is_singular( 'post' ) || is_category() ) && 'Blog' === $item->title ) ) {

		$classes[] = 'current-menu-item';

	}

	return array_unique( $classes );

}
