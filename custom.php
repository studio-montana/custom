<?php

/**
 * Plugin Name: Custom
 * Plugin URI: https://github.com/studio-montana/custom
 * Description: Multitool experience on WP
 * Version: 2.0.1.2
 * Author: Studio Montana
 * Author URI: http://www.studio-montana.com/
 * License: GPL2
 * Text Domain: custom
 */

/**
 * Copyright 2016 Sébastien Chandonay (email : please contact me from my website)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

defined('ABSPATH') or die("Go Away!");

/**
 * Custom PLUGIN CONSTANTS
*/
define('CUSTOM_PLUGIN_NAME', "custom");
define('CUSTOM_PLUGIN_FILE', __FILE__);
define('CUSTOM_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CUSTOM_PLUGIN_URI', plugin_dir_url(__FILE__));
define('CUSTOM_PLUGIN_SLUG_INSTALLER', 'custom');

define('CUSTOM_PLUGIN_TEXT_DOMAIN', 'custom');
define('CUSTOM_PLUGIN_CORE_FOLDER', 'core/');
define('CUSTOM_PLUGIN_COMMONS_FOLDER', 'core/commons/');
define('CUSTOM_PLUGIN_CONFIG_FOLDER', 'core/commons/config/');
define('CUSTOM_PLUGIN_INSTALLER_FOLDER', 'core/commons/installer/');
define('CUSTOM_PLUGIN_TEMPLATES_FOLDER', 'core/templates/');
define('CUSTOM_PLUGIN_TEMPLATES_DASHBOARD_FOLDER', 'core/templates/dashboard/');
define('CUSTOM_PLUGIN_TOOLS_FOLDER', 'core/tools/');
define('CUSTOM_PLUGIN_CSS_FOLDER', 'css/');
define('CUSTOM_PLUGIN_JS_FOLDER', 'js/');
define('CUSTOM_PLUGIN_FONTS_FOLDER', 'fonts/');

define('CUSTOM_DOCUMENTATION_URL', 'http://lab.studio-montana.com/documentation/custom/');

/**
 * Custom PLUGIN DEFINITION
*/
if(!class_exists('Custom')){

	class Custom{

		/**
		 * Construct the plugin object
		 */
		public function __construct(){

			load_plugin_textdomain('custom', false, dirname( plugin_basename( __FILE__ ) ).'/lang/' );
				
			do_action("custom_before_requires");
				
			/** utils */
			require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_COMMONS_FOLDER.'session.php');
			require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_COMMONS_FOLDER.'comparators.php');
			require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_COMMONS_FOLDER.'utils.php');
				
			/** installer */
			require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_INSTALLER_FOLDER.'installer.class.php');

			/** config */
			require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_CONFIG_FOLDER.'config.php');
				
			/** templates */
			require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_COMMONS_FOLDER.'templates.php');
				
			/** custom fields */
			require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_COMMONS_FOLDER.'custom-fields.php');
				
			/** postpicker */
			require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_COMMONS_FOLDER.'postpicker/postpicker.php');
				
			/** tools */
			require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_COMMONS_FOLDER.'tools.php');
				
			do_action("custom_after_requires");
				
			add_action("init", array('Custom', 'init'));

		}

		/**
		 * Activate the plugin
		 */
		public static function activate(){
			require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_COMMONS_FOLDER.'plugin.activate.php');
		}

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate(){
			require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_COMMONS_FOLDER.'plugin.deactivate.php');
		}
		
		public static function get_info($name){
			$plugin_data = get_plugin_data(__FILE__);
			return $plugin_data[$name];
		}

		/**
		 * Load plugin textdomain.
		 */
		public static function init() {
				
			do_action("custom_before_init");
				
			require_once (CUSTOM_PLUGIN_PATH.'core/init.php');
				
			do_action("custom_after_init");
		}

	}


}

if(class_exists('Custom')){

	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('Custom', 'activate'));
	register_deactivation_hook(__FILE__, array('Custom', 'deactivate'));

	// instantiate the plugin class
	$custom_plugin = new Custom();
}