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

class CustomOptions {
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;
	private $fields;

	/**
	 * Start up
	 */
	public function __construct(){
		// set options
		$this->options = custom_get_options();

		// actions
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page(){
		// This page will be under "Settings"
		add_options_page(
		'Settings Admin',
		'Custom',
		'manage_options',
		'custom_options',
		array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page(){
		?>
<div class="wrap">
	<h2>
		<i class="fa fa-gears"></i>&nbsp;
		<?php _e("Custom settings", CUSTOM_PLUGIN_TEXT_DOMAIN); ?>
	</h2>
	<form method="post" action="options.php">
		<?php
		// This prints out all hidden setting fields
		settings_fields( 'custom_option_group' );
		do_settings_sections( 'custom-admin' );
		submit_button();
		?>
	</form>
</div>
<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init(){
		register_setting(
		'custom_option_group', // Option group
		CUSTOM_CONFIG_OPTIONS, // Option name
		array( $this, 'sanitize' ) // Sanitize
		);

		// --- Key activation

		add_settings_section(
		'custom_settings_key_activation_id', // ID
		__("Activation"), // Title
		array( $this, 'print_section_key_activation_info' ), // Callback
		'custom-admin' // Page
		);

		add_settings_field(
		'key-activation-id', // ID
		__("enter your key", CUSTOM_PLUGIN_TEXT_DOMAIN), // Title
		array( $this, 'print_setting_key_activation' ), // Callback
		'custom-admin', // Page
		'custom_settings_key_activation_id' // Section
		);

		$this->fields[] = "key-activation";

		// --- Tools

		if (custom_is_registered()){

			$tools = custom_get_available_tools();
			foreach ($tools as $tool){
				$fields = array();
				$fields = apply_filters("custom_config_options_fields_tool_".$tool['slug'], $fields);

				if (!empty($fields)){

					// tool section
					$callback = null;
					if (function_exists("tool_".$tool['slug']."_get_config_options_section_description"))
						$callback = "tool_".$tool['slug']."_get_config_options_section_description";
					$documentation_link = "";
					if (function_exists("tool_".$tool['slug']."_get_config_options_section_documentation_url"))
						$documentation_link = '<a class="tool-documentation" href="'.call_user_func("tool_".$tool['slug']."_get_config_options_section_documentation_url").'" target="_blank"><i class="fa fa-info-circle"></i></a>';
					add_settings_section(
					'custom_settings_tool_'.$tool['slug'].'_id', // ID
					$tool['name'].$documentation_link, // Title
					$callback, // Callback
					'custom-admin' // Page
					);

					// tool fields
					if (!empty($fields)){
						foreach ($fields as $field){
							add_settings_field(
							$field['slug'], // ID
							$field['title'], // Title
							$field['callback'], // Callback
							'custom-admin', // Page
							'custom_settings_tool_'.$tool['slug'].'_id', // Section
							array('options' => $this->options) // Args
							);
							$this->fields[] = $field['slug'];
						}
					}
				}
			}
		}
	}


	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ){

		// IMPORTANT : set empty value to unset fields (fixe issue for default value on checkbox items - see custom_get_options())
		foreach ($this->fields as $field){
			if (!isset($input[$field]))
				$input[$field] = '';
		}

		$input = apply_filters("custom_config_options_sanitize_fields", $input);

		return $input;
	}

	/**
	 * Print the Section text
	 */
	public function print_section_key_activation_info(){
	}

	function print_setting_key_activation(){
		$value = "";
		// TODO display message if key is invalid
		if (isset($this->options['key-activation']))
			$value = $this->options['key-activation'];
		echo '<input placeholder="'.__("YOUR KEY", CUSTOM_PLUGIN_TEXT_DOMAIN).'" type="text" name="'.CUSTOM_CONFIG_OPTIONS.'[key-activation]" value="'.$value.'" /><a href="'.esc_url(CUSTOM_CONFIG_GET_KEY_URL).'" target="_blank" class="button primary">'.__('Get key', CUSTOM_PLUGIN_TEXT_DOMAIN).'</a>';
	}
}

if( is_admin() )
	$custom_options = new CustomOptions();