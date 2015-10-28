<?php
/**
 * WALL Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */
$class = "";
$style = "width: 100%; height: 100%;";
$has_thumb = false;
if (has_post_thumbnail(get_the_ID())){
	$thumbnail_id = get_post_thumbnail_id(get_the_ID());
	$thumbnail = wp_get_attachment_image_src($thumbnail_id, 'tool-wall-thumb');
	if ($thumbnail) {
		$has_thumb = true;
		list($thumbnail_src, $thumbnail_width, $thumbnail_height) = $thumbnail;
		$style .= "background:	url('$thumbnail_src') no-repeat center center;";
		$style .= "-webkit-background-size: cover;";
		$style .= "-moz-background-size: cover;";
		$style .= "-o-background-size: cover;";
		$style .= "-ms-background-size: cover;";
		$style .= "background-size: cover;";
		$style .= "overflow: hidden;";
	}
}
if ($has_thumb){
	$class .= " has-thumb";
}else{
	$class .= " no-thumb";
}
$class = join(' ', get_post_class($class));
$class = wall_sanitize_wall_item_classes($class);

$width = 100/$wall_args['meta_wall_display_presentation_columns']*$wall_args['wall_item_width_selected'];
$height = $wall_args['meta_wall_display_presentation_initial_height']*$wall_args['wall_item_height_selected'];
?>
<li class="isotope-item template-thumb <?php echo $class; ?>"style="height: <?php echo $height; ?>px; width: <?php echo $width; ?>%;" data-columns="<?php echo $wall_args['wall_item_width_selected']; ?>" data-lines="<?php echo $wall_args['wall_item_height_selected']; ?>">
	<?php if (!is_admin()){ ?>
	<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
	<?php } ?>
		<div class="inner-item thumb" style="<?php echo $style; ?>">
	
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
		echo $wall_args["meta_wall_admin_item_code"];
	} ?>
</li>