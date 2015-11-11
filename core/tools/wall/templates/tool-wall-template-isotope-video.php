<?php
/**
 * WALL Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */
$class = "";
if (video_has_featured_video(get_the_ID())){
	$class .= ' has-video';
}else{
	$class .= ' no-video';
}
$class = join(' ', get_post_class($class));
$class = wall_sanitize_wall_item_classes($class);

$width = 100/$wall_args['meta_wall_display_presentation_columns']*$wall_args['wall_item_width_selected'];
$height = 250*$wall_args['wall_item_height_selected']; /* override by js */
?>
<li class="isotope-item template-video <?php echo $class; ?>"style="height: <?php echo $height; ?>px; width: <?php echo $width; ?>%;" data-format="<?php echo $wall_args['meta_wall_display_presentation_format']; ?>" data-columns="<?php echo $wall_args['wall_item_width_selected']; ?>" data-lines="<?php echo $wall_args['wall_item_height_selected']; ?>">
	<div class="inner-item video" style="width: 100%; height: 100%;">
	
		<?php // badge
		if (defined("META_DISPLAY_BADGED")) $badged = get_post_meta(get_the_ID(), META_DISPLAY_BADGED, true);
		else $badged = 'off';
		if (!empty($badged) && $badged == 'on'){ ?>
			<div class="has-badge"><span><?php echo get_post_meta(get_the_ID(), META_DISPLAY_BADGE_TEXT, true); ?></span></div>
		<?php } ?>
			
		<?php
		if (video_has_featured_video(get_the_ID())){
			 echo video_get_featured_video(get_the_ID(), "100%", "100%");
		}else if(is_admin()){
			?>
			<div class="no-content" style="min-height: 150px;"><i class="fa fa-ban"></i></div>
			<?php
		}
		?>
		<?php if (!is_admin()){ ?>
		<div class="has-more"><a class="post-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php _e("more", CUSTOM_TEXT_DOMAIN); ?></a></div>
		<?php } ?>
	</div>
	<?php if (is_admin()){
		echo $wall_args["meta_wall_admin_item_code"];
	} ?>
</li>