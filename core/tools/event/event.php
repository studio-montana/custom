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
 * CONSTANTS
 */
define('EVENT_NONCE_ACTION', 'event_nonce_action');

/**
 * WIDGETS
*/
require_once (CUSTOM_PLUGIN_PATH.'/'.'/'.CUSTOM_PLUGIN_TOOLS_FOLDER.EVENT_TOOL_NAME.'/widgets/tool-event-widget.class.php');

if (!function_exists("tool_event_admin_init")):
/**
 * Hooks the WP admin_init action to add metaboxe customfields on post-type
*
* @return void
*/
function tool_event_admin_init() {
	add_meta_box('tool-event-properties', '<i class="dashicons dashicons-calendar-alt" style="margin-right: 6px; font-size: 1.3rem;"></i>'.__( 'Event properties', CUSTOM_PLUGIN_TEXT_DOMAIN), 'tool_event_add_inner_meta_boxes', 'event', 'side', 'high');
}
add_action('admin_init', 'tool_event_admin_init');
endif;

if (!function_exists("tool_event_add_inner_meta_boxes")):
/**
 * Hooks the WP admin_init action to add metaboxe customfields on post-type
*
* @return void
*/
function tool_event_add_inner_meta_boxes() {
	include(locate_ressource('/'.CUSTOM_PLUGIN_TOOLS_FOLDER.EVENT_TOOL_NAME.'/templates/template-event-fields.php'));
}
endif;

if (!function_exists("event_add_inner_meta_boxes")):
/**
 * This action is called by Custom when metabox is displayed on post-type
* @param unknown $post
*/
function event_add_inner_meta_boxes($post){
	$id_blog_page = get_option('page_for_posts');
	if ($id_blog_page != get_the_ID()){
		if (get_post_type($post) == 'event'){
			include(locate_ressource('/'.CUSTOM_PLUGIN_TOOLS_FOLDER.EVENT_TOOL_NAME.'/templates/template-event-fields.php'));
		}
	}
}
//add_action("customfields_add_inner_meta_boxes", "event_add_inner_meta_boxes");
endif;

if (!function_exists("add_event_post_type")):
/**
 * ajoute le post-type 'event'
*/
function add_event_post_type(){

	// custom post type
	$labels = array(
			'name'               => __('Events', CUSTOM_PLUGIN_TEXT_DOMAIN),
			'singular_name'      => __('Event', CUSTOM_PLUGIN_TEXT_DOMAIN),
			'add_new_item'       => __('Add Event', CUSTOM_PLUGIN_TEXT_DOMAIN),
			'edit_item'          => __('Edit Event', CUSTOM_PLUGIN_TEXT_DOMAIN),
			'new_item'           => __('New Event', CUSTOM_PLUGIN_TEXT_DOMAIN),
			'all_items'          => __('Events', CUSTOM_PLUGIN_TEXT_DOMAIN),
			'view_item'          => __('Look Event', CUSTOM_PLUGIN_TEXT_DOMAIN),
			'search_items'       => __('Search Events', CUSTOM_PLUGIN_TEXT_DOMAIN),
			'not_found'          => __('No Event found', CUSTOM_PLUGIN_TEXT_DOMAIN),
			'not_found_in_trash' => __('No Event found in trash', CUSTOM_PLUGIN_TEXT_DOMAIN)
	);
	$args = array(
			'labels'             => $labels,
			'exclude_from_search' => false,
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => 'dashicons-calendar-alt',
			'capability_type' => 'post',
			'hierarchical' => true,
			'supports' => array('title', 'editor', 'thumbnail'),
			'rewrite'           => array('slug' => _x('evenement', 'URL slug', CUSTOM_PLUGIN_TEXT_DOMAIN))
	);
	register_post_type('event', $args);

	// custom taxonomy
	$labels = array(
			"name"              => __("Event Types", CUSTOM_PLUGIN_TEXT_DOMAIN),
			"singular_name"     => __("Event Type", CUSTOM_PLUGIN_TEXT_DOMAIN),
			"search_items"      => __("Search Event Type", CUSTOM_PLUGIN_TEXT_DOMAIN),
			"all_items"         => __("All Event Types", CUSTOM_PLUGIN_TEXT_DOMAIN),
			"parent_item"       => __("Event Type's parent", CUSTOM_PLUGIN_TEXT_DOMAIN),
			"parent_item_colon" => __("Event Type's parent", CUSTOM_PLUGIN_TEXT_DOMAIN),
			"edit_item"         => __("Edit Event Type", CUSTOM_PLUGIN_TEXT_DOMAIN),
			"update_item"       => __("Update Event Type", CUSTOM_PLUGIN_TEXT_DOMAIN),
			"add_new_item"      => __("Add Event Type", CUSTOM_PLUGIN_TEXT_DOMAIN),
			"new_item_name"     => __("Name", CUSTOM_PLUGIN_TEXT_DOMAIN),
			"menu_name"         => __("Event Type", CUSTOM_PLUGIN_TEXT_DOMAIN)
	);
	$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => _x('evenement-type', 'URL slug', CUSTOM_PLUGIN_TEXT_DOMAIN))
	);
	register_taxonomy('eventtype', array( 'event' ), $args);

	add_action('save_post', 'save_event_post_type');
}
add_action('init', 'add_event_post_type');
endif;

