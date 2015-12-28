<?php
/**
 * WALL Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * register JS
 */
function wall_ajax_admin_enqueue_scripts(){
	$wall_ajax_js_file = locate_web_ressource(CUSTOM_TOOLS_FOLDER.WALL_TOOL_NAME.'/ajax/wall-ajax.js');
	if (!empty($wall_ajax_js_file)){
		wp_enqueue_script('wall-ajax', $wall_ajax_js_file, array('jquery'), "1.0");
		wp_localize_script('wall-ajax', 'GalleryAjax', array(
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'ajaxNonce' => wp_create_nonce('wall-ajax-nonce'),
		)
		);
	}
}
add_action('admin_enqueue_scripts', 'wall_ajax_admin_enqueue_scripts');

/**
 * retrieve configuration's form for wall présentation
*/
function wall_ajax_get_wall_presentation_results() {
	if (!check_ajax_referer('wall-ajax-nonce', 'ajaxNonce', false)){
		die ('Busted!');
	}

	$response = array('what'=>'wall_ajax_get_wall_presentation_results',
			'action'=>'wall_ajax_get_wall_presentation_results',
			'id'=>'1'
	);
	$wall_args = array();
	foreach ($_POST as $k => $v){
		if (startsWith($k, "meta_wall_"))
			$wall_args[$k] = $v;
	}

	ob_start();
	$wall_template = locate_ressource("tool-wall-display.php", array(CUSTOM_TOOLS_FOLDER.WALL_TOOL_NAME.'/templates/'));
	if (!empty($wall_template))
		include($wall_template);
	$results = ob_get_contents();
	ob_end_clean();

	$response['data'] = $results;

	$xmlResponse = new WP_Ajax_Response($response);
	$xmlResponse->send();
	exit();
}
add_action('wp_ajax_get_wall_presentation_results', 'wall_ajax_get_wall_presentation_results');
add_action('wp_ajax_nopriv_get_wall_presentation_results', 'wall_ajax_get_wall_presentation_results');