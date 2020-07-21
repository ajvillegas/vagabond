<?php
/**
 * Vagabond functions and definitions.
 *
 * This file defines the theme constants and loads the
 * custom function files for the theme.
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

// Define theme constants (do not remove).
require_once get_template_directory() . '/includes/init.php';

// Load theme files (do not remove).
require_once VAGABOND_INC_DIR . '/theme-setup.php';
require_once VAGABOND_INC_DIR . '/white-label.php';
require_once VAGABOND_INC_DIR . '/helper-functions.php';
require_once VAGABOND_INC_DIR . '/template-tags.php';
require_once VAGABOND_INC_DIR . '/layouts.php';
require_once VAGABOND_INC_DIR . '/widget-areas.php';
require_once VAGABOND_INC_DIR . '/scripts-and-styles.php';
require_once VAGABOND_INC_DIR . '/integrations.php';
require_once VAGABOND_INC_DIR . '/customizer/customizer.php';

// Load theme admin files when necessary (do not remove).
if ( is_admin() ) {
	require_once VAGABOND_INC_DIR . '/admin-functions.php';
}
