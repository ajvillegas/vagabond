<?php
/**
 * Template part for displaying custom category posts.
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

// Add the opening Bootstrap grid markup to posts.
echo '<div class="col-sm-12 col-md-6">';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?> itemscope itemtype="https://schema.org/CreativeWork">

	<?php vagabond_post_thumbnail(); ?>

	<?php if ( ! is_singular() ) : ?>
		<header class="entry-header">
			<?php
			the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					vagabond_posted_on();
					vagabond_posted_by();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content" itemprop="text">
		<?php
		if ( is_singular() ) :

			the_content(
				sprintf(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					esc_html__( 'Continue reading %s', 'vagabond' ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				)
			);

		else :

			the_excerpt();

		endif;

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'vagabond' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( is_singular() ) : ?>
		<footer class="entry-footer">
			<div class="entry-meta">
				<?php vagabond_entry_footer(); ?>
			</div>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php

// Add the closing Bootstrap grid markup to posts.
echo '</div>';
