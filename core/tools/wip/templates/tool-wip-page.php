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
		<?php wp_head(); ?>
	</head>
	<body class="wip">
		
		<?php do_action("custom_html_before_wip_page"); ?>
		
		<div id="wip-page">
			<?php if (function_exists("logo_has") && logo_has() && function_exists("logo_display")){ ?>
				<?php logo_display(array("class" => "site-logo", "alt" => esc_attr(get_bloginfo('name')))); ?>
			<?php }else{ ?>
				<h1><?php bloginfo('name'); ?></h1>
			<?php } ?>
			<?php 
			$wip_message = get_theme_mod('wip_message');
			if (!empty($wip_message)){
				?>
				<div class="wip-message"><?php echo $wip_message; ?></div>
				<?php 
			}
			?>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>