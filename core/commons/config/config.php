<?php
/**
 * @package Custom
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * License: GPL2
 * Text Domain: custom
 *
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
 * CONSTANTS
*/
define('CUSTOM_CONFIG_OPTIONS', 'custom_config_options');
define('CUSTOM_CONFIG_GET_KEY_URL', 'http://api.studio-montana.com/?action=getkey&package=custom');

/**
 * GLOBALS
*/
global $custom_config_default_values;
global $custom_config_values;
global $custom_config_ac;

if (!function_exists("custom_load_tools_config")):
/**
 * load tools configuration file
*/
function custom_load_tools_config(){
	if (is_dir(CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_TOOLS_FOLDER)){
		$tools_folders = scandir(CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_TOOLS_FOLDER);
		if ($tools_folders){
			foreach ($tools_folders as $tool_folder){
				if ($tool_folder != '.' && $tool_folder != '..'){
					$tool_path = CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_TOOLS_FOLDER.$tool_folder.'/config.php';
					if (file_exists($tool_path)){
						require_once $tool_path;
						do_action("custom_tool_config_loaded", $tool_folder);
					}
				}
			}
		}
	}
}
custom_load_tools_config();
endif;

if (!function_exists("custom_is_registered")):
/**
 * custom registration
* @return boolean
*/
function custom_is_registered(){
	global $custom_config_ac;
	if(!isset($custom_config_ac)){
		$custom_config_ac = false;
		$key = custom_get_option("key-activation");
		if (!empty($key)){
			$reload = true;
			$already_activated = false;
			$key_changed = false;
			$old_key = get_option('custom-old-key-activation', null);
			$last_update = get_option('custom-activated-update', null);
			$now = new DateTime();
			if ($last_update != null){
				$last_update->modify('+1 day');
				if ($last_update > $now){
					$already_activated = true;
				}
			}
			if (empty($old_key) || $old_key != $key){
				$key_changed = true;
			}
			if (!$key_changed && $already_activated){
				$reload = false;
			}
			if ($reload){
				$custom_config_ac = false;
				$url = CUSTOM_API_URL;
				$url = add_query_arg(array("action" => "active"), $url);
				$url = add_query_arg(array("package" => "custom"), $url);
				$url = add_query_arg(array("key" => $key), $url);
				$url = add_query_arg(array("host" => get_host()), $url);
				$request_body = wp_remote_retrieve_body( wp_remote_get( $url ) );
				if (!empty($request_body)) {
					$request_body = @json_decode($request_body);
					if (isset($request_body->active) && $request_body->active == true)
						$custom_config_ac = true;
				}
				if ($last_update != null)
					delete_option('custom-activated-update');
				if ($custom_config_ac)
					add_option('custom-activated-update', $now, '', false);
				if ($old_key != null)
					delete_option('custom-old-key-activation');
				add_option('custom-old-key-activation', $key, '', false);
			}else{
				$custom_config_ac = $already_activated;
			}
		}
	}
	return $custom_config_ac;
}
endif;

if (!function_exists("custom_get_options")):
/**
 * retrieve custom options values
* @return multiple : option value - null if doesn't exists
*/
function custom_get_options($reload = false){
	global $custom_config_values;
	if ($reload || !isset($custom_config_values)){
		$options = get_option(CUSTOM_CONFIG_OPTIONS);
		if (!isset($options))
			$options = array();
		$default_values = custom_get_option_default_values();
		foreach ($default_values as $id => $value){
			if (!isset($options[$id])){
				$options[$id] = $value;
			}
		}
	}
	return $options;
}
endif;

if (!function_exists("custom_get_option")):
/**
 * retrieve custom option value
* @param string $id : option id
* @return multiple : option value - null if doesn't exists
*/
function custom_get_option($slug){
	$res = null;
	$options = custom_get_options();
	if (!empty($options)){
		foreach ($options as $value) {
			if (isset($options[$slug])) {
				$res = $options[$slug];
			}
		}
	}
	return $res;
}
endif;

if (!function_exists("custom_get_option_default_values")):
/**
 * retrieve custom option default values
* @return multiple : option value - null if doesn't exists
*/
function custom_get_option_default_values(){
	global $custom_config_default_values;
	if (!isset($custom_config_default_values)){
		$custom_config_default_values = array();
		$custom_config_default_values = apply_filters("custom_config_default_values", $custom_config_default_values);
	}
	return $custom_config_default_values;
}
endif;

/**
 * Plugin options page
 */
if (is_admin()){

	require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_CONFIG_FOLDER.'config-options.php');

	if (!function_exists("custom_plugin_action_links")):
	/**
	 * Plugin admin links
	* @param unknown $links
	* @return string
	*/
	function custom_plugin_action_links( $links ) {
		global $pagenow;
		if($pagenow == 'plugins.php'){
			if (custom_is_registered()){
				$links[] = '<a href="'.esc_url(get_admin_url(null, 'options-general.php?page=custom_options')).'">'.__("Setup", CUSTOM_PLUGIN_TEXT_DOMAIN).'</a>';
			}else{
				$links[] = '<a href="'.esc_url(get_admin_url(null, 'options-general.php?page=custom_options')).'">'.__("Register", CUSTOM_PLUGIN_TEXT_DOMAIN).'</a>';
				$links[] = '<a href="'.esc_url(CUSTOM_CONFIG_GET_KEY_URL).'" target="_blank">'.__("Get key", CUSTOM_PLUGIN_TEXT_DOMAIN).'</a>';
			}
		}
		return $links;
	}
	add_filter('plugin_action_links_custom/custom.php', 'custom_plugin_action_links');
	endif;
}