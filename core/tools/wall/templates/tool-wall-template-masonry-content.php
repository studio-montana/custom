<?php
/**
 * WALL Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */
$style = "";
$class = "";
if ($wall_args['meta_wall_display_presentation_masonry_width'] == "customized"){
	$style .= "max-width: ".$wall_args['meta_wall_display_presentation_masonry_width_customized']."px;";
	$style .= "width: 100%;";
}else{
	$style .= "width: ".(100/$wall_args['meta_wall_display_presentation_masonry_width'])."%;";
}
$style .= " height: auto;";
$class = join(' ', get_post_class($class));
$class = wall_sanitize_wall_item_classes($class);
?>
<li class="masonry-item template-content <?php echo $class; ?>" style="<?php echo $style; ?>" data-autoresponsive="true" data-columns="1">
	<?php if (!is_admin()){ ?>
	<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
	<?php } ?>
		<div class="inner-item content" style="width: 100%; height: 100%;">
	
			<?php // badge
			if (defined("META_DISPLAY_BADGED")) $badged = get_post_meta(get_the_ID(), META_DISPLAY_BADGED, true);
			else $badged = 'off';
			if (!empty($badged) && $badged == 'on'){ ?>
				<div class="has-badge"><span><?php _e("new", CUSTOM_TEXT_DOMAIN); ?></span></div>
			<?php } ?>
			
			<div class="has-mask">
				<?php if (has_post_thumbnail(get_the_ID())){ ?>
					<div class="thumb"><?php the_post_thumbnail('tool-wall-thumb'); ?></div>
				<?php } ?>
				<?php
				if (defined("META_DISPLAY_CUSTOMTITLE")) $custom_title = get_post_meta(get_the_ID(), META_DISPLAY_CUSTOMTITLE, true);
				else $custom_title = '';
				if (empty($custom_title)) $custom_title = get_the_title();
				?>
				<div class="title"><?php echo $custom_title; ?></div>
				<div class="excerpt"><?php the_excerpt(); ?></div>
			</div>
			<div class="has-infos">
				<?php if (has_post_thumbnail(get_the_ID())){ ?>
					<div class="thumb"><?php the_post_thumbnail('tool-wall-thumb'); ?></div>
				<?php } ?>
				<?php
				if (defined("META_DISPLAY_CUSTOMTITLE")) $custom_title = get_post_meta(get_the_ID(), META_DISPLAY_CUSTOMTITLE, true);
				else $custom_title = '';
				if (empty($custom_title)) $custom_title = get_the_title();
				?>
				<div class="title"><?php echo $custom_title; ?></div>
				<div class="excerpt"><?php the_excerpt(); ?></div>
			</div>
		</div>
		
	<?php if (!is_admin()){ ?>
	</a>
	<?php }else{
		echo $wall_args['meta_wall_admin_item_code'];
	} ?>
</li>