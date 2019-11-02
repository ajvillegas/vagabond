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

/**
 * Set the Customizer default options.
 *
 * @since 1.0.0
 */
function vagabond_generate_customizer_defaults() {

	$customizer_defaults = array(
		'sample_toggle_switch'             => 0,
		'sample_slider_control'            => 48,
		'sample_sortable_repeater_control' => '',
		'sample_image_radio_button'        => 'sidebarright',
		'sample_text_radio_button'         => 'right',
		'sample_image_checkbox'            => 'stylebold,styleallcaps',
		'sample_alpha_color'               => 'rgba(209,0,55,0.7)',
		'sample_simple_notice'             => '',
		'sample_tinymce_editor'            => '',
		'sample_default_text'              => '',
		'sample_email_text'                => '',
		'sample_url_text'                  => '',
		'sample_number_text'               => '',
		'sample_hidden_text'               => '',
		'sample_date_text'                 => '',
		'sample_default_checkbox'          => 0,
		'sample_default_select'            => 'jet-fuel',
		'sample_default_radio'             => 'spider-man',
		'sample_default_dropdownpages'     => '0',
		'sample_default_textarea'          => '',
		'sample_default_color'             => '#dd3333',
		'sample_default_media'             => '',
		'sample_default_image'             => '',
		'sample_default_cropped_image'     => '',
		'sample_date_only'                 => '2017-08-28',
		'sample_date_time'                 => '2017-08-28 16:30:00',
		'sample_date_time_no_past_date'    => date( 'Y-m-d' ),
	);

	return $customizer_defaults;

}

