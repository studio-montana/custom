<?php

/**
 * Propose des champs SEO sur les Posts Type du site
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 */

define('SEO_NONCE_SEO_ACTION', 'seo_action');
define('SEO_OPTIONS_NAME', 'seo-options');

define('SEO_CUSTOMFIELD_METATITLE', 'seo-meta-title');
define('SEO_CUSTOMFIELD_METADESCRIPTION', 'seo-meta-description');
define('SEO_CUSTOMFIELD_METAKEYWORDS', 'seo-meta-keywords');

if (!function_exists("seo_admin_init")):
/**
 * Hooks the WP admin_init action to add metaboxe seo on post-type
*
* @return void
*/
function seo_admin_init() {
	$seo_posttypes_available = get_displayed_post_types();
	foreach ($seo_posttypes_available as $post_type){
		add_meta_box('seo', __( 'SEO', CUSTOM_TEXT_DOMAIN), 'seo_add_inner_meta_boxes', $post_type);
	}
}
add_action('admin_init', 'seo_admin_init');
endif;

if (!function_exists("seo_add_inner_meta_boxes")):
/**
 * include seo template
* @param unknown $post
*/
function seo_add_inner_meta_boxes($post) {
	include(locate_template('/'.CUSTOM_TOOLS_FOLDER.SEO_TOOL_NAME.'/custom-fields/templates/seo.php'));
}
endif;

if (!function_exists("seo_save_post")):
/**
 * save SEO fields on post type
* @param unknown $post_id
*/
function seo_save_post($post_id){
	$seo_posttypes_available = get_displayed_post_types();

	// verify if this is an auto save routine.
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
	// verify if this post-type is available and editable.
	$is_post_available = false;
	$post_type = null;
	if (isset($_POST['post_type']) && !empty($_POST['post_type']) && in_array($_POST['post_type'], $seo_posttypes_available)){
		$post_type = $_POST['post_type'];
	}
	if (empty($post_type))
		return;
	if ($post_type == 'page') {
		if (!current_user_can('edit_page', $post_id))
			return;
	} else {
		if (!current_user_can('edit_post', $post_id ))
			return;
	}
	if (!isset($_POST[SEO_NONCE_SEO_ACTION]) || !wp_verify_nonce($_POST[SEO_NONCE_SEO_ACTION], SEO_NONCE_SEO_ACTION))
		return;

	// SEO_CUSTOMFIELD_METATITLE
	if (!empty($_POST[SEO_CUSTOMFIELD_METATITLE])){
		update_post_meta($post_id, SEO_CUSTOMFIELD_METATITLE, sanitize_text_field($_POST[SEO_CUSTOMFIELD_METATITLE]));
	}else{
		delete_post_meta($post_id, SEO_CUSTOMFIELD_METATITLE);
	}

	// SEO_CUSTOMFIELD_METADESCRIPTION
	if (!empty($_POST[SEO_CUSTOMFIELD_METADESCRIPTION])){
		update_post_meta($post_id, SEO_CUSTOMFIELD_METADESCRIPTION, sanitize_text_field($_POST[SEO_CUSTOMFIELD_METADESCRIPTION]));
	}else{
		delete_post_meta($post_id, SEO_CUSTOMFIELD_METADESCRIPTION);
	}

	// SEO_CUSTOMFIELD_METAKEYWORDS
	if (!empty($_POST[SEO_CUSTOMFIELD_METAKEYWORDS])){
		update_post_meta($post_id, SEO_CUSTOMFIELD_METAKEYWORDS, sanitize_text_field($_POST[SEO_CUSTOMFIELD_METAKEYWORDS]));
	}else{
		delete_post_meta($post_id, SEO_CUSTOMFIELD_METAKEYWORDS);
	}
}
add_action('save_post', 'seo_save_post');
endif;


if (!function_exists("seo_add_taxonomy_fields")):
/**
 * Hooks the WP taxonomyname_edit_fields action to add metaboxe seo on term
*
* @return void
*/
function seo_add_taxonomy_fields($term) {
	include(locate_template('/'.CUSTOM_TOOLS_FOLDER.SEO_TOOL_NAME.'/custom-fields/templates/seo-term.php'));
}
endif;

if (!function_exists("seo_save_taxonomy_fields")):
/**
 * save seo category extra fields
*/
function seo_save_taxonomy_fields($term_id) {
	// SEO_CUSTOMFIELD_METATITLE
	if (!empty($_POST[SEO_CUSTOMFIELD_METATITLE])){
		update_option("term_".$term_id."_".SEO_CUSTOMFIELD_METATITLE, sanitize_text_field($_POST[SEO_CUSTOMFIELD_METATITLE]));
	}else{
		delete_option("term_".$term_id."_".SEO_CUSTOMFIELD_METATITLE);
	}
	// SEO_CUSTOMFIELD_METADESCRIPTION
	if (!empty($_POST[SEO_CUSTOMFIELD_METADESCRIPTION])){
		update_option("term_".$term_id."_".SEO_CUSTOMFIELD_METADESCRIPTION, sanitize_text_field($_POST[SEO_CUSTOMFIELD_METADESCRIPTION]));
	}else{
		delete_option("term_".$term_id."_".SEO_CUSTOMFIELD_METADESCRIPTION);
	}
	// SEO_CUSTOMFIELD_METAKEYWORDS
	if (!empty($_POST[SEO_CUSTOMFIELD_METAKEYWORDS])){
		update_option("term_".$term_id."_".SEO_CUSTOMFIELD_METAKEYWORDS, sanitize_text_field($_POST[SEO_CUSTOMFIELD_METAKEYWORDS]));
	}else{
		delete_option("term_".$term_id."_".SEO_CUSTOMFIELD_METAKEYWORDS);
	}
}
endif;

if (!function_exists("seo_registered_taxonomy")):
/**
 * add seo on custom taxonomy extra fields
 */
function seo_registered_taxonomy($taxonomy){
	$seo_exludes_taxonomies = array("post_tag", "nav_menu", "link_category", "post_format");
	if (!in_array($taxonomy, $seo_exludes_taxonomies)){
		add_action($taxonomy.'_edit_form_fields', 'seo_add_taxonomy_fields');
		add_action('edited_'.$taxonomy, 'seo_save_taxonomy_fields');
	}
}
add_action('registered_taxonomy', 'seo_registered_taxonomy');
endif;
