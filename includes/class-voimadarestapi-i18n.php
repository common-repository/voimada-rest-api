<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.voimada.com
 * @since      1.0.0
 *
 * @package    VoimadaRestAPI
 * @subpackage VoimadaRestAPI/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    VoimadaRestAPI
 * @subpackage VoimadaRestAPI/includes
 * @author     Voimada <team@voimada.com>
 */
class VoimadaRestAPI_i18n
{


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain(
			'voimadarestapi',
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
		);
	}
}
