<?php
/**
 * Session manager
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

add_action('init', 'custom_session_start', 1);

/**
 * start the session, after this call the PHP $_SESSION super global is available
*/
function custom_session_start() {
	//trace_info("custom_session_start");
	if(!session_id())session_start();
}

/**
 * destroy the session
 */
function custom_session_destroy() {
	//trace_info("custom_session_destroy");
	session_destroy();
}

/**
 * get a value from the session array
 * @param type $key the key in the array
 * @param type $default the value to use if the key is not present. empty string if not present
 * @return type the value found or the default if not found
 */
function custom_session_get($key, $default='') {
	//trace_info("custom_session_get($key, $default)");
	if(isset($_SESSION[$key]))
		return $_SESSION[$key];
	return $default;
}

/**
 * set a value in the session array
 * @param type $key the key in the array
 * @param type $value the value to set
 */
function custom_session_set($key, $value) {
	//trace_info("custom_session_set($key, $value)");
	$_SESSION[$key] = $value;
}


/**
 * unset a value in the session array
 * @param type $key the key in the array
 */
function custom_session_unset($key) {
	//trace_info("custom_session_unset($key)");
	if(isset($_SESSION[$key]))
		unset($_SESSION[$key]);
}
