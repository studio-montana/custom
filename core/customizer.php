<?php
/**
 * Custom cutomizer
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Add Custom's fields setup for the Customizer.
 *
 * @since Custom SEO 1.0
 *
 * @param WP_Customize_Manager $wp_customize_manager Customizer object.
 */
function custom_customize_register($wp_customize_manager) {
	// ------ setup section
	$wp_customize_manager->add_section('custom_customizer', array(
			'title' => 'Various'
	) );

	// copyright
	$wp_customize_manager->add_setting('custom_copyright', array('type' => 'theme_mod', 'default'	=> "&copy; ".date('Y'), 'transport'=>'postMessage'));
	$wp_customize_manager->add_control('custom_copyright', array(
			'label'		=> __('Copyright', CUSTOM_TEXT_DOMAIN ),
			'section'	=> 'custom_customizer',
			'settings'	=> 'custom_copyright',
	));

	// comments
	$wp_customize_manager->add_setting('custom_comments', array('type' => 'theme_mod', 'transport'=>'postMessage'));
	$wp_customize_manager->add_control('custom_comments', array(
			'label'      => __('Enable comments', CUSTOM_TEXT_DOMAIN ),
			'section'    => 'custom_customizer',
			'settings'   => 'custom_comments',
			'type' => 'checkbox',
	));
}
add_action('customize_register', 'custom_customize_register');