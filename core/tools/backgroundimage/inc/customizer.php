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

if (!function_exists("backgroundimage_custom_html_before_page")):
/**
 * add background image div before #page element
*/
function backgroundimage_custom_html_before_page(){
	$_queried_post = get_queried_object();
	$id_post = $_queried_post->ID;
	if (is_home()){ // blog page
		$id_post = get_option('page_for_posts');
	}

	// background image
	$url_backgroundimage = "";
	$class = "";
	if ($id_post && (is_single() || is_page() || is_home())){
		$url_backgroundimage = get_post_meta($id_post, BACKGROUNDIMAGE_URL, true);
	}
	if (empty($url_backgroundimage)){
		$class = "default";
		$url_backgroundimage = get_theme_mod('backgroundimage_image');
	}

	// background color
	$background_color_code = "";
	$background_color_opacity = "";
	if ($id_post && (is_single() || is_page() || is_home())){
		$background_color_code = get_post_meta($id_post, BACKGROUNDCOLOR_CODE, true);
		$background_color_opacity = get_post_meta($id_post, BACKGROUNDCOLOR_OPACITY, true);
	}

	if (!empty($background_color_code)){
		$background_color_code = hex_to_rgb($background_color_code, true);
		if (empty($background_color_opacity))
			$background_color_opacity = 0;
		if ($background_color_opacity == 100){
			$background_color_opacity = "1";
		}else{
			$background_color_opacity = "0.".$background_color_opacity;
		}
	}

	if (!empty($url_backgroundimage)){
		?>
<div id="tool-backgroundimage" class="<?php echo $class; ?>" style="background: url('<?php echo $url_backgroundimage; ?>') no-repeat center center fixed;
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
			z-index: -100;">
	<?php
	if (!empty($background_color_code)){
?>
	<div id="tool-backgroundimage-color"
		style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(<?php echo $background_color_code; ?>, <?php echo $background_color_opacity; ?>);"></div>
	<?php } ?>
</div>
<?php
	}else if (!empty($background_color_code)){
		?>
<div id="tool-backgroundimage-color"
		style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(<?php echo $background_color_code; ?>, <?php echo $background_color_opacity; ?>); z-index: -100;"></div>
<?php
	}
}
add_action('custom_html_before_page', 'backgroundimage_custom_html_before_page');
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
	background: url("<?php echo $url_backgroundimage; ?>") no-repeat center
		center fixed;
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

