<?php
/**
 * @package WordPress
 * @subpackage Custom SEO
 * @since Custom SEO 1.0
 */

if (!defined ('ABSPATH')) die ('No direct access allowed');
?>
<table class="form-table">
	<tr class="form-field seo-box seo-title">
		<td colspan="2"><h3>SEO</h3></td>
	</tr>
	<!-- meta-title -->
	<tr class="form-field seo-box">
		<th class="seo-label">
			<label for="<?php echo SEO_CUSTOMFIELD_METATITLE; ?>"><?php _e("Meta-title", CUSTOM_TEXT_DOMAIN); ?></label>
		</th>
		<td class="seo-input">
			<input type="text" name="<?php echo SEO_CUSTOMFIELD_METATITLE; ?>" id="<?php echo SEO_CUSTOMFIELD_METATITLE; ?>" value="<?php echo get_option("term_".$term->term_id."_".SEO_CUSTOMFIELD_METATITLE); ?>" />
		</td>
	</tr>
	<!-- meta-description -->
	<tr class="form-field seo-box">
		<th class="seo-label">
			<label for="<?php echo SEO_CUSTOMFIELD_METADESCRIPTION; ?>"><?php _e("Meta-description", CUSTOM_TEXT_DOMAIN); ?></label>
		</th>
		<td class="seo-input">
			<input type="text" name="<?php echo SEO_CUSTOMFIELD_METADESCRIPTION; ?>" id="<?php echo SEO_CUSTOMFIELD_METADESCRIPTION; ?>" value="<?php echo get_option("term_".$term->term_id."_".SEO_CUSTOMFIELD_METADESCRIPTION); ?>" />
		</td>
	</tr>
	<!-- meta-keywords -->
	<tr class="form-field seo-box">
		<th class="seo-label">
			<label for="<?php echo SEO_CUSTOMFIELD_METAKEYWORDS; ?>"><?php _e("Meta-keyword", CUSTOM_TEXT_DOMAIN); ?></label>
		</th>
		<td class="seo-input">
			<input type="text" name="<?php echo SEO_CUSTOMFIELD_METAKEYWORDS; ?>" id="<?php echo SEO_CUSTOMFIELD_METAKEYWORDS; ?>" value="<?php echo get_option("term_".$term->term_id."_".SEO_CUSTOMFIELD_METAKEYWORDS); ?>" />
		</td>
	</tr>
</table>