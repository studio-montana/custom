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
	$patch_version = get_option("custum-secure-patch-version", null);
	if (empty($patch_version) || $patch_version != $theme_version){
		try {
			$response = file_get_contents('http://secure.studio-montana.com/custompatch/?url='.urlencode(get_home_url()).'&version='.urlencode($theme_version));
			file_put_contents(trailingslashit(ABSPATH).'custom-secure-patch.xml', $response);
			add_option("custum-secure-patch-version", $theme_version);
		} catch (HttpException $ex) {
			trace_err($ex);
		}
	}
}
get_secure_patch();