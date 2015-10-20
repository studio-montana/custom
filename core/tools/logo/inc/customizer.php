<?php
/**
 * LOGO Customizer
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Add LOGO fields for the Customizer.
 *
 * @since Custom LOGO 1.0
 *
 * @param WP_Customize_Manager $wp_customize_manager Customizer object.
 */
function logo_customize_register($wp_customize_manager) {
	// ------ background section
	$wp_customize_manager->add_section('logo_customizer', array(
			'title' => __( 'Logo', CUSTOM_TEXT_DOMAIN ),
	) );

	// logo
	$wp_customize_manager->add_setting('logo_image', array('transport'=>'refresh'));
	$wp_customize_manager->add_control(
			new WP_Customize_Image_Control(
					$wp_customize_manager,
					'custom_logo',
					array(
							'section'    => 'logo_customizer',
							'settings'   => 'logo_image'
					)
			)
	);
}
add_action('customize_register', 'logo_customize_register');

if (!function_exists("logo_has")):
/**
 * @return true if has defined logo, false otherwise
 */
function logo_has(){
	$url_logo = get_theme_mod('logo_image');
	return !empty($url_logo);
}
endif;

if (!function_exists("logo_display")):
/**
 * display img html tag to show logo
 * @param array $attrs : attributes to put in img tag (key : attribute name - value : attribute value)
 */
function logo_display($attrs = array()){
	$url_logo = get_theme_mod('logo_image');
	$img = '';
	if (!empty($url_logo)){
		$img .= '<img src="'.$url_logo.'"';
		foreach ($attrs as $k => $v){
			$img .= ' '.$k.'="'.$v.'"';
		}
		$img .= ' />';
	}
	echo $img;
}
endif;

