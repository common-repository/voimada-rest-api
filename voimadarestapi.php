<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.voimada.com
 * @since             1.0.0
 * @package           PostRemote
 *
 * @wordpress-plugin
 * Plugin Name:       PostRemote
 * Plugin URI:        
 * Description:       Artificial intelligence writing the best content and also makes publishing easier.  Voimada allows you to schedule content and use generative speech to text to automatically create your content.
 * Version:           1.0.0
 * Author:            Voimada <team@voimada.com>
 * Author URI:        https://www.voimada.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       voimadarestapi
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('VOIMADARESTAPI_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-voimadarestapi-activator.php
 */
function VoimadaRestAPI_activate()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-voimadarestapi-activator.php';
	VoimadaRestAPI_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-voimadarestapi-deactivator.php
 */
function VoimadaRestAPI_deactivate()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-voimadarestapi-deactivator.php';
	VoimadaRestAPI_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'VoimadaRestAPI_activate');
register_deactivation_hook(__FILE__, 'VoimadaRestAPI_deactivate');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-voimadarestapi.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function VoimadaRestAPI_run()
{

	$plugin = new VoimadaRestAPI();
	$plugin->run();
}
VoimadaRestAPI_run();
