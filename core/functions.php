<?php
/**
 * Custom functions and definitions
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Constantes
 */
define('CUSTOM_THEME_NAME', 'Custom');
define('CUSTOM_TEXT_DOMAIN', 'custom');
define('CUSTOM_OPTIONS_NAME', 'custom_options');

define('CUSTOM_CORE_FOLDER', 'core/');
define('CUSTOM_TEMPLATES_FOLDER', 'core/templates/');
define('CUSTOM_TOOLS_FOLDER', 'core/tools/');
define('CUSTOM_CSS_FOLDER', 'css/');
define('CUSTOM_JS_FOLDER', 'js/');
define('CUSTOM_LANG_FOLDER', 'lang/');

/**
 * Github Support
 */
define('GITHUB_UPDATER_EXTENDED_NAMING', true);

/**
 * Remove generator tag from html source code
*/
remove_action('wp_head', 'wp_generator');

/**
 * Custom setup.
 *
 * @return void
*/
function custom_setup() {

	do_action("custom_before_setup_theme");

	/*
	 * Config (doit être appeler avant tout autre chose)
	*/
	require_once (locate_template('/'.CUSTOM_CORE_FOLDER.'config.php'));

	/*
	 * Utils
	*/
	require_once (locate_template('/'.CUSTOM_CORE_FOLDER.'session.php'));
	require_once (locate_template('/'.CUSTOM_CORE_FOLDER.'comparators.php'));
	require_once (locate_template('/'.CUSTOM_CORE_FOLDER.'utils.php'));
	require_once (locate_template('/'.CUSTOM_CORE_FOLDER.'utils.secure.php'));

	/*
	 * templates
	*/
	require_once (locate_template('/'.CUSTOM_CORE_FOLDER.'templates.php'));

	/*
	 * custom fields
	*/
	require_once (locate_template('/'.CUSTOM_CORE_FOLDER.'custom-fields.php'));

	/*
	 * Tools
	*/
	require_once (locate_template('/'.CUSTOM_CORE_FOLDER.'tools.php'));

	/*
	 * Theme Customizer
	*/
	require_once (locate_template('/'.CUSTOM_CORE_FOLDER.'customizer.php'));

	/*
	 * Makes Custom available for translation.
	*/
	load_theme_textdomain(CUSTOM_TEXT_DOMAIN, get_template_directory() . '/'.CUSTOM_LANG_FOLDER);

	/*
	 * Adds RSS feed links to <head> for posts and comments.
	*/
	add_theme_support('automatic-feed-links');

	/*
	 * Switches default core markup for search form, comment form, and comments to output valid HTML5.
	*/
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list') );

	/*
	 * This theme supports all available post formats by default. See http://codex.wordpress.org/Post_Formats
	*/
	add_theme_support('post-formats', array());

	/*
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menu('primary', __('Main menu', CUSTOM_TEXT_DOMAIN) );

	/*
	 * This theme uses a custom image size for featured images, displayed on "standard" posts and pages.
	*/
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(1200, 250, true);

	do_action("custom_after_setup_theme");
}
add_action('after_setup_theme', 'custom_setup');

/**
 * Custom init
 *
 * @return void
*/
function custom_init(){
	do_action("custom_before_init");
	do_action("custom_after_init");
}
add_action('init','custom_init');

