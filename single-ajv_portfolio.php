<?php
/**
 * The template for displaying all single posts.
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

add_filter( 'body_class', 'vagabond_single_portfolio_body_class' );
/**
 * Adds a unique class to the body element.
 *
 * @since 1.0.0
 *
 * @param array $classes Array of classes applied to the body class attribute.
 *
 * @return array $classes The updated array of classes applied to the body class attribute.
 */
function vagabond_single_portfolio_body_class( $classes ) {

	$classes[] = 'portfolio-single';

	return $classes;

}

add_filter( 'vagabond_default_content_layout', 'vagabond_set_single_portfolio_layout' );
/**
 * Force the content-sidebar layout.
 *
 * See /includes/layouts.php.
 *
 * @since 1.0.0
 *
 * @param string $layout The current default layout.
 *
 * @return string $layout The new default layout.
 */
function vagabond_set_single_portfolio_layout( $layout ) {

	// Define the page layout.
	$layout = 'content-sidebar';

	return $layout;

}

// Get post meta.
$description = get_post_meta( get_the_ID(), '_ajv_portfolio_description', true );
$client      = get_post_meta( get_the_ID(), '_ajv_portfolio_client', true );
$company     = get_post_meta( get_the_ID(), '_ajv_portfolio_company', true );
$url         = get_post_meta( get_the_ID(), '_ajv_portfolio_url', true );
$url_text    = get_post_meta( get_the_ID(), '_ajv_portfolio_url_text', true );

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

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '&laquo; ' . esc_html__( 'Previous Project', 'vagabond' ),
					'next_text' => esc_html__( 'Next Project', 'vagabond' ) . ' &raquo;',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- .content -->

	<aside id="primary-sidebar" class="sidebar" role="complementary" aria-label="Primary Sidebar" itemscope itemtype="https://schema.org/WPSideBar">
		<h2 class="site-sidebar-title screen-reader-text">
			<?php echo esc_html__( 'Primary Sidebar', 'vagabond' ); ?>
		</h2>

		<?php
		if ( ! empty( $description )
			|| ! empty( $client )
			|| ! empty( $company )
			|| ( ! empty( $url ) && ! empty( $url_text ) )
		) {
			?>
			<section class="widget">
				<h3 class="widget-title"><?php echo esc_html__( 'Project Details', 'vagabond' ); ?></h3>

				<?php
				if ( ! empty( $description ) ) {
					?>
					<div class="description">
						<p><?php echo esc_html( $description ); ?></p>
					</div>
					<?php
				}

				if ( ! empty( $client ) ) {
					?>
					<div class="icon-details">
						<?php echo vagabond_get_icon( 'admin-users' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<p><span><?php echo esc_html__( 'Client:', 'vagabond' ); ?></span>
						<?php echo esc_html( $client ); ?></p>
					</div>
					<?php
				}

				if ( ! empty( $company ) ) {
					?>
					<div class="icon-details">
						<?php echo vagabond_get_icon( 'portfolio' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<p><span><?php echo esc_html__( 'Company:', 'vagabond' ); ?></span>
						<?php echo esc_html( $company ); ?></p>
					</div>
					<?php
				}

				if ( ! empty( $url ) && ! empty( $url_text ) ) {
					?>
					<a href="<?php echo esc_url( $url ); ?>" class="button" target="_blank" rel="noopener"><?php echo esc_html( $url_text ); ?></a>
					<?php
				}
				?>
			</section>
			<?php
		}
		?>
	</aside>

</div><!-- .content-sidebar-wrap -->
<?php

get_footer();
