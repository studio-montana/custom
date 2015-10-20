<?php
/**
 * PAGINATION Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

if (!defined ('ABSPATH')) die ('No direct access allowed');
?>
<div id="tool-pagination-display-pagination" class="custom-fields-section">
	<header class="custom-fields-section-header">
		<h3><?php _e('Pagination options', CUSTOM_TEXT_DOMAIN); ?></h3>
	</header>
	<div class="custom-fields-section-content">
		<table class="fields">
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_PAGINATION_DISPLAY_PAGINATION; ?>"><?php _e('Display pagination', CUSTOM_TEXT_DOMAIN); ?> : </label>
				</th>
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_PAGINATION_DISPLAY_PAGINATION, true); ?>
					<input type="checkbox" id="<?php echo META_PAGINATION_DISPLAY_PAGINATION; ?>" name="<?php echo META_PAGINATION_DISPLAY_PAGINATION; ?>" <?php if (empty($meta) || $meta == 'on'){ echo 'checked="checked"'; }?> />
				</td>
				<td valign="middle"></td>
			</tr>
		</table>
	</div>
</div>
