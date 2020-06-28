<?php
/**
 * This file adds the typography test page template to the theme.
 *
 * Template Name: Typography Test
 *
 * @package    AJV_Theme
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'body_class', 'vagabond_theme_typography_body_class' );
/**
 * Adds a unique class to the body element.
 *
 * @since 1.0.0
 *
 * @param array $classes Array of classes applied to the body class attribute.
 *
 * @return array $classes The updated array of classes applied to the body class attribute.
 */
function vagabond_theme_typography_body_class( $classes ) {

	$classes[] = 'typography-test';

	return $classes;

}

add_filter( 'vagabond_default_content_layout', 'vagabond_set_typography_page_layout' );
/**
 * Force the full-width-padded content layout.
 *
 * See /includes/layouts.php.
 *
 * @since 1.0.0
 *
 * @param string $layout The current default layout.
 *
 * @return string $layout The new default layout.
 */
function vagabond_set_typography_page_layout( $layout ) {

	// Define the page layout.
	$layout = 'full-width-padded';

	return $layout;

}

get_header();

?>
<div class="content-sidebar-wrap">
	<main id="site-content" class="content">

		<?php
		if ( function_exists( 'breadcrumb_trail' ) ) {
			breadcrumb_trail(
				array(
					'show_on_front' => false,
					'labels'        => array(
						'browse' => esc_html__( 'You are here:', 'vagabond' ),
					),
				)
			);
		}

		get_template_part( 'template-parts/content', 'typography' );
		?>

	</main><!-- .content -->

	<?php get_sidebar(); ?>

</div><!-- .content-sidebar-wrap -->
<?php

get_footer();
