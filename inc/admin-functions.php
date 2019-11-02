<?php
/**
 * Theme admin functions.
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

add_filter( 'admin_footer_text', 'vagabond_admin_footer_text' );
/**
 * Modify the admin footer text message.
 *
 * @since 1.0.0
 */
function vagabond_admin_footer_text() {

	?>
	<span id="footer-thankyou">
		<a href="<?php echo esc_url( admin_url( 'themes.php?theme=' ) . esc_attr( VAGABOND_THEME_TEXTDOMAIN ) ); ?>"><?php echo esc_html( VAGABOND_THEME_NAME ); ?></a>
		<?php echo ' ' . esc_html__( 'theme developed by', 'vagabond' ) . ' '; ?>
		<a href="<?php echo esc_url( VAGABOND_DEVELOPER_URL ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( VAGABOND_DEVELOPER ); ?></a>
	</span>
	<?php

}

add_action( 'admin_init', 'vagabond_remove_dashboard_widgets' );
/**
 * Remove WordPress dashboard widgets.
 *
 * @since 1.0.0
 */
function vagabond_remove_dashboard_widgets() {

	remove_action( 'welcome_panel', 'wp_welcome_panel' ); // Welcome widget.
	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // At a Glance widget.
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Activity widget.
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Quick Draft widget.
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress Events and News widget.

}

add_action( 'wp_dashboard_setup', 'vagabond_add_dashboard_widgets' );
/**
 * Add custom WordPress dashboard widgets.
 *
 * @since 1.0.0
 */
function vagabond_add_dashboard_widgets() {

	add_meta_box( 'website_details_dashboard_widget', esc_html__( 'Website Help & Support', 'vagabond' ), 'vagabond_dashboard_widget', 'dashboard', 'normal', 'high' );

}

/**
 * Define the Website Help & Support dashboard widget.
 *
 * @since 1.0.0
 */
function vagabond_dashboard_widget() {

	if ( defined( 'VAGABOND_DEVELOPER_LOGO' ) ) {
		?>
		<img src="<?php echo esc_attr( VAGABOND_DEVELOPER_LOGO ); ?>" class="agency-logo" />
		<?php
	} else {
		?>
		<h3 class="agency-title"><?php echo esc_html( VAGABOND_DEVELOPER ); ?></h3>
		<?php
	}

	?>
	<p>
		<?php echo esc_html__( 'I\'m here to help! If you have any questions please don\'t hesitate to reach out.', 'vagabond' ); ?>
	</p>
	<?php

	if ( is_plugin_active( 'video-user-manuals/plugin.php' ) ) {
		$menu_title = get_option( 'wpm_o_custom_menu_name' ) ? get_option( 'wpm_o_custom_menu_name' ) : esc_html__( 'Manual', 'vagabond' );

		echo sprintf(
			/* translators: %s: Video User Manuals admin page URL */
			'<p>' . esc_html__( 'For video and written tutorials, please refer to the %s section on the sidebar.', 'vagabond' ) . '</p>',
			'<a href="admin.php?page=video-user-manuals/plugin.php">' . esc_html( $menu_title ) . '</a>'
		);
	}

	?>
	<ul>
		<li><strong><?php echo esc_html__( 'Developed by:', 'vagabond' ); ?></strong><?php echo ' ' . esc_html( VAGABOND_DEVELOPER ); ?></li>
		<li><strong><?php echo esc_html__( 'Website:', 'vagabond' ); ?></strong><a href="<?php echo esc_url( VAGABOND_DEVELOPER_URL ); ?>" target="blank_"><?php echo ' ' . esc_html( VAGABOND_DEVELOPER_URL ); ?></a></li>
	<?php

	if ( defined( 'VAGABOND_DEVELOPER_EMAIL' ) ) {
		?>
		<li><strong><?php echo esc_html__( 'Contact:', 'vagabond' ); ?></strong><a href="mailto:<?php echo esc_attr( VAGABOND_DEVELOPER_EMAIL ); ?>"><?php echo ' ' . esc_html( VAGABOND_DEVELOPER_EMAIL ); ?></a></li>
		<?php
	}

	?>
	</ul>
	<?php

}

add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', 'vagabond_custom_menu_order' );
/**
 * Customize dashboard menu order.
 *
 * @since 1.0.0
 * @param array $menu_order Array with current menu order.
 * @return array $menu_order Array with new menu order.
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/custom_menu_order
 */
function vagabond_custom_menu_order( $menu_order ) {

	if ( ! $menu_order ) {
		return true;
	}

	return array(
		'index.php', // Admin dashboard.
		'video-user-manuals/plugin.php', // Video User Manuals plugin.
		'separator1', // First of 3 separators available: separator1, separator2, separator-last.
		'edit.php?post_type=page', // Pages.
		'edit.php', // Posts.
		'edit-comments.php', // Comments.
		'upload.php', // Media.
	);

}

add_action( 'widgets_init', 'vagabond_unregister_widgets' );
/**
 * Unregister unwanted widgets.
 *
 * See /wp-includes/widgets/ folder for all core widget classes.
 *
 * @since 1.0.0
 */
function vagabond_unregister_widgets() {

	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'Akismet_Widget' );

}

add_action( 'pre_current_active_plugins', 'vagabond_hide_plugin' );
/**
 * Hide plugin from admin plugin list.
 *
 * @since 1.0.0
 */
function vagabond_hide_plugin() {

	global $wp_list_table;

	$hide    = array( 'video-user-manuals/plugin.php' );
	$plugins = $wp_list_table->items;

	foreach ( $plugins as $key => $val ) {
		if ( in_array( $key, $hide, true ) ) {
			unset( $wp_list_table->items[ $key ] );
		}
	}

}
