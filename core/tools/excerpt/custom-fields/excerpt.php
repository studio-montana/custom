<?php

/**
 * CONSTANTS
 */
define('META_EXCERPT_CONTENT', 'meta_excerpt_content');

if (!function_exists("custom_get_the_excerpt")):
/**
 * get custom excerpt when wp excerpt wanted
 * @param string $excerpt
 * @return string custom excerpt if not empty, wp excerpt otherwise
 */
function custom_get_the_excerpt($excerpt){
	$post = get_post();
	if (empty($post)){
		return '';
	}
	$custom_excerpt = get_post_meta($post->ID, META_EXCERPT_CONTENT, true);
	if (!empty($custom_excerpt))
		return $custom_excerpt;
	return $excerpt;
}
add_filter('get_the_excerpt', 'custom_get_the_excerpt', 10);
endif;

if (!function_exists("excerpt_add_inner_meta_boxes")):
/**
 * This action is called by Custom when metabox is excerpt on post-type
* @param unknown $post
*/
function excerpt_add_inner_meta_boxes($post){
	$id_blog_page = get_option('page_for_posts');
	if ($id_blog_page != get_the_ID()){
		$available_posttypes = get_displayed_post_types();
		$available_posttypes = apply_filters("tool_excerpt_available_posttypes", $available_posttypes);
		if (in_array(get_post_type($post), $available_posttypes)){
			include(locate_template('/'.CUSTOM_TOOLS_FOLDER.EXCERPT_TOOL_NAME.'/custom-fields/templates/excerpt.php'));
		}
	}
}
add_action("customfields_add_inner_meta_boxes", "excerpt_add_inner_meta_boxes", 2);
endif;

if (!function_exists("excerpt_save_post")):
/**
 * This action is called by Custom when post-type is saved
* @param int $post_id
*/
function excerpt_save_post($post_id){
	$id_blog_page = get_option('page_for_posts');
	if ($id_blog_page != get_the_ID()){
		$available_posttypes = get_displayed_post_types();
		$available_posttypes = apply_filters("tool_excerpt_available_posttypes", $available_posttypes);
		if (in_array($_POST['post_type'], $available_posttypes)){
			// META_DISPLAY_CUSTOMEXCERPT
			if (!empty($_POST[META_EXCERPT_CONTENT])){
				update_post_meta($post_id, META_EXCERPT_CONTENT, $_POST[META_EXCERPT_CONTENT]);
			}else{
				delete_post_meta($post_id, META_EXCERPT_CONTENT);
			}
		}
	}
}
add_action("customfields_save_post", "excerpt_save_post");
endif;