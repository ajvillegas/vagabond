<?php
/**
 * Register Customizer panels, sections and controls.
 *
 * Included by customizer.php.
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

add_action( 'customize_register', 'vagabond_register_customizer_panels' );
/**
 * Register Customizer panels.
 *
 * @since 1.0.0
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function vagabond_register_customizer_panels( $wp_customize ) {

	// Panel: Theme Settings.
	$wp_customize->add_panel(
		'vagabond_theme_settings',
		array(
			'priority'    => 125,
			'title'       => esc_html__( 'Theme Settings', 'vagabond' ),
			'description' => esc_html__( 'Edit the theme\'s default settings.', 'vagabond' ),
			'capability'  => 'edit_theme_options',
		)
	);

}

add_action( 'customize_register', 'vagabond_register_customizer_sections' );
/**
 * Register Customizer sections.
 *
 * @since 1.0.0
 *
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function vagabond_register_customizer_sections( $wp_customize ) {

	// Section: Site Layout.
	$wp_customize->add_section(
		'vagabond_layout_section',
		array(
			'priority'    => 10,
			'panel'       => 'vagabond_theme_settings',
			'title'       => esc_html__( 'Site Layout', 'vagabond' ),
			'description' => esc_html__( 'Select the default site layout for post and pages.', 'vagabond' ),
			'capability'  => 'edit_theme_options',
		)
	);

	// Section: Default Images.
	$wp_customize->add_section(
		'vagabond_images_section',
		array(
			'priority'    => 20,
			'panel'       => 'vagabond_theme_settings',
			'title'       => esc_html__( 'Default Images', 'vagabond' ),
			'description' => esc_html__( 'For optimal results, the recommended size for images is 1500 x 1000 pixels.', 'vagabond' ),
			'capability'  => 'edit_theme_options',
		)
	);

	// Section: Footer.
	$wp_customize->add_section(
		'vagabond_footer_section',
		array(
			'priority'    => 30,
			'panel'       => 'vagabond_theme_settings',
			'title'       => esc_html__( 'Footer', 'vagabond' ),
			'description' => esc_html__( 'Edit the text that displays in your site footer.', 'vagabond' ),
			'capability'  => 'edit_theme_options',
		)
	);

}

add_action( 'customize_register', 'vagabond_register_customizer_controls' );
/**
 * Register theme Customizer controls.
 *
 * @since 1.0.0
 *
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function vagabond_register_customizer_controls( $wp_customize ) {

	// Site Layout Control.
	$wp_customize->add_setting(
		'vagabond_default_layout',
		array(
			'default'           => 'content-sidebar',
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_radio_sanitization',
		)
	);
	$wp_customize->add_control(
		new Vagabond_Image_Radio_Button(
			$wp_customize,
			'vagabond_default_layout',
			array(
				'label'   => esc_html__( 'Default Site Layout', 'vagabond' ),
				'section' => 'vagabond_layout_section',
				'choices' => array(
					'content-sidebar'    => array(
						'image' => VAGABOND_IMAGES . '/post-layouts/content-sidebar.gif',
						'name'  => esc_html__( 'Right Sidebar', 'vagabond' ),
					),
					'sidebar-content'    => array(
						'image' => VAGABOND_IMAGES . '/post-layouts/sidebar-content.gif',
						'name'  => esc_html__( 'Left Sidebar', 'vagabond' ),
					),
					'full-width-padded'  => array(
						'image' => VAGABOND_IMAGES . '/post-layouts/full-width-padded.gif',
						'name'  => esc_html__( 'Full Width Padded', 'vagabond' ),
					),
					'full-width-content' => array(
						'image' => VAGABOND_IMAGES . '/post-layouts/full-width-content.gif',
						'name'  => esc_html__( 'Full Width Content', 'vagabond' ),
					),
				),
			)
		)
	);

	// Default Featured Image Control.
	$wp_customize->add_setting(
		'vagabond_default_featured_image',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'vagabond_default_featured_image',
			array(
				'label'         => esc_html__( 'Featured Image', 'vagabond' ),
				'description'   => esc_html__( 'The default featured image for posts and pages.', 'vagabond' ),
				'section'       => 'vagabond_images_section',
				'button_labels' => array(
					'select'       => esc_html__( 'Select Image', 'vagabond' ),
					'change'       => esc_html__( 'Change Image', 'vagabond' ),
					'remove'       => esc_html__( 'Remove', 'vagabond' ),
					'default'      => esc_html__( 'Default', 'vagabond' ),
					'placeholder'  => esc_html__( 'No image selected', 'vagabond' ),
					'frame_title'  => esc_html__( 'Select Image', 'vagabond' ),
					'frame_button' => esc_html__( 'Choose Image', 'vagabond' ),
				),
			)
		)
	);

	// Default 404 Error Image Control.
	$wp_customize->add_setting(
		'vagabond_default_404_image',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'vagabond_default_404_image',
			array(
				'label'         => esc_html__( '404 Error Image', 'vagabond' ),
				'description'   => esc_html__( 'The image for the 404 error (not found) page.', 'vagabond' ),
				'section'       => 'vagabond_images_section',
				'button_labels' => array(
					'select'       => esc_html__( 'Select Image', 'vagabond' ),
					'change'       => esc_html__( 'Change Image', 'vagabond' ),
					'remove'       => esc_html__( 'Remove', 'vagabond' ),
					'default'      => esc_html__( 'Default', 'vagabond' ),
					'placeholder'  => esc_html__( 'No image selected', 'vagabond' ),
					'frame_title'  => esc_html__( 'Select Image', 'vagabond' ),
					'frame_button' => esc_html__( 'Choose Image', 'vagabond' ),
				),
			)
		)
	);

	// Footer Credits Control.
	$wp_customize->add_setting(
		'vagabond_footer_creds',
		array(
			'default'           => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		new Vagabond_TinyMCE(
			$wp_customize,
			'vagabond_footer_creds',
			array(
				'label'       => esc_html__( 'Footer Credits', 'vagabond' ),
				'description' => esc_html__( 'You can use the [year] shortcode to dynamically display the current year.', 'vagabond' ),
				'section'     => 'vagabond_footer_section',
				'input_attrs' => array(
					'toolbar1' => 'bold italic link',
				),
			)
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'vagabond_footer_creds',
		array(
			'selector'            => '.footer-creds p',
			'container_inclusive' => false,
			'render_callback'     => 'vagabond_footer_creds',
			'fallback_refresh'    => true,
		)
	);

}

add_action( 'customize_register', 'vagabond_modify_default_customizer_controls' );
/**
 * Modify default theme Customizer controls.
 *
 * @since 1.0.0
 *
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function vagabond_modify_default_customizer_controls( $wp_customize ) {

	// Remove the Tagline (blog description) control.
	$wp_customize->remove_control( 'blogdescription' );

	// Modify the Site Icon control label.
	$wp_customize->get_control( 'site_icon' )->label = esc_html__( 'Site Icon (Favicon)', 'vagabond' );

}
