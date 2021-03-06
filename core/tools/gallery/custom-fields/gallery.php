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
 * GLOBALS
 */
global $gallery_post_count;
$gallery_post_count = 0;

/**
 * CONSTANTS
 */
define('META_GALLERY_PRESENTATION', 'meta_gallery_presentation');
define('META_GALLERY_HEIGHT', 'meta_gallery_initial_height');
define('META_GALLERY_DISABLE_FANCYBOX', 'meta_gallery_disable_fancybox');
define('META_GALLERY_PRESENTATION_FORMAT', 'meta_gallery_presentation_format');
define('META_GALLERY_PRESENTATION_SLIDER_CAROUSEL', 'meta_gallery_presentation_slider_carousel');
define('META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH', 'meta_gallery_presentation_slider_carousel_item_width');
define('META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN', 'meta_gallery_presentation_slider_carousel_item_margin');
define('META_GALLERY_PRESENTATION_SLIDER_AUTOPLAY', 'meta_gallery_presentation_slider_autoplay');
define('META_GALLERY_PRESENTATION_SLIDER_THUMB_NAV', 'meta_gallery_presentation_slider_thumb_nav');
define('META_GALLERY_PRESENTATION_MASONRY_WIDTH', 'meta_gallery_initial_max_width');
define('META_GALLERY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED', 'meta_gallery_initial_max_width_customized');
define('META_GALLERY_PRESENTATION_MASONRY_HEIGHT', 'meta_gallery_initial_max_height');


if (!function_exists("gallery_add_inner_meta_boxes")):
/**
 * This action is called by Custom when metabox is displayed on post-type
* @param unknown $post
*/
function gallery_add_inner_meta_boxes($post){
	$id_blog_page = get_option('page_for_posts');
	if ($id_blog_page != get_the_ID()){
		$available_posttypes = get_displayed_post_types();
		$available_posttypes = apply_filters("tool_gallery_available_posttypes", $available_posttypes);
		if (in_array(get_post_type($post), $available_posttypes)){
			include(locate_ressource('/'.CUSTOM_PLUGIN_TOOLS_FOLDER.GALLERY_TOOL_NAME.'/custom-fields/templates/gallery.php'));
		}
	}
}
add_action("customfields_add_inner_meta_boxes", "gallery_add_inner_meta_boxes");
endif;

