<?php
/**
 * WooCommerce Tool (plugin's supports - http://docs.woothemes.com/document/third-party-custom-theme-compatibility/)
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('WOOCOMMERCE_TOOL_NAME', 'woocommerce');

/**
 * SUPPORTS
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'custom_woocommerce_support_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'custom_woocommerce_support_wrapper_end', 10);
function custom_woocommerce_support_wrapper_start() {
	echo '<section id="main">';
}
function custom_woocommerce_support_wrapper_end() {
	echo '</section>';
}
add_action('custom_after_setup_theme', 'custom_woocommerce_support_after_setup_theme');
function custom_woocommerce_support_after_setup_theme() {
    add_theme_support('woocommerce');
}