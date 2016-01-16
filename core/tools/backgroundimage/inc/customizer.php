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

if (!function_exists("backgroundimage_get_url")):
/**
 * retrieve backgroundimage url
* @param string $id_post - current post if null
*/
function backgroundimage_get_url($id_post = null){
	$url_backgroundimage = "";
	if (empty($id_post) || !is_numeric($id_post)){
		$_queried_post = get_queried_object();
		$id_post = $_queried_post->ID;
		if (is_home()){ // blog page
			$id_post = get_option('page_for_posts');
		}
	}
	if ($id_post && (is_single() || is_page() || is_home())){
		$url_backgroundimage = get_post_meta($id_post, BACKGROUNDIMAGE_URL, true);
	}
	if (empty($url_backgroundimage)){
		$url_backgroundimage = get_theme_mod('backgroundimage_image');
	}

	return $url_backgroundimage;
}
endif;

if (!function_exists("backgroundimage_is_default")):
/**
 * retrieve backgroundimage url
* @param string $id_post - current post if null
*/
function backgroundimage_is_default($id_post = null){
	$default = true;
	if (empty($id_post) || !is_numeric($id_post)){
		$_queried_post = get_queried_object();
		$id_post = $_queried_post->ID;
		if (is_home()){ // blog page
			$id_post = get_option('page_for_posts');
		}
	}
	// background image
	if ($id_post && (is_single() || is_page() || is_home())){
		if (!empty(get_post_meta($id_post, BACKGROUNDIMAGE_URL, true))){
			$default = false;
		}
	}
	return $default;
}
endif;

if (!function_exists("backgroundimage_get_color")):
/**
 * retrieve backgroundimage color
* @param string $id_post - current post if null
*/
function backgroundimage_get_color($id_post = null){
	$background_color_code = "";
	if (empty($id_post) || !is_numeric($id_post)){
		$_queried_post = get_queried_object();
		$id_post = $_queried_post->ID;
		if (is_home()){ // blog page
			$id_post = get_option('page_for_posts');
		}
	}
	if ($id_post && (is_single() || is_page() || is_home())){
		$background_color_code = get_post_meta($id_post, BACKGROUNDCOLOR_CODE, true);
		if (!empty($background_color_code)){
			$background_color_code = hex_to_rgb($background_color_code, true);
		}
	}
	return $background_color_code;
}
endif;

if (!function_exists("backgroundimage_get_color_opacity")):
/**
 * retrieve backgroundimage color's opacity
* @param string $id_post - current post if null
*/
function backgroundimage_get_color_opacity($id_post = null){
	$background_color_opacity = "";
	if (empty($id_post) || !is_numeric($id_post)){
		$_queried_post = get_queried_object();
		$id_post = $_queried_post->ID;
		if (is_home()){ // blog page
			$id_post = get_option('page_for_posts');
		}
	}
	if ($id_post && (is_single() || is_page() || is_home())){
		$background_color_opacity = get_post_meta($id_post, BACKGROUNDCOLOR_OPACITY, true);
	}
	if (empty($background_color_opacity))
		$background_color_opacity = 0;
	if ($background_color_opacity == 100){
		$background_color_opacity = "1";
	}else{
		$background_color_opacity = "0.".$background_color_opacity;
	}
	return $background_color_opacity;
}
endif;

if (!function_exists("backgroundimage_display")):
/**
 * add background image div before #page element
*/
function backgroundimage_display(){
	$_queried_post = get_queried_object();
	$id_post = $_queried_post->ID;
	if (is_home()){ // blog page
		$id_post = get_option('page_for_posts');
	}

	// background image
	$url_backgroundimage = backgroundimage_get_url($id_post);

	// background color
	$background_color_code = backgroundimage_get_color($id_post);
	
	// background color opacity
	$background_color_opacity = backgroundimage_get_color_opacity($id_post);

	// default ?
	$class = "";
	if (backgroundimage_is_default($id_post))
		$class = "default";

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
add_action('custom_html_before_page', 'backgroundimage_display');
endif;
