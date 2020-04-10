<?php
/**
 * The template for displaying 404 error (not found) pages.
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

get_header();

?>
<div class="content-sidebar-wrap">
	<main id="site-content" class="content">
		<section class="error-404 not-found entry">
			<div class="entry-content">
				<?php
				echo sprintf(
					/* translators: 1: homepage URL opening tag, 2: homepage URL closing tag */
					'<p>' . esc_html__( 'It looks like nothing was found at this location. Perhaps you can return back to the site\'s %1$shomepage%2$s and see if you can find what you\'re looking for. Or, you can try finding it by using the search form below.', 'vagabond' ) . '</p>',
					'<a href="' . esc_url( trailingslashit( home_url() ) ) . '">',
					'</a>'
				);

				get_search_form();

				echo '<h2>' . esc_html__( 'Sitemap', 'vagabond' ) . '</h2>';
				echo wp_kses_post( vagabond_get_sitemap( 'h3' ) );
				?>
			</div><!-- .entry-content -->
		</section><!-- .error-404 -->
	</main><!-- .content -->

	<?php get_sidebar(); ?>

</div><!-- .content-sidebar-wrap -->
<?php

get_footer();
