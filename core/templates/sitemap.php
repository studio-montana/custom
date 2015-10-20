<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */

get_header();?>

	<div id="primary" class="content-area page sitemap">
		<div id="content" class="site-content" role="main">
			<?php 
			$available_posttypes = apply_filters("sitemap_available_posttypes", get_displayed_post_types(true));
			foreach ($available_posttypes as $post_type){
				if ($post_type != 'wpcf7_contact_form'){
					$post_types = get_posts(array("post_type" => $post_type, 'numberposts' => -1, "orderby" => "name", "order" => "ASC"));
					global $post;
					if (!empty($post_types)){
						$current_post_type_label = get_post_type_labels(get_post_type_object($post_type));
						?>
						<h3 class="sitemap-title post-type-<?php echo $post_type; ?>"><?php echo $current_post_type_label->name; ?></h3>
						<ul class="sitemap-box post-type-<?php echo $post_type; ?>">
							<?php
							foreach ($post_types as $post){
								setup_postdata($post);
								?>
								<li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></li>
								<?php
								wp_reset_postdata();
							}
							?>
						</ul>
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