<?php
/**
 * Define the Alpha Color Picker custom control.
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
	 * Alpha Color Picker custom control.
	 *
	 * @since 1.0.0
	 * @author Braad Martin <http://braadmartin.com>
	 * @link https://github.com/BraadMartin/components/tree/master/customizer/alpha-color-picker
	 */
	class Vagabond_Alpha_Color_Picker extends WP_Customize_Control {

		/**
		 * Type of control being rendered.
		 *
		 * @var string $type
		 */
		public $type = 'alpha-color';

		/**
		 * Add support for palettes to be passed in.
		 *
		 * Supported palette values are true, false, or an array of RGBa and Hex colors.
		 *
		 * @var array $palette
		 */
		public $palette;

		/**
		 * Add support for showing the opacity value on the slider handle.
		 *
		 * @var bool $show_opacity
		 */
		public $show_opacity;

		/**
		 * Enqueue scripts and styles.
		 */
		public function enqueue() {

			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_enqueue_script( 'vagabond_custom_controls_js', VAGABOND_INC . "/customizer/assets/js/customizer{$suffix}.js", array( 'jquery', 'jquery-ui-core' ), VAGABOND_THEME_VERSION, true );
			wp_enqueue_style( 'vagabond_custom_controls_css', VAGABOND_INC . "/customizer/assets/css/customizer{$suffix}.css", array(), VAGABOND_THEME_VERSION, 'all' );

		}

		/**
		 * Render the control in the Customizer.
		 */
		public function render_content() {

			// Process the palette.
			if ( is_array( $this->palette ) ) {
				$palette = implode( '|', $this->palette );
			} else {
				// Default to true.
				$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
			}

			// Support passing show_opacity as string or boolean (default to true).
			$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';

			?>
			<label>
				<?php
				// Output the label and description if they were passed in.
				if ( isset( $this->label ) && '' !== $this->label ) {
					echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
				}

				if ( isset( $this->description ) && '' !== $this->description ) {
					echo '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
				}
				?>
			</label>

			<input class="alpha-color-control" type="text" data-show-opacity="<?php echo esc_attr( $show_opacity ); ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>  />
			<?php

		}

	}

}
