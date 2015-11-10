<?php
/**
 * COOKIES Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * IMPORTANT : this secure tool use $_SESSION and similare keys for all securized forms, in particular usage you can be failtoban because of an other form failed to ban
 */

/**
 * CONSTANTS
 */
define('SECURE_TOOL_NAME', 'secure');

/**
 * REQUIREMENTS
*/
require_once (locate_template(CUSTOM_TOOLS_FOLDER.SECURE_TOOL_NAME.'/inc/customizer.php'));
require_once (locate_template(CUSTOM_TOOLS_FOLDER.SECURE_TOOL_NAME.'/inc/captcha.php'));
require_once (locate_template(CUSTOM_TOOLS_FOLDER.SECURE_TOOL_NAME.'/inc/failtoban.php'));

/**
 * Add captchanum to Contact Form 7 plugin
 */
$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
if ($captcha_enable == 1 && class_exists("WPCF7_ContactForm")){
	require_once (locate_template(CUSTOM_TOOLS_FOLDER.SECURE_TOOL_NAME.'/inc/contactform7/captchanum.php'));
}

/**
 * WP uses this action to generate login form
*/
add_action('login_form', 'secure_login_form');

/**
 * WooCommerce uses this action to generate login form
*/
add_action('woocommerce_login_form', 'secure_woocommerce_login_form');

/**
 * WooCommerce uses this action to generate checkout registration form
*/
add_action('woocommerce_after_checkout_registration_form', 'secure_woocommerce_checkout_registration_form');

/**
 * WP and WooCommerce uses this action to generate registration form
*/
add_action('register_form', 'secure_register_form');

/**
 * WP uses this action during login process
*/
add_action('wp_authenticate', 'secure_validate_login_form', 1, 1);

/**
 * WP uses this action during registration process
*/
add_action('registration_errors', 'secure_validate_register_form', 1, 1);

/**
 * WooCommerce uses this action during login process
*/
add_action('woocommerce_process_login_errors', 'secure_validate_woocommerce_login_form', 1, 3);

/**
 * WooCommerce uses this action during register process
*/
add_action('woocommerce_registration_errors', 'secure_validate_woocommerce_register_form', 1, 3);

/**
 * WP uses this filter to accepts new fields in comment form
*/
add_filter('comment_form_default_fields', 'secure_comment_form_field', 10, 1);

/**
 * WP uses this action before insert new comment
*/
add_action('pre_comment_on_post', 'secure_comment_validate', 1, 1);

/**
 * PRIVATE TOOL uses this action before insert submit field in private form
*/
add_action('tool_private_form_before_submit_field', 'secure_tool_private_form_field');

/**
 * PRIVATE TOOL uses this action during validation of private form
*/
add_filter('tool_private_form_validation', 'secure_tool_private_form_validate', 1, 1);

/**
 * CONTACTFORM7 TOOL uses this action to display captchanum field
*/
add_filter('tool_contactform7_captchanum_field', 'secure_contactform7_form_field', 1, 1);

/**
 * CONTACTFORM7 TOOL uses this action to validate captchanum field
*/
add_filter('tool_contactform7_captchanum_validatation', 'secure_contactform7_form_validate', 1, 1);

/**
 * called to generate WP login form
*/
function secure_login_form(){
	$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
	if ($failtoban_enable == 1){
		secure_failtoban_login_form();
	}
	$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
	if ($captcha_enable == 1){
		secure_captcha_login_form();
	}
}

/**
 * called to generate WooCommerce login form
 */
function secure_woocommerce_login_form(){
	$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
	if ($failtoban_enable == 1){
		secure_failtoban_woocommerce_login_form();
	}
	$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
	if ($captcha_enable == 1){
		secure_captcha_woocommerce_login_form();
	}
}

/**
 * called to generate WooCommerce checkout registration form
 */
function secure_woocommerce_checkout_registration_form(){
	$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
	if ($failtoban_enable == 1){
		secure_failtoban_woocommerce_checkout_registration_form();
	}
	$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
	if ($captcha_enable == 1){
		secure_captcha_woocommerce_checkout_registration_form();
	}
}

/**
 * called to generate WP and WooCommerce registration form
 */
function secure_register_form(){
	$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
	if ($failtoban_enable == 1){
		secure_failtoban_register_form();
	}
	$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
	if ($captcha_enable == 1){
		secure_captcha_register_form();
	}
}

/**
 * called to validate WP login form
 */
function secure_validate_login_form($args){
	$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
	if ($failtoban_enable == 1){
		secure_failtoban_validate_login_form($args);
	}
	$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
	if ($captcha_enable == 1){
		secure_captcha_validate_login_form($args);
	}
}

/**
 * called to validate WP registration form
 */
function secure_validate_register_form($errors){
	if (empty($errors)){
		$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
		if ($failtoban_enable == 1){
			$errors = secure_failtoban_validate_register_form($errors);
		}
		if (empty($errors)){
			$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
			if ($captcha_enable == 1){
				$errors = secure_captcha_validate_register_form($errors);
			}
		}
	}
	return $errors;
}

/**
 * called to validate WooCommerce login form
 */
function secure_validate_woocommerce_login_form($validation_error, $user, $password){
	if (!$validation_error->get_error_code()){
		$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
		if ($failtoban_enable == 1){
			$validation_error = secure_failtoban_validate_woocommerce_login_form($validation_error, $user, $password);
		}
		if (!$validation_error->get_error_code()){
			$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
			if ($captcha_enable == 1){
				$validation_error = secure_captcha_validate_woocommerce_login_form($validation_error, $user, $password);
			}
		}
	}
	return $validation_error;
}

