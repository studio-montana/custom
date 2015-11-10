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
 * Enqueue styles for the front end.
 */
function tool_private_custom_front_enqueue_styles_tools($dependencies) {

	$css_private = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-private.css', array(CUSTOM_TOOLS_FOLDER.PRIVATE_TOOL_NAME.'/'));
	if (!empty($css_private))
		wp_enqueue_style('tool-private-css', $css_private, $dependencies, '1.0');
}
add_action('custom_front_enqueue_styles_tools', 'tool_private_custom_front_enqueue_styles_tools');