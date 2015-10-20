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
 * Enqueue scripts and styles for the front end.
 *
 * @since Custom 1.0
 * @return void
*/
function tool_wall_scripts_styles() {
	$css_wall = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-wall.css', array(CUSTOM_TOOLS_FOLDER.WALL_TOOL_NAME.'/'));
	if (!empty($css_wall))
		wp_enqueue_style('tool-wall-css', $css_wall, array(), '1.0');
}
add_action('wp_enqueue_scripts', 'tool_wall_scripts_styles');

/**
 * Enqueue scripts and styles for the back end.
 *
 * @since Custom 1.0
 * @return void
*/
function tool_wall_admin_scripts_styles() {
	$css_wall = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-wall-admin.css', array(CUSTOM_TOOLS_FOLDER.WALL_TOOL_NAME.'/'));
	if (!empty($css_wall))
		wp_enqueue_style('tool-wall-admin-css', $css_wall, array(), '1.0');
}
add_action('admin_enqueue_scripts', 'tool_wall_admin_scripts_styles');

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
