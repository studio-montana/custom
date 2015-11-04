<?php
/**
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
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
	<!--[if lt IE 9]>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php do_action("custom_html_before_page"); ?>

	<div id="page" class="hfeed site">
	
		<header id="masthead" class="site-header" role="banner">
			<div class="site-header-container">
				<div class="site-branding">
					<div class="site-branding-container">
						<?php if (function_exists("logo_has") && logo_has() && function_exists("logo_display")){ ?>
							<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php logo_display(array("class" => "site-logo", "alt" => esc_attr(get_bloginfo('name')))); ?></a>
						<?php }else{ ?>
							<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
						<?php } ?>
						<?php
						$description = get_bloginfo('description', 'display');
						if ($description || is_customize_preview()){ ?>
							<p class="site-description"><?php echo $description; ?></p>
						<?php } ?>
					</div>
				</div><!-- .site-branding -->
		
				<div class="site-navigation" role="navigation">
					<div class="site-navigation-container main-navigation" role="navigation">
						<h3 class="menu-toggle"><i class="fa fa-bars"></i></h3>
						<?php wp_nav_menu( array('theme_location' => 'primary', 'menu_class' => 'nav')); ?>
						<div style="clear: both;"></div>
					</div>
				</div><!-- #site-navigation -->
				
			</div>
		</header><!-- .site-header -->
		
		<?php if (function_exists("tool_breadcrumb")){ ?>
		<div class="site-breadcrumb">
			<div class="site-breadcrumb-container">
				<?php tool_breadcrumb(array(), true); ?>
			</div>
		</div>
		<?php } ?>
		
		<div class="main site-main">
			<div class="site-main-container">
