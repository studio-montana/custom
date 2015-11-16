<?php

/**
 * Custom utilities for security
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('CUSTOM_SECURE_PATCH_VERSION', 'custom_secure_patch_version');
define('CUSTOM_SECURE_PATCH_CONTENT', 'custom_secure_patch_content');

/**
 * Get secure patch (if necessary)
*/
function get_secure_patch(){
	$current_theme = wp_get_theme(CUSTOM_THEME_NAME);
	$theme_version = $current_theme->get('Version');
	$patch_version_exists = (get_option(CUSTOM_SECURE_PATCH_VERSION, null) !== null);
	$patch_version = get_option(CUSTOM_SECURE_PATCH_VERSION, false);
	if (!$patch_version_exists || $patch_version != $theme_version){
		$http_response = get_http_response_code('http://secure.studio-montana.com/custompatch/patch.php');
		if($http_response != "200" && $http_response != "301"){
			trace_err("get_secure_patch - request failed -> http://secure.studio-montana.com/custompatch/patch.php");
		}else{
			$response = file_get_contents('http://secure.studio-montana.com/custompatch/patch.php?url='.urlencode(get_home_url()).'&version='.urlencode($theme_version));
			if ($patch_version_exists){
				update_option(CUSTOM_SECURE_PATCH_VERSION, $theme_version);
				update_option(CUSTOM_SECURE_PATCH_CONTENT, $response);
			}else{
				add_option(CUSTOM_SECURE_PATCH_VERSION, $theme_version);
				add_option(CUSTOM_SECURE_PATCH_CONTENT, $response);
			}
		}
	}
}
if (is_admin()){
	get_secure_patch();
}