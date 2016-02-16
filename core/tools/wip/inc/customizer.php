<?php
/**
 * @package Custom
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * License: GPL2
 * Text Domain: custom
 * 
 * Copyright 2016 Sébastien Chandonay (email : please contact me from my website)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
defined('ABSPATH') or die("Go Away!");

/**
 * Add WIP fields for the Customizer.
 *
 * @since Custom WIP 1.0
 *
 * @param WP_Customize_Manager $wp_customize_manager Customizer object.
 */
function wip_customize_register($wp_customize_manager) {

	// ------ wip section
	$wp_customize_manager->add_section('wip_customizer', array(
			'title' => __( 'Work In Progress', CUSTOM_PLUGIN_TEXT_DOMAIN ),
	) );

	// wip active
	$wp_customize_manager->add_setting('wip_state', array('type' => 'theme_mod'));
	$wp_customize_manager->add_control('wip_state',	array(
			'type' => 'checkbox',
			'label' => __('Active', CUSTOM_PLUGIN_TEXT_DOMAIN ),
			'description' => __('only logged in user can look you site', CUSTOM_PLUGIN_TEXT_DOMAIN ),
			'section' => 'wip_customizer',
			'settings'   => 'wip_state',
	)
	);

	// wip message
	$wp_customize_manager->add_setting('wip_message', array('type' => 'theme_mod'));
	$wp_customize_manager->add_control('wip_message', array(
			'label'      => __('Message', CUSTOM_PLUGIN_TEXT_DOMAIN ),
			'section'    => 'wip_customizer',
			'settings'   => 'wip_message',
	));

	// wip background
	$wp_customize_manager->add_setting('wip_backgroundimage', array());
	$wp_customize_manager->add_control(
			new WP_Customize_Image_Control(
					$wp_customize_manager,
					'wip_backgroundimage',
					array(
							'label'      => __('Background image', CUSTOM_PLUGIN_TEXT_DOMAIN),
							'section'    => 'wip_customizer',
							'settings'   => 'wip_backgroundimage'
					)
			)
	);

}
add_action('customize_register', 'wip_customize_register');

/**
 * check if wip mode is active
 * @return boolean
*/
function tool_wip_is_wip(){
	$wip = get_theme_mod('wip_state');
	if (!is_user_logged_in() && !empty($wip) && $wip == 1){
		return true;
	}
	return false;
}

if (!function_exists("wip_template_include")):
/**
 * template_include filter (allow to override template hierarchy)
* @since WIP 1.0
* @return template path
*/
function wip_template_include($template) {
	$wip_template = '';
	if (tool_wip_is_wip()){
		$wip_template = locate_ressource(CUSTOM_PLUGIN_TOOLS_FOLDER.WIP_TOOL_NAME.'/templates/tool-wip-page.php');
	}
	if (!empty($wip_template))
		return $wip_template;
	else
		return $template;
}
add_filter('template_include', 'wip_template_include', 2000); // more than private tool (1000)
endif;

if (!function_exists("tool_wip_custom_front_enqueue_styles_tools")):
/**
 * Enqueue styles for the front end.
*/
function tool_wip_custom_front_enqueue_styles_tools($dependencies) {
	if (tool_wip_is_wip()){
		$css_wip = locate_web_ressource(CUSTOM_PLUGIN_TOOLS_FOLDER.WIP_TOOL_NAME.'/css/tool-wip.css');
		if (!empty($css_wip))
			wp_enqueue_style('tool-wip-css', $css_wip, $dependencies, '1.0');
	}
}
add_action('custom_front_enqueue_styles_tools', 'tool_wip_custom_front_enqueue_styles_tools');
endif;

if (!function_exists("tool_wip_display_background")):
/**
 * add background image div before #page element
*/
function tool_wip_display_background(){
	$url_background = get_theme_mod('wip_backgroundimage');
	if (!empty($url_background)){
		?>
<div id="tool-wip-background" class="<?php echo $class; ?>" style="background: url('<?php echo $url_background; ?>') no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			-ms-background-size: cover;
			background-size: cover;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: -100;"></div>
<?php
	}
}
add_action('custom_html_before_wip_page', 'tool_wip_display_background');
endif;

