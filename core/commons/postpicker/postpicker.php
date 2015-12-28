<?php
/**
 * Post-picker
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.1
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * register JS
 */
function postpicker_ajax_admin_enqueue_scripts(){
	$postpicker_ajax_js_file = locate_web_ressource(CUSTOM_COMMONS_FOLDER.'postpicker/postpicker.js');
	if (!empty($postpicker_ajax_js_file)){
		wp_enqueue_script('postpicker-ajax', $postpicker_ajax_js_file, array('jquery'), "1.0");
		wp_localize_script('postpicker-ajax', 'Postpicker', array(
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'ajaxNonce' => wp_create_nonce('postpicker-ajax-nonce'),
		'doneButtonText' => __("Done", CUSTOM_TEXT_DOMAIN),
		'orderButtonText' => __("Order", CUSTOM_TEXT_DOMAIN),
		)
		);
	}
}
add_action('admin_enqueue_scripts', 'postpicker_ajax_admin_enqueue_scripts');

/**
 * retrieve posts
*/
function postpicker_ajax_postpicker_get_posts() {
	if (!check_ajax_referer('postpicker-ajax-nonce', 'ajaxNonce', false)){
		die ('Busted!');
	}

	$response = array('what'=>'postpicker_ajax_postpicker_get_posts',
			'action'=>'postpicker_ajax_postpicker_get_posts',
			'id'=>'1'
	);

	$postypes = null;
	if (isset($_POST['postypes']) && !empty($_POST['postypes'])){
		$postypes = split(",", $_POST['postypes']);
	}

	$exclude = null;
	if (isset($_POST['exclude']) && !empty($_POST['exclude'])){
		$exclude = split(",", $_POST['exclude']);
	}

	ob_start();
	$postpick_items_template = locate_ressource("postpicker-items.php", array(CUSTOM_COMMONS_FOLDER.'/postpicker/templates/'));
	if (!empty($postpick_items_template))
		include($postpick_items_template);
	$results = ob_get_contents();
	ob_end_clean();

	$response['data'] = $results;

	$xmlResponse = new WP_Ajax_Response($response);
	$xmlResponse->send();
	exit();
}
add_action('wp_ajax_postpicker_get_posts', 'postpicker_ajax_postpicker_get_posts');
add_action('wp_ajax_nopriv_postpicker_get_posts', 'postpicker_ajax_postpicker_get_posts');

/**
 * retrieve post
*/
function postpicker_ajax_postpicker_get_post() {
	if (!check_ajax_referer('postpicker-ajax-nonce', 'ajaxNonce', false)){
		die ('Busted!');
	}

	$response = array('what'=>'postpicker_ajax_postpicker_get_post',
			'action'=>'postpicker_ajax_postpicker_get_post',
			'id'=>'1'
	);

	$results = "";

	$post_id = null;
	if (isset($_POST['post_id']) && !empty($_POST['post_id'])){
		$post_id = $_POST['post_id'];
	}

	$asked_post = get_post($post_id);
	
	if ($asked_post){
		global $post;
		$post = $asked_post;
		setup_postdata($post);
		ob_start();
		$postpick_item_template = locate_ressource("postpicker-item.php", array(CUSTOM_COMMONS_FOLDER.'/postpicker/templates/'));
		if (!empty($postpick_item_template))
			include($postpick_item_template);
		$results = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
	}
	
	$response['data'] = $results;

	$xmlResponse = new WP_Ajax_Response($response);
	$xmlResponse->send();
	exit();
}
add_action('wp_ajax_postpicker_get_post', 'postpicker_ajax_postpicker_get_post');
add_action('wp_ajax_nopriv_postpicker_get_post', 'postpicker_ajax_postpicker_get_post');