/**
 * called to validate WooCommerce register form
 */
function secure_validate_woocommerce_register_form($validation_error, $user, $email){
	if (!$validation_error->get_error_code()){
		$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
		if ($failtoban_enable == 1){
			$validation_error = secure_failtoban_validate_woocommerce_register_form($validation_error, $user, $email);
		}
		if (!$validation_error->get_error_code()){
			$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
			if ($captcha_enable == 1){
				$validation_error = secure_captcha_validate_woocommerce_register_form($validation_error, $user, $email);
			}
		}
	}
	return $validation_error;
}

/**
 * called when WP constructs fields for comment form
 */
function secure_comment_form_field($fields){
	$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
	if ($failtoban_enable == 1){
		$fields = secure_failtoban_comment_form_field($fields);
	}
	$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
	if ($captcha_enable == 1){
		$fields = secure_captcha_comment_form_field($fields);
	}
	return $fields;
}

/**
 * called when WP attemps to insert new comment
 */
function secure_comment_validate($comment_post_ID){
	$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
	if ($failtoban_enable == 1){
		secure_failtoban_comment_validate($comment_post_ID);
	}
	$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
	if ($captcha_enable == 1){
		secure_captcha_comment_validate($comment_post_ID);
	}
}

/**
 * called before PRIVATE TOOL inserts submit field in private form
 */
function secure_tool_private_form_field(){
	$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
	if ($failtoban_enable == 1){
		secure_failtoban_generic_form_field();
	}
	$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
	if ($captcha_enable == 1){
		secure_captcha_generic_form_field();
	}
}

/**
 * called when PRIVATE TOOL validate private form
 */
function secure_tool_private_form_validate($errors){
	if (empty($errors)){
		$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
		if ($failtoban_enable == 1){
			$errors = secure_failtoban_generic_form_validate($errors);
		}
		if (empty($errors)){
			$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
			if ($captcha_enable == 1){
				$errors = secure_captcha_generic_form_validate("", $errors);
			}
		}
	}
	return $errors;
}

/**
 * called when CONTACTFORM7 TOOL displays captchanum field
 */
function secure_contactform7_form_field($field_name){
	$field = "";
	$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
	if ($failtoban_enable == 1){
		$field .= secure_failtoban_generic_form_field(false);
	}
	$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
	if ($captcha_enable == 1){
		$field .= secure_captcha_generic_form_field($field_name, false);
	}
	return $field;
}

/**
 * called when CONTACTFORM7 TOOL validates captchanum field
 */
function secure_contactform7_form_validate($field_name){
	$errors = array();
	$failtoban_enable = get_theme_mod(SECURE_FAILTOBAN_ACTIVE, 1);
	if ($failtoban_enable == 1){
		$errors = secure_failtoban_generic_form_validate($errors);
	}
	if (empty($errors)){
		$captcha_enable = get_theme_mod(SECURE_CAPTCHA_ACTIVE, 1);
		if ($captcha_enable == 1){
			$errors = secure_captcha_generic_form_validate($field_name, $errors);
		}
	}
	return $errors;
}

/**
 * Enqueue styles for the front end.
 */
function tool_secure_custom_front_enqueue_styles_tools($dependencies) {

	$css_secure = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-secure.css', array(CUSTOM_TOOLS_FOLDER.SECURE_TOOL_NAME.'/'));
	if (!empty($css_secure))
		wp_enqueue_style('tool-secure-css', $css_secure, $dependencies, '1.0');
}
add_action('custom_front_enqueue_styles_tools', 'tool_secure_custom_front_enqueue_styles_tools');

/**
 * Enqueue scripts for the front end.
*/
function tool_secure_custom_front_enqueue_scripts_tools($dependencies) {

	$js_tool_secure = locate_web_ressource(CUSTOM_JS_FOLDER.'tool-secure.js', array(CUSTOM_TOOLS_FOLDER.SECURE_TOOL_NAME.'/'));
	if (!empty($js_tool_secure))
		wp_enqueue_script('tool-secure-script', $js_tool_secure, $dependencies, '1.0', true);
}
add_action('custom_front_enqueue_scripts_tools', 'tool_secure_custom_front_enqueue_scripts_tools');

/**
 * Enqueue styles for the login end.
*/
function tool_secure_custom_login_enqueue_styles_tools($dependencies) {

	$css_secure = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-secure.css', array(CUSTOM_TOOLS_FOLDER.SECURE_TOOL_NAME.'/'));
	if (!empty($css_secure))
		wp_enqueue_style('tool-secure-css', $css_secure, $dependencies, '1.0');
}
add_action('custom_login_enqueue_styles_tools', 'tool_secure_custom_login_enqueue_styles_tools');

/**
 * Enqueue scripts for the login end.
*/
function tool_secure_custom_login_enqueue_scripts_tools($dependencies) {

	$js_tool_secure = locate_web_ressource(CUSTOM_JS_FOLDER.'tool-secure.js', array(CUSTOM_TOOLS_FOLDER.SECURE_TOOL_NAME.'/'));
	if (!empty($js_tool_secure))
		wp_enqueue_script('tool-secure-script', $js_tool_secure, $dependencies, '1.0', true);
}
add_action('custom_login_enqueue_scripts_tools', 'tool_secure_custom_login_enqueue_scripts_tools');