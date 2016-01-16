<?php
/**
 * LOGIN Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('LOGIN_TOOL_NAME', 'login');

/**
 * REQUIREMENTS
*/
require_once (locate_template(CUSTOM_TOOLS_FOLDER.LOGIN_TOOL_NAME.'/inc/customizer.php'));


if (!function_exists("tool_login_enqueue_styles_tools")):
/**
 * login template styles
*/
function tool_login_enqueue_styles_tools(){
	$css_login = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-login.css', array(CUSTOM_TOOLS_FOLDER.LOGIN_TOOL_NAME.'/'));
	if (!empty($css_login))
		wp_enqueue_style('tool-login-css', $css_login, array(), '1.0');
}
add_action("custom_login_enqueue_styles_tools", "tool_login_enqueue_styles_tools");
endif;

if (!function_exists("tool_login_enqueue_scripts_tools")):
/**
 * login template scripts
*/
function tool_login_enqueue_scripts_tools(){
	$js_login = locate_web_ressource(CUSTOM_JS_FOLDER.'tool-login.js', array(CUSTOM_TOOLS_FOLDER.LOGIN_TOOL_NAME.'/'));
	if (!empty($js_login)){
		wp_enqueue_script('tool-login-script', $js_login, array('jquery'), '1.0', true );
		wp_localize_script('tool-login-script', 'ToolLogin', array('url_title' => get_bloginfo( 'name' ), 'url_site' => get_site_url(), 'message' => '', 'placeholder_login' => __("login", CUSTOM_TEXT_DOMAIN), 'placeholder_password' => __("password", CUSTOM_TEXT_DOMAIN)));
	}
}
add_action("custom_login_enqueue_scripts_tools", "tool_login_enqueue_scripts_tools");
endif;

if (!function_exists("tool_login_display_background")):
/**
 * add background image div before #page element
*/
function tool_login_display_background(){
	$url_background = get_theme_mod("login_backgroundimage");
	
	if (empty($url_background) && is_registered_custom_tool("backgroundimage")){
		$url_background = get_theme_mod('backgroundimage_image');
	}

	if (!empty($url_background)){
		?>
<div id="tool-login-background" class="<?php echo $class; ?>" style="background: url('<?php echo $url_background; ?>') no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			-ms-background-size: cover;
			background-size: cover;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: -100;"></div>
<?php
	}
}
add_action('login_footer', 'tool_login_display_background');
endif;

