<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */

if (is_active_sidebar('sidebar')) : ?>
	<div id="sidebar" class="sidebar-container" role="complementary">
		<div class="widget-area">
			<?php dynamic_sidebar('sidebar'); ?>
		</div><!-- .widget-area -->
		<div class="clear"></div>
	</div><!-- #sidebar -->
<?php endif; ?>