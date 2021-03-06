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

$current_post_type_label = get_post_type_labels(get_post_type_object(get_post_type()));
?>
<div id="tool-wall-display-wall" class="custom-fields-section">
	<header class="custom-fields-section-header">
		<h3><?php _e('Wall', CUSTOM_PLUGIN_TEXT_DOMAIN); ?></h3>
		<em style="margin-left: 12px;"><?php _e('insert elements in this', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> <?php echo $current_post_type_label->singular_name;?></em>
	</header>
	<div class="custom-fields-section-content">
		<table class="fields">
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_POST_TYPE; ?>"><?php _e('Display', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_POST_TYPE, true); ?>
					<select class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_POST_TYPE; ?>" name="<?php echo META_WALL_DISPLAY_POST_TYPE; ?>">
						<option value="0" <?php if (empty($meta) || $meta == '0'){ echo 'selected="selected"'; }?>><?php _e("nothing", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<?php $post_types = get_displayed_post_types();
						foreach ($post_types as $post_type){ ?>
							<?php
							$post_type_label = get_post_type_labels(get_post_type_object($post_type));
							$hierarchical = is_post_type_hierarchical($post_type) ? 'true' : 'false';
							?>
							<option value="<?php echo $post_type; ?>" <?php if (!empty($meta) && $meta == $post_type){ echo 'selected="selected"'; }?> data-list="dynamic" data-hierarchical="<?php echo $hierarchical; ?>"><?php echo $post_type_label->name; ?></option>
						<?php } ?>
						<option value="-1" <?php if (!empty($meta) && $meta == '-1'){ echo 'selected="selected"'; }?> data-list="static"><?php _e("customized…", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
					</select>
				</td>
				<td valign="middle">
					<span id="choose-wall-elements" class="button display-wall-options display-wall-options-list display-wall-options-list-static">
						<i class="fa fa-search" style="margin-right: 6px;"></i><?php _e("manage your elements", CUSTOM_PLUGIN_TEXT_DOMAIN); ?>
					</span>
				</td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-options-list display-wall-options-list-dynamic">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_TERM_SLUG; ?>">-&nbsp;<?php _e('Type', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_TERM_SLUG, true); ?>
					<select class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_TERM_SLUG; ?>" name="<?php echo META_WALL_DISPLAY_TERM_SLUG; ?>">
						<option value="0" <?php if (empty($meta) || $meta == '0'){ echo 'selected="selected"'; }?>><?php _e("All", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<?php 
						// complex tax options - controls by javascript which display valid terms for selected post_type
						$tax_options = '';
						$taxes = get_taxonomies(array(), false);
						$displayed_post_types = get_displayed_post_types();
						foreach ($taxes as $tax){
							$terms = get_terms($tax->name);
							$tax_post_type = $tax->object_type;
							$tax_post_types = "";
							$tax_labels = get_taxonomy_labels($tax);
							foreach ($tax_post_type as $tpt){
								if (in_array($tpt, $displayed_post_types)){
									if (!empty($tax_post_types))
										$tax_post_types .= " ";
									$tax_post_types .= $tpt;
								}
							}
							if (!empty($tax_post_types)){
								if (!empty($terms)){
									$tax_options .= '<optgroup label="'.esc_attr($tax_labels->name).'">';
									foreach ($terms as $term){
										$selected = !empty($meta) && $meta == $term->slug ? 'selected="selected"' : '';
										$tax_options .= '<option value="'.$term->slug.'" data-tax="'.$tax->name.'" data-post-type="'.$tax_post_types.'" '.$selected.'>'.$term->name.'</option>';
									}
									$tax_options .= '</optgroup>';
								}
							}
						}
						echo $tax_options;
						?>
					</select>
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-options-list display-wall-options-list-dynamic">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_ORDERBY; ?>">-&nbsp;<?php _e('Order by', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_ORDERBY, true); ?>
					<select class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_ORDERBY; ?>" name="<?php echo META_WALL_DISPLAY_ORDERBY; ?>">
						<option value="none" <?php if (!empty($meta) && $meta == 'none'){ echo 'selected="selected"'; }?>><?php _e("no order", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="ID" <?php if (!empty($meta) && $meta == 'ID'){ echo 'selected="selected"'; }?>><?php _e("id", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="author" <?php if (!empty($meta) && $meta == 'author'){ echo 'selected="selected"'; }?>><?php _e("author", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="title" <?php if (!empty($meta) && $meta == 'title'){ echo 'selected="selected"'; }?>><?php _e("title", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="date" <?php if (empty($meta) || $meta == 'date'){ echo 'selected="selected"'; }?>><?php _e("date", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="modified" <?php if (!empty($meta) && $meta == 'modified'){ echo 'selected="selected"'; }?>><?php _e("last modified date", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="rand" <?php if (!empty($meta) && $meta == 'rand'){ echo 'selected="selected"'; }?>><?php _e("random", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="menu_order" <?php if (!empty($meta) && $meta == 'menu_order'){ echo 'selected="selected"'; }?>><?php _e("num. order", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
					</select>
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-options-list display-wall-options-list-dynamic">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_ORDER; ?>">-&nbsp;<?php _e('Order', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_ORDER, true); ?>
					<select class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_ORDER; ?>" name="<?php echo META_WALL_DISPLAY_ORDER; ?>">
						<option value="DESC" <?php if (empty($meta) || $meta == 'DESC'){ echo 'selected="selected"'; }?>><?php _e("descendant", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="ASC" <?php if (!empty($meta) && $meta == 'ASC'){ echo 'selected="selected"'; }?>><?php _e("ascendant", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
					</select>
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-options-list display-wall-options-list-dynamic">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_NUMBER; ?>">-&nbsp;<?php _e('Number limit', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_NUMBER, true); ?>
					<input class="wall-update-presentation-setup" type="number" size="4" id="<?php echo META_WALL_DISPLAY_NUMBER; ?>" name="<?php echo META_WALL_DISPLAY_NUMBER; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-options-list display-wall-options-list-dynamic">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PARENT; ?>">-&nbsp;<?php _e('Children of', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PARENT, true); ?>
					<select class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_PARENT; ?>" name="<?php echo META_WALL_DISPLAY_PARENT; ?>">
						<option value="-1" <?php if (!isset($meta) || $meta == '-1'){ echo 'selected="selected"'; }?>><?php _e("All", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="0" <?php if (isset($meta) && $meta == '0'){ echo 'selected="selected"'; }?>><?php _e("First level", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<?php
						$post_types_hierarchical = array();
						$post_types = get_displayed_post_types();
						foreach ($post_types as $post_type){
							if (is_post_type_hierarchical($post_type))
								$post_types_hierarchical[] = $post_type;
						}
						echo wall_get_post_types_options($post_types_hierarchical, $meta, get_the_ID());
						?>
					</select>
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_POSITION; ?>">-&nbsp;<?php _e('Position', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_POSITION, true); ?>
					<select id="<?php echo META_WALL_DISPLAY_POSITION; ?>" name="<?php echo META_WALL_DISPLAY_POSITION; ?>">
						<option value="after-content" <?php if (empty($meta) || $meta == 'after-content'){ echo 'selected="selected"'; }?>><?php _e("after content", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="before-content" <?php if (!empty($meta) && $meta == 'before-content'){ echo 'selected="selected"'; }?>><?php _e("before content", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
					</select>
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION; ?>">-&nbsp;<?php _e('Presentation', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION, true); ?>
					<select class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_PRESENTATION; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION; ?>">
						<option value="masonry" <?php if (empty($meta) || $meta == 'masonry'){ echo 'selected="selected"'; }?>><?php _e("masonry", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="slider" <?php if (!empty($meta) && $meta == 'slider'){ echo 'selected="selected"'; }?>><?php _e("slider", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="list" <?php if (!empty($meta) && $meta == 'list'){ echo 'selected="selected"'; }?>><?php _e("list", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="isotope" <?php if (!empty($meta) && $meta == 'isotope'){ echo 'selected="selected"'; }?>><?php _e("grid", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
					</select>
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-specific-options display-wall-isotope-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION_COLUMNS; ?>">-&nbsp;<?php _e('Columns', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_COLUMNS, true); ?>
					<select class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_PRESENTATION_COLUMNS; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_COLUMNS; ?>">
						<option value="1" <?php if (!empty($meta) && $meta == '1'){ echo 'selected="selected"'; }?>><?php _e("1", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="2" <?php if (!empty($meta) && $meta == '2'){ echo 'selected="selected"'; }?>><?php _e("2", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="3" <?php if (empty($meta) || $meta == '3'){ echo 'selected="selected"'; }?>><?php _e("3", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="4" <?php if (!empty($meta) && $meta == '4'){ echo 'selected="selected"'; }?>><?php _e("4", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="5" <?php if (!empty($meta) && $meta == '5'){ echo 'selected="selected"'; }?>><?php _e("5", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="6" <?php if (!empty($meta) && $meta == '6'){ echo 'selected="selected"'; }?>><?php _e("6", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
					</select>
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-specific-options display-wall-slider-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION_INITIAL_HEIGHT; ?>">-&nbsp;<?php _e('Height', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_INITIAL_HEIGHT, true); 
					if (empty($meta) || !is_numeric($meta))
						$meta = "250";
					?>
					<input class="wall-update-presentation-setup" type="number" size="4" id="<?php echo META_WALL_DISPLAY_PRESENTATION_INITIAL_HEIGHT; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_INITIAL_HEIGHT; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle">px</td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-specific-options display-wall-isotope-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION_FORMAT; ?>">-&nbsp;<?php _e('Format', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_FORMAT, true); ?>
					<select class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_PRESENTATION_FORMAT; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_FORMAT; ?>">
						<option value="square" <?php if (empty($meta) || $meta == 'square'){ echo 'selected="selected"'; }?>><?php _e("square", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="portrait" <?php if (!empty($meta) && $meta == 'portrait'){ echo 'selected="selected"'; }?>><?php _e("portrait", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="landscape" <?php if (!empty($meta) && $meta == 'landscape'){ echo 'selected="selected"'; }?>><?php _e("landscape", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
					</select>
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			
			<tr valign="top" class="display-wall-options display-wall-specific-options display-wall-masonry-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_WIDTH; ?>">-&nbsp;<?php _e('Max width', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_MASONRY_WIDTH, true); ?>
					<select class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_WIDTH; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_WIDTH; ?>">
						<option value="1" <?php if (empty($meta) && $meta == '1'){ echo 'selected="selected"'; }?>><?php _e("100%", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="2" <?php if (!empty($meta) && $meta == '2'){ echo 'selected="selected"'; }?>><?php _e("50%", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="3" <?php if (!empty($meta) && $meta == '3'){ echo 'selected="selected"'; }?>><?php _e("33%", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="4" <?php if (empty($meta) || $meta == '4'){ echo 'selected="selected"'; }?>><?php _e("25%", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="5" <?php if (!empty($meta) && $meta == '5'){ echo 'selected="selected"'; }?>><?php _e("20%", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="6" <?php if (!empty($meta) && $meta == '6'){ echo 'selected="selected"'; }?>><?php _e("16%", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="customized" <?php if (!empty($meta) && $meta == 'customized'){ echo 'selected="selected"'; }?>><?php _e("customized…", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
					</select>
				</td>
				<td valign="middle" class="display-wall-masonry-options-customized-width">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED, true); 
					if (empty($meta) || !is_numeric($meta))
						$meta = "250";
					?>
					<input class="wall-update-presentation-setup" type="number" size="4" id="<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle" class="display-wall-masonry-options-customized-width">px</td>
			</tr>
			
			<tr valign="top" class="display-wall-options display-wall-specific-options display-wall-masonry-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_HEIGHT; ?>">-&nbsp;<?php _e('Max height', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_MASONRY_HEIGHT, true); 
					if (empty($meta) || !is_numeric($meta))
						$meta = "";
					?>
					<input type="checkbox" class="wall-update-presentation-setup" id="display-wall-masonry-auto-height" <?php if (empty($meta)){ echo ' checked="checked"'; } ?> />&nbsp;<label for="display-wall-masonry-auto-height"><?php _e("Auto", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></label>
				</td>
				<td valign="middle" class="display-wall-masonry-options-customized-height">
					<input class="wall-update-presentation-setup" type="text" size="4" id="<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_HEIGHT; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_HEIGHT; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle" class="display-wall-masonry-options-customized-height">px</td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-specific-options display-wall-masonry-options display-wall-isotope-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION_FILTERING; ?>">-&nbsp;<?php _e('Display filters', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_FILTERING, true); ?>
					<input type="checkbox" class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_PRESENTATION_FILTERING; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_FILTERING; ?>" <?php if (!empty($meta) && $meta == 'on'){ echo 'checked="checked"'; }?> />
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-specific-options display-wall-slider-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_AUTOPLAY; ?>">-&nbsp;<?php _e('Autoplay', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_SLIDER_AUTOPLAY, true); ?>
					<input type="checkbox" class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_AUTOPLAY; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_AUTOPLAY; ?>" <?php if (!empty($meta) && $meta == 'on'){ echo 'checked="checked"'; }?> />
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-specific-options display-wall-slider-options display-wall-slider-options-thumb-nav">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_THUMB_NAV; ?>">-&nbsp;<?php _e('Thumb navigation', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_SLIDER_THUMB_NAV, true); ?>
					<input type="checkbox" class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_THUMB_NAV; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_THUMB_NAV; ?>" <?php if (!empty($meta) && $meta == 'on'){ echo 'checked="checked"'; }?> />
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-specific-options display-wall-slider-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL; ?>">-&nbsp;<?php _e('Carousel', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL, true); ?>
					<input type="checkbox" class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL; ?>" <?php if (!empty($meta) && $meta == 'on'){ echo 'checked="checked"'; }?> />
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-specific-options display-wall-slider-options display-wall-slider-options-carousel">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_COLUMNS; ?>">-&nbsp;<?php _e('Carousel columns', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_COLUMNS, true); ?>
					<select class="wall-update-presentation-setup" id="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_COLUMNS; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_COLUMNS; ?>">
						<option value="1" <?php if (!empty($meta) && $meta == '1'){ echo 'selected="selected"'; }?>><?php _e("1", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="2" <?php if (!empty($meta) && $meta == '2'){ echo 'selected="selected"'; }?>><?php _e("2", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="3" <?php if (empty($meta) || $meta == '3'){ echo 'selected="selected"'; }?>><?php _e("3", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="4" <?php if (!empty($meta) && $meta == '4'){ echo 'selected="selected"'; }?>><?php _e("4", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="5" <?php if (!empty($meta) && $meta == '5'){ echo 'selected="selected"'; }?>><?php _e("5", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
						<option value="6" <?php if (!empty($meta) && $meta == '6'){ echo 'selected="selected"'; }?>><?php _e("6", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></option>
					</select>
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-specific-options display-wall-slider-options display-wall-slider-options-carousel">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH; ?>">-&nbsp;<?php _e('Carousel item width', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH, true); 
					if (empty($meta) || !is_numeric($meta))
						$meta = "250";
					?>
					<input type="text" class="wall-update-presentation-setup" size="4" id="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle">px</td>
				<td valign="middle"></td>
			</tr>
			<tr valign="top" class="display-wall-options display-wall-specific-options display-wall-slider-options display-wall-slider-options-carousel">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN; ?>">-&nbsp;<?php _e('Carousel item margin', CUSTOM_PLUGIN_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN, true); 
					if (empty($meta) || !is_numeric($meta))
						$meta = "5";
					?>
					<input type="text" class="wall-update-presentation-setup" size="4" id="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle">px</td>
				<td valign="middle"></td>
			</tr>
		</table>
		<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_TAX, true); ?>
		<input type="hidden" name="<?php echo META_WALL_DISPLAY_TAX; ?>" value="<?php echo $meta; ?>" /><!-- updated by javascript when META_WALL_DISPLAY_TERM_SLUG option change -->
		<hr />
		<div class="display-wall-options">
			<div id="wall-presentation-setup" style="min-height: 400px;">
				<!-- content set by ajax call -->
			</div>
		</div>
		
		<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_PRESENTATION_SETUP, true);
		if (!empty($meta)){
			$meta = htmlentities($meta);
		}
		?>
		<input type="hidden" id="<?php echo META_WALL_DISPLAY_PRESENTATION_SETUP; ?>" name="<?php echo META_WALL_DISPLAY_PRESENTATION_SETUP; ?>" value="<?php echo $meta; ?>" />
		
		<?php $meta = get_post_meta(get_the_ID(), META_WALL_DISPLAY_IDS, true);
		?>
		<input type="hidden" id="<?php echo META_WALL_DISPLAY_IDS; ?>" name="<?php echo META_WALL_DISPLAY_IDS; ?>" value="<?php echo $meta; ?>" />
		
		<script type="text/javascript">
		(function($) {
			$wall_masonry = null;
			$wall_isotope = null;
			$(document).ready(function(){
				// manage customized wall elements 
				var postpicker = null;
				$("#choose-wall-elements").on("click", function(e){
					var exclude_ids = "<?php echo get_the_ID(); ?>";
					var selected_ids = $("input[name='<?php echo META_WALL_DISPLAY_IDS; ?>']").val();
					if (postpicker == null){
						postpicker = $("body").postpicker({
								selected : selected_ids,
								exclude : exclude_ids,
								multi_select : true,
								order : true,
								onopen : function(){},
								oncontentupdated : function(){},
								oncontentupdatefail : function(){},
								onclose : function(){},
								done_button_text : "<?php _e("Update wall", CUSTOM_PLUGIN_TEXT_DOMAIN); ?>",
								order_button_text : "<?php _e("Order elements", CUSTOM_PLUGIN_TEXT_DOMAIN); ?>",
								ondone : function(post_ids){
									$("input[name='<?php echo META_WALL_DISPLAY_IDS; ?>']").val(post_ids.join(","));
									update_wall_presentation_setup();
								}
							});
						postpicker.open();
					}else{
						postpicker.options({
							selected : selected_ids,
							ondone : function(post_ids){
								$("input[name='<?php echo META_WALL_DISPLAY_IDS; ?>']").val(post_ids.join(","));
								update_wall_presentation_setup();
							}
						});
						postpicker.open();
					}
				});
				// post type change 
				$("#<?php echo META_WALL_DISPLAY_POST_TYPE; ?>").on("change", function(e){
					if ($(this).val() != "0"){
						$(".display-wall-options").fadeIn();
						update_wall_term_options();
						update_wall_parent_options();
						update_wall_list_options();
						update_wall_specific_options();
						update_wall_masonry_options();
					}else{
						$(".display-wall-options").fadeOut();
					}
				});
				// term slug change 
				$("#<?php echo META_WALL_DISPLAY_TERM_SLUG; ?>").on("change", function(e){
					update_wall_filtering();
					update_wall_tax_value();
				});
				// presentation change 
				$("#<?php echo META_WALL_DISPLAY_PRESENTATION; ?>").on("change", function(e){
					update_wall_specific_options();
					update_wall_filtering();
					update_wall_masonry_options();
					update_wall_slider_options();
				});
				// slider carousel 
				$("#<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL; ?>").on("change", function(e){
					update_wall_slider_options();
				});
				// masonry max width 
				$("#<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_WIDTH; ?>").on("change", function(e){
					update_wall_masonry_options();
				});
				// masonry max height 
				$("#display-wall-masonry-auto-height").on("click", function(e){
					update_wall_masonry_options();
				});
				// presentation setup on change 
				$(".wall-update-presentation-setup").on("change", function(e){
					update_wall_presentation_setup();
				});
				// save presentation on change 
				$(document).on("change", ".save-presentation-setup", function(e){
					save_wall_presentation_setup();
					update_wall_presentation_setup();
				});
				// init 
				if ($("#<?php echo META_WALL_DISPLAY_POST_TYPE; ?>").val() != "0"){
					$(".display-wall-options").fadeIn(0);
					update_wall_list_options();
					update_wall_specific_options();
					update_wall_term_options();
					update_wall_parent_options();
					update_wall_filtering();
					update_wall_masonry_options();
					update_wall_slider_options();
					update_wall_presentation_setup();
				}else{
					$(".display-wall-options").fadeOut(0);
				}
				// update columnWidth on window resize 
				$(window).resize(function() {
					if ($wall_isotope != null){
						$wall_isotope.isotope({
							// update columnWidth to a percentage of container width 
							masonry : {
								columnWidth : $wall_isotope.width() / $wall_isotope.data("columns")
							}
						});
					}
				});
			});
			function update_wall_slider_options(){
				if ($("#<?php echo META_WALL_DISPLAY_PRESENTATION; ?>").val() == 'slider'){
					$(".display-wall-slider-options-carousel").fadeOut(0);
					$(".display-wall-slider-options-thumb-nav").fadeOut(0);
					if ($("#<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL; ?>").is(":checked")){
						$(".display-wall-slider-options-carousel").fadeIn();
					}else{
						$(".display-wall-slider-options-thumb-nav").fadeIn();
					}
				}
			}
			function update_wall_masonry_options(){
				if ($("#<?php echo META_WALL_DISPLAY_PRESENTATION; ?>").val() == 'masonry'){
					$(".display-wall-masonry-options-customized-width").fadeOut(0);
					if ($("#<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_WIDTH; ?>").val() == 'customized'){
						$(".display-wall-masonry-options-customized-width").fadeIn();
					}
					$(".display-wall-masonry-options-customized-height").fadeOut(0);
					if ($("#display-wall-masonry-auto-height").is(":checked")){
						$("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_HEIGHT; ?>']").val("");
					}else{
						$(".display-wall-masonry-options-customized-height").fadeIn();
						if ($("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_HEIGHT; ?>']").val() == ""){
							$("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_HEIGHT; ?>']").val("250");
						}
					}
				}
			}
			function update_wall_specific_options(){
				$(".display-wall-specific-options").fadeOut(0);
				$(".display-wall-"+$("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION; ?>']").val()+"-options").fadeIn();
			}
			function update_wall_list_options(){
				$(".display-wall-options-list").fadeOut(0);
				$(".display-wall-options-list-"+$("*[name='<?php echo META_WALL_DISPLAY_POST_TYPE; ?>'] option:selected").data('list')).fadeIn();
			}
			function update_wall_filtering(){
				// display filtering option only in masonry presentation and if no tax is selected 
				if ($("*[name='<?php echo META_WALL_DISPLAY_TERM_SLUG; ?>']").val() == "0" 
					&& $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION; ?>']").val() != 'slider'
					&& $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION; ?>']").val() != 'list'){
					$(".display-wall-filtering-options").fadeIn();
				}else{
					$(".display-wall-filtering-options").fadeOut(0);
					$("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_FILTERING; ?>']").prop('checked', false);
				}
			}
			function update_wall_tax_value(){
				if ($("*[name='<?php echo META_WALL_DISPLAY_TERM_SLUG; ?>']").val() != "0"){
					$("*[name='<?php echo META_WALL_DISPLAY_TAX; ?>']").val($("*[name='<?php echo META_WALL_DISPLAY_TERM_SLUG; ?>'] option:selected").data('tax'));
				}else{
					$("*[name='<?php echo META_WALL_DISPLAY_TAX; ?>']").val("");
				}
			}
			function update_wall_term_options(){
				var post_type = $("#<?php echo META_WALL_DISPLAY_POST_TYPE; ?>").val();
				var has_selected_value = false;
				$("#<?php echo META_WALL_DISPLAY_TERM_SLUG; ?> option").each(function(i){
					if ($(this).attr('value') == '0' || $(this).data('post-type') == post_type){
						$(this).prop("disabled", false);
						if ($(this).attr('selected') == 'selected'){
							has_selected_value = true;
						}
					}else{
						$(this).prop("disabled", true);
					}
				});
				// no value selected - select default 
				if (has_selected_value == false){
					$("#<?php echo META_WALL_DISPLAY_TERM_SLUG; ?> option[value='0']").attr('selected', 'selected');
				}
				update_wall_tax_value();
			}
			function update_wall_parent_options(){
				if ($("*[name='<?php echo META_WALL_DISPLAY_POST_TYPE; ?>'] option:selected").data('hierarchical') == true){
					$("#<?php echo META_WALL_DISPLAY_PARENT; ?>").prop('disabled', false);
					var post_type = $("#<?php echo META_WALL_DISPLAY_POST_TYPE; ?>").val();
					var has_selected_value = false;
					$("#<?php echo META_WALL_DISPLAY_PARENT; ?> option").each(function(i){
						if ($(this).attr('value') == '0' || $(this).attr('value') == '-1' || $(this).data('post-type') == post_type){
							$(this).prop("disabled", false);
							if ($(this).attr('selected') == 'selected'){
								has_selected_value = true;
							}
						}else{
							$(this).prop("disabled", true);
						}
					});
					// no value selected - select default 
					if (has_selected_value == false){
						$("#<?php echo META_WALL_DISPLAY_PARENT; ?> option[value='-1']").attr('selected', 'selected');
					}
				}else{
					$("#<?php echo META_WALL_DISPLAY_PARENT; ?> option[value='-1']").attr('selected', 'selected');
					$("#<?php echo META_WALL_DISPLAY_PARENT; ?>").prop('disabled', true);
				}
			}
			function update_wall_presentation_setup(){
				var post_type = $("*[name='<?php echo META_WALL_DISPLAY_POST_TYPE; ?>']").val();
				var ids = $("*[name='<?php echo META_WALL_DISPLAY_IDS; ?>']").val();
				var tax = $("*[name='<?php echo META_WALL_DISPLAY_TAX; ?>']").val();
				var term_slug = $("*[name='<?php echo META_WALL_DISPLAY_TERM_SLUG; ?>']").val();
				var orderby = $("*[name='<?php echo META_WALL_DISPLAY_ORDERBY; ?>']").val();
				var order = $("*[name='<?php echo META_WALL_DISPLAY_ORDER; ?>']").val();
				var number = $("*[name='<?php echo META_WALL_DISPLAY_NUMBER; ?>']").val();
				var parent = $("*[name='<?php echo META_WALL_DISPLAY_PARENT; ?>']").val();
				var presentation = $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION; ?>']").val();
				var presentation_filtering = '';
				if ($("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_FILTERING; ?>']").is(":checked")){
					presentation_filtering = 'on';
				}
				var presentation_slider_autoplay = '';
				if ($("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_AUTOPLAY; ?>']").is(":checked")){
					presentation_slider_autoplay = 'on';
				}
				var presentation_slider_thumb_nav = '';
				if ($("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_THUMB_NAV; ?>']").is(":checked")){
					presentation_slider_thumb_nav = 'on';
				}
				var presentation_slider_carousel = '';
				if ($("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL; ?>']").is(":checked")){
					presentation_slider_carousel = 'on';
				}
				var presentation_slider_carousel_columns = $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_COLUMNS; ?>']").val();
				var presentation_slider_carousel_item_width = $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH; ?>']").val();
				var presentation_slider_carousel_item_margin = $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN; ?>']").val();
				var presentation_setup = $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_SETUP; ?>']").val();
				var presentation_columns = $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_COLUMNS; ?>']").val();
				var presentation_initial_height = $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_INITIAL_HEIGHT; ?>']").val();
				var presentation_format = $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_FORMAT; ?>']").val();
				var presentation_masonry_width = $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_WIDTH; ?>']").val();
				var presentation_masonry_width_customized = $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED; ?>']").val();
				var presentation_masonry_height = "";
				if (!$("#display-wall-masonry-auto-height").is(":checked")){
					presentation_masonry_height = $("*[name='<?php echo META_WALL_DISPLAY_PRESENTATION_MASONRY_HEIGHT; ?>']").val();
					if (presentation_masonry_height == ""){
						presentation_masonry_height = "250";
					}
				}
				var current_post_id = <?php echo get_the_ID(); ?>;
				wait($("#tool-wall-display-wall"));
				get_wall_presentation_results(
						current_post_id,
						post_type,
						ids,
						tax,
						term_slug,
						orderby,
						order,
						number,
						parent,
						presentation,
						presentation_filtering,
						presentation_slider_autoplay,
						presentation_slider_thumb_nav,
						presentation_slider_carousel,
						presentation_slider_carousel_columns,
						presentation_slider_carousel_item_width,
						presentation_slider_carousel_item_margin,
						presentation_setup,
						presentation_columns,
						presentation_initial_height,
						presentation_format,
						presentation_masonry_width,
						presentation_masonry_width_customized,
						presentation_masonry_height,
						function(response){
							unwait($("#tool-wall-display-wall"));
							$("#wall-presentation-setup").html($(response).text());
							if (presentation == 'slider'){
								var options = {prevText : '', nextText : '', autoHover : true};
								if (presentation_slider_autoplay == 'on'){
									options = $.extend({
										auto: true
									}, options);
								}
								if (presentation_slider_carousel == 'on'){
									options = $.extend({
										minSlides: parseInt(presentation_slider_carousel_columns),
										maxSlides: parseInt(presentation_slider_carousel_columns),
										slideWidth: parseInt(presentation_slider_carousel_item_width),
										slideMargin: parseInt(presentation_slider_carousel_item_margin),
										moveSlides: 1,
									}, options);
								}else{
									if (presentation_slider_thumb_nav == 'on'){
										options = $.extend({
											pagerCustom: '.tool-wall.admin.slider-thumb-nav'
										}, options);
									}
								}
								$slider = $('.tool-wall.admin.slider').bxSlider(options);
							}else if (presentation == 'masonry'){
								$wall_masonry = $('#admin-masonry-wall');
								$('#admin-masonry-wall-filter li').click(function() {
									var selector = $(this).attr('data-filter');
									$wall_masonry.isotope({
										filter : selector
									});
									$('#admin-masonry-wall-filter li').removeClass('active');
									$(this).addClass('active');
									return false;
								});
								$(document).trigger('gallery-isotope-ready', [$wall_masonry, '.masonry-item']); // use custom-gallery.js 
							}else{
								$wall_isotope = $('#admin-isotope-wall');
								$('#admin-isotope-wall-filter li').click(function() {
									var selector = $(this).attr('data-filter');
									$wall_isotope.isotope({
										filter : selector
									});
									$('#admin-isotope-wall-filter li').removeClass('active');
									$(this).addClass('active');
									return false;
								});
								$(document).trigger('gallery-isotope-ready', [$wall_isotope, '.isotope-item']); // use custom-gallery.js 
							}
							$("#wall-presentation-setup").fadeIn();
						}, function(){
							unwait($("#tool-wall-display-wall"));
							$("#wall-presentation-setup").html("");
							$("#wall-presentation-setup").fadeOut();
							$wall_isotope = null;
							$wall_masonry = null;
						}
				);
			}
			function save_wall_presentation_setup(){
				var setup = '';
				var saved_widths = []; // avoid to save cloned select 
				$(".wall-presentation-width").each(function(i){
					if ($.inArray($(this).attr('name'), saved_templates) < 0){
						if (setup == ''){
							setup += '{';
						}else{
							setup += ',';
						}
						setup += '"'+$(this).attr('name')+'":"'+$(this).val()+'"';
						saved_widths.push($(this).attr('name'));
					}
				});
				var saved_height = []; // avoid to save cloned select 
				$(".wall-presentation-height").each(function(i){
					if ($.inArray($(this).attr('name'), saved_templates) < 0){
						if (setup == ''){
							setup += '{';
						}else{
							setup += ',';
						}
						setup += '"'+$(this).attr('name')+'":"'+$(this).val()+'"';
						saved_height.push($(this).attr('name'));
					}
				});
				var saved_templates = []; // avoid to save cloned select 
				$(".wall-presentation-template").each(function(i){
					if ($.inArray($(this).attr('name'), saved_templates) < 0){
						if (setup == ''){
							setup += '{';
						}else{
							setup += ',';
						}
						setup += '"'+$(this).attr('name')+'":"'+$(this).val()+'"';
						saved_templates.push($(this).attr('name'));
					}
				});
				setup += "}";
				$("input[name='<?php echo META_WALL_DISPLAY_PRESENTATION_SETUP; ?>']").val(setup);
				// TODO - known bug : the last item template of slider isn't saved because is select is cloned... No solution for now :(
				// Explication : first slide and last slide are cloned by BxSlider, that's why we have 2 selects which are dupplicated 
			}
		})(jQuery);
		</script>
	</div>
</div>
