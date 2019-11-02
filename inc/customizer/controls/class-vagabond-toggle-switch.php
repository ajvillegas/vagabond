<?php
/**
 * Define the Toggle Switch custom control.
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
	 * Toggle Switch custom control.
	 *
	 * @since 1.0.0
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @link https://github.com/maddisondesigns
	 */
	class Vagabond_Toggle_Switch extends WP_Customize_Control {

		/**
		 * Type of control being rendered.
		 *
		 * @var string $type
		 */
		public $type = 'toogle_switch';

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
			<div class="toggle-switch-control">
				<div class="toggle-switch">
				<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>"
					<?php
					$this->link();
					checked( $this->value() );
					?>
				>
				<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
				<span class="toggle-switch-inner"></span>
				<span class="toggle-switch-switch"></span>
				</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
			<?php

		}

	}

}
