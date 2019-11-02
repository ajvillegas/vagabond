<?php
/**
 * The template for displaying archive pages.
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

		if ( have_posts() ) :

			?>
			<header class="page-header">
				<div class="archive-description">
					<?php the_archive_description(); ?>
				</div>
			</header><!-- .page-header -->
			<?php

			while ( have_posts() ) :

				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile; // End of the loop.

			vagabond_archive_pagination( 'numeric' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- .content -->

	<?php get_sidebar(); ?>

</div><!-- .content-sidebar-wrap -->
<?php

get_footer();
