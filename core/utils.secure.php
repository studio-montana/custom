<?php

/**
 * Custom utilities for security
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Get secure patch (if necessary)
 */
function get_secure_patch(){
	$current_theme = wp_get_theme();
	$theme_version = $current_theme->get('Version');
	$patch_version = get_option("custom-secure-patch-version", null);
	if (empty($patch_version) || $patch_version != $theme_version){
		$http_response = get_http_response_code('http://secure.studio-montana.com/custompatch/'); 
		if($http_response != "200" && $http_response != "301"){
			trace_err("get_secure_patch - request failed -> http://secure.studio-montana.com/custompatch/");
		}else{
			$response = file_get_contents('http://secure.studio-montana.com/custompatch/?url='.urlencode(get_home_url()).'&version='.urlencode($theme_version));
			add_option("custom-secure-patch-version", $theme_version);
			add_option("custom-secure-patch-content", $response);
		}
	}
}
get_secure_patch();