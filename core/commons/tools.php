<?php

/**
 * Custom tools loader
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

global $registered_tools;

if (!function_exists("load_custom_tools")):
/**
 * Load all custom tools (looking for core/tools/ folder)
*/
function load_custom_tools() {
	global $registered_tools;
	$registered_tools = array();
	if (is_dir(TEMPLATEPATH.'/'.CUSTOM_TOOLS_FOLDER)){
		$tools_folders = scandir(TEMPLATEPATH.'/'.CUSTOM_TOOLS_FOLDER);
		if ($tools_folders){
			foreach ($tools_folders as $tool_folder){
				if ($tool_folder != '.' && $tool_folder != '..'){
					if (file_exists(TEMPLATEPATH.'/'.CUSTOM_TOOLS_FOLDER.$tool_folder.'/'.$tool_folder.'.php') && custom_is_config("tool", $tool_folder, false)){
						$registered_tools[] = $tool_folder;
						require_once locate_template(CUSTOM_TOOLS_FOLDER.$tool_folder).'/'.$tool_folder.'.php';
						do_action("custom_tool_ready", $tool_folder);
					}
				}
			}
		}
	}
	do_action("custom_tools_ready", $registered_tools);
}
endif;

if (!function_exists("is_registered_custom_tool")):
/**
 * check if specified tool name is registered
 * @param string $tool_name (ex. 'video')
 * @return boolean
 */
function is_registered_custom_tool($tool_name) {
	global $registered_tools;
	return in_array($tool_name, $registered_tools);
}
endif;

/**
 * load tools
 */
load_custom_tools();