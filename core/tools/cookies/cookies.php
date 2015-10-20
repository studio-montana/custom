<?php
/**
 * COOKIES Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('COOKIES_TOOL_NAME', 'cookies');

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Custom 1.0
 * @return void
 */
function tool_cookies_scripts_styles() {

	// load cookies's css
	$css_cookies = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-cookies.css', array(CUSTOM_TOOLS_FOLDER.COOKIES_TOOL_NAME.'/'));
	if (!empty($css_cookies))
		wp_enqueue_style('tool-cookies-css', $css_cookies, array(), '1.0');
}
add_action('wp_enqueue_scripts', 'tool_cookies_scripts_styles');

/**
 * WP_Footer hook
 *
 * @since Custom 1.0
 * @return void
 */
function cookies_wp_footer() {
	$cookies_template = locate_ressource("tool-cookies-template-legislation.php", array(CUSTOM_TOOLS_FOLDER.COOKIES_TOOL_NAME.'/templates/'));
	if (!empty($cookies_template))
		include($cookies_template);
}
add_action('wp_footer', 'cookies_wp_footer');