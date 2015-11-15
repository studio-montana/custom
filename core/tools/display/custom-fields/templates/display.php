<?php
/**
 * @package WordPress
 * @subpackage Custom BACKGROUNDIMAGE
 * @since Custom BACKGROUNDIMAGE 1.0
 */

if (!defined ('ABSPATH')) die ('No direct access allowed');
?>
<div id="tool-display-general" class="custom-fields-section">
	<header class="custom-fields-section-header">
		<h3><?php _e("General options", CUSTOM_TEXT_DOMAIN); ?></h3>
	</header>
	<div class="custom-fields-section-content">
		<table class="fields">
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_DISPLAY_CUSTOMTITLE; ?>"><?php _e('Custom title', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php 
					$meta = get_post_meta(get_the_ID(), META_DISPLAY_CUSTOMTITLE, true);
					?>
					<input type="text" size="50" id="<?php echo META_DISPLAY_CUSTOMTITLE; ?>" name="<?php echo META_DISPLAY_CUSTOMTITLE; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle"><em><?php _e("Replace native title", CUSTOM_TEXT_DOMAIN); ?></em></td>
			</tr>
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_DISPLAY_SUBTITLE; ?>"><?php _e('Subtitle', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php 
					$meta = get_post_meta(get_the_ID(), META_DISPLAY_SUBTITLE, true);
					?>
					<input type="text" size="50" id="<?php echo META_DISPLAY_SUBTITLE; ?>" name="<?php echo META_DISPLAY_SUBTITLE; ?>" value="<?php echo $meta; ?>" />
				</td>
			</tr>
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_DISPLAY_HIDE_TITLE; ?>"><?php _e('Hide title/custom title', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php 
					$meta = get_post_meta(get_the_ID(), META_DISPLAY_HIDE_TITLE, true);
					?>
					<input type="checkbox" id="<?php echo META_DISPLAY_HIDE_TITLE; ?>" name="<?php echo META_DISPLAY_HIDE_TITLE; ?>" <?php if (!empty($meta) && $meta == 'on'){ echo 'checked="checked"'; }?> />
				</td>
				<td valign="middle"><em><?php _e("Hide title or custom title except in lists", CUSTOM_TEXT_DOMAIN); ?></em></td>
			</tr>
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_DISPLAY_HIDE_THUMBNAIL; ?>"><?php _e('Hide thumbnail', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php 
					$meta = get_post_meta(get_the_ID(), META_DISPLAY_HIDE_THUMBNAIL, true);
					?>
					<input type="checkbox" id="<?php echo META_DISPLAY_HIDE_THUMBNAIL; ?>" name="<?php echo META_DISPLAY_HIDE_THUMBNAIL; ?>" <?php if (!empty($meta) && $meta == 'on'){ echo 'checked="checked"'; }?> />
				</td>
				<td valign="middle"><em><?php _e("Hide thumbnail except in lists", CUSTOM_TEXT_DOMAIN); ?></em></td>
			</tr>
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_DISPLAY_BADGED; ?>"><?php _e("Badge", CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php 
					$meta = get_post_meta(get_the_ID(), META_DISPLAY_BADGED, true);
					?>
					<input type="checkbox" id="<?php echo META_DISPLAY_BADGED; ?>" name="<?php echo META_DISPLAY_BADGED; ?>" <?php if (!empty($meta) && $meta == 'on'){ echo 'checked="checked"'; }?> />
				</td>
				<td valign="middle"><em><?php _e("Add awesome badge for new stuff !", CUSTOM_TEXT_DOMAIN); ?></em></td>
			</tr>
			<tr valign="top" class="badge-text" style="display: none;">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_DISPLAY_BADGE_TEXT; ?>"><?php _e("Badge's text", CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php 
					$meta = get_post_meta(get_the_ID(), META_DISPLAY_BADGE_TEXT, true);
					if (empty($meta)){
						$meta = __("new", CUSTOM_TEXT_DOMAIN);
					}
					?>
					<input type="text" size="50" id="<?php echo META_DISPLAY_BADGE_TEXT; ?>" name="<?php echo META_DISPLAY_BADGE_TEXT; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle"></td>
			</tr>
		</table>
		<script type="text/javascript">
			(function($) {
				$("input[name='<?php echo META_DISPLAY_BADGED ?>']").on('click', function(e) {
					if ($(this).prop('checked')){
						$(".badge-text").fadeIn();
					}else{
						$(".badge-text").fadeOut();
					}
				});
				if ($("input[name='<?php echo META_DISPLAY_BADGED ?>']").prop('checked')){
					$(".badge-text").fadeIn();
				}else{
					$(".badge-text").fadeOut();
				}
			})(jQuery);
		</script>
	</div>
</div>