<?php
/**
 * Template part for displaying a message that posts cannot be found.
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

?>
<section class="no-results not-found entry">
	<header class="entry-header">
		<h2 class="entry-title" itemprop="headline"><?php esc_html_e( 'Nothing Found', 'vagabond' ); ?></h2>
	</header><!-- .entry-header -->

	<div class="entry-content" itemprop="text">
		<?php
		if ( ( is_home() || is_front_page() || is_page_template( 'page-templates/template-posts.php' ) ) && current_user_can( 'publish_posts' ) ) :

			printf(
				/* translators: 1: new post page URL opening tag, 2: new post page URL closing tag. */
				'<p>' . esc_html__( 'Ready to publish your first post? %1$sGet started here%2$s.', 'vagabond' ) . '</p>',
				'<a href="' . esc_url( admin_url( 'post-new.php' ) ) . '">',
				'</a>'
			);

		elseif ( is_search() ) :

			?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vagabond' ); ?></p>
			<?php

			get_search_form();

		else :

			?>
			<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'vagabond' ); ?></p>
			<?php

			get_search_form();

		endif;
		?>
	</div><!-- .entry-content -->
</section><!-- .no-results -->
