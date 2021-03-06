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
?>
<div id="tool-excerpt-general" class="custom-fields-section">
	<header class="custom-fields-section-header">
		<h3><?php _e("Custom excerpt", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></h3>
		<em style="margin-left: 12px;"><?php _e("Let empty to get automatic excerpt from content", CUSTOM_PLUGIN_TEXT_DOMAIN); ?></em>
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