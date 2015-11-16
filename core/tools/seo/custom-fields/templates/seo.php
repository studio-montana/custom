<?php
/**
 * @package WordPress
 * @subpackage Custom SEO
 * @since Custom SEO 1.0
 */

if (!defined ('ABSPATH')) die ('No direct access allowed');
?>
<div id="tool-display-general" class="custom-fields-section">
	<header class="custom-fields-section-header">
		<h3><?php _e("SEO", CUSTOM_TEXT_DOMAIN); ?></h3>
	</header>
	<div class="custom-fields-section-content">
		<table class="fields full-width">
			<!-- meta-title -->
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle">
					<label for="<?php echo SEO_CUSTOMFIELD_METATITLE; ?>"><?php _e("Meta-title", CUSTOM_TEXT_DOMAIN); ?></label>
				</th>
				<td valign="middle">
					<input type="text" placeholder="<?php _e("content title used by default", CUSTOM_TEXT_DOMAIN); ?>" name="<?php echo SEO_CUSTOMFIELD_METATITLE; ?>" id="<?php echo SEO_CUSTOMFIELD_METATITLE; ?>" value="<?php echo @get_post_meta($post->ID, SEO_CUSTOMFIELD_METATITLE, true); ?>" />
				</td>
				<td valign="middle"></td>
			</tr>
			<!-- meta-description -->
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle">
					<label for="<?php echo SEO_CUSTOMFIELD_METADESCRIPTION; ?>"><?php _e("Meta-description", CUSTOM_TEXT_DOMAIN); ?></label>
				</th>
				<td valign="middle">
					<input type="text" placeholder="<?php _e("site description used by default", CUSTOM_TEXT_DOMAIN); ?>" name="<?php echo SEO_CUSTOMFIELD_METADESCRIPTION; ?>" id="<?php echo SEO_CUSTOMFIELD_METADESCRIPTION; ?>" value="<?php echo @get_post_meta($post->ID, SEO_CUSTOMFIELD_METADESCRIPTION, true); ?>" />
				</td>
				<td valign="middle"></td>
			</tr>
			<!-- meta-keywords -->
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle">
					<label for="<?php echo SEO_CUSTOMFIELD_METAKEYWORDS; ?>"><?php _e("Meta-keyword", CUSTOM_TEXT_DOMAIN); ?></label>
				</th>
				<td valign="middle">
					<input type="text" placeholder="<?php _e("separate keywords by comma", CUSTOM_TEXT_DOMAIN); ?>" name="<?php echo SEO_CUSTOMFIELD_METAKEYWORDS; ?>" id="<?php echo SEO_CUSTOMFIELD_METAKEYWORDS; ?>" value="<?php echo @get_post_meta($post->ID, SEO_CUSTOMFIELD_METAKEYWORDS, true); ?>" />
				</td>
				<td valign="middle"></td>
			</tr>
		</table>
	</div>
