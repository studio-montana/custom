<?php
/**
 * @package Custom
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * License: GPL2
 * Text Domain: custom
 * 
 * Copyright 2016 Sébastien Chandonay (email : please contact me from my website)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
defined('ABSPATH') or die("Go Away!");

/**
 * REQUIREMENTS
*/
require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_TOOLS_FOLDER.VIDEO_TOOL_NAME.'/custom-fields/featured-video.php');
require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_TOOLS_FOLDER.VIDEO_TOOL_NAME.'/ajax/video-ajax.php');

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

if (!function_exists("tool_video_post_thumbnail_filter")):
/**
 * replace thumbnail by featured video if exists and if has auto-insert configuration
 * @param unknown $html
 * @param unknown $post_id
 * @param unknown $post_thumbnail_id
 * @param unknown $size
 * @param unknown $attr
 */
function tool_video_post_thumbnail_filter($html, $post_id, $post_thumbnail_id, $size, $attr){
	$auto_insert = custom_get_option("tool-video-auto-insert");
	if (!empty($auto_insert) && $auto_insert == 'on'){
		$default_width = custom_get_option("tool-video-default-width");
		$default_height = custom_get_option("tool-video-default-height");
		$video_embed = video_get_featured_video($post_id, $default_width, $default_height);
		if (!empty($video_embed))
			$html = '<div class="featured-video">'.$video_embed.'</div>';
	}
	$html = apply_filters("post_featured_video_html", $html, $post_id, $post_thumbnail_id, $size, $attr);
	return $html;
}
add_filter('post_thumbnail_html', "tool_video_post_thumbnail_filter", 1, 5);
endif;