/**
 * Enqueue scripts and styles for the front end.
 *
 * @return void
*/
function custom_scripts_styles() {

	// Loads parts stylesheets
	// -- bxslider
	$css_bxslider = locate_web_ressource(CUSTOM_JS_FOLDER.'bxslider/jquery.bxslider.css');
	if (!empty($css_bxslider)){
		wp_enqueue_style('custom-css-bxslider', $css_bxslider, array(), '2.1.1');
	}
	// -- fancybox
	$css_fancybox = locate_web_ressource(CUSTOM_JS_FOLDER.'fancybox/jquery.fancybox.css');
	if (!empty($css_fancybox)){
		wp_enqueue_style('custom-css-fancybox', $css_fancybox, array('custom-css-bxslider'), '2.1.5');
	}

	// Loads core stylesheets
	// -- knacss
	$css_knacss = locate_web_ressource(CUSTOM_CSS_FOLDER.'custom-knacss.css');
	if (!empty($css_knacss))
		wp_enqueue_style('custom-core-knacss-style', $css_knacss, array('custom-css-fancybox'), '1.0');
	
	// Action for stylesheets tools
	do_action("custom_front_enqueue_styles_tools", array("custom-core-knacss-style"));
	
	// Other core stylesheets
	// -- isotope
	$css_isotope = locate_web_ressource(CUSTOM_CSS_FOLDER.'custom-isotope.css');
	if (!empty($css_isotope))
		wp_enqueue_style('custom-core-isotope-style', $css_isotope, array('custom-core-knacss-style'), '1.0');
	// -- slider
	$css_slider = locate_web_ressource(CUSTOM_CSS_FOLDER.'custom-slider.css');
	if (!empty($css_slider))
		wp_enqueue_style('custom-core-slider-style', $css_slider, array('custom-core-isotope-style'), '1.0');
	// -- templates
	$css_templates = locate_web_ressource(CUSTOM_CSS_FOLDER.'custom-templates.css');
	if (!empty($css_templates))
		wp_enqueue_style('custom-core-templates-style', $css_templates, array('custom-core-slider-style'), '1.0');
	// -- style
	wp_enqueue_style('custom-core-style', get_template_directory_uri()."/".CUSTOM_TEMPLATES_FOLDER.CUSTOM_CSS_FOLDER."custom-style.css", array('custom-core-templates-style'), '1.0');

	// Loads theme stylesheet
	wp_enqueue_style('custom-style', get_stylesheet_uri(), array('custom-core-style'), '1.0');
	
	// Loads Internet Explorer specific stylesheet
	$css_ie = locate_web_ressource(CUSTOM_CSS_FOLDER.'custom-ie.css');
	if (!empty($css_ie)){
		wp_enqueue_style('custom-ie', $css_ie, array('custom-style'), '1.0');
		wp_style_add_data('custom-ie', 'conditional', 'lt IE 9');
	}

	// Loads Cookies jQuery plugin
	$js_cookies = locate_web_ressource(CUSTOM_JS_FOLDER.'cookies/jquery.cookie.js');
	if (!empty($js_cookies))
		wp_enqueue_script('custom-script-cookies', $js_cookies, array('jquery'), '1.4.1', true);

	// Loads Isotope JavaScript file
	$js_isotope = locate_web_ressource(CUSTOM_JS_FOLDER.'isotope/isotope.pkgd.min.js');
	if (!empty($js_isotope))
		wp_enqueue_script('custom-script-isotope', $js_isotope, array('jquery'), '2.1.1', true);

	// Loads BxSlider JavaScript file
	$js_bxslider = locate_web_ressource(CUSTOM_JS_FOLDER.'bxslider/jquery.bxslider.min.js');
	if (!empty($js_bxslider))
		wp_enqueue_script('custom-script-bxslider', $js_bxslider, array('jquery'), '2.1.1', true);

	// Loads Fancybox JavaScript file
	$js_fancybox = locate_web_ressource(CUSTOM_JS_FOLDER.'fancybox/jquery.fancybox.pack.js');
	if (!empty($js_fancybox))
		wp_enqueue_script('custom-script-fancybox', $js_fancybox, array('jquery'), '2.1.5', true);

	// Loads Utils JavaScript file
	$js_utils = locate_web_ressource(CUSTOM_JS_FOLDER.'custom-utils.js');
	if (!empty($js_utils))
		wp_enqueue_script('custom-script-custom-utils', $js_utils, array('jquery'), '1.0', true);
	
	// Action for javascripts tools
	do_action("custom_front_enqueue_scripts_tools", array("custom-script-custom-utils"));

	// Loads Functions JavaScript file
	$js_functions = locate_web_ressource(CUSTOM_JS_FOLDER.'custom-functions.js');
	if (!empty($js_functions))
		wp_enqueue_script('custom-script-custom-functions', $js_functions, array('jquery'), '1.0', true);

	// Loads Gallery Matrix JavaScript file
	$js_gallery_matrix = locate_web_ressource(CUSTOM_JS_FOLDER.'custom-gallery-matrix.js');
	if (!empty($js_gallery_matrix))
		wp_enqueue_script('custom-script-custom-gallery-matrix', $js_gallery_matrix, array('jquery'), '1.0', true);

	// Loads Gallery JavaScript file
	$js_gallery = locate_web_ressource(CUSTOM_JS_FOLDER.'custom-gallery.js');
	if (!empty($js_gallery))
		wp_enqueue_script('custom-script-custom-gallery', $js_gallery, array('jquery', 'custom-script-custom-gallery-matrix'), '1.0', true);

	// Loads slider JavaScript file
	$js_slider = locate_web_ressource(CUSTOM_JS_FOLDER.'custom-slider.js');
	if (!empty($js_slider))
		wp_enqueue_script('custom-script-custom-slider', $js_slider, array('jquery'), '1.0', true);

}
add_action('wp_enqueue_scripts', 'custom_scripts_styles');

