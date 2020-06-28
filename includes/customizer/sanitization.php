<?php
/**
 * Customizer sanitization functions.
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
 * Radio button and select sanitization.
 *
 * @param string $input Radio Button value.
 * @param object $setting WP_Customize_Setting instance.
 * @return integer Sanitized value.
 */
function vagabond_radio_sanitization( $input, $setting ) {

	// Get the list of possible radio box or select options.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	if ( array_key_exists( $input, $choices ) ) {
		return $input;
	} else {
		return $setting->default;
	}

}
