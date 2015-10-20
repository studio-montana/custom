<?php

/**
 * Custom comparatoes
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

if (!function_exists("custom_cmp_posttypes")):
/**
 * Comparator for post_types string
*/
function custom_cmp_posttypes($post_type_1, $post_type_2) {
	$current_post_type_label_1 = get_post_type_labels(get_post_type_object($post_type_1));
	$current_post_type_label_2 = get_post_type_labels(get_post_type_object($post_type_2));
	return strcmp($current_post_type_label_1->name, $current_post_type_label_2->name);
}
endif;