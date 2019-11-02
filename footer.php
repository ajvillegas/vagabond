<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the .site-container div and all content after.
 *
 * @package    Vagabond
 * @author     Alexis J. Villegas
 * @link       https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @license    GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
		</div><!-- .site-inner -->

		<?php if ( is_active_sidebar( 'footer-widgets-1' ) || is_active_sidebar( 'footer-widgets-2' ) || is_active_sidebar( 'footer-widgets-3' ) || is_active_sidebar( 'footer-widgets-4' ) ) : ?>

		<div id="footer-widgets">
			<span class="screen-reader-text"><?php echo esc_html__( 'Footer Widgets', 'vagabond' ); ?></span>
			<div class="wrap">

				<?php if ( is_active_sidebar( 'footer-widgets-1' ) || is_active_sidebar( 'footer-widgets-2' ) || is_active_sidebar( 'footer-widgets-3' ) ) : ?>

				<div class="row">
					<?php if ( is_active_sidebar( 'footer-widgets-1' ) ) : ?>
					<div class="col-sm-12 col-md-4">
						<?php dynamic_sidebar( 'footer-widgets-1' ); ?>
					</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-widgets-2' ) ) : ?>
					<div class="col-sm-12 col-md-4">
						<?php dynamic_sidebar( 'footer-widgets-2' ); ?>
					</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-widgets-3' ) ) : ?>
					<div class="col-sm-12 col-md-4">
						<?php dynamic_sidebar( 'footer-widgets-3' ); ?>
					</div>
					<?php endif; ?>
				</div>

				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-widgets-4' ) ) : ?>
				<div>
					<?php dynamic_sidebar( 'footer-widgets-4' ); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>

		<?php endif; ?>

		<footer id="site-footer" itemscope="" itemtype="https://schema.org/WPFooter">
			<div class="wrap">
				<nav id="nav-footer" aria-label="Footer" itemscope="" itemtype="https://schema.org/SiteNavigationElement">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'depth'          => 1,
							'container'      => false,
							'menu_id'        => 'footer-menu',
						)
					);
					?>
				</nav>

				<div class="footer-creds">
					<p>
						<?php
						if ( get_theme_mod( 'vagabond_footer_creds' ) ) {
							echo wp_kses_post( get_theme_mod( 'vagabond_footer_creds' ) );
						} else {
							echo esc_html__( 'Copyright', 'vagabond' ) . ' &copy; ' . esc_html( date( 'Y' ) );
							echo ' ' . esc_html( get_bloginfo( 'name' ) ) . ' <br><span>|</span> ';
							echo sprintf(
								/* translators: %s: Developer URL */
								esc_html__( 'Website by %s', 'vagabond' ),
								'<a href="http://www.alexisvillegas.com/" target="_blank">AJV</a>'
							);
						}
						?>
					</p>
				</div>
			</div>
		</footer><!-- .site-footer -->

		<button title="Back To Top" class="to-top">
			<span class="screen-reader-text"><?php esc_html__( 'Back to top', 'vagabond' ); ?></span>
			<span class="arrow-up"></span>
		</button>
	</div><!-- .site-container -->

	<?php wp_footer(); ?>

</body>
</html>
