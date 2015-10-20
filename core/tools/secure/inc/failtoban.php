<?php
/**
 * SECURE : failtoban
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('SECURE_FAILTOBAN_FIELD', 'secure-failtoban-field');

/**
 * called to generate WP login form
*/
function secure_failtoban_login_form(){
	echo secure_failtoban_generate_field();
}

/**
 * called to generate WooCommerce login form
 */
function secure_failtoban_woocommerce_login_form(){
	echo secure_failtoban_generate_field();
}

/**
 * called to generate WooCommerce checkout registration form
 */
function secure_failtoban_woocommerce_checkout_registration_form(){
	echo secure_failtoban_generate_field();
}

/**
 * called to generate WP and WooCommerce registration form
 */
function secure_failtoban_register_form(){
	echo secure_failtoban_generate_field();
}

/**
 * called to validate WP login form
 */
function secure_failtoban_validate_login_form($args){
	if (isset($_POST['log']) && isset($_POST['pwd'])){
		if (secure_is_failtoban()){
			header('Location: '.get_current_url(true));
			exit;
		}
	}
}

/**
 * called to validate WP registration form
 */
function secure_failtoban_validate_register_form($errors){
	if (isset($_POST['user_login']) && isset($_POST['user_email'])){
		if (secure_is_failtoban()){
			$errors->add('faltoban-error', "<strong>".__("ERROR", CUSTOM_TEXT_DOMAIN)." : </strong>".__("invalid captcha", CUSTOM_TEXT_DOMAIN));
		}
	}
	return $errors;
}

/**
 * called to validate WooCommerce login form
 */
function secure_failtoban_validate_woocommerce_login_form($validation_error, $user, $password){
	if (secure_is_failtoban()){
		$validation_error = new WP_Error('faltoban-error', __("Too many tries - please wait 1min", CUSTOM_TEXT_DOMAIN));
	}
	return $validation_error;
}

/**
 * called to validate WooCommerce register form
 */
function secure_failtoban_validate_woocommerce_register_form($validation_error, $user, $email){
	if (secure_is_failtoban()){
		$validation_error = new WP_Error('faltoban-error', __("Too many tries - please wait 1min", CUSTOM_TEXT_DOMAIN));
	}
	return $validation_error;
}

/**
 * called when WP constructs fields for comment form
 */
function secure_failtoban_comment_form_field($fields){
	$fields[SECURE_FAILTOBAN_FIELD.'-comment'] = secure_failtoban_generate_field();
	return $fields;
}

/**
 * called when WP attemps to insert new comment
 */
function secure_failtoban_comment_validate($comment_post_ID){
	if (secure_is_failtoban()){
		wp_die(__('<strong>ERROR</strong>: Too many tries - please wait 1min', CUSTOM_TEXT_DOMAIN), 200);
	}
}

/**
 * generic form field
 */
function secure_failtoban_generic_form_field($display = true){
	$field = secure_failtoban_generate_field();
	if ($display)
		echo $field;
	else
		return $field;
}

/**
 * generic form validation
 */
function secure_failtoban_generic_form_validate($errors){
	if (secure_is_failtoban()){
		$errors[] = new WP_Error('failtoban-error', __("Too many tries - please wait 1min", CUSTOM_TEXT_DOMAIN));
	}
	return $errors;
}

/**
 * generate failtoban field
 */
function secure_failtoban_generate_field(){
	$field = "";
	$error = custom_session_get('failtoban-error', "");
	if (!empty($error))
		$field .= '<p class="error failtoban-error">'.$error.'</p>';
	return $field;
}

/**
 * analyse request and determine if failed to ban
 */
function secure_is_failtoban(){
	$failedtoban = false;
	$timestamp = time();
	$last_failtoban_time = custom_session_get("secure-last-failtoban-time", null);
	$last_login_time = custom_session_get("secure-last-login-time", null);
	$nb_try_login = custom_session_get("secure-nb-try-login", null);
	if (!empty($last_failtoban_time) && ($timestamp - $last_failtoban_time) < 60){
		$failedtoban = true; // failtoban must wait 1min.
		custom_session_set("secure-last-failtoban-time", $timestamp);
		custom_session_unset("secure-last-login-time");
		custom_session_unset("secure-nb-try-login");
	}else{
		custom_session_unset("secure-last-failtoban-time");
		if (!empty($last_login_time)){
			if ($nb_try_login > 9){ // more than 10 tries in 1min.
				if (($timestamp - $last_login_time) < 60){ // more than 10 tries in 1min. => failtoban
					$failedtoban = true;
					custom_session_set("secure-last-failtoban-time", $timestamp);
					custom_session_unset("secure-last-login-time");
					custom_session_unset("secure-nb-try-login");
				}else{ // reset
					custom_session_set("secure-last-login-time", $timestamp);
					custom_session_set("secure-nb-try-login", 1);
				}
			}else{ // increment try login
				custom_session_set("secure-nb-try-login", ($nb_try_login+1));
			}
		}else{ // reset
			custom_session_set("secure-last-login-time", $timestamp);
			custom_session_set("secure-nb-try-login", 1);
		}
	}
	if (!$failedtoban)
		custom_session_set('failtoban-error', "");
	else
		custom_session_set('failtoban-error', __("Too many tries - please wait 1min", CUSTOM_TEXT_DOMAIN));
	return $failedtoban;
}