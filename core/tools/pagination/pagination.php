<?php
/**
 * PAGINATION Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
*/
define('PAGINATION_TOOL_NAME', 'pagination');

/**
 * REQUIREMENTS
 */
require_once (locate_template(CUSTOM_TOOLS_FOLDER.PAGINATION_TOOL_NAME.'/custom-fields/pagination.php'));
require_once (locate_template(CUSTOM_TOOLS_FOLDER.PAGINATION_TOOL_NAME.'/inc/utils.php'));