if (!function_exists("gallery_save_post")):
/**
 * This action is called by Custom when post-type is saved
* @param int $post_id
*/
function gallery_save_post($post_id){
	$available_posttypes = get_displayed_post_types();
	$available_posttypes = apply_filters("tool_gallery_available_posttypes", $available_posttypes);
	if (in_array(get_post_type($post_id), $available_posttypes)){
		// META_GALLERY_PRESENTATION
		if (!empty($_POST[META_GALLERY_PRESENTATION])){
			update_post_meta($post_id, META_GALLERY_PRESENTATION, sanitize_text_field($_POST[META_GALLERY_PRESENTATION]));
		}else{
			delete_post_meta($post_id, META_GALLERY_PRESENTATION);
		}
		// META_GALLERY_HEIGHT
		if (!empty($_POST[META_GALLERY_HEIGHT]) && is_numeric($_POST[META_GALLERY_HEIGHT])){
			update_post_meta($post_id, META_GALLERY_HEIGHT, sanitize_text_field($_POST[META_GALLERY_HEIGHT]));
		}else{
			delete_post_meta($post_id, META_GALLERY_HEIGHT);
		}
		// META_GALLERY_PRESENTATION_FORMAT
		if (!empty($_POST[META_GALLERY_PRESENTATION_FORMAT])){
			update_post_meta($post_id, META_GALLERY_PRESENTATION_FORMAT, sanitize_text_field($_POST[META_GALLERY_PRESENTATION_FORMAT]));
		}else{
			update_post_meta($post_id, META_GALLERY_PRESENTATION_FORMAT, "square");
		}
		// META_GALLERY_PRESENTATION_MASONRY_WIDTH
		if (!empty($_POST[META_GALLERY_PRESENTATION_MASONRY_WIDTH]) && is_numeric($_POST[META_GALLERY_PRESENTATION_MASONRY_WIDTH])){
			update_post_meta($post_id, META_GALLERY_PRESENTATION_MASONRY_WIDTH, sanitize_text_field($_POST[META_GALLERY_PRESENTATION_MASONRY_WIDTH]));
		}else{
			delete_post_meta($post_id, META_GALLERY_PRESENTATION_MASONRY_WIDTH);
		}
		// META_GALLERY_PRESENTATION_MASONRY_HEIGHT
		if (!empty($_POST[META_GALLERY_PRESENTATION_MASONRY_HEIGHT]) && is_numeric($_POST[META_GALLERY_PRESENTATION_MASONRY_HEIGHT])){
			update_post_meta($post_id, META_GALLERY_PRESENTATION_MASONRY_HEIGHT, sanitize_text_field($_POST[META_GALLERY_PRESENTATION_MASONRY_HEIGHT]));
		}else{
			delete_post_meta($post_id, META_GALLERY_PRESENTATION_MASONRY_HEIGHT);
		}
		// META_GALLERY_DISABLE_FANCYBOX
		if (!empty($_POST[META_GALLERY_DISABLE_FANCYBOX])){
			update_post_meta($post_id, META_GALLERY_DISABLE_FANCYBOX, sanitize_text_field($_POST[META_GALLERY_DISABLE_FANCYBOX]));
		}else{
			delete_post_meta($post_id, META_GALLERY_DISABLE_FANCYBOX);
		}
		// META_GALLERY_PRESENTATION_SLIDER_CAROUSEL
		if (!empty($_POST[META_GALLERY_PRESENTATION_SLIDER_CAROUSEL])){
			update_post_meta($post_id, META_GALLERY_PRESENTATION_SLIDER_CAROUSEL, sanitize_text_field($_POST[META_GALLERY_PRESENTATION_SLIDER_CAROUSEL]));
		}else{
			delete_post_meta($post_id, META_GALLERY_PRESENTATION_SLIDER_CAROUSEL);
		}
		// META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH
		if (!empty($_POST[META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH]) && is_numeric($_POST[META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH])){
			update_post_meta($post_id, META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH, sanitize_text_field($_POST[META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH]));
		}else{
			update_post_meta($post_id, META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH, "250");
		}
		// META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN
		if (!empty($_POST[META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN]) && is_numeric($_POST[META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN])){
			update_post_meta($post_id, META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN, sanitize_text_field($_POST[META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN]));
		}else{
			update_post_meta($post_id, META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN, "5");
		}
		// META_GALLERY_PRESENTATION_SLIDER_AUTOPLAY
		if (!empty($_POST[META_GALLERY_PRESENTATION_SLIDER_AUTOPLAY])){
			update_post_meta($post_id, META_GALLERY_PRESENTATION_SLIDER_AUTOPLAY, sanitize_text_field($_POST[META_GALLERY_PRESENTATION_SLIDER_AUTOPLAY]));
		}else{
			delete_post_meta($post_id, META_GALLERY_PRESENTATION_SLIDER_AUTOPLAY);
		}
		// META_GALLERY_PRESENTATION_SLIDER_THUMB_NAV
		if (!empty($_POST[META_GALLERY_PRESENTATION_SLIDER_THUMB_NAV])){
			update_post_meta($post_id, META_GALLERY_PRESENTATION_SLIDER_THUMB_NAV, sanitize_text_field($_POST[META_GALLERY_PRESENTATION_SLIDER_THUMB_NAV]));
		}else{
			delete_post_meta($post_id, META_GALLERY_PRESENTATION_SLIDER_THUMB_NAV);
		}
		// META_GALLERY_PRESENTATION_MASONRY_WIDTH
		if (!empty($_POST[META_GALLERY_PRESENTATION_MASONRY_WIDTH])){
			update_post_meta($post_id, META_GALLERY_PRESENTATION_MASONRY_WIDTH, sanitize_text_field($_POST[META_GALLERY_PRESENTATION_MASONRY_WIDTH]));
		}else{
			update_post_meta($post_id, META_GALLERY_PRESENTATION_MASONRY_WIDTH, 'fully-responsive');
		}
		// META_GALLERY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED
		if (!empty($_POST[META_GALLERY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED])){
			update_post_meta($post_id, META_GALLERY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED, sanitize_text_field($_POST[META_GALLERY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED]));
		}else{
			update_post_meta($post_id, META_GALLERY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED, "250");
		}
		// META_GALLERY_PRESENTATION_MASONRY_HEIGHT
		if (!empty($_POST[META_GALLERY_PRESENTATION_MASONRY_HEIGHT]) && is_numeric($_POST[META_GALLERY_PRESENTATION_MASONRY_HEIGHT])){
			update_post_meta($post_id, META_GALLERY_PRESENTATION_MASONRY_HEIGHT, sanitize_text_field($_POST[META_GALLERY_PRESENTATION_MASONRY_HEIGHT]));
		}else{
			delete_post_meta($post_id, META_GALLERY_PRESENTATION_MASONRY_HEIGHT);
		}
	}
}
add_action("customfields_save_post", "gallery_save_post");
endif;

