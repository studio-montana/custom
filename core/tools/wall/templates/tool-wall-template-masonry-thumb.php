<?php
/**
 * WALL Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */
$ratio = "";
$style = "";
$class = "";
$style_thumb = "width: 100%; height: 100%;";
$has_thumb = false;
$width = $wall_args['meta_wall_display_presentation_masonry_width_customized'];
$height = $wall_args['meta_wall_display_presentation_masonry_height'];
if (has_post_thumbnail(get_the_ID())){
	$thumbnail_id = get_post_thumbnail_id(get_the_ID());
	$thumbnail = wp_get_attachment_image_src($thumbnail_id, 'tool-wall-thumb');
	if ($thumbnail) {
		$has_thumb = true;
		list($thumbnail_src, $thumbnail_width, $thumbnail_height) = $thumbnail;
		$ratio = $thumbnail_height / $thumbnail_width;
		if ($wall_args['meta_wall_display_presentation_masonry_width'] == "customized"){
			$style .= "max-width: ".$width."px;";
			$style .= "width: 100%;";
			$proportional_height = floor(($thumbnail_height*$width)/$thumbnail_width);
			if (!empty($height) && is_numeric($height) && $proportional_height > $height){
				$style .= "height: ".$height."px;";
			}else{
				$style .= "height: ".$proportional_height."px;";
			}
		}else{
			$style .= "width: ".(100/$wall_args['meta_wall_display_presentation_masonry_width'])."%;";
			$temp_width = floor($thumbnail_width * ((100 / $wall_args['meta_wall_display_presentation_masonry_width']) / 100));
			$proportional_height = floor(($thumbnail_height*$temp_width)/$thumbnail_width);
			if (!empty($height) && is_numeric($height) && $proportional_height > $height){
				$style .= "height: ".$height."px;";
			}else{
				$style .= "height: ".$proportional_height."px;";
			}
		}
		$style_thumb .= "background:	url('$thumbnail_src') no-repeat center center;";
		$style_thumb .= "-webkit-background-size: cover;";
		$style_thumb .= "-moz-background-size: cover;";
		$style_thumb .= "-o-background-size: cover;";
		$style_thumb .= "-ms-background-size: cover;";
		$style_thumb .= "background-size: cover;";
		$style_thumb .= "overflow: hidden;";
	}
}
if (!$has_thumb){
	if ($wall_args['meta_wall_display_presentation_masonry_width'] == "customized"){
		$style .= "max-width: ".$wall_args['meta_wall_display_presentation_masonry_width_customized']."px;";
		$style .= "width: 100%;";
	}else{
		$style .= "width: ".(100/$wall_args['meta_wall_display_presentation_masonry_width'])."%;";
	}
	$style .= " max-height: ".$wall_args["meta_wall_display_presentation_masonry_height"]."px;";
	$class .= ' no-thumb';
}else{
	$class .= ' has-thumb';
}
$class = join(' ', get_post_class($class));
$class = wall_sanitize_wall_item_classes($class);
?>
<li class="masonry-item template-thumb <?php echo $class; ?>" style="<?php echo $style; ?>" data-ratio-width-height="<?php echo $ratio; ?>" data-columns="1">
	<?php if (!is_admin()){ ?>
	<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
	<?php } ?>
		<div class="inner-item thumb" style="<?php echo $style_thumb; ?>">
	
			<?php // badge
			if (defined("META_DISPLAY_BADGED")) $badged = get_post_meta(get_the_ID(), META_DISPLAY_BADGED, true);
			else $badged = 'off';
			if (!empty($badged) && $badged == 'on'){ ?>
				<div class="has-badge"><span><?php echo get_post_meta(get_the_ID(), META_DISPLAY_BADGE_TEXT, true); ?></span></div>
			<?php } ?>
			
			<div class="has-mask">
				<?php
				if (defined("META_DISPLAY_CUSTOMTITLE")) $custom_title = get_post_meta(get_the_ID(), META_DISPLAY_CUSTOMTITLE, true);
				else $custom_title = '';
				if (empty($custom_title)) $custom_title = get_the_title();
				?>
				<div class="title"><?php echo $custom_title; ?></div>
			</div>
			<div class="has-infos">
				<?php
				if (defined("META_DISPLAY_CUSTOMTITLE")) $custom_title = get_post_meta(get_the_ID(), META_DISPLAY_CUSTOMTITLE, true);
				else $custom_title = '';
				if (empty($custom_title)) $custom_title = get_the_title();
				?>
				<div class="title"><?php echo $custom_title; ?></div>
			</div>
			<?php if (!$has_thumb && is_admin()){ ?><div class="no-content"><i class="fa fa-ban"></i></div><?php } ?>
		</div>
	<?php if (!is_admin()){ ?>
	</a>
	<?php }else{
		echo $wall_args['meta_wall_admin_item_code'];
	} ?>
</li>