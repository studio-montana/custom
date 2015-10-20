<?php
/**
 * MENU Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('MENU_TOOL_NAME', 'menu');

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Custom 1.0
 * @return void
*/
function tool_menu_scripts_styles() {

	/**
	 * enqueue menu-hightlight javascript file
	 */
	$js_tool_menu_hightlight = locate_web_ressource(CUSTOM_JS_FOLDER.'tool-menu-hightlight.js', array(CUSTOM_TOOLS_FOLDER.MENU_TOOL_NAME.'/'));
	if (!empty($js_tool_menu_hightlight)){
		if (is_multisite()){
			$home_url = get_site_url(BLOG_ID_CURRENT_SITE);
			$home_minisite_url = get_site_url(get_current_blog_id());
		}else{
			$home_url = home_url('/');
			$home_minisite_url = "";
		}
		$id_blog_page = get_option('page_for_posts');
		if (!empty($id_blog_page) && is_numeric($id_blog_page)){
			$blog_url = get_permalink($id_blog_page);
		}else{
			$blog_url = "";
		}
		if (is_single() && get_post_type() == 'post'){
			$is_post = "1";
		}else{
			$is_post = "0";
		}
		$current_url = get_current_url();
		wp_enqueue_script('tool-menu-script-menu-hightlight', $js_tool_menu_hightlight, array('jquery'), '1.0', true);
		wp_localize_script('tool-menu-script-menu-hightlight', 'ToolMenu', array(
			'current_url' => $current_url,
			'home_url' => $home_url,
			'home_minisite_url' => $home_minisite_url,
			'blog_url' => $blog_url,
			'is_post' => $is_post
		));
	}
	/**
	 * enqueue menu-toggle javascript file
	 */
	$js_tool_menu_toggle = locate_web_ressource(CUSTOM_JS_FOLDER.'tool-menu-toggle.js', array(CUSTOM_TOOLS_FOLDER.MENU_TOOL_NAME.'/'));
	if (!empty($js_tool_menu_toggle)){
		wp_enqueue_script('tool-menu-script-menu-toggle', $js_tool_menu_toggle, array('jquery'), '1.0', true);
	}
	/**
	 * enqueue menu-fixed-on-scroll javascript file
	 */
	$js_tool_menu_fixed_on_scroll = locate_web_ressource(CUSTOM_JS_FOLDER.'tool-menu-fixed-on-scroll.js', array(CUSTOM_TOOLS_FOLDER.MENU_TOOL_NAME.'/'));
	if (!empty($js_tool_menu_fixed_on_scroll)){
		wp_enqueue_script('tool-menu-script-fixed-on-scroll', $js_tool_menu_fixed_on_scroll, array('jquery'), '1.0', true);
	}
}
add_action('wp_enqueue_scripts', 'tool_menu_scripts_styles');