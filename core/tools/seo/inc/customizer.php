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


/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Custom SEO 1.0
 *
 * @param WP_Customize_Manager $wp_customize_manager Customizer object.
 */
function seo_customize_register( $wp_customize_manager ) {

	// SEO section
	$wp_customize_manager->add_section('seo_customizer', array(
			'title' => 'SEO',
			'description' => '<a href="'.SEO_get_xmlsitemap_url().'" target="_blank">look at sitemap.xml</a><hr />'.__("Default values are used when nothing is recoverable (blog page for example)", CUSTOM_TEXT_DOMAIN).' '
	));

	// meta title
	$wp_customize_manager->add_setting(SEO_DEFAULT_METATITLE, array('type' => 'theme_mod', 'transport'=>'postMessage'));
	$wp_customize_manager->add_control(SEO_DEFAULT_METATITLE, array(
			'label'      => __('Default meta-title', CUSTOM_TEXT_DOMAIN ),
			'section'    => 'seo_customizer',
			'settings'   => SEO_DEFAULT_METATITLE,
	));

	// meta description
	$wp_customize_manager->add_setting(SEO_DEFAULT_METADESCRIPTION, array('type' => 'theme_mod', 'transport'=>'postMessage'));
	$wp_customize_manager->add_control(SEO_DEFAULT_METADESCRIPTION, array(
			'label'      => __('Default meta-description', CUSTOM_TEXT_DOMAIN ),
			'section'    => 'seo_customizer',
			'settings'   => SEO_DEFAULT_METADESCRIPTION,
	));

	// meta keywords
	$wp_customize_manager->add_setting(SEO_DEFAULT_METAKEYWORDS, array('type' => 'theme_mod', 'transport'=>'postMessage'));
	$wp_customize_manager->add_control(SEO_DEFAULT_METAKEYWORDS, array(
			'label'      => __('Default meta-keywords', CUSTOM_TEXT_DOMAIN ),
			'section'    => 'seo_customizer',
			'settings'   => SEO_DEFAULT_METAKEYWORDS,
	));
	
	
}
add_action('customize_register', 'seo_customize_register');



if (!function_exists("seo_wp_title")):
/**
 * Filter the page title.
*
* @since Custom SEO 1.0
* @param string $title Default title text for current view.
* @param string $sep   Optional separator.
* @return string the filtered title.
*/
function seo_wp_title( $title, $sep, $seplocation ) {
	global $paged, $page;

	$title = "";

	$has_title = false;

	$prefix = " $sep ";

	$queried_object = get_queried_object();

	$blogname = get_bloginfo('name');

	// note : le title arrive avec le nom de la page courante (post / categorie / ...)
	// soit on écrase avec les meta_data définies, soit, on concatène avec le nom du site et, si elle existe, la description

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
				$has_title = true;
			}
		}
		// blog name
		if (!empty($blogname)){
			if ($has_title == true)
				$title .= "$sep$blogname";
		}
	}
	// other title
	else{
		// meta_title du post courant
		$has_title = false;
		if ($queried_object){
			// meta title
			$meta_data = get_post_meta($queried_object->ID, SEO_CUSTOMFIELD_METATITLE, true);
			if (!empty($meta_data)){
				$title = $meta_data;
				$has_title = true;
			}
			// post title
			else{
				$post_title = get_the_title($queried_object->ID);
				if (!empty($post_title)){
					$title = $post_title;
					$has_title = true;
				}
			}
		}

		// blog name
		if (!empty($blogname)){
			if ($has_title == true)
				$title .= "$sep$blogname";
		}
	}

	// default value
	if (empty($title)){
		$meta_data_default = stripslashes(get_theme_mod(SEO_DEFAULT_METATITLE));
		if (!empty($meta_data_default)){
			$title = $meta_data_default;
			if (!empty($blogname)){
				$title .= "$sep$blogname";
			}
		}else{
			if (!empty($blogname)){
				$title = $blogname;
			}
		}
	}

	// Add a page number if necessary.
	if ($paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', CUSTOM_TEXT_DOMAIN ), max( $paged, $page ) );

	return $title;
}
add_filter('wp_title', 'seo_wp_title', 100, 3);
endif;

if (!function_exists("seo_get_metadescription")):
/**
 * seo_get_metadescription
*
* @since Custom 1.0
* @return void
*/
function seo_get_metadescription() {
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
		$meta_data_default = stripslashes(get_theme_mod(SEO_DEFAULT_METADESCRIPTION));
		if (!empty($meta_data_default)){
			$description = $meta_data_default;
		}else{
			$description = get_bloginfo('description', 'display');
		}
	}

	echo esc_attr($description);
}
add_action("get_metadescription", "seo_get_metadescription");
endif;

if (!function_exists("seo_get_metakeywords")):
/**
 * seo_get_metakeywords
*
* @since Custom SEO 1.0
* @return void
*/
function seo_get_metakeywords() {
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
		$meta_data_default = stripslashes(get_theme_mod(SEO_DEFAULT_METAKEYWORDS));
		if (!empty($meta_data_default)){
			$keywords = $meta_data_default;
		}
	}

	echo esc_attr($keywords);
}
add_action("get_metakeywords", "seo_get_metakeywords");
endif;

function seo_header(){
	?>
<meta
	name="description" content="<?php do_action('get_metadescription'); ?>">
<meta
	name="keywords" content="<?php do_action('get_metakeywords'); ?>">
<?php
}
add_action('wp_head', 'seo_header');