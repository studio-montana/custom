<?php
/**
 * SEO Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
*/
define('SEO_TOOL_NAME', 'seo');

/**
 * REQUIREMENTS
 */
require_once (locate_template(CUSTOM_TOOLS_FOLDER.SEO_TOOL_NAME.'/custom-fields/seo.php'));
require_once (locate_template(CUSTOM_TOOLS_FOLDER.SEO_TOOL_NAME.'/inc/customizer.php'));
require_once (locate_template(CUSTOM_TOOLS_FOLDER.SEO_TOOL_NAME.'/xmlsitemap/xmlsitemap.php'));

/**
 * called after custom_setup_theme core function
*/
function tool_seo_setup_theme_action(){

	// seo image sizes
	add_image_size('tool-seo-thumb', 600);

	// can be override
	do_action('after_tool_seo_setup_theme_action');

}
add_action("custom_after_setup_theme", "tool_seo_setup_theme_action");