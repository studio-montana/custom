<?php
/**
 * WALL Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

$style = "width: 100%; height: 100%;";
$class = "";
$class = join(' ', get_post_class($class));
$class = wall_sanitize_wall_item_classes($class);

$width = 100/$wall_args['meta_wall_display_presentation_columns']*$wall_args['wall_item_width_selected'];
$height = 250*$wall_args['wall_item_height_selected']; /* override by js */
?>
<li class="isotope-item template-content <?php echo $class; ?>"style="height: <?php echo $height; ?>px; width: <?php echo $width; ?>%;" data-format="<?php echo $wall_args['meta_wall_display_presentation_format']; ?>" data-columns="<?php echo $wall_args['wall_item_width_selected']; ?>" data-lines="<?php echo $wall_args['wall_item_height_selected']; ?>">
	<?php if (!is_admin()){ ?>
	<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
	<?php } ?>
		<div class="inner-item content" style="<?php echo $style; ?>">
	
			<?php // badge
			if (defined("META_DISPLAY_BADGED")) $badged = get_post_meta(get_the_ID(), META_DISPLAY_BADGED, true);
			else $badged = 'off';
			if (!empty($badged) && $badged == 'on'){ ?>
				<div class="has-badge"><span><?php echo get_post_meta(get_the_ID(), META_DISPLAY_BADGE_TEXT, true); ?></span></div>
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
		echo $wall_args["meta_wall_admin_item_code"];
	} ?>
</li>