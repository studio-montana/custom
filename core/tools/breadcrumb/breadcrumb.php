<?php
/**
 * BREADCRUMB Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * CONSTANTS
 */
define('BREADCRUMB_TOOL_NAME', 'breadcrumb');

/**
 * Enqueue scripts and styles for the front end.
 *
 * @return void
*/
function tool_breadcrumb_scripts_styles() {

	// load breadcrumb's css
	$css_breadcrumb = locate_web_ressource(CUSTOM_CSS_FOLDER.'tool-breadcrumb.css', array(CUSTOM_TOOLS_FOLDER.BREADCRUMB_TOOL_NAME.'/'));
	if (!empty($css_breadcrumb))
		wp_enqueue_style('tool-breadcrumb-css', $css_breadcrumb, array(), '1.0');
}
add_action('wp_enqueue_scripts', 'tool_breadcrumb_scripts_styles');

/**
 * retrieve or display breadcrumb
 * @param array $args {
 *     Optional.
 *     @type string		$seperator		displayed after each breadcrumb element, except the last
 *     @type string		$final			displayed after last breadcrumb item
 *     @type string		$home-item		displayed in place of home's breadcrumb item content
 * }
 * @param string $display : true to display, otherwise return result
 * @return string
*/
function tool_breadcrumb($args = array(), $display = false){

	$id_blog_page = get_option('page_for_posts');
	$id_front_page = get_option('page_on_front');

	$defaults = array(
			'seperator' => '<li class="separator"><i class="fa fa-caret-right"></i></li>',
			'final' => '<li class="final"></li>',
			'home-item' => __("Home", CUSTOM_TEXT_DOMAIN)
	);
	$args = wp_parse_args($args, $defaults);

	$separator = $args['seperator'];
	$final = $args['final'];

	$res = '<ul class="tool-breadcrumb">';

	// -------------------- home
	$home_url = esc_url(home_url('/'));
	$res .= '<li class="breadcrumb-item home"><a href="'.$home_url.'" title="'.__("Home", CUSTOM_TEXT_DOMAIN).'">'.$args['home-item'].'</a></li>';
	if (is_front_page()){ // site home page
		$res .= $final;
	}else if (!is_home()){ // site inner page
		$res .= $separator;
	}else { // site inner page
		$res .= $separator;
	}

	// -------------------- inner
	if (!is_front_page()){
		if (is_home() && !empty($id_front_page)) {
			if (!empty($id_blog_page) && is_numeric($id_blog_page)){
				$res .= tool_breadcrumb_post_ancestors($id_blog_page, $separator);
				$res .= '<li class="breadcrumb-item current"><a href="'.get_permalink($id_blog_page).'" title="'.esc_attr(get_the_title($id_blog_page)).'">'.get_the_title($id_blog_page).'</a></li>'.$final;
			}
		}else if (is_single()) {
			if (get_post_type() == 'post'){ // blog article - display blog page if is different of front page and if front page is set
				if (!empty($id_blog_page) && is_numeric($id_blog_page) && !empty($id_front_page) && $id_blog_page != $id_front_page){
					$res .= tool_breadcrumb_post_ancestors($id_blog_page, $separator);
					$res .= '<li class="breadcrumb-item current"><a href="'.get_permalink($id_blog_page).'" title="'.esc_attr(get_the_title($id_blog_page)).'">'.get_the_title($id_blog_page).'</a></li>'.$separator;
				}
			}
			$res .= tool_breadcrumb_post_ancestors(get_the_ID(), $separator);
			$res .= '<li class="breadcrumb-item current"><a href="'.get_the_permalink().'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></li>'.$final;
		}else if (is_category()) {
			$categories = get_the_category();
			$category_id = $categories[0]->cat_ID;
			$res .= tool_breadcrumb_term_ancestors($category_id, 'category', $separator);
			$res .= '<li class="breadcrumb-item current"><a href="'.get_the_permalink().'" title="'.get_cat_name($category_id).'">'.get_cat_name($category_id).'</a></li>'.$final;
		}else if (is_archive()){
			if (is_tax() || is_category() || is_tag() ){
				$current_term = get_queried_object();
				if (is_tax()){
					$res .= tool_breadcrumb_term_ancestors($current_term->term_id, 'typebancaservice', $separator);
				}else if(is_category()){
					$res .= tool_breadcrumb_term_ancestors($current_term->term_id, 'category', $separator);
				}
				$res .= '<li class="breadcrumb-item current"><a href="'.get_the_permalink().'" title="'.esc_attr($current_term->name).'">'.$current_term->name.'</a></li>'.$final;
			}
		}else if(is_page()) {
			$res .= tool_breadcrumb_post_ancestors(get_the_ID(), $separator);
			$res .= '<li class="breadcrumb-item current"><a href="'.get_the_permalink().'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></li>'.$final;
		}else if(is_404()){
			$res .= '<li class="breadcrumb-item current"><a href="'.get_the_permalink().'" title="'.esc_attr(get_the_title()).'">404</a></li>'.$final;
		}else if(is_search()){
			$res .= '<li class="breadcrumb-item current"><span title="'.esc_attr(get_the_title()).'">'.__('search',CUSTOM_TEXT_DOMAIN).'</span></li>'.$final;
		}else if(is_tag()) {
			single_tag_title();
		}
		else if(is_day()) {
			$res .= '<li class="breadcrumb-item current">'.__('Archive ', CUSTOM_TEXT_DOMAIN)." "; the_time('F jS, Y'); $res .= '</li>'.$final;
		}
		else if(is_month()) {
			$res .= '<li class="breadcrumb-item current">'.__('Archive ', CUSTOM_TEXT_DOMAIN)." "; the_time('F, Y'); $res .= '</li>'.$final;
		}
		else if(is_year()) {
			$res .= '<li class="breadcrumb-item current">'.__('Archive ', CUSTOM_TEXT_DOMAIN)." "; the_time('Y'); $res .= '</li>'.$final;
		}
		else if(is_author()) {
			$res .= '<li class="breadcrumb-item current">'.__('Author', CUSTOM_TEXT_DOMAIN); $res .= '</li>'.$final;
		}
		else if(isset($_GET['paged']) && !empty($_GET['paged'])) {
			$res .= '<li class="breadcrumb-item current">'.__("Blog archives", CUSTOM_TEXT_DOMAIN); $res .= '</li>'.$final;
		}
		else if(is_search()) {
			$res .= '<li class="breadcrumb-item current">'.__('Search results', CUSTOM_TEXT_DOMAIN); $res .= '</li>'.$final;
		}
	}
	$res .= '</ul><div style="clear: both"></div>';

	if ($display == true){
		echo $res;
	}else{
		return $res;
	}
}


function tool_breadcrumb_post_ancestors($id_post, $separator){
	$output = '';
	$ancestors = get_post_ancestors($id_post);
	if ($ancestors){
		sort($ancestors, -1);
		foreach ($ancestors as $ancestor ) {
			$output .= '<li class="breadcrumb-item"><a href="'.get_permalink($ancestor).'" title="'.esc_attr(get_the_title($ancestor)).'">'.get_the_title($ancestor).'</a></li>'.$separator;
		}
	}
	return $output;
}

function tool_breadcrumb_term_ancestors($id, $taxonomy, $separator){
	$output = '';
	$ancestors = get_ancestors($id, $taxonomy);
	if ($ancestors){
		sort($ancestors, -1);
		foreach ($ancestors as $ancestor ) {
			$term = get_term($ancestor, $taxonomy);
			$output .= '<li class="breadcrumb-item"><a href="'.get_term_link($term, $taxonomy).'" title="'.esc_attr($term->name).'">'.$term->name.'</a></li>'.$separator;
		}
	}
	return $output;
}

