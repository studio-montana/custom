<?php
/**
 * PRIVATE Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('PRIVATE_TOOL_NAME', 'private');

/**
 * REQUIREMENTS
 */
require_once (locate_template(CUSTOM_TOOLS_FOLDER.PRIVATE_TOOL_NAME.'/inc/customizer.php'));

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Custom 1.0
 * @return void
 */
function tool_private_scripts_styles() {

	// load private's css
	$css_private = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-private.css', array(CUSTOM_TOOLS_FOLDER.PRIVATE_TOOL_NAME.'/'));
	if (!empty($css_private))
		wp_enqueue_style('tool-private-css', $css_private, array(), '1.0');
}
add_action('wp_enqueue_scripts', 'tool_private_scripts_styles');