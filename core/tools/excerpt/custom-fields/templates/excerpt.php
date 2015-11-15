<?php
/**
 * @package WordPress
 * @subpackage Custom BACKGROUNDIMAGE
 * @since Custom BACKGROUNDIMAGE 1.0
 */

if (!defined ('ABSPATH')) die ('No direct access allowed');
?>
<div id="tool-excerpt-general" class="custom-fields-section">
	<header class="custom-fields-section-header">
		<h3><?php _e("Custom excerpt", CUSTOM_TEXT_DOMAIN); ?></h3>
		<em style="margin-left: 12px;"><?php _e("Let empty to get automatic excerpt from content", CUSTOM_TEXT_DOMAIN); ?></em>
	</header>
	<div class="custom-fields-section-content">
		<table class="fields" style="width: 100%;">
			<tr valign="top" class="custom-excerpt">
				<td valign="middle">
					<?php $meta = get_post_meta(get_the_ID(), META_EXCERPT_CONTENT, true); ?>
					<?php 
					wp_editor($meta, 'customexcerpt', array(
							'wpautop'       => true,
							'media_buttons' => false,
							'textarea_name' => META_EXCERPT_CONTENT,
							'textarea_rows' => 10,
							'teeny'         => true,
							'dfw'                 => true,
							'_content_editor_dfw' => true
						));
					?>
				</td>
				<td valign="middle"></td>
			</tr>
		</table>
	</div>
</div>