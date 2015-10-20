<?php
/**
 * GALLERY Customizer
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Add GALLERY fields for the Customizer.
 *
 * @since Custom GALLERY 1.0
 *
 * @param WP_Customize_Manager $wp_customize_manager Customizer object.
 */
function gallery_customize_register($wp_customize_manager) {

	// ------ background section
	$wp_customize_manager->add_section('gallery_customizer', array(
			'title' => __( 'FancyBox', CUSTOM_TEXT_DOMAIN),
	) );

	// background image
	$wp_customize_manager->add_setting('gallery_fancybox_state', array('type' => 'theme_mod', 'transport'=>'refresh'));
	$wp_customize_manager->add_control('gallery_fancybox_state',	array(
			'type' => 'checkbox',
			'label' => __('Disable', CUSTOM_TEXT_DOMAIN),
			'description' => __('disable fancybox on this site', CUSTOM_TEXT_DOMAIN),
			'section' => 'gallery_customizer',
			'settings'   => 'gallery_fancybox_state',
	)
	);

}
add_action('customize_register', 'gallery_customize_register');