add_action( 'customize_register', 'vagabond_register_customizer_panels' );
/**
 * Register Customizer panels.
 *
 * @since 1.0.0
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function vagabond_register_customizer_panels( $wp_customize ) {

	// Panel: Theme Homepage.
	$wp_customize->add_panel(
		'vagabond_homepage_panel',
		array(
			'priority'        => 125,
			'title'           => esc_html__( 'Theme Homepage', 'vagabond' ),
			'description'     => esc_html__( 'Edit the theme\'s custom homepage sections.', 'vagabond' ),
			'capability'      => 'edit_theme_options',
			'active_callback' => 'vagabond_is_front_page',
		)
	);

}


add_action( 'customize_register', 'vagabond_register_customizer_sections' );
/**
 * Register Customizer sections.
 *
 * @since 1.0.0
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function vagabond_register_customizer_sections( $wp_customize ) {

	// Section: Default Controls.
	$wp_customize->add_section(
		'vagabond_default_controls_section',
		array(
			'priority'    => 10,
			'panel'       => 'vagabond_homepage_panel',
			'title'       => esc_html__( 'Default Controls Section', 'vagabond' ),
			'description' => esc_html__( 'Section Description.', 'vagabond' ),
			'capability'  => 'edit_theme_options',
		)
	);

	// Section: Custom Controls.
	$wp_customize->add_section(
		'vagabond_custom_controls_section',
		array(
			'priority'    => 20,
			'panel'       => 'vagabond_homepage_panel',
			'title'       => esc_html__( 'Custom Controls Section', 'vagabond' ),
			'description' => esc_html__( 'Section Description.', 'vagabond' ),
			'capability'  => 'edit_theme_options',
		)
	);

}

add_action( 'customize_register', 'vagabond_register_customizer_default_controls' );
/**
 * Register default Customizer controls.
 *
 * @since 1.0.0
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function vagabond_register_customizer_default_controls( $wp_customize ) {

	$defaults = vagabond_generate_customizer_defaults();

	// Test of Text Control.
	$wp_customize->add_setting(
		'sample_default_text',
		array(
			'default'           => $defaults['sample_default_text'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_text_sanitization',
		)
	);
	$wp_customize->add_control(
		'sample_default_text',
		array(
			'label'       => esc_html__( 'Default Text Control', 'vagabond' ),
			'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'vagabond' ),
			'section'     => 'vagabond_default_controls_section',
			'type'        => 'text',
			'input_attrs' => array(
				'class'       => 'my-custom-class',
				'style'       => 'border: 1px solid rebeccapurple',
				'placeholder' => esc_html__( 'Enter name...', 'vagabond' ),
			),
		)
	);

	// Test of Email Control.
	$wp_customize->add_setting(
		'sample_email_text',
		array(
			'default'           => $defaults['sample_email_text'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_email',
		)
	);
	$wp_customize->add_control(
		'sample_email_text',
		array(
			'label'       => esc_html__( 'Default Email Control', 'vagabond' ),
			'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'vagabond' ),
			'section'     => 'vagabond_default_controls_section',
			'type'        => 'email',
		)
	);

	// Test of URL Control.
	$wp_customize->add_setting(
		'sample_url_text',
		array(
			'default'           => $defaults['sample_url_text'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'sample_url_text',
		array(
			'label'       => esc_html__( 'Default URL Control', 'vagabond' ),
			'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'vagabond' ),
			'section'     => 'vagabond_default_controls_section',
			'type'        => 'url',
		)
	);

	// Test of Number Control.
	$wp_customize->add_setting(
		'sample_number_text',
		array(
			'default'           => $defaults['sample_number_text'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_sanitize_integer',
		)
	);
	$wp_customize->add_control(
		'sample_number_text',
		array(
			'label'       => esc_html__( 'Default Number Control', 'vagabond' ),
			'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'vagabond' ),
			'section'     => 'vagabond_default_controls_section',
			'type'        => 'number',
		)
	);

	// Test of Hidden Control.
	$wp_customize->add_setting(
		'sample_hidden_text',
		array(
			'default'           => $defaults['sample_hidden_text'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_text_sanitization',
		)
	);
	$wp_customize->add_control(
		'sample_hidden_text',
		array(
			'label'       => esc_html__( 'Default Hidden Control', 'vagabond' ),
			'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'vagabond' ),
			'section'     => 'vagabond_default_controls_section',
			'type'        => 'hidden',
		)
	);

	// Test of Date Control.
	$wp_customize->add_setting(
		'sample_date_text',
		array(
			'default'           => $defaults['sample_date_text'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_text_sanitization',
		)
	);
	$wp_customize->add_control(
		'sample_date_text',
		array(
			'label'       => esc_html__( 'Default Date Control', 'vagabond' ),
			'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'vagabond' ),
			'section'     => 'vagabond_default_controls_section',
			'type'        => 'text',
		)
	);

	// Test of Standard Checkbox Control.
	$wp_customize->add_setting(
		'sample_default_checkbox',
		array(
			'default'           => $defaults['sample_default_checkbox'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		'sample_default_checkbox',
		array(
			'label'       => esc_html__( 'Default Checkbox Control', 'vagabond' ),
			'description' => esc_html__( 'Sample Checkbox description', 'vagabond' ),
			'section'     => 'vagabond_default_controls_section',
			'type'        => 'checkbox',
		)
	);

	// Test of Standard Select Control.
	$wp_customize->add_setting(
		'sample_default_select',
		array(
			'default'           => $defaults['sample_default_select'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_radio_sanitization',
		)
	);
	$wp_customize->add_control(
		'sample_default_select',
		array(
			'label'   => esc_html__( 'Standard Select Control', 'vagabond' ),
			'section' => 'vagabond_default_controls_section',
			'type'    => 'select',
			'choices' => array(
				'wordpress'      => esc_html__( 'WordPress', 'vagabond' ),
				'hamsters'       => esc_html__( 'Hamsters', 'vagabond' ),
				'jet-fuel'       => esc_html__( 'Jet Fuel', 'vagabond' ),
				'nuclear-energy' => esc_html__( 'Nuclear Energy', 'vagabond' ),
			),
		)
	);

	// Test of Standard Radio Control.
	$wp_customize->add_setting(
		'sample_default_radio',
		array(
			'default'           => $defaults['sample_default_radio'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_radio_sanitization',
		)
	);
	$wp_customize->add_control(
		'sample_default_radio',
		array(
			'label'   => esc_html__( 'Standard Radio Control', 'vagabond' ),
			'section' => 'vagabond_default_controls_section',
			'type'    => 'radio',
			'choices' => array(
				'captain-america' => esc_html__( 'Captain America', 'vagabond' ),
				'iron-man'        => esc_html__( 'Iron Man', 'vagabond' ),
				'spider-man'      => esc_html__( 'Spider-Man', 'vagabond' ),
				'thor'            => esc_html__( 'Thor', 'vagabond' ),
			),
		)
	);

	// Test of Dropdown Pages Control.
	$wp_customize->add_setting(
		'sample_default_dropdownpages',
		array(
			'default'           => $defaults['sample_default_dropdownpages'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'sample_default_dropdownpages',
		array(
			'label'   => esc_html__( 'Default Dropdown Pages Control', 'vagabond' ),
			'section' => 'vagabond_default_controls_section',
			'type'    => 'dropdown-pages',
		)
	);

	// Test of Textarea Control.
	$wp_customize->add_setting(
		'sample_default_textarea',
		array(
			'default'           => $defaults['sample_default_textarea'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);
	$wp_customize->add_control(
		'sample_default_textarea',
		array(
			'label'       => esc_html__( 'Default Textarea Control', 'vagabond' ),
			'section'     => 'vagabond_default_controls_section',
			'type'        => 'textarea',
			'input_attrs' => array(
				'class'       => 'my-custom-class',
				'style'       => 'border: 1px solid #999',
				'placeholder' => esc_html__( 'Enter message...', 'vagabond' ),
			),
		)
	);

	// Test of Color Control.
	$wp_customize->add_setting(
		'sample_default_color',
		array(
			'default'           => $defaults['sample_default_color'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sample_default_color',
			array(
				'label'   => esc_html__( 'Default Color Control', 'vagabond' ),
				'section' => 'vagabond_default_controls_section',
				'type'    => 'color',
			)
		)
	);

	// Test of Media Control.
	$wp_customize->add_setting(
		'sample_default_media',
		array(
			'default'           => $defaults['sample_default_media'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'sample_default_media',
			array(
				'label'         => esc_html__( 'Default Media Control', 'vagabond' ),
				'description'   => esc_html__( 'This is the description for the Media Control', 'vagabond' ),
				'section'       => 'vagabond_default_controls_section',
				'mime_type'     => 'image',
				'button_labels' => array(
					'select'       => esc_html__( 'Select File', 'vagabond' ),
					'change'       => esc_html__( 'Change File', 'vagabond' ),
					'default'      => esc_html__( 'Default', 'vagabond' ),
					'remove'       => esc_html__( 'Remove', 'vagabond' ),
					'placeholder'  => esc_html__( 'No file selected', 'vagabond' ),
					'frame_title'  => esc_html__( 'Select File', 'vagabond' ),
					'frame_button' => esc_html__( 'Choose File', 'vagabond' ),
				),
			)
		)
	);

	// Test of Image Control.
	$wp_customize->add_setting(
		'sample_default_image',
		array(
			'default'           => $defaults['sample_default_image'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'sample_default_image',
			array(
				'label'         => esc_html__( 'Default Image Control', 'vagabond' ),
				'description'   => esc_html__( 'This is the description for the Image Control', 'vagabond' ),
				'section'       => 'vagabond_default_controls_section',
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

	// Test of Cropped Image Control.
	$wp_customize->add_setting(
		'sample_default_cropped_image',
		array(
			'default'           => $defaults['sample_default_cropped_image'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'sample_default_cropped_image',
			array(
				'label'       => esc_html__( 'Default Cropped Image Control', 'vagabond' ),
				'description' => esc_html__( 'This is the description for the Cropped Image Control', 'vagabond' ),
				'section'     => 'vagabond_default_controls_section',
				'flex_width'  => false,
				'flex_height' => false,
				'width'       => 800,
				'height'      => 400,
			)
		)
	);

	// Test of Date/Time Control.
	$wp_customize->add_setting(
		'sample_date_only',
		array(
			'default'           => $defaults['sample_date_only'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_date_time_sanitization',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Date_Time_Control(
			$wp_customize,
			'sample_date_only',
			array(
				'label'              => esc_html__( 'Default Date Control', 'vagabond' ),
				'description'        => esc_html__( 'This is the Date Time Control but is only displaying a date field. It also has Max and Min years set.', 'vagabond' ),
				'section'            => 'vagabond_default_controls_section',
				'include_time'       => false,
				'allow_past_date'    => true,
				'twelve_hour_format' => true,
				'min_year'           => '2016',
				'max_year'           => '2025',
			)
		)
	);

	// Test of Date/Time Control.
	$wp_customize->add_setting(
		'sample_date_time',
		array(
			'default'           => $defaults['sample_date_time'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_date_time_sanitization',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Date_Time_Control(
			$wp_customize,
			'sample_date_time',
			array(
				'label'              => esc_html__( 'Default Date Control', 'vagabond' ),
				'description'        => esc_html__( 'This is the Date Time Control. It also has Max and Min years set.', 'vagabond' ),
				'section'            => 'vagabond_default_controls_section',
				'include_time'       => true,
				'allow_past_date'    => true,
				'twelve_hour_format' => true,
				'min_year'           => '2010',
				'max_year'           => '2020',
			)
		)
	);

	// Test of Date/Time Control.
	$wp_customize->add_setting(
		'sample_date_time_no_past_date',
		array(
			'default'           => $defaults['sample_date_time_no_past_date'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_date_time_sanitization',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Date_Time_Control(
			$wp_customize,
			'sample_date_time_no_past_date',
			array(
				'label'              => esc_html__( 'Default Date Control', 'vagabond' ),
				'description'        => esc_html__( 'This is the Date Time Control but is only displaying a date field. Past dates are not allowed.', 'vagabond' ),
				'section'            => 'vagabond_default_controls_section',
				'include_time'       => false,
				'allow_past_date'    => false,
				'twelve_hour_format' => true,
				'min_year'           => '2016',
				'max_year'           => '2099',
			)
		)
	);

}

add_action( 'customize_register', 'vagabond_register_customizer_custom_controls' );
/**
 * Register custom Customizer controls.
 *
 * @since 1.0.0
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function vagabond_register_customizer_custom_controls( $wp_customize ) {

	$defaults = vagabond_generate_customizer_defaults();

	// Test of Toggle Switch Custom Control.
	$wp_customize->add_setting(
		'sample_toggle_switch',
		array(
			'default'           => $defaults['sample_toggle_switch'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_switch_sanitization',
		)
	);
	$wp_customize->add_control(
		new Vagabond_Toggle_Switch(
			$wp_customize,
			'sample_toggle_switch',
			array(
				'label'   => esc_html__( 'Toggle switch', 'vagabond' ),
				'section' => 'vagabond_custom_controls_section',
			)
		)
	);

	// Test of Slider Custom Control.
	$wp_customize->add_setting(
		'sample_slider_control',
		array(
			'default'           => $defaults['sample_slider_control'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new Vagabond_Slider(
			$wp_customize,
			'sample_slider_control',
			array(
				'label'       => esc_html__( 'Slider Control (px)', 'vagabond' ),
				'section'     => 'vagabond_custom_controls_section',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 90,
					'step' => 1,
				),
			)
		)
	);

	// Test of Sortable Repeater Custom Control.
	$wp_customize->add_setting(
		'sample_sortable_repeater_control',
		array(
			'default'           => $defaults['sample_sortable_repeater_control'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_url_sanitization',
		)
	);
	$wp_customize->add_control(
		new Vagabond_Sortable_Repeater(
			$wp_customize,
			'sample_sortable_repeater_control',
			array(
				'label'         => esc_html__( 'Sortable Repeater', 'vagabond' ),
				'description'   => esc_html__( 'This is the control description.', 'vagabond' ),
				'section'       => 'vagabond_custom_controls_section',
				'button_labels' => array(
					'add' => esc_html__( 'Add Row', 'vagabond' ),
				),
			)
		)
	);

	// Test of Image Radio Button Custom Control.
	$wp_customize->add_setting(
		'sample_image_radio_button',
		array(
			'default'           => $defaults['sample_image_radio_button'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_radio_sanitization',
		)
	);
	$wp_customize->add_control(
		new Vagabond_Image_Radio_Button(
			$wp_customize,
			'sample_image_radio_button',
			array(
				'label'       => esc_html__( 'Image Radio Button Control', 'vagabond' ),
				'description' => esc_html__( 'Sample custom control description', 'vagabond' ),
				'section'     => 'vagabond_custom_controls_section',
				'choices'     => array(
					'sidebarleft'  => array(
						'image' => VAGABOND_INC . '/customizer/assets/images/sidebar-left.png',
						'name'  => esc_html__( 'Left Sidebar', 'vagabond' ),
					),
					'sidebarnone'  => array(
						'image' => VAGABOND_INC . '/customizer/assets/images/sidebar-none.png',
						'name'  => esc_html__( 'No Sidebar', 'vagabond' ),
					),
					'sidebarright' => array(
						'image' => VAGABOND_INC . '/customizer/assets/images/sidebar-right.png',
						'name'  => esc_html__( 'Right Sidebar', 'vagabond' ),
					),
				),
			)
		)
	);

	// Test of Text Radio Button Custom Control.
	$wp_customize->add_setting(
		'sample_text_radio_button',
		array(
			'default'           => $defaults['sample_text_radio_button'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_radio_sanitization',
		)
	);
	$wp_customize->add_control(
		new Vagabond_Text_Radio_Button(
			$wp_customize,
			'sample_text_radio_button',
			array(
				'label'       => esc_html__( 'Text Radio Button Control', 'vagabond' ),
				'description' => esc_html__( 'Sample custom control description', 'vagabond' ),
				'section'     => 'vagabond_custom_controls_section',
				'choices'     => array(
					'left'     => esc_html__( 'Left', 'vagabond' ),
					'centered' => esc_html__( 'Centered', 'vagabond' ),
					'right'    => esc_html__( 'Right', 'vagabond' ),
				),
			)
		)
	);

	// Test of Image Checkbox Custom Control.
	$wp_customize->add_setting(
		'sample_image_checkbox',
		array(
			'default'           => $defaults['sample_image_checkbox'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'vagabond_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Vagabond_Image_checkbox(
			$wp_customize,
			'sample_image_checkbox',
			array(
				'label'       => esc_html__( 'Image Checkbox Control', 'vagabond' ),
				'description' => esc_html__( 'Sample custom control description', 'vagabond' ),
				'section'     => 'vagabond_custom_controls_section',
				'choices'     => array(
					'stylebold'      => array(
						'image' => VAGABOND_INC . '/customizer/assets/images/bold.png',
						'name'  => esc_html__( 'Bold', 'vagabond' ),
					),
					'styleitalic'    => array(
						'image' => VAGABOND_INC . '/customizer/assets/images/italic.png',
						'name'  => esc_html__( 'Italic', 'vagabond' ),
					),
					'styleallcaps'   => array(
						'image' => VAGABOND_INC . '/customizer/assets/images/allcaps.png',
						'name'  => esc_html__( 'All Caps', 'vagabond' ),
					),
					'styleunderline' => array(
						'image' => VAGABOND_INC . '/customizer/assets/images/underline.png',
						'name'  => esc_html__( 'Underline', 'vagabond' ),
					),
				),
			)
		)
	);

	// Test of Alpha Color Picker Control.
	$wp_customize->add_setting(
		'sample_alpha_color',
		array(
			'default'           => $defaults['sample_alpha_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'vagabond_hex_rgba_sanitization',
		)
	);
	$wp_customize->add_control(
		new Vagabond_Alpha_Color_Picker(
			$wp_customize,
			'sample_alpha_color',
			array(
				'label'        => esc_html__( 'Alpha Color Picker Control', 'vagabond' ),
				'description'  => esc_html__( 'Sample custom control description', 'vagabond' ),
				'section'      => 'vagabond_custom_controls_section',
				'show_opacity' => true,
				'palette'      => array(
					'#000',
					'#fff',
					'#df312c',
					'#df9a23',
					'#eef000',
					'#7ed934',
					'#1571c1',
					'#8309e7',
				),
			)
		)
	);

	// Test of Simple Notice control.
	$wp_customize->add_setting(
		'sample_simple_notice',
		array(
			'default'           => $defaults['sample_simple_notice'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'vagabond_text_sanitization',
		)
	);
	$wp_customize->add_control(
		new Vagabond_Simple_Notice(
			$wp_customize,
			'sample_simple_notice',
			array(
				'label'       => esc_html__( 'Simple Notice Control', 'vagabond' ),
				'description' => wp_kses_post( __( 'This Custom Control allows you to display a simple title and description to your users. You can even include <a href="http://google.com" target="_blank">basic html</a>.', 'vagabond' ) ),
				'section'     => 'vagabond_custom_controls_section',
			)
		)
	);

	// Test of TinyMCE control.
	$wp_customize->add_setting(
		'sample_tinymce_editor',
		array(
			'default'           => $defaults['sample_tinymce_editor'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		new Vagabond_TinyMCE(
			$wp_customize,
			'sample_tinymce_editor',
			array(
				'label'       => esc_html__( 'TinyMCE Control', 'vagabond' ),
				'description' => esc_html__( 'This is a TinyMCE Editor Custom Control', 'vagabond' ),
				'section'     => 'vagabond_custom_controls_section',
				'input_attrs' => array(
					'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
				),
			)
		)
	);

}

add_action( 'customize_register', 'vagabond_register_post_message_support' );
/**
 * Add postMessage support for site title and description.
 *
 * @since 1.0.0
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function vagabond_register_post_message_support( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'vagabond_customize_partial_blogname',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'vagabond_customize_partial_blogdescription',
			)
		);

	}

}
