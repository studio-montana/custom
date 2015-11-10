<?php
/**
 * SHORTCODES Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('SHORTCODES_TOOL_NAME', 'shortcodes');

/**
 * REQUIREMENTS
 */
require_once (locate_template(CUSTOM_TOOLS_FOLDER.SHORTCODES_TOOL_NAME.'/exergue/exergue.php'));
require_once (locate_template(CUSTOM_TOOLS_FOLDER.SHORTCODES_TOOL_NAME.'/heightspace/heightspace.php'));
require_once (locate_template(CUSTOM_TOOLS_FOLDER.SHORTCODES_TOOL_NAME.'/icons/icons.php'));

/**
 * Enqueue styles for the front end.
 */
function tool_shortcodes_custom_front_enqueue_styles_tools($dependencies) {

	$css_shortcodes = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-shortcodes.css', array(CUSTOM_TOOLS_FOLDER.SHORTCODES_TOOL_NAME.'/'));
	if (!empty($css_shortcodes))
		wp_enqueue_style('tool-shortcodes-css', $css_shortcodes, $dependencies, '1.0');
}
add_action('custom_front_enqueue_styles_tools', 'tool_shortcodes_custom_front_enqueue_styles_tools');

/**
 * Enqueue styles for the back end.
 */
function tool_shortcodes_custom_admin_enqueue_styles_tools($dependencies) {

	$css_shortcodes = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-shortcodes-admin.css', array(CUSTOM_TOOLS_FOLDER.SHORTCODES_TOOL_NAME.'/'));
	if (!empty($css_shortcodes))
		wp_enqueue_style('tool-shortcodes-css', $css_shortcodes, $dependencies, '1.0');
}
add_action('custom_admin_enqueue_styles_tools', 'tool_shortcodes_custom_admin_enqueue_styles_tools');

/**
 * Enqueue scripts for the back end.
 */
function tool_shortcodes_custom_admin_enqueue_scripts_tools($dependencies) {

	$js_tool_shortcodes = locate_web_ressource(CUSTOM_JS_FOLDER.'tool-shortcodes.js', array(CUSTOM_TOOLS_FOLDER.SHORTCODES_TOOL_NAME.'/'));
	if (!empty($js_tool_shortcodes))
		wp_enqueue_script('tool-shortcodes-script', $js_tool_shortcodes, $dependencies, '1.0', true);
}
add_action('custom_admin_enqueue_scripts_tools', 'tool_shortcodes_custom_admin_enqueue_scripts_tools');