if (!function_exists("save_event_post_type")):
/**
 * save event's custom fields
*/
function save_event_post_type($post_id){

	// verify if this is an auto save routine.
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
	// verify if this post-type is available and editable.
	$is_post_available = false;
	$post_type = null;
	if (isset($_POST['post_type']) && !empty($_POST['post_type'])){
		$post_type = $_POST['post_type'];
	}
	if (empty($post_type))
		return;
	if ($post_type != 'event' || !current_user_can('edit_post', $post_id ))
		return;
	if (!isset($_POST[EVENT_NONCE_ACTION]) || !wp_verify_nonce($_POST[EVENT_NONCE_ACTION], EVENT_NONCE_ACTION))
		return;


	// meta_event_date_begin
	if (isset($_POST["meta_event_date_begin"]) && !empty($_POST["meta_event_date_begin"])){
		if (isset($_POST["meta_event_hour_begin"]) && !empty($_POST["meta_event_hour_begin"])){
			$hour_begin = $_POST["meta_event_hour_begin"];
		}else{
			$hour_begin = "08";
		}
		if (isset($_POST["meta_event_minute_begin"]) && !empty($_POST["meta_event_minute_begin"])){
			$minute_begin = $_POST["meta_event_minute_begin"];
		}else{
			$minute_begin = "00";
		}
		// transform date to timestamp
		$date_begin = DateTime::createFromFormat('d/m/Y H:i', $_POST["meta_event_date_begin"]." ".$hour_begin.":".$minute_begin);
		if ($date_begin)
			update_post_meta($post_id, "meta_event_date_begin", $date_begin->getTimestamp());
		else
			delete_post_meta($post_id, "meta_event_date_begin");
	}else{
		delete_post_meta($post_id, "meta_event_date_begin");
	}
	// meta_event_date_end
	if (isset($_POST["meta_event_date_end"]) && !empty($_POST["meta_event_date_end"])){
		if (isset($_POST["meta_event_hour_end"]) && !empty($_POST["meta_event_hour_end"])){
			$hour_end = $_POST["meta_event_hour_end"];
		}else{
			$hour_end = "18";
		}
		if (isset($_POST["meta_event_minute_end"]) && !empty($_POST["meta_event_minute_end"])){
			$minute_end = $_POST["meta_event_minute_end"];
		}else{
			$minute_end = "00";
		}
		// transform date to timestamp
		$date_end = DateTime::createFromFormat('d/m/Y H:i', $_POST["meta_event_date_end"]." ".$hour_end.":".$minute_end);
		if ($date_end)
			update_post_meta($post_id, "meta_event_date_end", $date_end->getTimestamp());
		else
			delete_post_meta($post_id, "meta_event_date_end");
	}else{
		delete_post_meta($post_id, "meta_event_date_end");
	}
}
endif;

if (!function_exists("define_event_columns")):
/**
 * custom listing columns
*/
function define_event_columns($columns){
	$columns["event-date-begin"] = __("Begin", CUSTOM_PLUGIN_TEXT_DOMAIN);
	$columns["event-date-end"] = __("End", CUSTOM_PLUGIN_TEXT_DOMAIN);
	return $columns;
}
add_filter('manage_edit-event_columns', 'define_event_columns' );
endif;

if (!function_exists("build_event_columns")):
/**
 * custom listing columns content
*/
function build_event_columns($column, $post_id){
	switch($column){
		case "event-date-begin":
			$meta_date_begin = get_post_meta($post_id, "meta_event_date_begin", true);
			$meta_date_begin_s = "";
			if (!empty($meta_date_begin) && is_numeric($meta_date_begin)){
				$meta_date_begin = new DateTime("@".$meta_date_begin);
				if ($meta_date_begin)
					echo $meta_date_begin->format("d")."/".$meta_date_begin->format("m")."/".$meta_date_begin->format("Y")." ".$meta_date_begin->format("H").":".$meta_date_begin->format("i");
				else
					echo '-';
			}else{
				echo '-';
			}
			break;
		case "event-date-end":
			$meta_date_end = get_post_meta($post_id, "meta_event_date_end", true);
			$meta_date_end_s = "";
			if (!empty($meta_date_end) && is_numeric($meta_date_end)){
				$meta_date_end = new DateTime("@".$meta_date_end);
				if ($meta_date_end)
					echo $meta_date_end->format("d")."/".$meta_date_end->format("m")."/".$meta_date_end->format("Y")." ".$meta_date_end->format("H").":".$meta_date_end->format("i");
				else
					echo '-';
			}else{
				echo '-';
			}
			break;
	}
}
add_action( 'manage_event_posts_custom_column' , 'build_event_columns', 10, 2 );
endif;

/**
 * renvoi les post-type event
 * @param string $meta_args : permet de filtrer sur les post_meta
 * @return array
 */
function get_event_post_types($meta_args = null, $args=array()){
	return get_post_types_by_type('event', $meta_args, $args);
}

/**
 * construit les options (html) avec les event existants
 * @param string $id_selected
 * @return string
 */
function get_event_options($id_selected = null){
	$events = get_event_post_types();
	foreach ($events as $event){
		if ($id_selected == $event->ID)
			$selected = ' selected="selected"';
		else
			$selected = '';
		$res .= '<option value="'.$event->ID.'"'.$selected.'>'.$event->post_title.'</option>';
	}
	return $res;
}

