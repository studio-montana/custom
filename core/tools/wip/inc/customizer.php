<?php
/**
 * WIP Customizer
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Add WIP fields for the Customizer.
 *
 * @since Custom WIP 1.0
 *
 * @param WP_Customize_Manager $wp_customize_manager Customizer object.
 */
function wip_customize_register($wp_customize_manager) {

	// ------ background section
	$wp_customize_manager->add_section('wip_customizer', array(
			'title' => __( 'Work In Progress', CUSTOM_TEXT_DOMAIN ),
	) );

	// background image
	$wp_customize_manager->add_setting('wip_state', array('type' => 'theme_mod', 'transport'=>'refresh'));
	$wp_customize_manager->add_control('wip_state',	array(
			'type' => 'checkbox',
			'label' => __('Active', CUSTOM_TEXT_DOMAIN ),
			'description' => __('only logged in user can look you site', CUSTOM_TEXT_DOMAIN ),
			'section' => 'wip_customizer',
			'settings'   => 'wip_state',
	)
	);

}
add_action('customize_register', 'wip_customize_register');

if (!function_exists("wip_template_include")):
/**
 * template_include filter (allow to override template hierarchy)
* @since WIP 1.0
* @return template path
*/
function wip_template_include($template) {
	$wip_template = '';
	if (!is_user_logged_in()){
		$wip = get_theme_mod('wip_state');
		if (!empty($wip) && $wip == 1){
			$wip_template = locate_ressource("tool-wip-page.php", array(CUSTOM_TOOLS_FOLDER.WIP_TOOL_NAME.'/templates/'));
		}
	}
	if (!empty($wip_template))
		return $wip_template;
	else
		return $template;
}
add_filter('template_include', 'wip_template_include', 2000); // more than private tool (1000)
endif;

