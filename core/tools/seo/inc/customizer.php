<?php
/**
 * Custom Customizer functionality
 *
 * @package WordPress
 * @subpackage Custom SEO
 * @since Custom SEO 1.0
 */

define('SEO_DEFAULT_METATITLE', 'seo-default-metatitle');
define('SEO_DEFAULT_METADESCRIPTION', 'seo-default-metadescription');
define('SEO_DEFAULT_METAKEYWORDS', 'seo-default-metakeywords');


if (!function_exists("seo_wp_title")):
/**
 * Filter the page title.
*/
function seo_wp_title($title, $sep, $seplocation) {
	return seo_get_metatitle($sep, false);
}
add_filter('wp_title', 'seo_wp_title', 100, 3);
endif;

if (!function_exists("seo_get_metatitle")):
/**
 * seo_get_metadescription
*/
function seo_get_metatitle($sep = " | ", $display = true) {
	global $paged, $page;
	$title = "";
	$prefix = " $sep ";
	$queried_object = get_queried_object();
	$blogname = get_bloginfo('name');
	if (is_category() || is_tax()){
		if (is_category()){
			$categories = get_the_category();
			$term_id = $categories[0]->cat_ID;
		}else if(is_tax()){
			$term_id =  (int) $queried_object->term_id;
		}
		if (!empty($term_id)){
			$meta_data_cat = stripslashes(get_option("term_".$term_id."_".SEO_CUSTOMFIELD_METATITLE));
			if (!empty($meta_data_cat)){
				$title = $meta_data_cat;
			}
		}
	}
	else{
		if ($queried_object){
			// meta title
			$meta_data = get_post_meta($queried_object->ID, SEO_CUSTOMFIELD_METATITLE, true);
			if (!empty($meta_data)){
				$title = $meta_data;
			}
			// post title
			else{
				$post_title = get_the_title($queried_object->ID);
				if (!empty($post_title)){
					$title = $post_title;
				}
			}
		}
	}
	// default value
	if (empty($title)){
		$title = $blogname;
	}else{
		$title .= "$sep$blogname";
	}
	// Add a page number if necessary.
	if ($paged >= 2 || $page >= 2 )
		$title = "$title$sep" . sprintf( __( 'page %s', CUSTOM_TEXT_DOMAIN ), max( $paged, $page ) );
	// result
	if ($display)
		echo $title;
	else
		return $title;
}
add_action("get_metatitle", "seo_get_metatitle");
endif;

if (!function_exists("seo_get_metadescription")):
/**
 * seo_get_metadescription
*/
function seo_get_metadescription($display = true) {
	$description = '';
	if (is_category() || is_tax()){
		if (is_category()){
			$categories = get_the_category();
			$term_id = $categories[0]->cat_ID;
		}else if(is_tax()){
			$queried_object = get_queried_object();
			$term_id =  (int) $queried_object->term_id;
		}
		if (!empty($term_id)){
			$meta_data_cat = stripslashes(get_option("term_".$term_id."_".SEO_CUSTOMFIELD_METADESCRIPTION));
			if (!empty($meta_data_cat)){
				$description = $meta_data_cat;
			}
		}
	}else{
		$_queried_post = get_queried_object();
		if ($_queried_post){
			$meta_data = get_post_meta($_queried_post->ID, SEO_CUSTOMFIELD_METADESCRIPTION, true);
			if (!empty($meta_data)){
				$description = $meta_data;
			}
		}
	}

	// default value
	if (empty($description)){
		$description = get_bloginfo('description', 'display');
	}

	// result
	if ($display)
		echo esc_attr($description);
	else
		return esc_attr($description);
}
add_action("get_metadescription", "seo_get_metadescription");
endif;

