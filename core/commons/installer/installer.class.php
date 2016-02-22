<?php

require_once (CUSTOM_PLUGIN_PATH.'/'.CUSTOM_PLUGIN_INSTALLER_FOLDER.'uploader.class.php');
if (is_admin()){
    new CustomUploader(CUSTOM_PLUGIN_FILE, CUSTOM_PLUGIN_NAME);
}

?>