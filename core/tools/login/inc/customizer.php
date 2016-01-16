<?php
/**
 * LOGIN Customizer
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Add LOGIN fields for the Customizer.
 *
 * @since Custom LOGIN 1.0
 *
 * @param WP_Customize_Manager $wp_customize_manager Customizer object.
 */
function login_customize_register($wp_customize_manager) {

	// ------ login section
	$wp_customize_manager->add_section('login_customizer', array(
			'title' => __( 'Login options', CUSTOM_TEXT_DOMAIN ),
	) );

	// login background
	$wp_customize_manager->add_setting('login_backgroundimage', array());
	$wp_customize_manager->add_control(
			new WP_Customize_Image_Control(
					$wp_customize_manager,
					'login_backgroundimage',
					array(
							'label'      => __('Background image', CUSTOM_TEXT_DOMAIN),
							'section'    => 'login_customizer',
							'settings'   => 'login_backgroundimage'
					)
			)
	);

}
add_action('customize_register', 'login_customize_register');



