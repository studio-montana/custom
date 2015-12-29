<?php
/**
 * PRIVATE Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */
if (!defined ('ABSPATH')) die ('No direct access allowed');

/**
 * CONSTANTS
*/
define('TOOL_PRIVATE_OPTIONS_NONCE_ACTION', 'tool-private-options-nonce-action');
define('TOOL_PRIVATE_OPTIONS_GO_PRIVATE', 'tool-private-option-go-private');
define('TOOL_PRIVATE_OPTIONS_ITEMS', 'tool-private-option-items');
define('TOOL_PRIVATE_OPTIONS_MESSAGE', 'tool-private-option-message');

/**
 * create admin menu for private settings
*/
function tool_private_create_menu() {
	add_menu_page(__('Private settings', CUSTOM_TEXT_DOMAIN), __('Private site', CUSTOM_TEXT_DOMAIN), 'administrator', "tool-private-settings-page", 'tool_private_settings_template' , 'dashicons-lock');
}
add_action('admin_menu', 'tool_private_create_menu');

/**
 * load settings template
*/
function tool_private_settings_template() {
	tool_private_settings_save();
	?>
<form method="post" action="<?php echo get_current_url(true); ?>">
	<input type="hidden"
		name="<?php echo TOOL_PRIVATE_OPTIONS_NONCE_ACTION; ?>"
		value="<?php echo wp_create_nonce(TOOL_PRIVATE_OPTIONS_NONCE_ACTION);?>" />
	<?php
	require_once (locate_template(CUSTOM_TOOLS_FOLDER.PRIVATE_TOOL_NAME.'/inc/options-fields.php'));
	submit_button();
	?>
</form>
<?php
}

/**
 * save settings
 */
function tool_private_settings_save() {
	if (!current_user_can('administrator'))
		return;
	if (!isset($_POST[TOOL_PRIVATE_OPTIONS_NONCE_ACTION]) || !wp_verify_nonce($_POST[TOOL_PRIVATE_OPTIONS_NONCE_ACTION], TOOL_PRIVATE_OPTIONS_NONCE_ACTION))
		return;

	// TOOL_PRIVATE_OPTIONS_GO_PRIVATE
	if (isset($_POST[TOOL_PRIVATE_OPTIONS_GO_PRIVATE]) && !empty($_POST[TOOL_PRIVATE_OPTIONS_GO_PRIVATE])){
		if (!get_option(TOOL_PRIVATE_OPTIONS_GO_PRIVATE))
			add_option(TOOL_PRIVATE_OPTIONS_GO_PRIVATE, sanitize_text_field($_POST[TOOL_PRIVATE_OPTIONS_GO_PRIVATE]));
		else
			update_option(TOOL_PRIVATE_OPTIONS_GO_PRIVATE, sanitize_text_field($_POST[TOOL_PRIVATE_OPTIONS_GO_PRIVATE]));
	}else{
		delete_option(TOOL_PRIVATE_OPTIONS_GO_PRIVATE);
	}

	// TOOL_PRIVATE_OPTIONS_ITEMS
	$items = "";
	foreach ($_POST as $k => $v){
		if (startsWith($k, "tool-private-item-")){
			if ($v = "on"){
				$id = str_replace("tool-private-item-", "", $k);
				if (!empty($items))
					$items .= ",";
				$items .= $id;
			}
		}
	}
	if (!empty($items)){
		if (!get_option(TOOL_PRIVATE_OPTIONS_ITEMS))
			add_option(TOOL_PRIVATE_OPTIONS_ITEMS, $items);
		else
			update_option(TOOL_PRIVATE_OPTIONS_ITEMS, $items);
	}else{
		delete_option(TOOL_PRIVATE_OPTIONS_ITEMS);
	}
	
	// TOOL_PRIVATE_OPTIONS_MESSAGE
	if (isset($_POST[TOOL_PRIVATE_OPTIONS_MESSAGE]) && !empty($_POST[TOOL_PRIVATE_OPTIONS_MESSAGE])){
		if (!get_option(TOOL_PRIVATE_OPTIONS_MESSAGE))
			add_option(TOOL_PRIVATE_OPTIONS_MESSAGE, sanitize_text_field($_POST[TOOL_PRIVATE_OPTIONS_MESSAGE]));
		else
			update_option(TOOL_PRIVATE_OPTIONS_MESSAGE, sanitize_text_field($_POST[TOOL_PRIVATE_OPTIONS_MESSAGE]));
	}else{
		delete_option(TOOL_PRIVATE_OPTIONS_MESSAGE);
	}
}
