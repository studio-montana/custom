<?php
/**
 * BACKGROUND IMAGE Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('BACKGROUNDIMAGE_TOOL_NAME', 'backgroundimage');

/**
 * REQUIREMENTS
 */
require_once (locate_template(CUSTOM_TOOLS_FOLDER.BACKGROUNDIMAGE_TOOL_NAME.'/custom-fields/backgroundimage.php'));
require_once (locate_template(CUSTOM_TOOLS_FOLDER.BACKGROUNDIMAGE_TOOL_NAME.'/inc/customizer.php'));