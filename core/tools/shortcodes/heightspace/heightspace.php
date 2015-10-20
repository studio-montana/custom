<?php

/**
 * Register admin scripts on tinymce load
 */
function tool_shortcodes_heightspace_tiny_mce_plugins($plugins) {
	if (tool_shortcodes_heightspace_has_permissions() && tool_shortcodes_heightspace_is_edit_screen()) {
		wp_enqueue_script('tool-shortcodes-script-heightspace', get_template_directory_uri().'/'.CUSTOM_TOOLS_FOLDER.SHORTCODES_TOOL_NAME.'/heightspace/heightspace.js', array('jquery'), '1.0');
	}
	return $plugins;
}
add_filter('tiny_mce_plugins', 'tool_shortcodes_heightspace_tiny_mce_plugins');

/**
 * Make shortcode
*/
function tool_shortcodes_heightspace($atts, $content = null, $name='') {
	$atts = shortcode_atts( array(
			"height"	=> '36px',
	), $atts );
	$height = sanitize_text_field($atts['height']);
	$output = '<span class="line-break" style=" display: block; width: 100%; height:'.$height.';">'.do_shortcode($content).'</span>';
	return $output;
}
add_shortcode('heightspace', 'tool_shortcodes_heightspace');

/**
 * Is edit screen
*/
function tool_shortcodes_heightspace_is_edit_screen() {
	global $pagenow;
	$allowed_screens = apply_filters('cpsh_allowed_screens', array('post-new.php', 'page-new.php', 'post.php', 'page.php'));
	if (in_array($pagenow, $allowed_screens))
		return true;
	return false;
}

/**
 * has permissions
 */
function tool_shortcodes_heightspace_has_permissions() {
	if (current_user_can('edit_posts') && current_user_can('edit_pages'))
		return true;
	return false;
}

/**
 * Add buttons to TimyMCE
 */
function tool_shortcodes_heightspace_add_editor_buttons() {
	if (!tool_shortcodes_heightspace_has_permissions() || !tool_shortcodes_heightspace_is_edit_screen())
		return false;
	add_action('media_buttons', 'tool_shortcodes_heightspace_add_button', 100);
}
add_action('admin_init', 'tool_shortcodes_heightspace_add_editor_buttons');

/**
 * Add shortcode button to TimyMCE
*/
function tool_shortcodes_heightspace_add_button( $page = null, $target = null ) {
	?>
<a id="tool-shortcodes-heightspace-insert-shortcode" class="button"
	href="#tool-shortcodes-heightspace-insert-shortcode"
	title="<?php _e('Exergue', CUSTOM_TEXT_DOMAIN); ?>"
	data-page="<?php echo $page; ?>" data-target="<?php echo $target; ?>" style="width: 36px; text-align: center;">
	<i class="fa fa-arrows-v"></i>
</a>
<?php
}