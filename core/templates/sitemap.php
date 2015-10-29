<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */

get_header();?>

<?php 
function custom_sitemap_get_node($post_type, $posts, $is_hierarchical = false){
	global $post;
	?>
	<ul class="sitemap-box post-type-<?php echo $post_type; ?>">
	<?php
	foreach ($posts as $post){
		setup_postdata($post);
		?>
		<li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></li>
		<?php
		if ($is_hierarchical){
			$sub_posts = get_pages(array("post_type" => $post_type, 'numberposts' => -1, "orderby" => "name", "order" => "ASC", "parent" => get_the_ID()));
			if (!empty($sub_posts)){
				custom_sitemap_get_node($post_type, $sub_posts, $is_hierarchical);
			}
		}
		wp_reset_postdata();
	}
	?>
	</ul>
	<?php
}
?>

	<div id="primary" class="content-area page sitemap">
		<div id="content" class="site-content" role="main">
			<?php 
			$available_posttypes = apply_filters("sitemap_available_posttypes", get_displayed_post_types(true));
			foreach ($available_posttypes as $post_type){
				if ($post_type != 'wpcf7_contact_form'){
					$is_hierarchical = is_post_type_hierarchical($post_type);
					if ($is_hierarchical)
						$posts = get_pages(array("post_type" => $post_type, 'numberposts' => -1, "orderby" => "name", "order" => "ASC", "parent" => 0));
					else
						$posts = get_posts(array("post_type" => $post_type, 'numberposts' => -1, "orderby" => "name", "order" => "ASC"));
					if (!empty($posts)){
						$current_post_type_label = get_post_type_labels(get_post_type_object($post_type));
						?>
						<h3 class="sitemap-title post-type-<?php echo $post_type; ?>"><?php echo $current_post_type_label->name; ?></h3>
						<?php custom_sitemap_get_node($post_type, $posts, $is_hierarchical); ?>
						<?php
					}
				}
			}
			?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>