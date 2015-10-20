<?php
/**
 * @package WordPress
 * @subpackage Custom SEO
 * @since Custom SEO 1.0
 */

if (!defined ('ABSPATH')) die ('No direct access allowed');
?>
<input type="hidden" name="<?php echo SEO_NONCE_SEO_ACTION; ?>" value="<?php echo wp_create_nonce(SEO_NONCE_SEO_ACTION);?>" />

<table class="form-table">
	<!-- meta-title -->
	<tr class="form-field seo-box">
		<td class="seo-label">
			<label for="<?php echo SEO_CUSTOMFIELD_METATITLE; ?>"><?php _e("Meta-title", CUSTOM_TEXT_DOMAIN); ?></label>
		</td>
		<td class="seo-input">
			<input type="text" name="<?php echo SEO_CUSTOMFIELD_METATITLE; ?>" id="<?php echo SEO_CUSTOMFIELD_METATITLE; ?>" value="<?php echo @get_post_meta($post->ID, SEO_CUSTOMFIELD_METATITLE, true); ?>" />
		</td>
	</tr>
	<!-- meta-description -->
	<tr class="form-field seo-box">
		<td class="seo-label">
			<label for="<?php echo SEO_CUSTOMFIELD_METADESCRIPTION; ?>"><?php _e("Meta-description", CUSTOM_TEXT_DOMAIN); ?></label>
		</td>
		<td class="seo-input">
			<input type="text" name="<?php echo SEO_CUSTOMFIELD_METADESCRIPTION; ?>" id="<?php echo SEO_CUSTOMFIELD_METADESCRIPTION; ?>" value="<?php echo @get_post_meta($post->ID, SEO_CUSTOMFIELD_METADESCRIPTION, true); ?>" />
		</td>
	</tr>
	<!-- meta-keywords -->
	<tr class="form-field seo-box">
		<td class="seo-label">
			<label for="<?php echo SEO_CUSTOMFIELD_METAKEYWORDS; ?>"><?php _e("Meta-keyword", CUSTOM_TEXT_DOMAIN); ?></label>
		</td>
		<td class="seo-input">
			<input type="text" name="<?php echo SEO_CUSTOMFIELD_METAKEYWORDS; ?>" id="<?php echo SEO_CUSTOMFIELD_METAKEYWORDS; ?>" value="<?php echo @get_post_meta($post->ID, SEO_CUSTOMFIELD_METAKEYWORDS, true); ?>" />
		</td>
	</tr>
</table>