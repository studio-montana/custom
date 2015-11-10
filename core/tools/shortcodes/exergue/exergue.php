<?php

/**
 * Register admin scripts on tinymce load
 */
function tool_shortcodes_exergue_tiny_mce_plugins($plugins) {
	if (tool_shortcodes_exergue_has_permissions() && tool_shortcodes_exergue_is_edit_screen()) {
		wp_enqueue_script('tool-shortcodes-script-exergue', get_template_directory_uri().'/'.CUSTOM_TOOLS_FOLDER.SHORTCODES_TOOL_NAME.'/exergue/exergue.js', array('jquery'), '1.0');
	}
	return $plugins;
}
add_filter('tiny_mce_plugins', 'tool_shortcodes_exergue_tiny_mce_plugins');

/**
 * Make shortcode
*/
function tool_shortcodes_exergue($atts, $content = null, $name='') {
	$atts = shortcode_atts( array(
			"style"	=> ''
	), $atts );
	$style = sanitize_text_field($atts['style']);
	$output = '<div class="shortcode-exergue" style="'.$style.'">'.do_shortcode($content).'</div>';
	return $output;
}
add_shortcode('exergue', 'tool_shortcodes_exergue');

/**
 * Is edit screen
*/
function tool_shortcodes_exergue_is_edit_screen() {
	global $pagenow;
	$allowed_screens = apply_filters('cpsh_allowed_screens', array('post-new.php', 'page-new.php', 'post.php', 'page.php'));
	if (in_array($pagenow, $allowed_screens))
		return true;
	return false;
}

/**
 * has permissions
 */
function tool_shortcodes_exergue_has_permissions() {
	if (current_user_can('edit_posts') && current_user_can('edit_pages'))
		return true;
	return false;
}

/**
 * Add buttons to TimyMCE
 */
function tool_shortcodes_exergue_add_editor_buttons() {
	if (!tool_shortcodes_exergue_has_permissions() || !tool_shortcodes_exergue_is_edit_screen())
		return false;
	add_action('media_buttons', 'tool_shortcodes_exergue_add_button', 100);
}
add_action('admin_init', 'tool_shortcodes_exergue_add_editor_buttons');

/**
 * Add shortcode button to TimyMCE
*/
function tool_shortcodes_exergue_add_button($id_editor = null) {
	?>
<span class="tool-shortcodes-insert-shortcode tool-shortcodes-exergue-insert-shortcode button"
	title="<?php _e('Exergue', CUSTOM_TEXT_DOMAIN); ?>"
	data-id-editor="<?php echo $id_editor; ?>">
	<i class="fa fa-star"></i>
</span>
<?php
}
