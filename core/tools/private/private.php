<?php
/**
 * PRIVATE Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

if (!defined ('ABSPATH')) die ('No direct access allowed');

/**
 * CONSTANTS
*/
define('PRIVATE_TOOL_NAME', 'private');

/**
 * REQUIREMENTS
*/
require_once (locate_template(CUSTOM_TOOLS_FOLDER.PRIVATE_TOOL_NAME.'/inc/options.php'));

/**
 * Enqueue styles for the front end.
*/
function tool_private_custom_front_enqueue_styles_tools($dependencies) {
	$css_private = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-private.css', array(CUSTOM_TOOLS_FOLDER.PRIVATE_TOOL_NAME.'/'));
	if (!empty($css_private))
		wp_enqueue_style('tool-private-css', $css_private, $dependencies, '1.0');
}
add_action('custom_front_enqueue_styles_tools', 'tool_private_custom_front_enqueue_styles_tools');

if (!function_exists("private_template_include")):
/**
 * template_include filter (allow to override template hierarchy)
* @return template path
*/
function private_template_include($template) {
	$post_id = get_the_id();
	if (is_home())
		$post_id = get_option('page_for_posts');
	if (tool_private_is_private_post($post_id) && !is_user_logged_in()){
		$private_template = locate_ressource("tool-private-template.php", array(CUSTOM_TOOLS_FOLDER.PRIVATE_TOOL_NAME.'/templates/'));
		if (!empty($private_template))
			$template =  $private_template;
		else
			wp_redirect(wp_login_url(get_current_url(true)));
	}
	return $template;
}
add_filter('template_include', 'private_template_include', 1000);
endif;

if (!function_exists("tool_private_is_private_site")):
function tool_private_is_private_site(){
	$go_private = get_option(TOOL_PRIVATE_OPTIONS_GO_PRIVATE);
	if ($go_private && $go_private == "1"){
		return true;
	}
	return false;
}
endif;

if (!function_exists("tool_private_is_private_post")):
function tool_private_is_private_post($post_id){
	$go_private = get_option(TOOL_PRIVATE_OPTIONS_GO_PRIVATE);
	if ($go_private && $go_private == "1"){
		return true;
	}else if ($go_private && $go_private == "2"){
		$private_items = get_option(TOOL_PRIVATE_OPTIONS_ITEMS."-".get_current_lang());
		if (!empty($private_items)){
			$parent_ids = get_post_ancestors($post_id);
			$private_items = split(",", $private_items);
			if (in_array($post_id, $private_items)){
				return true;
			}else{
				foreach ($parent_ids as $parent_id){
					if (in_array($parent_id, $private_items))
						return true;
				}
			}
		}
	}
	return false;
}
endif;

if (!function_exists("private_login_fail")):
/**
 * redirect on login failed (keep redirect_to parameter)
*/
function private_login_fail( $username ) {
	$referrer = $_SERVER['HTTP_REFERER'];
	$redirect_to = "";
	if (isset($_REQUEST['redirect_to']))
		$redirect_to = $_REQUEST['redirect_to'];
	if (!empty($redirect_to) && !empty($referrer) && !strstr($referrer,'wp-admin')) {
		wp_redirect(wp_login_url($redirect_to));
		exit;
	}
}
add_action('wp_login_failed', 'private_login_fail');
endif;

if (!function_exists("private_wp_footer")):
/**
 * Add logout link in footer
*/
function private_wp_footer() {
	if (is_user_logged_in()){
		?>
<div class="private-logout">
	<a href="<?php echo wp_logout_url(get_permalink()); ?>"
		title="<?php echo esc_attr(__("sign out", CUSTOM_TEXT_DOMAIN)); ?>"><i
		class="fa fa-sign-out"></i><span><?php _e("sign out", CUSTOM_TEXT_DOMAIN); ?>
	</span> </a>
</div>
<?php 
	}
}
add_action('wp_footer', 'private_wp_footer');
endif;
