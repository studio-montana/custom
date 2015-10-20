<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */

get_header();?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><i class="icon-book"></i><?php
					if ( is_day() ) :
						printf( __('Archives %s', CUSTOM_TEXT_DOMAIN), get_the_date() );
					elseif ( is_month() ) :
						printf( __('Archives %s', CUSTOM_TEXT_DOMAIN), get_the_date( _x('F Y', 'monthly archives date format', CUSTOM_TEXT_DOMAIN) ) );
					elseif ( is_year() ) :
						printf( __('Archives %s', CUSTOM_TEXT_DOMAIN), get_the_date( _x('Y', 'yearly archives date format', CUSTOM_TEXT_DOMAIN) ) );
					else :
						_e('Archives', CUSTOM_TEXT_DOMAIN);
					endif;
				?></h1>
			</header><!-- .archive-header -->

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('content', 'resume'); ?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part('content', 'none'); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>
