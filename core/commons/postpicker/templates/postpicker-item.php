<?php
/**
 * Post-picker items template
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.1
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */
if (!defined ('ABSPATH')) die ('No direct access allowed');
?>
<article>
	<?php 
	$has_video = false;
	$has_thumb = false;
	// featured video
	if (is_registered_custom_tool('video') && video_has_featured_video(get_the_ID())){
		$has_video = true;
		?>
		<div class="video"><?php echo video_get_featured_video(get_the_ID(), "100%", "100%"); ?></div>
		<?php
	}
	// featured thumbnail
	if (!$has_video){
		if (has_post_thumbnail()){
			$attach_id = get_post_thumbnail_id(get_the_ID());
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
					$has_thumb = true;
					?>
					<div class="thumb" style="<?php echo $style; ?>"></div>
					<?php
				}
			}
		}
	}
	// excerpt
	if (!$has_video && !$has_thumb){
		?>
		<div class="excerpt"><?php echo get_the_excerpt(); ?></div>
		<?php
	}
	?>
	<h1 class="title"><?php echo get_the_title(); ?></h1>
</article>