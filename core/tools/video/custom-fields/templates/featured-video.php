<?php
/**
 * @package WordPress
 * @subpackage Custom VIDEO
 * @since Custom VIDEO 1.0
 */

if (!defined ('ABSPATH')) die ('No direct access allowed');
?>
<input type="hidden" name="<?php echo VIDEO_NONCE_VIDEO_ACTION; ?>" value="<?php echo wp_create_nonce(VIDEO_NONCE_VIDEO_ACTION);?>" />

<div id="tool-video-featured-video" class="custom-fields-section">
	<div class="custom-fields-section-content">
		<table class="fields">
			<tr valign="top">
				<th class="metabox_label_column" align="left" valign="middle"><label
					for="<?php echo META_VIDEO_FEATURED_URL; ?>"><?php _e('Url', CUSTOM_TEXT_DOMAIN); ?></label>
				</th>
				<td valign="middle">
					<?php 
					$meta = get_post_meta(get_the_ID(), META_VIDEO_FEATURED_URL, true);
					?>
					<input type="text" size="50" id="<?php echo META_VIDEO_FEATURED_URL; ?>" name="<?php echo META_VIDEO_FEATURED_URL; ?>" value="<?php echo $meta; ?>" />
				</td>
			</tr>
		</table>
		<div class="featured-video-options">
			<div id="featured-video-preview">
				<!-- content set by ajax call -->
			</div>
		</div>
		<script type="text/javascript">
		(function($) {
			$(document).ready(function(){
				$("#<?php echo META_VIDEO_FEATURED_URL; ?>").on("change", function(e){
					update_video_preview();
				});
				update_video_preview();
			});
			function update_video_preview(){
				var video_url = $("*[name='<?php echo META_VIDEO_FEATURED_URL; ?>']").val();
				if (video_url != ''){
					wait($("#tool-video-featured-video"));
					get_video_preview(video_url, $("#featured-video-preview").width(), 150, function(response){
						unwait($("#tool-video-featured-video"));
						$("#featured-video-preview").html($(response).text());
						
					}, function(){
						unwait($("#tool-video-featured-video"));
						$("#featured-video-preview").html("");
					});
				}else{
					$("#featured-video-preview").html("");
				}
			}
		})(jQuery);
		</script>
	</div>
</div>