<?php
/**
 * Custom templates functions and definitions
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

if (!function_exists('custom_entry_meta') ) :
/**
 * Custom entry-meta
*
* @since Custom 1.0
* @return void
*/
function custom_entry_meta() {
	if (is_sticky() && is_home() && ! is_paged())
		echo '<span class="featured-post">' . __('Sticky', CUSTOM_TEXT_DOMAIN) . '</span>';

	if (!has_post_format('link') && 'post' == get_post_type() )
		custom_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __(', ', CUSTOM_TEXT_DOMAIN));
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list('', __(', ', CUSTOM_TEXT_DOMAIN) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ('post' == get_post_type() ) {
		printf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta('ID') ) ),
		esc_attr( sprintf( __('View all posts by %s', CUSTOM_TEXT_DOMAIN), get_the_author() ) ),
		get_the_author()
		);
	}
}
endif;

if (!function_exists('custom_entry_date')) :
/**
 * Custom entry-date
*
* @since Custom 1.0
* @return void
*/
function custom_entry_date($echo = true) {
	if (has_post_format( array('chat', 'status')))
		$format_prefix = _x('%1$s on %2$s', '1: post format name. 2: date', CUSTOM_TEXT_DOMAIN);
	else
		$format_prefix = '%2$s';

	$date = sprintf('<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
			esc_url( get_permalink() ),
			esc_attr( sprintf( __('Permalink to %s', CUSTOM_TEXT_DOMAIN), the_title_attribute('echo=0') ) ),
			esc_attr( get_the_date('c') ),
			esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if (!function_exists('custom_comments_template')) :
/**
 * Custom comment_template
*
* @since Custom 1.0
* @return void
*/
function custom_comments_template() {
	$custom_comments = get_theme_mod('custom_comments');
	if (!empty($custom_comments))
		comments_template();
}
endif;

if (!function_exists('custom_comments_popup_link')) :
/**
 * Custom comments_popup_link
*
* @since Custom 1.0
* @return void
*/
function custom_comments_popup_link($zero, $one, $more){
	$custom_comments = get_theme_mod('custom_comments');
	if (!empty($custom_comments))
		comments_popup_link($zero, $one, $more);
}
endif;

function mini_excerpt_length( $length ) {
	return 10;
}


function small_inter_excerpt_length( $length ) {
	return 20;
}


function small_excerpt_length( $length ) {
	return 30;
}


function normal_excerpt_length( $length ) {
	return 60;
}

function set_normal_excerpt_lenght(){
	add_filter( 'excerpt_length', 'normal_excerpt_length', 999 );
}

function set_small_excerpt_lenght(){
	add_filter( 'excerpt_length', 'small_excerpt_length', 999 );
}

function set_small_inter_excerpt_lenght(){
	add_filter( 'excerpt_length', 'small_inter_excerpt_length', 999 );
}

function set_mini_excerpt_lenght(){
	add_filter( 'excerpt_length', 'mini_excerpt_length', 999 );
}

function new_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');