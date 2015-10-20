<?php
/**
 * GALLERY Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('GALLERY_TOOL_NAME', 'gallery');

/**
 * REQUIREMENTS
*/
require_once (locate_template(CUSTOM_TOOLS_FOLDER.GALLERY_TOOL_NAME.'/custom-fields/gallery.php'));
require_once (locate_template(CUSTOM_TOOLS_FOLDER.GALLERY_TOOL_NAME.'/inc/customizer.php'));

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Custom 1.0
 * @return void
*/
function tool_gallery_scripts_styles() {

	// load gallery's css
	$css_gallery = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-gallery.css', array(CUSTOM_TOOLS_FOLDER.GALLERY_TOOL_NAME.'/'));
	if (!empty($css_gallery))
		wp_enqueue_style('tool-gallery-css', $css_gallery, array(), '1.0');

	// load gallery's fancybox javascript
	$js_tool_gallery_fancybox = locate_web_ressource(CUSTOM_JS_FOLDER.'tool-gallery-fancybox.js', array(CUSTOM_TOOLS_FOLDER.GALLERY_TOOL_NAME.'/'));
	if (!empty($js_tool_gallery_fancybox))
		wp_enqueue_script('tool-gallery-script-fancybox', $js_tool_gallery_fancybox, array('jquery', 'custom-script-fancybox'), '1.0', true);

	// load gallery's fancybox css
	$css_gallery_fancybox = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-gallery-fancybox.css', array(CUSTOM_TOOLS_FOLDER.GALLERY_TOOL_NAME.'/'));
	if (!empty($css_gallery_fancybox))
		wp_enqueue_style('tool-gallery-css-fancybox', $css_gallery_fancybox, array('custom-css-fancybox'), '1.0');
}
add_action('wp_enqueue_scripts', 'tool_gallery_scripts_styles');

/**
 * called after custom_setup_theme core function
*/
function tool_gallery_setup_theme_action(){

	// gallery image sizes
	add_image_size('tool-gallery-thumb', 500);
	add_image_size('tool-gallery-slider-nav-thumb', 150, 150, true);

	// can be override
	do_action('after_tool_gallery_setup_theme_action');

}
add_action("custom_after_setup_theme", "tool_gallery_setup_theme_action");
