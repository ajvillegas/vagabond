<?php
/**
 * This file adds the homepage template to the theme.
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
		// Custom query.
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => 6, // Select the last six posts only.
			'no_found_rows'  => true, // No need for pagination, so skip it altogether.
			'cache_results'  => false, // Bypass the extra caching queries to speed up the query process.
		);

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) :

			?>
			<div class="large-posts row">
			<?php

			while ( $the_query->have_posts() ) :

				$the_query->the_post();

				if ( 1 === $the_query->current_post || 2 === $the_query->current_post ) {
					?>
					<div class="col-sm-12 col-md-6">
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?> itemscope itemtype="https://schema.org/CreativeWork">

							<?php vagabond_post_thumbnail(); ?>

							<header class="entry-header">
								<?php
								the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
								?>

								<div class="entry-meta">
								<?php
								vagabond_posted_on();
								vagabond_posted_by();
								?>
								</div><!-- .entry-meta -->
							</header><!-- .entry-header -->

							<div class="entry-content" itemprop="text">
								<?php the_excerpt(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-<?php the_ID(); ?> -->
					</div>
					<?php
				}

			endwhile; // End of the loop.

			?>
			</div>

			<div class="short-posts row">
			<?php

			while ( $the_query->have_posts() ) :

				$the_query->the_post();

				if ( 3 === $the_query->current_post || 4 === $the_query->current_post || 5 === $the_query->current_post ) {
					?>
					<div class="col-sm-12 col-md-4">
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
				}

			endwhile; // End of the loop.

			?>
			</div>

			<div class="blog-link">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>"><?php echo esc_html__( 'More Posts', 'vagabond' ); ?></a>
			</div>
			<?php

			// Reset post data.
			wp_reset_postdata();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- .content -->
</div><!-- .content-sidebar-wrap -->
<?php

get_footer();
