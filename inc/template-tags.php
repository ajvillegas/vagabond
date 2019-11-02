<?php
/**
 * Custom theme template tags.
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

if ( ! function_exists( 'vagabond_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 *
	 * @since 1.0.0
	 */
	function vagabond_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		echo '<span class="posted-on">' . $time_string . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}

if ( ! function_exists( 'vagabond_posted_by' ) ) {
	/**
	 * Prints HTML with meta information for the current author and comments.
	 *
	 * @since 1.0.0
	 */
	function vagabond_posted_by() {

		global $post;

		$author_id   = $post->post_author;
		$name        = get_the_author_meta( 'display_name', $author_id );
		$url         = get_author_posts_url( $author_id );
		$author_link = '<a href="' . esc_url( $url ) . '" class="author-link" rel="author" itemprop="url"><span class="author-name" itemprop="name">' . esc_html( $name ) . '</span></a>';

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html__( 'by %s', 'vagabond' ),
			$author_link
		);

		echo '<span class="byline"> ' . $byline . '</span> '; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			if ( get_comments_number() > 0 ) {

				echo '- <span class="comments-link">';
					comments_popup_link( '' );
				echo '</span>';

			}
		}

	}
}

if ( ! function_exists( 'vagabond_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories and tags.
	 *
	 * @since 1.0.0
	 */
	function vagabond_entry_footer() {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'vagabond' ) );

			if ( $categories_list ) {
				printf(
					/* translators: 1: list of categories. */
					'<span class="cat-links"><span class=svg-icon>%1$s</span>' . esc_html__( 'Filed Under: %2$s', 'vagabond' ) . '</span>',
					vagabond_get_icon( 'category' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'vagabond' ) );

			if ( $tags_list ) {
				printf(
					/* translators: 1: list of tags. */
					'<span class="tags-links"><span class=svg-icon>%1$s</span>' . esc_html__( 'Tagged With: %2$s', 'vagabond' ) . '</span>',
					vagabond_get_icon( 'tag' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post. Only visible to screen readers. */
				esc_html__( 'Edit %s', 'vagabond' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			),
			'<div class="edit-link">',
			'</div>'
		);

	}
}

if ( ! function_exists( 'vagabond_post_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @since 1.0.0
	 */
	function vagabond_post_thumbnail() {

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( ! is_singular() ) {
			?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>
			<?php
		}

	}
}

if ( ! function_exists( 'vagabond_archive_pagination' ) ) {
	/**
	 * Display numerical or prev/next archive pagination links.
	 *
	 * @since 1.0.0
	 *
	 * @param string $pagination The pagination style.
	 */
	function vagabond_archive_pagination( $pagination = 'numeric' ) {

		if ( 'numeric' === $pagination ) {
			$args = array(
				'prev_text' => '&laquo; ' . esc_html__( 'Previous Page', 'vagabond' ),
				'next_text' => esc_html__( 'Next Page', 'vagabond' ) . ' &raquo;',
			);

			?>
			<div class="archive-pagination pagination">
				<?php echo wp_kses_post( paginate_links( $args ) ); ?>
			</div>
			<?php
		} elseif ( 'prev-next' === $pagination ) {
			?>
			<div class="archive-pagination pagination">
				<div class="pagination-previous alignleft">
					<?php previous_posts_link( '&laquo; ' . esc_html__( 'Previous Page', 'vagabond' ) ); ?>
				</div>

				<div class="pagination-next alignright">
					<?php next_posts_link( esc_html__( 'Next Page', 'vagabond' ) . ' &raquo;' ); ?>
				</div>
			</div>
			<?php
		}

	}
}

if ( ! function_exists( 'vagabond_get_sitemap' ) ) {
	/**
	 * Generate markup for an HTML sitemap.
	 *
	 * @since 1.0.0
	 * @param string $heading Heading element; defaults to `h2`.
	 * @return string $sitemap Sitemap content.
	 */
	function vagabond_get_sitemap( $heading = 'h2' ) {

		$sitemap  = sprintf( '<%2$s>%1$s</%2$s>', esc_html__( 'Pages:', 'vagabond' ), $heading );
		$sitemap .= sprintf( '<ul>%s</ul>', wp_list_pages( 'title_li=&echo=0' ) );

		$post_counts = wp_count_posts();

		// Only display if there are published posts.
		if ( $post_counts->publish > 0 ) {

			$sitemap .= sprintf( '<%2$s>%1$s</%2$s>', esc_html__( 'Categories:', 'vagabond' ), $heading );
			$sitemap .= sprintf( '<ul>%s</ul>', wp_list_categories( 'sort_column=name&title_li=&echo=0' ) );

			$sitemap .= sprintf( '<%2$s>%1$s</%2$s>', esc_html__( 'Authors:', 'vagabond' ), $heading );
			$sitemap .= sprintf( '<ul>%s</ul>', wp_list_authors( 'exclude_admin=0&optioncount=1&echo=0' ) );

			$sitemap .= sprintf( '<%2$s>%1$s</%2$s>', esc_html__( 'Monthly:', 'vagabond' ), $heading );
			$sitemap .= sprintf( '<ul>%s</ul>', wp_get_archives( 'type=monthly&echo=0' ) );

			$sitemap .= sprintf( '<%2$s>%1$s</%2$s>', esc_html__( 'Recent Posts:', 'vagabond' ), $heading );
			$sitemap .= sprintf( '<ul>%s</ul>', wp_get_archives( 'type=postbypost&limit=100&echo=0' ) );

		}

		return $sitemap;

	}
}

if ( ! function_exists( 'vagabond_header_hero' ) ) {
	/**
	 * Prints HTML for the header hero image with post/page title and entry meta.
	 *
	 * @since 1.0.0
	 */
	function vagabond_header_hero() {
		// Bail if on front page.
		if ( is_front_page() ) {
			return;
		}

		// Hero image background.
		if ( is_search() || is_archive() || is_home() ) {
			$hero_image = VAGABOND_IMAGES . '/default-hero-image.jpg';
		} elseif ( is_404() ) {
			$hero_image = VAGABOND_IMAGES . '/404.jpg';
		} else {
			$hero_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : VAGABOND_IMAGES . '/default-hero-image.jpg';
		}

		?>
		<div class="header-hero" style="background-image: url(<?php echo esc_url( $hero_image ); ?>);">
			<div class="wrap">
				<header class="entry-header">
					<?php
					// Display page title.
					if ( is_search() ) {
						/* translators: %s: search query. */
						printf( '<h1 class="archive-title" itemprop="headline">' . esc_html__( 'Search Results for: %s', 'vagabond' ) . '</h1>', get_search_query() );
					} elseif ( is_archive() ) {
						the_archive_title( '<h1 class="archive-title" itemprop="headline">', '</h1>' );
					} elseif ( is_home() ) {
						$blog_title = single_post_title( '', false ) ? single_post_title( '', false ) : esc_html__( 'Blog', 'vagabond' );

						echo '<h1 class="archive-title" itemprop="headline">' . $blog_title . '</h1>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					} elseif ( is_404() ) {
						echo '<h1 class="entry-title" itemprop="headline">' . esc_html__( 'Oops! That page can\'t be found.', 'vagabond' ) . '</h1>';
					} else {
						the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
					}

					// Display entry meta on single posts.
					if ( is_singular( 'post' ) ) {
						// Categories list with single space separator.
						$categories_list = get_the_category_list( ' ' );

						if ( $categories_list ) {
							echo '<div class="categories">';
								echo $categories_list; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo '</div>';
						}

						echo '<div class="entry-meta">';
							vagabond_posted_on();
							vagabond_posted_by();
						echo '</div>';
					}
					?>
				</header>
			</div>
		</div>
		<?php
	}
}
