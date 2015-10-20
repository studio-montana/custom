<div class="widget-content">

	<?php 
	$today_timestamp = time();
	$today_timestamp_more_two_years = time() + ((((365*2)*60)*60)*24);
	$events = get_event_post_types(array(), array(
			'orderby'   => 'meta_value_num',
			'meta_key'  => 'meta_event_date_begin',
			'posts_per_page' => $nb,
			'order' => 'ASC',
			'meta_query' => array(
					array(
							'key' => 'meta_event_date_begin',
							'value' => array($today_timestamp, $today_timestamp_more_two_years),
							'compare' => 'BETWEEN'
					)
			)
	));
	if (!empty($events)){
		?>
		<ul class="list-events">
			<?php 
			global $post;
			foreach ($events as $post){
				setup_postdata($post);
				?>
				<li class="event">
					<?php 
					$template = locate_ressource("tool-event-widget-output-event.php");
					if (empty($template))
						$template = locate_template('/'.CUSTOM_TOOLS_FOLDER.EVENT_TOOL_NAME.'/widgets/templates/tool-event-widget-output-event.php');
					if (!empty($template))
						include($template);
					?>
				</li>
				<?php	
				wp_reset_postdata();
			}
			?>
		</ul>
		<div style="clear: both;"></div>
		<?php 
	}else{
		?>
		<div class="no-content"><?php _e("No upcoming event", CUSTOM_TEXT_DOMAIN); ?></div>
		<?php
	}	
	?>

</div>