<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */

get_header(); ?>

	<div id="primary" class="content-area page-not-found">
		<div id="content" class="site-content" role="main">

			<article class="not-found">
				<header class="entry-header">
					<h1 class="entry-title">404</h1>
				</header>
				<div class="entry-content">
					<p class="causes-title">
						<?php _e("We couldn't find the page you were looking for. This is either because", CUSTOM_TEXT_DOMAIN); ?>:
					</p>
					<ul class="causes">
						<li><?php _e("There is an error in the URL entered into your web browser. Please check the URL and try again", CUSTOM_TEXT_DOMAIN); ?>.</li>
						<li><?php _e("The page you are looking for has been moved or deleted", CUSTOM_TEXT_DOMAIN); ?>.</li>
					</ul>
					<p class="solution">
						<?php _e("You can return to our homepage by", CUSTOM_TEXT_DOMAIN); ?>&nbsp;<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php _e("Home", CUSTOM_TEXT_DOMAIN); ?>"><?php _e("clicking here", CUSTOM_TEXT_DOMAIN); ?></a>,&nbsp;
						<?php _e("or you can try searching for the content you are seeking", CUSTOM_TEXT_DOMAIN); ?>.
						<?php get_search_form(); ?>
					</p>
				</div>
			</article>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
?>