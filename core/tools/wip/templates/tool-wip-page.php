<?php
/**
 * WIP Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php esc_attr(wp_title(' | ', true, 'right')); ?></title>
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<style type="text/css">
			body.wip {
				margin: 0;
				text-align: center;
				font-family: Helvetica;
			}

			body.wip h1, body.wip h6 {
				margin: 0 0 1.2rem 0;
			}
			
			#wip {
			    margin: 0 auto;
			    margin-top: 10%;
			    padding: 24px 0;
			    max-width: 320px;
				position: relative;
				color: #fff;
				background: rgba(255, 255, 255, 0);
			}
		</style>
		<?php wp_head(); ?>
	</head>
	<body class="wip">
		<div id="wip">
			<?php if (function_exists("logo_has") && logo_has() && function_exists("logo_display")){ ?>
				<?php logo_display(array("class" => "site-logo", "alt" => esc_attr(get_bloginfo('name')))); ?>
			<?php }else{ ?>
				<h1><?php bloginfo('name'); ?></h1>
			<?php } ?>
			<h6>[ <?php _e("work in progress", CUSTOM_TEXT_DOMAIN); ?> ]</h6>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>