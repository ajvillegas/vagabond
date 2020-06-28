<?php
/**
 * Define the TinyMCE custom control.
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
	 * TinyMCE custom control.
	 *
	 * @since 1.0.0
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @link https://github.com/maddisondesigns
	 */
	class Vagabond_TinyMCE extends WP_Customize_Control {

		/**
		 * Type of control being rendered.
		 *
		 * @var string $type
		 */
		public $type = 'tinymce_editor';

		/**
		 * Enqueue scripts and styles.
		 */
		public function enqueue() {

			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_enqueue_script( 'vagabond_custom_controls_js', VAGABOND_INC . "/customizer/assets/js/customizer{$suffix}.js", array( 'jquery', 'jquery-ui-core' ), VAGABOND_THEME_VERSION, true );
			wp_enqueue_style( 'vagabond_custom_controls_css', VAGABOND_INC . "/customizer/assets/css/customizer{$suffix}.css", array(), VAGABOND_THEME_VERSION, 'all' );
			wp_enqueue_editor();

		}

		/**
		 * Pass our TinyMCE toolbar string to JavaScript.
		 */
		public function to_json() {

			parent::to_json();

			$this->json['ajvcustomizetinymcetoolbar1'] = isset( $this->input_attrs['toolbar1'] ) ? esc_attr( $this->input_attrs['toolbar1'] ) : 'bold italic bullist numlist alignleft aligncenter alignright link';
			$this->json['ajvcustomizetinymcetoolbar2'] = isset( $this->input_attrs['toolbar2'] ) ? esc_attr( $this->input_attrs['toolbar2'] ) : '';

		}

		/**
		 * Render the control in the Customizer.
		 */
		public function render_content() {

			?>
			<div class="tinymce-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<textarea rows="6" columns="4" id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
			</div>
			<?php

		}

	}

}
