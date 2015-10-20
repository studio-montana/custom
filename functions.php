<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */

include('core/functions.php');

/**
 * you can override anything after this comment or listen custom hook actions/filters
*/

if (!function_exists('custom_after_setup_theme_action')):
/**
 * called after custom_after_setup_theme core function
 */
function custom_after_setup_theme_action(){
	// custom image sizes
	// set_post_thumbnail_size(1200, 250, true);
	// add_image_size('small', 150, 90, true);
	// add_image_size('medium', 320, 150, true);
	// add_image_size('large', 800, 350, true);
}
add_action("custom_after_setup_theme", "custom_after_setup_theme_action");
endif;