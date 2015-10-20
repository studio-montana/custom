<?php 

// Creating the widget
class tool_event_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
				// Base ID of your widget
				'tool-event',

				// Widget name will appear in UI
				__("Events", CUSTOM_TEXT_DOMAIN),

				// Widget description
				array( 'description' => __("Show upcoming events", CUSTOM_TEXT_DOMAIN),)
		);
	}

	// Creating widget front-end
	public function widget( $args, $instance ) {

		if (isset( $instance['title'] ))
			$title = $instance['title'];
		else
			$title = "";

		if (isset( $instance['nb'] ))
			$nb = $instance['nb'];
		else
			$nb = 5;

		echo $args['before_widget'];

		echo $args['before_title'];
		echo $title;
		echo $args['after_title'];

		$template = locate_ressource("tool-event-widget-output.php");
		if (empty($template))
			$template = locate_template('/'.CUSTOM_TOOLS_FOLDER.EVENT_TOOL_NAME.'/widgets/templates/tool-event-widget-output.php');
		if (!empty($template))
			include($template);

		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance['title'] ))
			$title = $instance['title'];
		else
			$title = __("Events", CUSTOM_TEXT_DOMAIN);

		if (isset( $instance['nb'] ))
			$nb = $instance['nb'];
		else
			$nb = 5;

		// Widget admin form
		$template = locate_template('/'.CUSTOM_TOOLS_FOLDER.EVENT_TOOL_NAME.'/widgets/templates/tool-event-widget-form.php');
		if (!empty($template))
			include($template);
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['nb'] = ( ! empty( $new_instance['nb'] ) ) ? strip_tags( $new_instance['nb'] ) : '';
		return $instance;
	}
}

// Register and load the widget
function tool_event_load_widget() {
	register_widget('tool_event_widget');
}
add_action( 'widgets_init', 'tool_event_load_widget');
