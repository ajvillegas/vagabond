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
 * URL sanitization.
 *
 * @param string $input Input to be sanitized (either a string containing a single url or multiple, separated by commas).
 * @return string Sanitized input.
 */
function vagabond_url_sanitization( $input ) {

	if ( strpos( $input, ',' ) !== false ) {
		$input = explode( ',', $input );
	}

	if ( is_array( $input ) ) {
		foreach ( $input as $key => $value ) {
			$input[ $key ] = esc_url_raw( $value );
		}
		$input = implode( ',', $input );
	} else {
		$input = esc_url_raw( $input );
	}

	return $input;

}

/**
 * Switch sanitization.
 *
 * @param string $input Switch value.
 * @return integer Sanitized value.
 */
function vagabond_switch_sanitization( $input ) {

	if ( true === $input ) {
		return 1;
	} else {
		return 0;
	}

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

/**
 * Integer sanitization.
 *
 * @param string $input Input value to check.
 * @return integer Returned integer value.
 */
function vagabond_sanitize_integer( $input ) {

	return (int) $input;

}

/**
 * Text sanitization.
 *
 * @param string $input Input to be sanitized (either a string containing a single string or multiple, separated by commas).
 * @return string Sanitized input.
 */
function vagabond_text_sanitization( $input ) {

	if ( strpos( $input, ',' ) !== false ) {
		$input = explode( ',', $input );
	}

	if ( is_array( $input ) ) {
		foreach ( $input as $key => $value ) {
			$input[ $key ] = sanitize_text_field( $value );
		}
		$input = implode( ',', $input );
	} else {
		$input = sanitize_text_field( $input );
	}

	return $input;

}

/**
 * Alpha Color (Hex & RGBa) sanitization.
 *
 * @param string $input Input to be sanitized.
 * @param object $setting WP_Customize_Setting instance.
 * @return string Sanitized input.
 */
function vagabond_hex_rgba_sanitization( $input, $setting ) {

	if ( empty( $input ) || is_array( $input ) ) {
		return $setting->default;
	}

	if ( false === strpos( $input, 'rgba' ) ) {
		// If string doesn't start with 'rgba' then santize as hex color.
		$input = sanitize_hex_color( $input );
	} else {
		// Sanitize as RGBa color.
		$input = str_replace( ' ', '', $input );
		sscanf( $input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		$input = 'rgba(' . vagabond_in_range( $red, 0, 255 ) . ',' . vagabond_in_range( $green, 0, 255 ) . ',' . vagabond_in_range( $blue, 0, 255 ) . ',' . vagabond_in_range( $alpha, 0, 1 ) . ')';
	}

	return $input;

}

/**
 * Only allow values between a certain minimum & maxmium range.
 *
 * @param number $input Input to be sanitized.
 * @param number $min Minimum value.
 * @param number $max Maxmium value.
 * @return number Sanitized input.
 */
function vagabond_in_range( $input, $min, $max ) {

	if ( $input < $min ) {
		$input = $min;
	}

	if ( $input > $max ) {
		$input = $max;
	}

	return $input;

}

/**
 * Date Time sanitization.
 *
 * @param string $input Date/Time string to be sanitized.
 * @param object $setting WP_Customize_Setting instance.
 * @return string Sanitized input.
 */
function vagabond_date_time_sanitization( $input, $setting ) {

	$datetimeformat = 'Y-m-d';

	if ( $setting->manager->get_control( $setting->id )->include_time ) {
		$datetimeformat = 'Y-m-d H:i:s';
	}

	$date = DateTime::createFromFormat( $datetimeformat, $input );

	if ( false === $date ) {
		$date = DateTime::createFromFormat( $datetimeformat, $setting->default );
	}

	return $date->format( $datetimeformat );

}
