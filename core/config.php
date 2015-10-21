<?php

/**
 * Custom configuration utilities
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

global $custom_config;

/**
 * Test une configuration du thème
 * @param string $type : type de configuration (tool, widget, option, ...)
 * @param string $name : nom de la configuration
 * @param boolean $default : retourné si la configuration est inexistante
 * @return boolean
 */
function custom_is_config($type, $name, $default = true){
	$config = custom_get_config($type, $name);
	if (isset($config) && !empty($config)){
		if ($config == false)
			return false;
		else
			return true;
	}else{
		return $default;
	}
}

/**
 * Récupère une configuration du thème
 * @param string $type : type de configuration (widget, option, ...)
 * @param string $name : nom de la configuration
 * @return mixed (null si introuvable)
 */
function custom_get_config($type, $name){
	global $custom_config;
	if (!isset($custom_config) || !is_array($custom_config)){
		$custom_config = custom_init_config();
	}
	if (isset($custom_config) && !empty($custom_config[$type]) && is_array($custom_config[$type])){
		if (isset($custom_config[$type][$name]))
			return $custom_config[$type][$name];
	}
	return null;
}

/**
 * Initialise la configuration du thème.<br />
 * Lecture du fichier 'custom-config.xml' situé à la racine du custom
 * @return array
 */
function custom_init_config(){
	$config = array();
	$config_file = TEMPLATEPATH."/config.xml";
	if (file_exists($config_file)){
		$xml = simplexml_load_string(file_get_contents($config_file));
		if ($xml){
			$nodes = $xml->xpath("./*");
			if ($nodes){
				foreach ($nodes as $node){
					if (is_object($node)){
						$config_type = $node->getName();
						if (!isset($config[$config_type]) || !is_array($config[$config_type])){
							$config[$config_type] = array();
						}
						$config_name = '';
						foreach($node->attributes() as $attr_key => $attr_value) {
							if ($attr_key == 'name')
								$config_name = ''.$attr_value;
						}
						if (!empty($config_name)){
							if ($node == 'false'){
								$config[$config_type][$config_name] = false;
							}else if($node == 'true'){
								$config[$config_type][$config_name] = true;
							}else{
								$config[$config_type][$config_name] = ''.$node;
							}
						}
					}
				}
			}
		}
	}
	return $config;
}