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
define('META_PAGINATION_DISPLAY_PAGINATION', 'meta_pagination_display_pagination');

if (!function_exists("pagination_add_inner_meta_boxes")):
/**
 * This action is called by Custom when metabox is displayed on post-type
* @param unknown $post
*/
function pagination_add_inner_meta_boxes($post){
	if (in_array(get_post_type($post), get_displayed_post_types())){
		include(locate_template('/'.CUSTOM_TOOLS_FOLDER.PAGINATION_TOOL_NAME.'/custom-fields/templates/display-pagination.php'));
	}
}
add_action("customfields_add_inner_meta_boxes", "pagination_add_inner_meta_boxes");
endif;

if (!function_exists("pagination_save_post")):
/**
 * This action is called by Custom when post-type is saved
* @param int $post_id
*/
function pagination_save_post($post_id){
	if (in_array(get_post_type($post_id), get_displayed_post_types())){
		// META_PAGINATION_DISPLAY_PAGINATION
		if (!empty($_POST[META_PAGINATION_DISPLAY_PAGINATION])){
			update_post_meta($post_id, META_PAGINATION_DISPLAY_PAGINATION, sanitize_text_field($_POST[META_PAGINATION_DISPLAY_PAGINATION]));
		}else{
			update_post_meta($post_id, META_PAGINATION_DISPLAY_PAGINATION, "off");
		}
	}
}
add_action("customfields_save_post", "pagination_save_post");
endif;