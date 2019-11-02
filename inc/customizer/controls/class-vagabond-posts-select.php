<?php
/**
 * Define the Post Select custom control.
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
	 * Post Select custom control.
	 *
	 * @since 1.0.0
	 * @author Alexis J. Villgeas <http://www.alexisvillegas.com>
	 */
	class Vagabond_Posts_Select extends WP_Customize_Control {

		/**
		 * Type of control being rendered.
		 *
		 * @var string $type
		 */
		public $type = 'post_select';

		/**
		 * Set posts to false.
		 *
		 * @var bool $posts
		 */
		private $posts = false;

		/**
		 * Constructor.
		 *
		 * @param object $manager The Customizer bootstrap instance.
		 * @param string $id The control ID.
		 * @param array  $args An associative array containing arguments for the setting.
		 * @param array  $options An associative array containing default values.
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {

			parent::__construct( $manager, $id, $args );

			$postargs = wp_parse_args( $options,
				array(
					'post_type'      => 'post',
					'posts_per_page' => '100', // Use a sensible number to prevent scaling issues.
				)
			);

			$this->posts = new WP_Query( $postargs );

		}

		/**
		 * Render the control in the Customizer.
		 */
		public function render_content() {

			if ( ! empty( $this->posts ) ) {

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
							foreach ( $this->posts as $post ) {
								echo '<option value="' . esc_attr( $post->ID ) . '" ' . selected( $this->value(), $post->ID, false ) . '>' . esc_html( $post->post_title ) . '</option>';
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
