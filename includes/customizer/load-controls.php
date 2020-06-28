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
 * Load the Image Radio Button custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-image-radio-button.php';

/**
 * Load the TinyMCE custom control.
 */
require_once VAGABOND_INC_DIR . '/customizer/controls/class-vagabond-tinymce.php';
