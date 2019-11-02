<?php
/**
 * Load custom Customizer controls.
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
 * Load the Alpha Color Picker custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-alpha-color-picker.php';

/**
 * Load the Gravity Forms Select custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-gf-select.php';

/**
 * Load the Image Check Box custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-image-checkbox.php';

/**
 * Load the Image Radio Button custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-image-radio-button.php';

/**
 * Load the Posts Select custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-posts-select.php';

/**
 * Load the Simple Notice custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-simple-notice.php';

/**
 * Load the Slider custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-slider.php';

/**
 * Load the Sortable Repeater custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-sortable-repeater.php';

/**
 * Load the Text Radio Button custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-text-radio-button.php';

/**
 * Load the TinyMCE custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-tinymce.php';

/**
 * Load the Toggle Switch custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-toggle-switch.php';
