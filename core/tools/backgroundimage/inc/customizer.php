<?php
/**
 * BACKGROUNDIMAGE Customizer
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Add BACKGROUNDIMAGE fields for the Customizer.
 *
 * @since Custom BACKGROUNDIMAGE 1.0
 *
 * @param WP_Customize_Manager $wp_customize_manager Customizer object.
 */
function backgroundimage_customize_register($wp_customize_manager) {
	// ------ background section
	$wp_customize_manager->add_section('backgroundimage_customizer', array(
			'title' => __( 'Background Image', CUSTOM_TEXT_DOMAIN ),
	) );

	// background image
	$wp_customize_manager->add_setting('backgroundimage_image', array('transport'=>'refresh'));
	$wp_customize_manager->add_control(
			new WP_Customize_Image_Control(
					$wp_customize_manager,
					'custom_background_image',
					array(
							'label'      => __('Background image', CUSTOM_TEXT_DOMAIN),
							'section'    => 'backgroundimage_customizer',
							'settings'   => 'backgroundimage_image'
					)
			)
	);
}
add_action('customize_register', 'backgroundimage_customize_register');

if (!function_exists("backgroundimage_wp_head")):
/**
 * custom_customizer_wp_head
*/
function backgroundimage_wp_head(){
	
	$url_backgroundimage = "";
	$_queried_post = get_queried_object();
	if ($_queried_post && (is_single() || is_page())){
		$url_backgroundimage = get_post_meta($_queried_post->ID, BACKGROUNDIMAGE_URL, true);
	}
	if (empty($url_backgroundimage)){
		$url_backgroundimage = get_theme_mod('backgroundimage_image');
	}
	
	if (!empty($url_backgroundimage)){
		?>
<style>
body {
	background:
		url("<?php echo $url_backgroundimage; ?>")
		no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	-ms-background-size: cover;
	background-size: cover;
}
</style>
<?php
	}
}
add_action('wp_head', 'backgroundimage_wp_head');
endif;

if (!function_exists("backgroundimage_login_head")):
/**
 * custom_customizer_wp_head
*/
function backgroundimage_login_head(){
	
	$url_backgroundimage = get_theme_mod('backgroundimage_image');
	if (!empty($url_backgroundimage)){
		?>
<style>
html {
	background:
		url("<?php echo $url_backgroundimage; ?>")
		no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	-ms-background-size: cover;
	background-size: cover;
}
</style>
<?php
	}
}
add_action('login_head', 'backgroundimage_login_head');
endif;

