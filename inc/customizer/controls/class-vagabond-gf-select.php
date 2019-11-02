<?php
/**
 * Define the Gravity Forms Select custom control.
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
	 * Gravity Forms Select custom control.
	 *
	 * @since 1.0.0
	 * @author Alexis J. Villgeas <http://www.alexisvillegas.com>
	 */
	class Vagabond_GF_Select extends WP_Customize_Control {

		/**
		 * Type of control being rendered.
		 *
		 * @var string $type
		 */
		public $type = 'gf_select';

		/**
		 * Render the control in the Customizer.
		 */
		public function render_content() {

			if ( class_exists( 'RGFormsModel' ) ) {

				?>
				<div class="post_select_control">
					<?php if ( ! empty( $this->label ) ) { ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php } ?>
					<?php if ( ! empty( $this->description ) ) { ?>
						<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php } ?>

					<div class="post-select">
						<select class="posts-list" control-name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?>>
							<option value="0"><?php echo esc_html( '- None -', 'vagabond' ); ?></option>
							<?php
							$forms = RGFormsModel::get_forms( 1, 'title' );
							foreach ( $forms as $form ) {
								echo '<option value="' . absint( $form->id ) . '" ' . selected( $this->value(), $form->id, false ) . '>' . esc_html( $form->title ) . '</option>';
							}
							?>
						</select>
					</div>
				</div>
				<?php

			}

		}

	}

}
