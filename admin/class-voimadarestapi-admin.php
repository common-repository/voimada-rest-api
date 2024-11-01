<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.voimada.com
 * @since      1.0.0
 *
 * @package    VoimadaRestAPI
 * @subpackage VoimadaRestAPI/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    VoimadaRestAPI
 * @subpackage VoimadaRestAPI/admin
 * @author     Voimada <team@voimada.com>
 */
class VoimadaRestAPI_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action('admin_menu', array($this, 'add_admin_menu'));

        add_action('after_setup_theme', array($this, 'add_voimada_cat'));
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in VoimadaRestAPI_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The VoimadaRestAPI_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/voimadarestapi-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in VoimadaRestAPI_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The VoimadaRestAPI_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/voimadarestapi-admin.js', array('jquery'), $this->version, false);
	}

	public function add_admin_menu()
	{

		add_menu_page('PostRemote Setting', 'PostRemote Setting', 'manage_options', plugin_dir_url(__FILE__) . '/voimadarestapi-admin-display.php', array($this, 'admin_page_view'), 'dashicons-tickets', 6);
	}

	public function admin_page_view()
	{
		require_once(plugin_dir_path(__FILE__) . 'partials/voimadarestapi-admin-display.php');
	}

    public function add_voimada_cat(){
        wp_insert_term(
		'Voimada',
		'category',
		array(
		  'description'	=> 'This category is created by Voimada plugin and will be used on every post publish via Voimada app.',
		  'slug' 		=> 'voimada-category'
		)
	);
    }
}
