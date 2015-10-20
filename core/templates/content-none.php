<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */
?>
<article class="content-none">
	<header class="page-header">
		<h1 class="page-title">
			<?php if (is_search()){ ?>
				<i class="icon-search"></i>
				<?php _e('No result', CUSTOM_TEXT_DOMAIN); ?>
			<?php }else{ ?>
				<?php _e('No content', CUSTOM_TEXT_DOMAIN); ?>
			<?php } ?>
		</h1>
	</header>
	
	<div class="page-content">
	</div><!-- .page-content -->
</article>