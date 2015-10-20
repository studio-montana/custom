<?php
/**
 * @package WordPress
 * @subpackage Custom BACKGROUNDIMAGE
 * @since Custom BACKGROUNDIMAGE 1.0
 */

if (!defined ('ABSPATH')) die ('No direct access allowed');
?>
<label class="hidden" for="page_template"><?php _e('BACKGROUNDIMAGE', CUSTOM_TEXT_DOMAIN); ?></label>

<input type="hidden" name="<?php echo BACKGROUNDIMAGE_NONCE_BACKGROUNDIMAGE_ACTION; ?>" value="<?php echo wp_create_nonce(BACKGROUNDIMAGE_NONCE_BACKGROUNDIMAGE_ACTION);?>" />

<!-- background image URL / background image ID -->
<?php 
$meta_backgroundimage_url = @get_post_meta(get_the_ID(), BACKGROUNDIMAGE_URL, true);
$meta_backgroundimage_id = @get_post_meta(get_the_ID(), BACKGROUNDIMAGE_ID, true);
?>
<div class="backgroundimage-box background-image-preview" style="
			<?php if (!empty($meta_backgroundimage_url)){ ?>
			background:	url('<?php echo $meta_backgroundimage_url; ?>') no-repeat center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			-ms-background-size: cover;
			background-size: cover;
			<?php }else{ ?>
			background: none;
			<?php } ?>
			width: 100%;
			height: 120px;
			overflow: hidden;">
	<table class="backgroundimage-input">
		<tr>
			<td style="height: 120px;">
				<input type="hidden" name="<?php echo BACKGROUNDIMAGE_URL; ?>" id="<?php echo BACKGROUNDIMAGE_URL; ?>" value="<?php echo $meta_backgroundimage_url; ?>" />
				<input type="hidden" name="<?php echo BACKGROUNDIMAGE_ID; ?>" id="<?php echo BACKGROUNDIMAGE_ID; ?>" value="<?php echo $meta_backgroundimage_id; ?>" />
				<button class="choose-backgroundimage button button-large"><?php _e("Choose image", CUSTOM_TEXT_DOMAIN); ?></button>
				<button class="delete-backgroundimage button button-large" style="<?php if (empty($meta_backgroundimage_url)){ echo 'display: none;'; } ?>"><?php _e("Delete", CUSTOM_TEXT_DOMAIN); ?></button>
			</td>
		</tr>
	</table>
</div>


<script type="text/javascript">
	jQuery(document).ready(function($){
		$('.choose-backgroundimage').click(function(e) {
			var custom_uploader;
	        e.preventDefault();
	        //If the uploader object has already been created, reopen the dialog 
	        if (custom_uploader) {
	            custom_uploader.open();
	            return;
	        }
	        //Extend the wp.media object 
	        custom_uploader = wp.media.frames.file_frame = wp.media({
	            title: '<?php _e("Choose document", CUSTOM_TEXT_DOMAIN); ?>',
	            button: {
	                text: '<?php _e("Ok", CUSTOM_TEXT_DOMAIN); ?>'
	            },
	            multiple: false
	        });
	        //When a file is selected, grab the URL and set it as the text field's value 
	        custom_uploader.on('select', function() {
	            attachment = custom_uploader.state().get('selection').first().toJSON();
	            $("input[name='<?php echo BACKGROUNDIMAGE_URL; ?>']").val(attachment.url);
	            $("input[name='<?php echo BACKGROUNDIMAGE_ID; ?>']").val(attachment.id);
	            $(".background-image-preview").css('background', 'url("'+attachment.url+'") no-repeat center center');
	            $(".delete-backgroundimage").fadeIn(0);
	        });
	        //Open the uploader dialog 
	        custom_uploader.open();
	        return false;
		});
		$('.delete-backgroundimage').click(function(e) {
			e.preventDefault();
			$("input[name='<?php echo BACKGROUNDIMAGE_URL; ?>']").val('');
			$("input[name='<?php echo BACKGROUNDIMAGE_ID; ?>']").val('');
			$(".background-image-preview").css('background', 'none');
			$(this).fadeOut(0);
		});
	});
</script>