</div>
<div id="tool-display-general" class="custom-fields-section">
	<header class="custom-fields-section-header">
		<h3><?php _e("Open Graph", CUSTOM_TEXT_DOMAIN); ?><em style="margin-left: 6px;">(<?php _e("Social network publication", CUSTOM_TEXT_DOMAIN); ?>)</em></h3>
	</header>
	<div class="custom-fields-section-content">
		<table class="fields full-width">
			<!-- meta-og-title -->
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle">
					<label for="<?php echo SEO_CUSTOMFIELD_META_OPENGRAPH_TITLE; ?>"><?php _e("OpenGraph-title", CUSTOM_TEXT_DOMAIN); ?></label>
				</th>
				<td valign="middle">
					<input type="text" placeholder="<?php _e("meta-title used by default", CUSTOM_TEXT_DOMAIN); ?>" name="<?php echo SEO_CUSTOMFIELD_META_OPENGRAPH_TITLE; ?>" id="<?php echo SEO_CUSTOMFIELD_META_OPENGRAPH_TITLE; ?>" value="<?php echo @get_post_meta($post->ID, SEO_CUSTOMFIELD_META_OPENGRAPH_TITLE, true); ?>" />
				</td>
				<td valign="middle"></td>
			</tr>
			<!-- meta-og-description -->
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle">
					<label for="<?php echo SEO_CUSTOMFIELD_META_OPENGRAPH_DESCRIPTION; ?>"><?php _e("OpenGraph-description", CUSTOM_TEXT_DOMAIN); ?></label>
				</th>
				<td valign="middle">
					<input type="text" placeholder="<?php _e("meta-description used by default", CUSTOM_TEXT_DOMAIN); ?>" name="<?php echo SEO_CUSTOMFIELD_META_OPENGRAPH_DESCRIPTION; ?>" id="<?php echo SEO_CUSTOMFIELD_META_OPENGRAPH_DESCRIPTION; ?>" value="<?php echo @get_post_meta($post->ID, SEO_CUSTOMFIELD_META_OPENGRAPH_DESCRIPTION, true); ?>" />
				</td>
				<td valign="middle"></td>
			</tr>
			<!-- meta-og-image -->
			<tr valign="top">
				<?php 
				$meta = @get_post_meta($post->ID, SEO_CUSTOMFIELD_META_OPENGRAPH_IMAGE, true);
				?>
				<th class="metabox_label_column" align="left" valign="middle">
					<label for="<?php echo SEO_CUSTOMFIELD_META_OPENGRAPH_IMAGE; ?>"><?php _e("OpenGraph-image", CUSTOM_TEXT_DOMAIN); ?></label>
				</th>
				<td valign="middle">
					<input type="text" placeholder="<?php _e("featured image used by default", CUSTOM_TEXT_DOMAIN); ?>" name="<?php echo SEO_CUSTOMFIELD_META_OPENGRAPH_IMAGE; ?>" id="<?php echo SEO_CUSTOMFIELD_META_OPENGRAPH_IMAGE; ?>" value="<?php echo $meta; ?>" />
				</td>
				<td valign="middle">
					<span id="choose-opengraph-image-library" class="button"><i class="fa fa-image"></i>&nbsp;<?php _e("Choose", CUSTOM_TEXT_DOMAIN); ?></span>
					<span id="remove-opengraph-image-library" class="button" <?php if (empty($meta)){ ?> style="display: none;"<?php } ?>><i class="fa fa-times"></i>&nbsp;<?php _e("Remove", CUSTOM_TEXT_DOMAIN); ?></span>
				</td>
			</tr>
		</table>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('#choose-opengraph-image-library').click(function(e) {
					var custom_seo_opengraph_image_uploader;
			        e.preventDefault();
			        //If the uploader object has already been created, reopen the dialog 
			        if (custom_seo_opengraph_image_uploader) {
			            custom_seo_opengraph_image_uploader.open();
			            return;
			        }
			        //Extend the wp.media object 
			        custom_seo_opengraph_image_uploader = wp.media.frames.file_frame = wp.media({
			            title: '<?php _e("Choose image", CUSTOM_TEXT_DOMAIN); ?>',
			            button: {
			                text: '<?php _e("Ok", CUSTOM_TEXT_DOMAIN); ?>'
			            },
			            multiple: false
			        });
			        //When a file is selected, grab the URL and set it as the text field's value 
			        custom_seo_opengraph_image_uploader.on('select', function() {
			            attachment = custom_seo_opengraph_image_uploader.state().get('selection').first().toJSON();
			            $("input[name='<?php echo SEO_CUSTOMFIELD_META_OPENGRAPH_IMAGE; ?>']").val(attachment.url);
			            $("#remove-opengraph-image-library").fadeIn(0);
			        });
			        //Open the uploader dialog 
			        custom_seo_opengraph_image_uploader.open();
			        return false;
				});
				$('#remove-opengraph-image-library').click(function(e) {
					e.preventDefault();
					$("input[name='<?php echo SEO_CUSTOMFIELD_META_OPENGRAPH_IMAGE; ?>']").val('');
					$(this).fadeOut(0);
				});
			});
		</script>
	</div>
</div>
