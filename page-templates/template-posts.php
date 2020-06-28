<?php
/**
 * This file adds the featured posts page template to the theme.
 *
 * Template Name: Featured Posts
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

add_filter( 'body_class', 'vagabond_featured_posts_body_class' );
/**
 * Adds a unique class to the body element.
 *
 * @since 1.0.0
 *
 * @param array $classes Array of classes applied to the body class attribute.
 *
 * @return array $classes The updated array of classes applied to the body class attribute.
 */
function vagabond_featured_posts_body_class( $classes ) {

	$classes[] = 'featured-posts';

	return $classes;

}

add_filter( 'vagabond_default_content_layout', 'vagabond_set_featured_posts_page_layout' );
/**
 * Force the full-width content layout.
 *
 * See /includes/layouts.php.
 *
 * @since 1.0.0
 *
 * @param string $layout The current default layout.
 *
 * @return string $layout The new default layout.
 */
function vagabond_set_featured_posts_page_layout( $layout ) {

	// Define the page layout.
	$layout = 'full-width-content';

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

		while ( have_posts() ) :

			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- .content -->

	<?php get_sidebar(); ?>

</div><!-- .content-sidebar-wrap -->
<?php

/**
 * Define featured posts category.
 *
 * Applies a filter to limit the featured posts
 * to a specific category.
 *
 * Uses the page ID number in the filter. Defaults to all categories.
 */
$page_id  = get_the_ID();
$category = apply_filters( "vagabong_featured_posts_page_{$page_id}_category", '' );

// Custom query.
$args = array(
	'post_type'      => 'post',
	'category_name'  => sanitize_title_with_dashes( strtolower( $category ) ),
	'posts_per_page' => 3, // Select the latest posts only.
	'no_found_rows'  => true, // No need for pagination, so skip it altogether.
	'cache_results'  => false, // Bypass the extra caching queries to speed up the query process.
);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) :

	?>
	<aside class="posts-section wrap">
		<div class="row">
		<?php

		while ( $the_query->have_posts() ) :

			$the_query->the_post();

			?>
			<div class="col-sm-12 col-md-6 col-lg-4">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?> itemscope itemtype="https://schema.org/CreativeWork">

					<?php vagabond_post_thumbnail(); ?>

					<header class="entry-header">
						<?php
						the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						?>
					</header><!-- .entry-header -->
				</article><!-- #post-<?php the_ID(); ?> -->
			</div>
			<?php

		endwhile; // End of the loop.

		?>
		</div>

		<div class="blog-link">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>"><?php echo esc_html__( 'View Blog', 'vagabond' ); ?></a>
		</div>
	</aside>
	<?php

	// Reset post data.
	wp_reset_postdata();

else :

	echo '<aside class="posts-section wrap">';
		get_template_part( 'template-parts/content', 'none' );
	echo '</aside>';

endif;

get_footer();