if (!function_exists("seo_get_metakeywords")):
/**
 * seo_get_metakeywords
*/
function seo_get_metakeywords($display = true) {
	$keywords = '';
	if (is_category() || is_tax()){
		if (is_category()){
			$categories = get_the_category();
			$term_id = $categories[0]->cat_ID;
		}else if(is_tax()){
			$queried_object = get_queried_object();
			$term_id =  (int) $queried_object->term_id;
		}
		if (!empty($term_id)){
			$meta_data_cat = stripslashes(get_option("term_".$term_id."_".SEO_CUSTOMFIELD_METAKEYWORDS));
			if (!empty($meta_data_cat)){
				$keywords = $meta_data_cat;
			}
		}
	}else {
		$_queried_post = get_queried_object();
		if ($_queried_post){
			$meta_data = get_post_meta($_queried_post->ID, SEO_CUSTOMFIELD_METAKEYWORDS, true);
			if (!empty($meta_data)){
				$keywords = $meta_data;
			}
		}
	}

	// default value
	if (empty($keywords)){
		// none
	}

	// result
	if ($display)
		echo esc_attr($keywords);
	else
		return esc_attr($keywords);
}
add_action("get_metakeywords", "seo_get_metakeywords");
endif;

if (!function_exists("seo_get_meta_opengraph_title")):
/**
 * seo_get_meta_opengraph_title
*/
function seo_get_meta_opengraph_title($display = true) {
	$opengraph_content = '';
	$sep = " | ";
	if (is_category() || is_tax()){
		if (is_category()){
			$categories = get_the_category();
			$term_id = $categories[0]->cat_ID;
		}else if(is_tax()){
			$queried_object = get_queried_object();
			$term_id =  (int) $queried_object->term_id;
		}
		if (!empty($term_id)){
			$meta_data_cat = stripslashes(get_option("term_".$term_id."_".SEO_CUSTOMFIELD_META_OPENGRAPH_TITLE));
			if (!empty($meta_data_cat)){
				$opengraph_content = $meta_data_cat;
			}else{ // default
				$meta_data_cat = stripslashes(get_option("term_".$term_id."_".SEO_CUSTOMFIELD_METATITLE));
				if (!empty($meta_data_cat)){
					$opengraph_content = $meta_data_cat;
				}
			}
		}
	}else{
		$_queried_post = get_queried_object();
		if ($_queried_post){
			$meta_data = get_post_meta($_queried_post->ID, SEO_CUSTOMFIELD_META_OPENGRAPH_TITLE, true);
			if (!empty($meta_data)){
				$opengraph_content = $meta_data;
			}else{ // default
				$meta_data = get_post_meta($_queried_post->ID, SEO_CUSTOMFIELD_METATITLE, true);
				if (!empty($meta_data)){
					$opengraph_content = $meta_data;
				}
			}
		}
	}
	// default
	if (empty($opengraph_content)){
		$opengraph_content = seo_get_metatitle($sep, false);
	}else{
		$blogname = get_bloginfo('name');
		if (!empty($blogname))
			$opengraph_content .= $sep.$blogname;
	}

	// result
	if ($display)
		echo esc_attr($opengraph_content);
	else
		return esc_attr($opengraph_content);
}
add_action("get_meta_opengraph_title", "seo_get_meta_opengraph_title");
endif;

