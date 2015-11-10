<?php
/**
 * SOCIAL Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('SOCIAL_TOOL_NAME', 'social');

/**
 * WIDGETS
 */
require_once (locate_template('/'.CUSTOM_TOOLS_FOLDER.SOCIAL_TOOL_NAME.'/widgets/tool-social-widget.class.php'));

/**
 * Enqueue styles for the front end.
 */
function tool_social_custom_front_enqueue_styles_tools($dependencies) {

	$css_social = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-social.css', array(CUSTOM_TOOLS_FOLDER.SOCIAL_TOOL_NAME.'/'));
	if (!empty($css_social))
		wp_enqueue_style('tool-social-css', $css_social, $dependencies, '1.0');
}
add_action('custom_front_enqueue_styles_tools', 'tool_social_custom_front_enqueue_styles_tools');

/**
 * Enqueue styles for the back end.
 */
function tool_social_custom_admin_enqueue_styles_tools($dependencies) {

	$css_social = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-social-admin.css', array(CUSTOM_TOOLS_FOLDER.SOCIAL_TOOL_NAME.'/'));
	if (!empty($css_social))
		wp_enqueue_style('tool-social-css', $css_social, $dependencies, '1.0');
}
add_action('custom_admin_enqueue_styles_tools', 'tool_social_custom_admin_enqueue_styles_tools');

/**
 * Enqueue scripts for the back end.
 */
function tool_social_custom_admin_enqueue_scripts_tools($dependencies) {

	$js_tool_social = locate_web_ressource(CUSTOM_JS_FOLDER.'tool-social.js', array(CUSTOM_TOOLS_FOLDER.SOCIAL_TOOL_NAME.'/'));
	if (!empty($js_tool_social))
		wp_enqueue_script('tool-social-script', $js_tool_social, $dependencies, '1.0', true);
}
add_action('custom_admin_enqueue_scripts_tools', 'tool_social_custom_admin_enqueue_scripts_tools');