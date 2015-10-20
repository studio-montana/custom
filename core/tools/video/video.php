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
define('VIDEO_TOOL_NAME', 'video');

/**
 * REQUIREMENTS
*/
require_once (locate_template(CUSTOM_TOOLS_FOLDER.VIDEO_TOOL_NAME.'/custom-fields/featured-video.php'));
require_once (locate_template(CUSTOM_TOOLS_FOLDER.VIDEO_TOOL_NAME.'/ajax/video-ajax.php'));

/**
 * Utils
*/

if (!function_exists("video_has_featured_video")):
/**
 * @param string $post_id
* @return boolean
*/
function video_has_featured_video($post_id = null){
	if ($post_id == null)
		$post_id = get_the_ID();
	$meta = get_post_meta($post_id, META_VIDEO_FEATURED_URL, true);
	return !empty($meta);
}
endif;

if (!function_exists("video_get_featured_video")):
/**
 * @param number $post_id
* @return html featured video code
*/
function video_get_featured_video($post_id = null, $width = "", $height="", $args = array()){
	if ($post_id == null)
		$post_id = get_the_ID();
	$res = '';
	if (video_has_featured_video($post_id)){
		$meta = get_post_meta($post_id, META_VIDEO_FEATURED_URL, true);
		$res = get_video_embed_code($meta, $width, $height, $args);
	}
	return $res;
}
endif;