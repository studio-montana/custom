<?php
/**
 * Post-picker items template
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.1
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */
if (!defined ('ABSPATH')) die ('No direct access allowed');

if (empty($postypes)){
	$postypes = get_displayed_post_types(true);
}
global $post;

if (!empty($postypes)){
	?>
	<div class="results">
		<div class="column column-left">
			<?php
			foreach ($postypes as $postype){
				?>
				<div class="post-type-selector" data-type="<?php echo $postype; ?>">					
					<?php
					$post_type_label = get_post_type_labels(get_post_type_object($postype));
					echo $post_type_label->name;
					?>
				</div>
				<?php
			}
			?>
		</div>
		<div class="column column-right">
			<?php
			foreach ($postypes as $postype){
				$posts = get_posts(array('post_type' => $postype, "numberposts" => -1, "exclude" => $exclude));
				?>
				<div class="postype-section" data-type="<?php echo $postype; ?>" style="display: none;">
					<?php if (empty($posts)){ ?>
						<h2><?php _e("No entry", CUSTOM_TEXT_DOMAIN); ?></h2>
					<?php }else{ ?>
						<ul>
							<?php
							foreach ($posts as $post){
								setup_postdata($post);
								?>
								<li class="post-item" data-id="<?php echo get_the_ID()?>">
									<?php 
									$postpick_item_template = locate_ressource("postpicker-item.php", array(CUSTOM_COMMONS_FOLDER.'/postpicker/templates/'));
									if (!empty($postpick_item_template))
										include($postpick_item_template);
									?>
									<div class="selected-box">
										<i class="fa fa-check added"></i>
										<i class="fa fa-minus remove"></i>
									</div>
									<div class="selectable-area"></div>
								</li>
								<?php
								wp_reset_postdata();
							} ?>
						</ul>
					<?php } ?>
					<div style="clear: both;"></div>
				</div>
				<?php 
			}
			?>
		</div>
		<script type="text/javascript">
		(function($) {
			$(document).ready(function(){
				// post-types management 
				var first_type = $("#postpicker-content .postype-section:first-child").data("type");
				$("#postpicker-content .postype-section[data-type='"+first_type+"']").fadeIn(0);
				$("#postpicker-content .post-type-selector[data-type='"+first_type+"']").addClass("selected");
				$("#postpicker-content .post-type-selector").on("click", function(e){
					var type = $(this).data("type");
					$("#postpicker-content .postype-section").fadeOut(0);
					$("#postpicker-content .post-type-selector").removeClass("selected");
					$("#postpicker-content .postype-section[data-type='"+type+"']").fadeIn(0);
					$("#postpicker-content .post-type-selector[data-type='"+type+"']").addClass("selected");
				});
			});
		})(jQuery);
		</script>
	</div>
<?php
}
?>