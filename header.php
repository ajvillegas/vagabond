<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div class="site-inner">.
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
<!doctype html>
<html <?php language_attributes( 'html' ); ?> class="no-js">
<head itemscope="" itemtype="https://schema.org/WebSite">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Replace no-js class in <html> tag if JS is loaded -->
	<script type="text/javascript">(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope="" itemtype="https://schema.org/WebPage">
	<div class="site-container">
		<ul class="site-skip-links">
			<li>
				<a class="screen-reader-text" href="#nav-menu"><?php esc_html_e( 'Skip to primary navigation', 'vagabond' ); ?></a>
			</li>
			<li>
				<a class="screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'vagabond' ); ?></a>
			</li>
			<li>
				<a class="screen-reader-text" href="#primary-sidebar"><?php esc_html_e( 'Skip to sidebar', 'vagabond' ); ?></a>
			</li>
			<li>
				<a class="screen-reader-text" href="#footer-widgets"><?php esc_html_e( 'Skip to footer', 'vagabond' ); ?></a>
			</li>
		</ul>

		<header class="site-header" itemscope="" itemtype="https://schema.org/WPHeader">
			<nav id="nav-menu" class="navbar navbar-expand-md" role="navigation">
				<?php
				if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :
					?>
					<p class="screen-reader-text"><?php echo bloginfo( 'name' ); ?></p>
					<?php

					the_custom_logo();
				else :
					?>
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<p class="site-title"><?php bloginfo( 'name' ); ?></p>
					</a>
					<?php
				endif;
				?>

				<p class="screen-reader-text"><?php bloginfo( 'description' ); ?></p>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
					<span class="navbar-toggler-icon"></span>
				</button>

				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'depth'           => 2,
						'container'       => 'div',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarSupportedContent',
						'link_before'     => '<span>',
						'link_after'      => '</span>',
						'menu_class'      => 'navbar-nav',
						'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
						'walker'          => new WP_Bootstrap_Navwalker(),
					)
				);
				?>
			</nav><!-- #site-nav-primary -->
		</header><!-- .site-header -->

		<?php vagabond_header_hero(); ?>

		<div class="site-inner">
