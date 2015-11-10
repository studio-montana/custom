<?php
/**
 * FONTAWESOME Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('FONTAWESOME_TOOL_NAME', 'fontawesome');

/**
 * Enqueue styles for the front end.
 */
function tool_fontawesome_custom_front_enqueue_styles_tools($dependencies) {

	$css_fontawesome = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-fontawesome.css', array(CUSTOM_TOOLS_FOLDER.FONTAWESOME_TOOL_NAME.'/'));
	if (!empty($css_fontawesome))
		wp_enqueue_style('tool-fontawesome-css', $css_fontawesome, $dependencies, '4.4.0');
}
add_action('custom_front_enqueue_styles_tools', 'tool_fontawesome_custom_front_enqueue_styles_tools');

/**
 * Enqueue styles for the back end.
 */
function tool_fontawesome_custom_admin_enqueue_styles_tools($dependencies) {

	$css_fontawesome = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-fontawesome.css', array(CUSTOM_TOOLS_FOLDER.FONTAWESOME_TOOL_NAME.'/'));
	if (!empty($css_fontawesome))
		wp_enqueue_style('tool-fontawesome-css', $css_fontawesome, $dependencies, '4.4.0');
}
add_action('custom_admin_enqueue_styles_tools', 'tool_fontawesome_custom_admin_enqueue_styles_tools');

/**
 * Enqueue styles for the login end.
 */
function tool_fontawesome_custom_login_enqueue_styles_tools($dependencies) {

	$css_fontawesome = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-fontawesome.css', array(CUSTOM_TOOLS_FOLDER.FONTAWESOME_TOOL_NAME.'/'));
	if (!empty($css_fontawesome))
		wp_enqueue_style('tool-fontawesome-css', $css_fontawesome, $dependencies, '4.4.0');
}
add_action('custom_login_enqueue_styles_tools', 'tool_fontawesome_custom_login_enqueue_styles_tools');