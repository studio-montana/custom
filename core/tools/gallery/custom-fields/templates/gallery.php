<?php
/**
 * GALLERY Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

if (!defined ('ABSPATH')) die ('No direct access allowed');
?>
<div id="tool-gallery-display-gallery" class="custom-fields-section">
	<header class="custom-fields-section-header">
		<h3><?php _e('Gallery options', CUSTOM_TEXT_DOMAIN); ?></h3>
		<em style="margin-left: 12px;"><?php _e('customize inner content galleries', CUSTOM_TEXT_DOMAIN); ?></em>
	</header>
	<div class="custom-fields-section-content">
		<table class="fields">
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_GALLERY_PRESENTATION; ?>"><?php _e('Presentation', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION, true); ?>
					<select id="<?php echo META_GALLERY_PRESENTATION; ?>" name="<?php echo META_GALLERY_PRESENTATION; ?>">
						<option value="classic" <?php if (empty($meta) || $meta == 'classic'){ echo 'selected="selected"'; }?>><?php _e("classic", CUSTOM_TEXT_DOMAIN); ?></option>
						<option value="slider" <?php if (!empty($meta) && $meta == 'slider'){ echo 'selected="selected"'; }?>><?php _e("slider", CUSTOM_TEXT_DOMAIN); ?></option>
						<option value="masonry" <?php if (!empty($meta) && $meta == 'masonry'){ echo 'selected="selected"'; }?>><?php _e("masonry", CUSTOM_TEXT_DOMAIN); ?></option>
						<option value="grid" <?php if (!empty($meta) && $meta == 'grid'){ echo 'selected="selected"'; }?>><?php _e("random grid", CUSTOM_TEXT_DOMAIN); ?></option>
					</select>
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			
			<tr valign="top" class="display-gallery-options display-gallery-slider-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_GALLERY_PRESENTATION_SLIDER_AUTOPLAY; ?>"><?php _e('Autoplay', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_SLIDER_AUTOPLAY, true); ?> 
					<input type="checkbox" id="<?php echo META_GALLERY_PRESENTATION_SLIDER_AUTOPLAY; ?>" name="<?php echo META_GALLERY_PRESENTATION_SLIDER_AUTOPLAY; ?>" <?php if (!empty($meta) && $meta == 'on'){ echo ' checked="checked"'; } ?> />
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			
			<tr valign="top" class="display-gallery-options display-gallery-slider-options display-gallery-slider-options-thumb-nav">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_GALLERY_PRESENTATION_SLIDER_THUMB_NAV; ?>"><?php _e('Thumb navigation', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_SLIDER_THUMB_NAV, true); ?> 
					<input type="checkbox" id="<?php echo META_GALLERY_PRESENTATION_SLIDER_THUMB_NAV; ?>" name="<?php echo META_GALLERY_PRESENTATION_SLIDER_THUMB_NAV; ?>" <?php if (!empty($meta) && $meta == 'on'){ echo ' checked="checked"'; } ?> />
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			
			<tr valign="top" class="display-gallery-options display-gallery-slider-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_GALLERY_PRESENTATION_SLIDER_CAROUSEL; ?>"><?php _e('Carousel', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_SLIDER_CAROUSEL, true); ?> 
					<input type="checkbox" id="<?php echo META_GALLERY_PRESENTATION_SLIDER_CAROUSEL; ?>" name="<?php echo META_GALLERY_PRESENTATION_SLIDER_CAROUSEL; ?>" <?php if (!empty($meta) && $meta == 'on'){ echo ' checked="checked"'; } ?> />
				</td>
				<td valign="middle"></td>
				<td valign="middle"></td>
			</tr>
			
			<tr valign="top" class="display-gallery-options display-gallery-slider-options display-gallery-slider-options-carousel">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH; ?>"><?php _e('Carousel item width', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH, true); 
					if (empty($meta) || !is_numeric($meta))
						$meta = "250";
					?>
					<input type="text" size="4" id="<?php echo META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH; ?>" name="<?php echo META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_WIDTH; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle">px</td>
				<td valign="middle"></td>
			</tr>
			
			<tr valign="top" class="display-gallery-options display-gallery-slider-options display-gallery-slider-options-carousel">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN; ?>"><?php _e('Carousel item margin', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN, true); 
					if (empty($meta) || !is_numeric($meta))
						$meta = "5";
					?>
					<input type="text" size="4" id="<?php echo META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN; ?>" name="<?php echo META_GALLERY_PRESENTATION_SLIDER_CAROUSEL_ITEM_MARGIN; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle">px</td>
				<td valign="middle"></td>
			</tr>
			
			<tr valign="top" class="display-gallery-options display-gallery-slider-options display-gallery-grid-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_GALLERY_HEIGHT; ?>"><?php _e('Height', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_GALLERY_HEIGHT, true); 
					if (empty($meta) || !is_numeric($meta))
						$meta = "250";
					?>
					<input type="text" size="4" id="<?php echo META_GALLERY_HEIGHT; ?>" name="<?php echo META_GALLERY_HEIGHT; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle">px</td>
				<td valign="middle"></td>
			</tr>
			
			<tr valign="top" class="display-gallery-options display-gallery-specific-options display-gallery-masonry-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_GALLERY_PRESENTATION_MASONRY_WIDTH; ?>"><?php _e('Max width', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_MASONRY_WIDTH, true); ?>
					<select id="<?php echo META_GALLERY_PRESENTATION_MASONRY_WIDTH; ?>" name="<?php echo META_GALLERY_PRESENTATION_MASONRY_WIDTH; ?>">
						<option value="fully-responsive" <?php if (empty($meta) && $meta == 'fully-responsive'){ echo 'selected="selected"'; }?>><?php _e("fully responsive", CUSTOM_TEXT_DOMAIN); ?></option>
						<option value="customized" <?php if (!empty($meta) && $meta == 'customized'){ echo 'selected="selected"'; }?>><?php _e("customized", CUSTOM_TEXT_DOMAIN); ?></option>
					</select>
				</td>
				<td valign="middle" class="display-gallery-masonry-options-customized-width">
					<?php $meta = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED, true); 
					if (empty($meta) || !is_numeric($meta))
						$meta = "250";
					?>
					<input type="number" size="4" id="<?php echo META_GALLERY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED; ?>" name="<?php echo META_GALLERY_PRESENTATION_MASONRY_WIDTH_CUSTOMIZED; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle" class="display-gallery-masonry-options-customized-width">px</td>
			</tr>
			
			<tr valign="top" class="display-gallery-options display-gallery-masonry-options">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_GALLERY_PRESENTATION_MASONRY_HEIGHT; ?>"><?php _e('Max height', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_GALLERY_PRESENTATION_MASONRY_HEIGHT, true); 
					if (empty($meta) || !is_numeric($meta))
						$meta = "";
					?>
					<input type="checkbox" id="display-gallery-masonry-auto-height" <?php if (empty($meta)){ echo ' checked="checked"'; } ?> />&nbsp;<label for="display-gallery-masonry-auto-height"><?php _e("Auto", CUSTOM_TEXT_DOMAIN); ?></label>					
				</td>
				<td valign="middle" class="display-gallery-masonry-options-customized-height">
					<input type="text" size="4" id="<?php echo META_GALLERY_PRESENTATION_MASONRY_HEIGHT; ?>" name="<?php echo META_GALLERY_PRESENTATION_MASONRY_HEIGHT; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle" class="display-gallery-masonry-options-customized-height">px</td>
			</tr>
			
			<?php 
			$meta_disable_fancybox = get_theme_mod("gallery_fancybox_state");
			if (empty($meta_disable_fancybox) || $meta_disable_fancybox != 1){
				?>
				<tr valign="top" class="">
					<th class="metabox_label_column" align="left" valign="middle"><label
						for="<?php echo META_GALLERY_DISABLE_FANCYBOX; ?>"><?php _e('Disable fancybox', CUSTOM_TEXT_DOMAIN); ?> : </label>
					</th>
					<td valign="middle">
						<?php $meta = get_post_meta(get_the_ID(), META_GALLERY_DISABLE_FANCYBOX, true); ?> 
						<input type="checkbox" id="<?php echo META_GALLERY_DISABLE_FANCYBOX; ?>" name="<?php echo META_GALLERY_DISABLE_FANCYBOX; ?>" <?php if (!empty($meta) && $meta == 'on'){ echo ' checked="checked"'; } ?> />
					</td>
					<td valign="middle"></td>
				</tr>
			<?php } ?>
		</table>
		<script type="text/javascript">
		(function($) {
			$(document).ready(function(){
				// presentation 
				$("#<?php echo META_GALLERY_PRESENTATION; ?>").on("change", function(e){
					update_gallery_presentation_setup();
					update_gallery_masonry_options();
					update_gallery_slider_options();
				});
				// masonry width 
				$("#<?php echo META_GALLERY_PRESENTATION_MASONRY_WIDTH; ?>").on("change", function(e){
					update_gallery_masonry_options();
				});
				// masonry auto height 
				$("#display-gallery-masonry-auto-height").on("click", function(e){
					update_gallery_masonry_options();
				});
				// slider carousel 
				$("#<?php echo META_GALLERY_PRESENTATION_SLIDER_CAROUSEL; ?>").on("click", function(e){
					update_gallery_slider_options();
				});
				// init 
				update_gallery_presentation_setup();
				update_gallery_masonry_options();
				update_gallery_slider_options();
			});
			function update_gallery_masonry_options(){
				if ($("#<?php echo META_GALLERY_PRESENTATION; ?>").val() == "masonry"){
					$(".display-gallery-masonry-options-customized-width").fadeOut(0);
					if ($("#<?php echo META_GALLERY_PRESENTATION_MASONRY_WIDTH; ?>").val() == 'customized'){
						$(".display-gallery-masonry-options-customized-width").fadeIn();
					}
					$(".display-gallery-masonry-options-customized-height").fadeOut(0);
					if ($("#display-gallery-masonry-auto-height").is(":checked")){
						$("*[name='<?php echo META_GALLERY_PRESENTATION_MASONRY_HEIGHT; ?>']").val("");
					}else{
						$(".display-gallery-masonry-options-customized-height").fadeIn();
						if ($("*[name='<?php echo META_GALLERY_PRESENTATION_MASONRY_HEIGHT; ?>']").val() == ""){
							$("*[name='<?php echo META_GALLERY_PRESENTATION_MASONRY_HEIGHT; ?>']").val("250");
						}
					}
				}
			}
			function update_gallery_slider_options(){
				if ($("#<?php echo META_GALLERY_PRESENTATION; ?>").val() == "slider"){
					$(".display-gallery-slider-options-carousel").fadeOut(0);
					$(".display-gallery-slider-options-thumb-nav").fadeOut(0);
					if ($("#<?php echo META_GALLERY_PRESENTATION_SLIDER_CAROUSEL; ?>").is(":checked")){
						$(".display-gallery-slider-options-carousel").fadeIn();
					}else{
						$(".display-gallery-slider-options-thumb-nav").fadeIn();
					}
				}
			}
			function update_gallery_presentation_setup(){
				$(".display-gallery-options").fadeOut(0);
				$(".display-gallery-"+$("#<?php echo META_GALLERY_PRESENTATION; ?>").val()+"-options").fadeIn();
			}
		})(jQuery);
		</script>
	</div>
</div>
