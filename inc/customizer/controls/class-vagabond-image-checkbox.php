<?php
/**
 * Define the Image Check Box custom control.
 *
 * Included by load-controls.php.
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

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Image Check Box custom control.
	 *
	 * @since 1.0.0
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @link https://github.com/maddisondesigns
	 */
	class Vagabond_Image_Checkbox extends WP_Customize_Control {

		/**
		 * Type of control being rendered.
		 *
		 * @var string $type
		 */
		public $type = 'image_checkbox';

		/**
		 * Enqueue scripts and styles.
		 */
		public function enqueue() {

			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_enqueue_style( 'vagabond_custom_controls_css', VAGABOND_INC . "/customizer/assets/css/customizer{$suffix}.css", array(), VAGABOND_THEME_VERSION, 'all' );

		}

		/**
		 * Render the control in the Customizer.
		 */
		public function render_content() {

			?>
			<div class="image_checkbox_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<?php $checkbox_values = explode( ',', esc_attr( $this->value() ) ); ?>
					<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-multi-image-checkbox" <?php $this->link(); ?> />
				<?php foreach ( $this->choices as $key => $value ) { ?>
					<label class="checkbox-label">
						<input type="checkbox" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( in_array( esc_attr( $key ), $checkbox_values, true ), 1 ); ?> class="multi-image-checkbox"/>
						<img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
					</label>
				<?php } ?>
			</div>
			<?php

		}

	}

}