/**
 * Enqueue scripts and styles for the back end.
 *
 * @since Custom 1.0
 * @return void
*/
function custom_admin_scripts_styles() {

	// jQuery DatePicker
	wp_enqueue_script('jquery-ui-datepicker');

	// Loads jquery-ui stylesheet (used by date jquery-ui-datepicker)
	$css_jquery_ui = locate_web_ressource(CUSTOM_CSS_FOLDER.'custom-jquery-ui.css');
	if (!empty($css_jquery_ui))
		wp_enqueue_style('custom-admin-css-jquery-ui', $css_jquery_ui, '1.11.2');
	
	// Action for stylesheets tools
	do_action("custom_admin_enqueue_styles_tools", array("custom-admin-css-jquery-ui"));

	// Loads Isotope specific stylesheet.
	$css_isotope = locate_web_ressource(CUSTOM_CSS_FOLDER.'custom-isotope.css');
	if (!empty($css_isotope)){
		wp_enqueue_style('custom-admin-css-isotope', $css_isotope, array(), '1.0');
	}

	// Loads BxSlider specific stylesheet
	$css_bxslider = locate_web_ressource(CUSTOM_JS_FOLDER.'bxslider/jquery.bxslider.css');
	if (!empty($css_bxslider)){
		wp_enqueue_style('custom-admin-css-bxslider', $css_bxslider, array(), '2.1.1');
	}

	// Loads Slider specific stylesheet.
	$css_slider = locate_web_ressource(CUSTOM_CSS_FOLDER.'custom-slider.css');
	if (!empty($css_slider)){
		wp_enqueue_style('custom-admin-css-slider', $css_slider, array(), '1.0');
	}

	// Loads our main template stylesheet
	$css_admin = locate_web_ressource(CUSTOM_CSS_FOLDER.'custom-admin.css');
	if (!empty($css_admin))
		wp_enqueue_style('custom-admin-style', $css_admin, array('custom-admin-css-isotope', 'custom-admin-css-slider', 'custom-admin-css-jquery-ui'), '1.0');

	// Loads Utils
	$js_utils = locate_web_ressource(CUSTOM_JS_FOLDER.'custom-utils.js');
	if (!empty($js_utils))
		wp_enqueue_script('custom-script-utils', $js_utils, array('jquery'), '1.0', true);

	// Loads Isotope JavaScript file
	$js_isotope = locate_web_ressource(CUSTOM_JS_FOLDER.'isotope/isotope.pkgd.min.js');
	if (!empty($js_isotope))
		wp_enqueue_script('custom-admin-script-isotope', $js_isotope, array('jquery'), '2.1.1', true);

	// Loads BxSlider JavaScript file
	$js_bxslider = locate_web_ressource(CUSTOM_JS_FOLDER.'bxslider/jquery.bxslider.min.js');
	if (!empty($js_bxslider))
		wp_enqueue_script('custom-admin-script-bxslider', $js_bxslider, array('jquery'), '2.1.1', true);
	
	// Action for javascript tools
	do_action("custom_admin_enqueue_scripts_tools", array("custom-admin-script-bxslider"));

	// Loads JavaScript file for admin.
	$js_admin = locate_web_ressource(CUSTOM_JS_FOLDER.'custom-admin.js');
	if (!empty($js_admin))
		wp_enqueue_script('custom-admin-script', $js_admin, array('jquery'), '1.0', true);

	// wp.media JavaScript in Admin environnement (widget, posts, ...)
	wp_enqueue_media();

}
add_action('admin_enqueue_scripts', 'custom_admin_scripts_styles');

/**
 * Enqueue scripts and styles for the login page.
 *
 * @return void
*/
function custom_login_scripts_styles() {

	// Loads Utils
	$js_utils = locate_web_ressource(CUSTOM_JS_FOLDER.'custom-utils.js');
	if (!empty($js_utils))
		wp_enqueue_script('custom-script-utils', $js_utils, array('jquery'), '1.0', true);
	
	// Action for stylesheets tools
	do_action("custom_login_enqueue_styles_tools", array());
	
	// Action for javascript tools
	do_action("custom_login_enqueue_scripts_tools", array("custom-script-utils"));

	// Loads our login stylesheet.
	$css_login = locate_web_ressource(CUSTOM_CSS_FOLDER.'custom-login.css');
	if (!empty($css_login))
		wp_enqueue_style('custom-login-css', $css_login, array(), '1.0');

	// Loads login JavaScript file
	$js_login = locate_web_ressource(CUSTOM_JS_FOLDER.'custom-login.js');
	if (!empty($js_login)){
		wp_enqueue_script('custom-login-script', $js_login, array('jquery'), '1.0', true );
		wp_localize_script('custom-login-script', 'CustomLogin', array('url_title' => get_bloginfo( 'name' ), 'url_site' => get_site_url(), 'message' => ''));
	}

}
add_action('login_enqueue_scripts', 'custom_login_scripts_styles');

/**
 * Register widgets areas.
 *
 * @return void
*/
function custom_widgets_init() {
	register_sidebar( array(
	'name'          => __('Sidebar', CUSTOM_TEXT_DOMAIN),
	'id'            => 'sidebar',
	'description'   => __('Shown in your site', CUSTOM_TEXT_DOMAIN),
	'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="widget-container">',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	'after_widget'  => '</div></aside>',
	) );
}
add_action('widgets_init', 'custom_widgets_init');