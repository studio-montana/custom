<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */

get_header();?>

	<div id="primary" class="content-area">
	
		<div id="content" class="site-content" role="main">
		
		<?php 
		// display blog page title 
		$blog_page = get_page(get_option('page_for_posts'));
		if (is_numeric($blog_page)){
			global $post;
			$post = $blog_page;
			setup_postdata($post);
			get_template_part('content', 'blog');
			wp_reset_postdata();
		}
		// display blog posts
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part('content', 'resume');
			endwhile;
		else :
			get_template_part('content', 'none');
		endif;
		?>
		
		<div style="clear: both;"></div>
		
		<?php 
		// display blog page pagination
		$blog_page = get_page(get_option('page_for_posts'));
		if ($blog_page){
			global $post;
			$post = $blog_page;
			setup_postdata($post);
			if (function_exists("pagination")) pagination(array(), true, '<div class="pagination">', '</div>', '<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>');
			wp_reset_postdata();
		}
		?>
		
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>