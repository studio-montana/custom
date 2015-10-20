<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */
?>
				<div style="clear: both;"></div>
			</div><!-- main container -->
		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-footer-container">
				<div class="site-info">
					<div class="site-info-container">
						<div><?php echo get_theme_mod("custom_copyright", "&copy; ".date('Y')); ?></div>
					</div>
				</div><!-- .site-info -->
				<div class="credits">
					<a target="_blank"
						href="http://www.cyriltissot.com" title="Cyril Tissot">www.cyriltissot.com</a>
					&nbsp;
					<a target="_blank"
						href="http://www.seb-c.com" title="Sébastien Chandonay">www.seb-c.com</a>
				</div>
			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>