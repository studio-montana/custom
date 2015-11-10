<?php
/**
 * WALL Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('WALL_TOOL_NAME', 'wall');

/**
 * REQUIREMENTS
*/
require_once (locate_template(CUSTOM_TOOLS_FOLDER.WALL_TOOL_NAME.'/ajax/wall-ajax.php'));
require_once (locate_template(CUSTOM_TOOLS_FOLDER.WALL_TOOL_NAME.'/custom-fields/wall.php'));

/**
 * Enqueue styles for the front end.
 */
function tool_wall_custom_front_enqueue_styles_tools($dependencies) {

	$css_wall = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-wall.css', array(CUSTOM_TOOLS_FOLDER.WALL_TOOL_NAME.'/'));
	if (!empty($css_wall))
		wp_enqueue_style('tool-wall-css', $css_wall, $dependencies, '1.0');
}
add_action('custom_front_enqueue_styles_tools', 'tool_wall_custom_front_enqueue_styles_tools');

/**
 * Enqueue styles for the back end.
 */
function tool_wall_custom_admin_enqueue_styles_tools($dependencies) {

	$css_wall = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-wall-admin.css', array(CUSTOM_TOOLS_FOLDER.WALL_TOOL_NAME.'/'));
	if (!empty($css_wall))
		wp_enqueue_style('tool-wall-css', $css_wall, $dependencies, '1.0');
}
add_action('custom_admin_enqueue_styles_tools', 'tool_wall_custom_admin_enqueue_styles_tools');

/**
 * called after custom_setup_theme core function
*/
function tool_wall_setup_theme_action(){

	// wall image sizes
	add_image_size('tool-wall-thumb', 500);
	add_image_size('tool-wall-slider-nav-thumb', 150, 150, true);

	// can be override
	do_action('after_tool_wall_setup_theme_action');

}
add_action("custom_after_setup_theme", "tool_wall_setup_theme_action");