if (!function_exists("gallery_post_gallery")):
/**
 * override wp gallery
* @param string $output
* @param array $attr
* @return string
*/
function gallery_post_gallery($output, $attr) {
	$res = '';
	if (in_array(get_post_type(get_the_ID()), get_displayed_post_types())){
		$meta_gallery_presentation = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION, true);
		$meta_gallery_presentation_height = get_post_meta(get_the_ID(), META_GALLERY_HEIGHT, true);
		$meta_gallery_presentation_format = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_FORMAT, true);
		$meta_gallery_disable_fancybox = get_post_meta(get_the_ID(), META_GALLERY_DISABLE_FANCYBOX, true);
		$meta_gallery_presentation_slider_autoplay = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_SLIDER_AUTOPLAY, true);
		$meta_gallery_presentation_slider_thumb_nav = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_SLIDER_THUMB_NAV, true);
		$meta_gallery_presentation_slider_carousel = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_SLIDER_CAROUSEL, true);
		$meta_gallery_presentation_slider_carousel_item_width = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH, true);
		$meta_gallery_presentation_slider_carousel_item_margin = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN, true);
		$meta_gallery_presentation_masonry_width = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_MASONRY_WIDTH, true);
		$meta_gallery_presentation_masonry_width_customized = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED, true);
		$meta_gallery_presentation_masonry_height = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_MASONRY_HEIGHT, true);
		$output = "";
		global $gallery_post_count;
		global $post;
		if (isset($attr['orderby'])) {
			$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
			if (!$attr['orderby'])
				unset($attr['orderby']);
		}
		extract(shortcode_atts(array(
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'id' => $post->ID,
		'itemtag' => 'dl',
		'icontag' => 'dt',
		'captiontag' => 'dd',
		'columns' => 3,
		'size' => 'thumbnail',
		'include' => '',
		'exclude' => ''
				), $attr));

		$id = intval($id);
		if ('RAND' == $order) $orderby = 'none';
		if (!empty($include)) {
			$include = preg_replace('/[^0-9,]+/', '', $include);
			$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
				
			$attachments = array();
			foreach ($_attachments as $key => $val) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		}
		if (!empty($attachments)){
			$gallery_post_count ++;
			ob_start();
			$gallery_template = locate_ressource(CUSTOM_PLUGIN_TOOLS_FOLDER.GALLERY_TOOL_NAME.'/templates/tool-gallery-display.php');
			if (!empty($gallery_template))
				include($gallery_template);
			$output = ob_get_contents();
			ob_end_clean();
		}
	}
	return $output;
}
add_filter('post_gallery', 'gallery_post_gallery', 10, 2);
endif;