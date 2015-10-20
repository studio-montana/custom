<?php
/**
 * PRIVATE Customizer
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

global $private_tool_errors;

/**
 * Add WIP fields for the Customizer.
 *
 * @since Custom WIP 1.0
 *
 * @param WP_Customize_Manager $wp_customize_manager Customizer object.
 */
function private_customize_register($wp_customize_manager) {

	// ------ background section
	$wp_customize_manager->add_section('private_customizer', array(
			'title' => __( 'Private Site', CUSTOM_TEXT_DOMAIN ),
	) );

	// state
	$wp_customize_manager->add_setting('private_state', array('type' => 'theme_mod', 'transport'=>'refresh'));
	$wp_customize_manager->add_control('private_state',	array(
			'type' => 'checkbox',
			'label' => __('Active', CUSTOM_TEXT_DOMAIN ),
			'description' => __('Make your site private', CUSTOM_TEXT_DOMAIN ),
			'section' => 'private_customizer',
			'settings'   => 'private_state',
	)
	);

	// message
	$wp_customize_manager->add_setting('private_message', array('type' => 'theme_mod', 'transport'=>'refresh'));
	$wp_customize_manager->add_control('private_message', array(
			'label'      => __('Message', CUSTOM_TEXT_DOMAIN ),
			'section'    => 'private_customizer',
			'settings'   => 'private_message',
	));

	// login
	$wp_customize_manager->add_setting('private_login', array('type' => 'theme_mod', 'transport'=>'refresh'));
	$wp_customize_manager->add_control('private_login', array(
			'label'      => __('Login', CUSTOM_TEXT_DOMAIN ),
			'section'    => 'private_customizer',
			'settings'   => 'private_login',
	));

	// password
	$wp_customize_manager->add_setting('private_password', array('type' => 'theme_mod', 'transport'=>'refresh'));
	$wp_customize_manager->add_control('private_password', array(
			'label'      => __('Password', CUSTOM_TEXT_DOMAIN ),
			'section'    => 'private_customizer',
			'settings'   => 'private_password',
	));

}
add_action('customize_register', 'private_customize_register');

if (!function_exists("private_template_include")):
/**
 * template_include filter (allow to override template hierarchy)
* @return template path
*/
function private_template_include($template) {
	global $private_tool_errors;
	$private_tool_errors = array();
	$private = get_theme_mod('private_state');
	if (!empty($private) && $private == 1){
		$private_template = '';

		// process GET form (logout action)
		if (!empty($_GET)){
			if (isset($_GET['tool-private-logout'])){
				private_logout();
			}
		}

		// process POST form (login action)
		if (!empty($_POST)){
			if (isset($_POST['tool-private-login']) && isset($_POST['tool-private-password'])){
				$login = $_POST['tool-private-login'];
				$password = $_POST['tool-private-password'];

				$private_tool_errors = apply_filters('tool_private_form_validation', $private_tool_errors);

				if (empty($private_tool_errors)){
					$login_res = private_login($login, $password);
					if ($login_res != null){
						$private_tool_errors[] = $login_res;
					}
				}
			}
		}

		// test logged in user
		if (!private_is_logged_in()){
			$private_template = locate_ressource("tool-private-template-login.php", array(CUSTOM_TOOLS_FOLDER.PRIVATE_TOOL_NAME.'/templates/'));
		}
		if (!empty($private_template))
			$template =  $private_template;
	}
	return $template;
}
add_filter('template_include', 'private_template_include', 1000);
endif;

if (!function_exists("private_body_class")):
/**
 * body_class filter
* @param array $classes
* @return body classes
*/
function private_body_class($classes) {
	$private = get_theme_mod('private_state');
	if (!empty($private) && $private == 1 && !private_is_logged_in()){
		$classes[] = "tool-private-page";
	}
	return $classes;
}
add_filter('body_class', 'private_body_class');
endif;

if (!function_exists("private_login")):
/**
 * login user
* @param unknown $login
* @param unknown $password
*/
function private_login($login, $password) {
	$error = null;
	$private_login = get_theme_mod('private_login', "");
	$private_password = get_theme_mod('private_password', "");

	if (!empty($private_login) && !empty($private_password) && $login == $private_login && $password == $private_password)
		custom_session_set("private_login", "1");
	else
		$error = new WP_Error('private-login-error', __("unknown account", CUSTOM_TEXT_DOMAIN));

	return $error;
}
endif;

if (!function_exists("private_logout")):
/**
 * logout user
*/
function private_logout() {
	custom_session_unset("private_login");
}
endif;

if (!function_exists("private_is_logged_in")):
/**
 * logout user
*/
function private_is_logged_in() {
	$logged_in = custom_session_get("private_login", "0");
	if ($logged_in == "1")
		return true;
	return false;
}
endif;

if (!function_exists("private_wp_footer")):
/**
 * WP_Footer hook
* @since Custom 1.0
* @return void
*/
function private_wp_footer() {
	$private = get_theme_mod('private_state');
	if (!empty($private) && $private == 1 && private_is_logged_in()){
		?>
<div class="private-logout">
	<a href="<?php echo esc_url(home_url('/'))."?tool-private-logout"; ?>"
		rel="home"><i class="fa fa-sign-out"></i><span><?php _e("sign out", CUSTOM_TEXT_DOMAIN); ?>
	</span> </a>
</div>
<?php 
	}
}
add_action('wp_footer', 'private_wp_footer');
endif;
