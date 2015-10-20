<?php

/**
 * Securize Wordpress
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * remove WP version of HTML code source
 */
remove_action("wp_head", "wp_generator");

/**
 * remove explicit messages from wrong connexion
 */
add_filter('login_errors', create_function('$a', "return null;"));

/**
 * Desactivate file edition from WP Admin
 */
define('DISALLOW_FILE_EDIT', true);