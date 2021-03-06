<?php
/**
 * @package Custom
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * License: GPL2
 * Text Domain: custom
 * 
 * Copyright 2016 Sébastien Chandonay (email : please contact me from my website)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
defined('ABSPATH') or die("Go Away!");

$style = "width: 100%; height: 100%;";
$class = "";
$class = join(' ', get_post_class($class));
$class = wall_sanitize_wall_item_classes($class);

$width = 100;
$height = $wall_args['meta_wall_display_presentation_initial_height'];
?>
<li class="slider-item template-content <?php echo $class; ?>" style="height: <?php echo $height; ?>px; width: <?php echo $width; ?>%;">
	<?php if (!is_admin()){ ?>
	<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
	<?php } ?>
		<div class="inner-item content" style="<?php echo $style; ?>">
	
			<?php if (function_exists("custom_display_badge")) custom_display_badge(); ?>
			
			<div class="has-mask">
				<?php if (function_exists("custom_display_thumbnail")){
					custom_display_thumbnail(get_the_ID(), 'tool-wall-thumb', '', true, false, '<div class="thumb">', '</div>'); 
				}else if (has_post_thumbnail(get_the_ID())){
					?><div class="thumb"><?php the_post_thumbnail('tool-wall-thumb'); ?></div><?php 
				}?>
				<?php if (function_exists("custom_display_title")) custom_display_title(get_the_ID(), true, false, '<div class="title">', '</div>'); else the_title('<div class="title">', '</div>'); ?>
				<div class="excerpt"><?php the_excerpt(); ?></div>
			</div>
			<div class="has-infos">
				<?php if (function_exists("custom_display_thumbnail")){
					custom_display_thumbnail(get_the_ID(), 'tool-wall-thumb', '', true, false, '<div class="thumb">', '</div>'); 
				}else if (has_post_thumbnail(get_the_ID())){
					?><div class="thumb"><?php the_post_thumbnail('tool-wall-thumb'); ?></div><?php 
				}?>
				<?php if (function_exists("custom_display_title")) custom_display_title(get_the_ID(), true, false, '<div class="title">', '</div>'); else the_title('<div class="title">', '</div>'); ?>
				<div class="excerpt"><?php the_excerpt(); ?></div>
			</div>
		</div>
	<?php if (!is_admin()){ ?>
	</a>
	<?php }else{
		echo $wall_args["meta_wall_admin_item_code"];
	} ?>
</li>