<?php

/**
 * CONSTANTS
 */
define('META_DISPLAY_HIDE_TITLE', 'meta_display_hide_title');
define('META_DISPLAY_CUSTOMTITLE', 'meta_display_customtitle');
define('META_DISPLAY_SUBTITLE', 'meta_display_subtitle');
define('META_DISPLAY_HIDE_THUMBNAIL', 'meta_display_hide_content');
define('META_DISPLAY_BADGED', 'meta_display_badged');

if (!function_exists("display_add_inner_meta_boxes")):
/**
 * This action is called by Custom when metabox is display on post-type
* @param unknown $post
*/
function display_add_inner_meta_boxes($post){
	$available_posttypes = get_displayed_post_types();
	$available_posttypes = apply_filters("tool_display_available_posttypes", $available_posttypes);
	if (in_array(get_post_type($post), $available_posttypes)){
		include(locate_template('/'.CUSTOM_TOOLS_FOLDER.DISPLAY_TOOL_NAME.'/custom-fields/templates/display.php'));
	}
}
add_action("customfields_add_inner_meta_boxes", "display_add_inner_meta_boxes");
endif;

if (!function_exists("display_save_post")):
/**
 * This action is called by Custom when post-type is saved
* @param int $post_id
*/
function display_save_post($post_id){
	$available_posttypes = get_displayed_post_types();
	$available_posttypes = apply_filters("tool_display_available_posttypes", $available_posttypes);
	if (in_array($_POST['post_type'], $available_posttypes)){
		// META_DISPLAY_HIDE_TITLE
		if (!empty($_POST[META_DISPLAY_HIDE_TITLE])){
			update_post_meta($post_id, META_DISPLAY_HIDE_TITLE, sanitize_text_field($_POST[META_DISPLAY_HIDE_TITLE]));
		}else{
			delete_post_meta($post_id, META_DISPLAY_HIDE_TITLE);
		}
		// META_DISPLAY_CUSTOMTITLE
		if (!empty($_POST[META_DISPLAY_CUSTOMTITLE])){
			update_post_meta($post_id, META_DISPLAY_CUSTOMTITLE, sanitize_text_field($_POST[META_DISPLAY_CUSTOMTITLE]));
		}else{
			delete_post_meta($post_id, META_DISPLAY_CUSTOMTITLE);
		}
		// META_DISPLAY_SUBTITLE
		if (!empty($_POST[META_DISPLAY_SUBTITLE])){
			update_post_meta($post_id, META_DISPLAY_SUBTITLE, sanitize_text_field($_POST[META_DISPLAY_SUBTITLE]));
		}else{
			delete_post_meta($post_id, META_DISPLAY_SUBTITLE);
		}
		// META_DISPLAY_HIDE_THUMBNAIL
		if (!empty($_POST[META_DISPLAY_HIDE_THUMBNAIL])){
			update_post_meta($post_id, META_DISPLAY_HIDE_THUMBNAIL, sanitize_text_field($_POST[META_DISPLAY_HIDE_THUMBNAIL]));
		}else{
			delete_post_meta($post_id, META_DISPLAY_HIDE_THUMBNAIL);
		}
		// META_DISPLAY_BADGED
		if (!empty($_POST[META_DISPLAY_BADGED])){
			update_post_meta($post_id, META_DISPLAY_BADGED, sanitize_text_field($_POST[META_DISPLAY_BADGED]));
		}else{
			delete_post_meta($post_id, META_DISPLAY_BADGED);
		}
	}
}
add_action("customfields_save_post", "display_save_post");
endif;