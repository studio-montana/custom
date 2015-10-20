<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-resume'); ?>>
	<header class="entry-header">
		<?php if (!post_password_required()){ ?>
			<?php if (is_registered_custom_tool('video') && video_has_featured_video(get_the_ID())){ ?>
				<div class="featured-video">
					<?php echo video_get_featured_video(get_the_ID(), "100%", "200px"); ?>
				</div>
			<?php }else if (has_post_thumbnail()){ ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php if (function_exists("custom_post_thumbnail")){ ?>
						<?php custom_post_thumbnail(); ?>
					<?php }else{ ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
					<?php } ?>
				</a>
			<?php } ?>
		<?php } ?>

		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php
				if (defined("META_DISPLAY_CUSTOMTITLE")) $custom_title = get_post_meta(get_the_ID(), META_DISPLAY_CUSTOMTITLE, true);
				else $custom_title = '';
				if (empty($custom_title)) the_title();
				else echo $custom_title;
				?>
			</a>
			<?php edit_post_link('<i class="fa fa-pencil-square-o"></i>', '<span>', '</span>'); ?>
		</h1>
		
		<?php
		if (defined("META_DISPLAY_SUBTITLE"))	$subtitle = get_post_meta(get_the_ID(), META_DISPLAY_SUBTITLE, true);
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

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
	<footer class="entry-meta">
		<?php if (comments_open() && ! is_single()) : ?>
			<div class="comments-link">
				<?php custom_comments_popup_link('<span class="leave-reply">' . __('Comment', CUSTOM_TEXT_DOMAIN) . '</span>', __('One comment', CUSTOM_TEXT_DOMAIN), __('See % comments', CUSTOM_TEXT_DOMAIN) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
