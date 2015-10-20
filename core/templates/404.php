<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<div class="page-wrapper">
				<div class="page-content">
					<h1><?php _e("This content doesn't exists anymore.", CUSTOM_TEXT_DOMAIN); ?></h1>
					<i class="icon-minus-sign"></i>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</div><!-- .page-wrapper -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
?>