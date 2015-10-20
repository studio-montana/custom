<?php
/**
 * COOKIES Tool
* @package WordPress
* @subpackage Custom
* @since Custom 1.0
* @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
*/
?>

<div id="cookies-legislation-box" class="cookies-legislation-container" style="display: none; z-index: 10000;">
	<div class="cookies-legislation-content">
		<span><?php _e("By continuing your visit to this site, you accept the use of cookies or other tracers", CUSTOM_TEXT_DOMAIN); ?>.&nbsp;<a href="http://www.cnil.fr/vos-obligations/sites-web-cookies-et-autres-traceurs/que-dit-la-loi/" target="_blank"><?php _e("More about", CUSTOM_TEXT_DOMAIN); ?></a></span>
		<button id="cookies-accept-condition"><?php _e('Ok', CUSTOM_TEXT_DOMAIN); ?></button>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($){
		if ($.cookie('cookies-accept-condition') != 'true'){
			$("#cookies-legislation-box").fadeIn();
			$("#cookies-accept-condition").on("click", function(e){
				$.cookie('cookies-accept-condition', 'true', {path: '/'});
				$("#cookies-legislation-box").fadeOut();
			});
		}
	});
</script>