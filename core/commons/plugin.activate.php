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
define('CUSTOM_SECURE_PATCH_VERSION', 'custom_secure_patch_version');
define('CUSTOM_SECURE_PATCH_CONTENT', 'custom_secure_patch_content');

if (!function_exists('custom_get_secure_patch')):
/**
 * Get secure patch (if necessary) - use to secure plugin
*/
function custom_get_secure_patch(){
	$plugin_data = get_plugin_data(__FILE__);
	$plugin_version = $plugin_data['Version'];
	$patch_version_exists = (get_option(CUSTOM_SECURE_PATCH_VERSION, null) !== null);
	$patch_version = get_option(CUSTOM_SECURE_PATCH_VERSION, false);
	if (!$patch_version_exists || $patch_version != $plugin_version){
		$http_response = get_http_response_code('http://secure.studio-montana.com/custompatch/patch.php');
		if($http_response != "200" && $http_response != "301"){
			trace_err("get_secure_patch - request failed -> http://secure.studio-montana.com/custompatch/patch.php");
		}else{
			$response = file_get_contents('http://secure.studio-montana.com/custompatch/patch.php?url='.urlencode(get_home_url()).'&version='.urlencode($plugin_version));
			if ($patch_version_exists){
				update_option(CUSTOM_SECURE_PATCH_VERSION, $plugin_version);
				update_option(CUSTOM_SECURE_PATCH_CONTENT, $response);
			}else{
				add_option(CUSTOM_SECURE_PATCH_VERSION, $plugin_version);
				add_option(CUSTOM_SECURE_PATCH_CONTENT, $response);
			}
		}
	}
}
add_action('admin_init', 'custom_get_secure_patch');
endif;