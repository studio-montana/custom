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