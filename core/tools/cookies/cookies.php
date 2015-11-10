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
 * Enqueue styles for the front end.
 */
function tool_cookies_custom_front_enqueue_styles_tools($dependencies) {

	$css_cookies = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-cookies.css', array(CUSTOM_TOOLS_FOLDER.COOKIES_TOOL_NAME.'/'));
	if (!empty($css_cookies))
		wp_enqueue_style('tool-cookies-css', $css_cookies, $dependencies, '1.0');
}
add_action('custom_front_enqueue_styles_tools', 'tool_cookies_custom_front_enqueue_styles_tools');

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