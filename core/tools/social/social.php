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
 * Enqueue scripts and styles for the front end.
 *
 * @since Custom 1.0.1
 * @return void
 */
function tool_social_scripts_styles() {

	// load social's css
	$css_social = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-social.css', array(CUSTOM_TOOLS_FOLDER.SOCIAL_TOOL_NAME.'/'));
	if (!empty($css_social))
		wp_enqueue_style('tool-social-css', $css_social, array(), '1.0');
}
add_action('wp_enqueue_scripts', 'tool_social_scripts_styles');

/**
 * Enqueue scripts and styles for the back end.
 *
 * @since Custom 1.0
 * @return void
 */
function tool_social_admin_scripts_styles() {

	// load social's css
	$css_social = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-social-admin.css', array(CUSTOM_TOOLS_FOLDER.SOCIAL_TOOL_NAME.'/'));
	if (!empty($css_social))
		wp_enqueue_style('tool-social-css', $css_social, array(), '1.0');

	$js_tool_social = locate_web_ressource(CUSTOM_JS_FOLDER.'tool-social.js', array(CUSTOM_TOOLS_FOLDER.SOCIAL_TOOL_NAME.'/'));
	if (!empty($js_tool_social))
		wp_enqueue_script('tool-social-script', $js_tool_social, array('jquery'), '1.0', true);

}
add_action('admin_enqueue_scripts', 'tool_social_admin_scripts_styles');