if (!function_exists("seo_get_meta_opengraph_description")):
/**
 * seo_get_meta_opengraph_description
*/
function seo_get_meta_opengraph_description($display = true) {
	$opengraph_content = '';
	if (is_category() || is_tax()){
		if (is_category()){
			$categories = get_the_category();
			$term_id = $categories[0]->cat_ID;
		}else if(is_tax()){
			$queried_object = get_queried_object();
			$term_id =  (int) $queried_object->term_id;
		}
		if (!empty($term_id)){
			$meta_data_cat = stripslashes(get_option("term_".$term_id."_".SEO_CUSTOMFIELD_META_OPENGRAPH_DESCRIPTION));
			if (!empty($meta_data_cat)){
				$opengraph_content = $meta_data_cat;
			}else{ // default
				$meta_data_cat = stripslashes(get_option("term_".$term_id."_".SEO_CUSTOMFIELD_METADESCRIPTION));
				if (!empty($meta_data_cat)){
					$opengraph_content = $meta_data_cat;
				}
			}
		}
	}else{
		$_queried_post = get_queried_object();
		if ($_queried_post){
			$meta_data = get_post_meta($_queried_post->ID, SEO_CUSTOMFIELD_META_OPENGRAPH_DESCRIPTION, true);
			if (!empty($meta_data)){
				$opengraph_content = $meta_data;
			}else{ // default
				$meta_data = get_post_meta($_queried_post->ID, SEO_CUSTOMFIELD_METADESCRIPTION, true);
				if (!empty($meta_data)){
					$opengraph_content = $meta_data;
				}
			}
		}
	}
	// default
	if (empty($opengraph_content)){
		$opengraph_content = get_bloginfo('description', 'display');
	}

	// result
	if ($display)
		echo esc_attr($opengraph_content);
	else
		return esc_attr($opengraph_content);
}
add_action("get_meta_opengraph_description", "seo_get_meta_opengraph_description");
endif;

if (!function_exists("seo_get_meta_opengraph_image")):
/**
 * seo_get_meta_opengraph_image
*/
function seo_get_meta_opengraph_image($display = true) {
	$opengraph_content = '';
	if (is_category() || is_tax()){
		if (is_category()){
			$categories = get_the_category();
			$term_id = $categories[0]->cat_ID;
		}else if(is_tax()){
			$queried_object = get_queried_object();
			$term_id =  (int) $queried_object->term_id;
		}
		if (!empty($term_id)){
			$meta_data_cat = stripslashes(get_option("term_".$term_id."_".SEO_CUSTOMFIELD_META_OPENGRAPH_IMAGE));
			if (!empty($meta_data_cat)){
				$opengraph_content = $meta_data_cat;
			}
		}
	}else{
		$_queried_post = get_queried_object();
		if ($_queried_post){
			$meta_data = get_post_meta($_queried_post->ID, SEO_CUSTOMFIELD_META_OPENGRAPH_IMAGE, true);
			if (!empty($meta_data)){
				$opengraph_content = $meta_data;
			}else{ // default (post thumbnail)
				if (has_post_thumbnail($_queried_post->ID)){
					$thumb_id = get_post_thumbnail_id($_queried_post->ID);
					$thumb = wp_get_attachment_image_src($thumb_id, 'tool-seo-thumb');
					if ($thumb) {
						list($thumb_src, $thumb_width, $thumb_height) = $thumb;
						if (!empty($thumb_src)){
							$opengraph_content = $thumb_src;
						}
					}
				}
			}
		}
	}

	if (empty($opengraph_content)){
		$url_logo = get_theme_mod('logo_image'); // site-logo
		if (!empty($url_logo)){
			$opengraph_content = $url_logo;
		}else{ // default (tool-seo-default-og-image.png)
			$opengraph_content = locate_web_ressource("tool-seo-default-og-image.png", array(CUSTOM_TOOLS_FOLDER.SEO_TOOL_NAME.'/img/'));
		}
	}

	// result
	if ($display)
		echo esc_attr($opengraph_content);
	else
		return esc_attr($opengraph_content);
}
add_action("get_meta_opengraph_image", "seo_get_meta_opengraph_image");
endif;

function seo_header(){
	?>
<meta
	name="description"
	content="<?php do_action('get_metadescription', true); ?>">
<meta
	name="keywords" content="<?php do_action('get_metakeywords', true); ?>">
<meta property="og:type"
	content="website" />
<meta
	property="og:title"
	content="<?php do_action('get_meta_opengraph_title', true); ?>">
<meta
	property="og:description"
	content="<?php do_action('get_meta_opengraph_description', true); ?>">
<meta
	property="og:image"
	content="<?php do_action('get_meta_opengraph_image', true); ?>">
<?php
}
add_action('wp_head', 'seo_header');