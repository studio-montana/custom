<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-page'); ?>>
	<header class="entry-header">
		<?php if (!post_password_required()){ ?>
			<?php if (is_registered_custom_tool('video') && video_has_featured_video()){ ?>
				<div class="featured-video">
					<?php echo video_get_featured_video(get_the_ID(), "100%", "200px"); ?>
				</div>
			<?php }else if (has_post_thumbnail()){ ?>
				<?php
				if (defined("META_DISPLAY_HIDE_THUMBNAIL")) $hide_thumbnail = get_post_meta(get_the_ID(), META_DISPLAY_HIDE_THUMBNAIL, true);
				else $hide_thumbnail = 'off';
				if (empty($hide_thumbnail) || $hide_thumbnail != 'on'){ ?>
					<div class="entry-thumbnail">
						<?php the_post_thumbnail('full'); ?>
					</div>
				<?php } ?>
			<?php } ?>
		<?php } ?>

		<?php
		if (defined("META_DISPLAY_HIDE_TITLE"))	$hide_title = get_post_meta(get_the_ID(), META_DISPLAY_HIDE_TITLE, true);
		else $hide_title = 'off';
		if (empty($hide_title) || $hide_title != 'on'){ ?>
			<h1 class="entry-title">
				<?php
				if (defined("META_DISPLAY_CUSTOMTITLE")) $custom_title = get_post_meta(get_the_ID(), META_DISPLAY_CUSTOMTITLE, true);
				else $custom_title = '';
				if (empty($custom_title)) the_title();
				else echo $custom_title;
				?>
			</h1>
		<?php } ?>
		
		<?php
		if (defined("META_DISPLAY_SUBTITLE")) $subtitle = get_post_meta(get_the_ID(), META_DISPLAY_SUBTITLE, true);
		else $subtitle = '';
		if (!empty($subtitle)){ ?>
			<h2 class="entry-subtitle">
				<?php echo $subtitle; ?>
			</h2>
		<?php } ?>

		<div class="entry-meta">
			<?php custom_entry_meta(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	
	<?php if (function_exists("pagination")) pagination(array(), true, '<div class="pagination">', '</div>', '<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'); ?>	

	<footer class="entry-meta">
		<?php if (is_single() && get_the_author_meta('description') && is_multi_author()) : ?>
			<?php get_template_part('author-bio'); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
