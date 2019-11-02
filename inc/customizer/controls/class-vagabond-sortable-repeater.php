<?php
/**
 * Define the Sortable Repeater custom control.
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
	 * Sortable Repeater custom control.
	 *
	 * @since 1.0.0
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @link https://github.com/maddisondesigns
	 */
	class Vagabond_Sortable_Repeater extends WP_Customize_Control {

		/**
		 * Type of control being rendered.
		 *
		 * @var string $type
		 */
		public $type = 'sortable_repeater';

		/**
		 * Button labels.
		 *
		 * @var array $button_labels
		 */
		public $button_labels = array();

		/**
		 * Constructor.
		 *
		 * @param object $manager The Customizer bootstrap instance.
		 * @param string $id The control ID.
		 * @param array  $args An associative array containing arguments for the setting.
		 */
		public function __construct( $manager, $id, $args = array() ) {

			parent::__construct( $manager, $id, $args );

			// Merge the passed button labels with our default labels.
			$this->button_labels = wp_parse_args( $this->button_labels,
				array(
					'add' => esc_html__( 'Add', 'vagabond' ),
				)
			);

		}

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

			?>
			<div class="sortable_repeater_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-sortable-repeater" <?php $this->link(); ?> />
				<div class="sortable" style="margin-bottom:10px;">
					<div class="repeater">
						<input type="text" value="" class="repeater-input" placeholder="http://" /><span class="dashicons dashicons-sort"></span><a class="customize-control-sortable-repeater-delete" href="#"><span class="dashicons dashicons-no-alt"></span></a>
						<button class="button vagabond-custom-media-button" type="button"><?php echo esc_html( 'Select Image', 'vagabond' ); ?></button>
					</div>
				</div>
				<button class="button add-new-widget customize-control-sortable-repeater-add" type="button"><?php echo esc_html( $this->button_labels['add'] ); ?></button>
			</div>
			<?php

		}

	}

}
