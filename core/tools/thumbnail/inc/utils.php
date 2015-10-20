<?php
/**
 * THUMBNAIL Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

if (!function_exists("custom_post_thumbnail")):
/**
 * show or retrieve post thumbnail with CSS3 background cover solution
* @param string $post_id
* @param number $width
* @param number $height
* @param string $display
*/
function custom_post_thumbnail($post_id = null, $display = true, $class = "entry-thumbnail custom-entry-thumbnail", $content = ""){
	$res = '';
	$attach_id = get_post_thumbnail_id($post_id);
	if ($attach_id){
		$image = wp_get_attachment_image_src($attach_id, 'full');
		if ($image){
			$style_wrapper = " min-width : 50px;";
			$style_wrapper .= " min-height : 50px;";
			$style = " width: 100%;";
			$style .= " height: 100%;";
			$style .= " background:	url('$image[0]') no-repeat center center;";
			$style .= " -webkit-background-size: cover;";
			$style .= " -moz-background-size: cover;";
			$style .= " -o-background-size: cover;";
			$style .= " -ms-background-size: cover;";
			$style .= " background-size: cover;";
			$style .= " overflow: hidden;";
			$res = '<div class="'.$class.'" style="'.$style_wrapper.'">';
			$res .= '<div class="thumb" style="'.$style.'">'.$content.'</div>';
			$res .= '</div>';
		}
	}
	if ($display == true){
		echo $res;
	}else{
		return $res;
	}
}
endif;