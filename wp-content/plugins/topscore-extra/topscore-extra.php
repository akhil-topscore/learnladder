<?php

/**
 * Plugin Name:       Topscore Extra
 * Plugin URI:        https://topscoresoftwares.com
 * Description:       Add extra features to TopscoreWP theme.
 * Version:           2.0.0
 * Author:            Topscore Deepu
 * Author URI:        https://topscoresoftwares.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       topscore-extra
 * 
 * Requires Plugins: elementor
 * Elementor tested up to: 3.21.0
 * Topscore Extra tested up to: 3.21.0
 * 
 * @link              https://topscoresoftwares.com
 * @since             1.0.0
 * @package           Topscore_Extra
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

define('TOPSCORE_EXTRA_PLUGIN_URI', plugin_dir_url('topscore-extra'));

function topscore_extra()
{
	// Load plugin file
	require_once(__DIR__ . '/includes/plugin.php');

	// Run the plugin
	\Topscore_Extra\Plugin::instance();
}
add_action('plugins_loaded', 'topscore_extra');
