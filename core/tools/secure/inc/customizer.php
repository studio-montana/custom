<?php
/**
 * SECURE Customizer
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('SECURE_CAPTCHA_ACTIVE', 'secure-captcha-active');
define('SECURE_FAILTOBAN_ACTIVE', 'secure-failtoban-active');

/**
 * Add SECURE fields for the Customizer.
 *
 * @since Custom SECURE 1.0
 *
 * @param WP_Customize_Manager $wp_customize_manager Customizer object.
 */
function secure_customize_register($wp_customize_manager) {

	// ------ secure
	$wp_customize_manager->add_section('secure_customizer', array(
			'title' => __( 'Security', CUSTOM_TEXT_DOMAIN ),
	) );

	// secure captcha
	$wp_customize_manager->add_setting(SECURE_CAPTCHA_ACTIVE, array('default' => 1, 'type' => 'theme_mod', 'transport'=>'refresh'));
	$wp_customize_manager->add_control(SECURE_CAPTCHA_ACTIVE,	array(
			'type' => 'checkbox',
			'label' => __('Activate captcha', CUSTOM_TEXT_DOMAIN ),
			'description' => __('add captcha on login, register and comment forms (Woocommerce supported)', CUSTOM_TEXT_DOMAIN ),
			'section' => 'secure_customizer',
			'settings'   => SECURE_CAPTCHA_ACTIVE,
	)
	);

	// secure failtoban
	$wp_customize_manager->add_setting(SECURE_FAILTOBAN_ACTIVE, array('default' => 1, 'type' => 'theme_mod', 'transport'=>'refresh'));
	$wp_customize_manager->add_control(SECURE_FAILTOBAN_ACTIVE,	array(
			'type' => 'checkbox',
			'label' => __('Activate failtoban', CUSTOM_TEXT_DOMAIN ),
			'description' => __('block gross power hacking on login, register and comment forms (Woocommerce supported)', CUSTOM_TEXT_DOMAIN ),
			'section' => 'secure_customizer',
			'settings'   => SECURE_FAILTOBAN_ACTIVE,
	)
	);

}
add_action('customize_register', 'secure_customize_register');

