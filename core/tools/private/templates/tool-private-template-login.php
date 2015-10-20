<?php
/**
 * PRIVATE template login
 * @package WordPress
 * @subpackage Custom
 * @version 2.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */
global $private_tool_errors;
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
			</div>
		</header><!-- .site-header -->
	
		<div class="main site-main">
		
			<div class="site-main-container">

				<div id="primary" class="content-area tool-private-login">
				
					<div id="content" class="site-content" role="main">
					
						<?php 
						$private_message = get_theme_mod('private_message');
						if (!empty($private_message)){
							?>
							<h4 class="private-message"><?php echo $private_message; ?></h4>
							<?php
						}
						
						if (!empty($_POST) && !empty($private_tool_errors)){
							foreach ($private_tool_errors as $err){
								if ($err->get_error_code()){
									?>
									<div class="private-error"><?php echo $err->get_error_message(); ?></div>
									<?php
								}
							}
						}
						?>
						
						<form method="post" enctype="multipart/form-data" name="tool-private-login-form">
							<input type="text" name="tool-private-login" value="" placeholder="<?php _e("LOGIN", CUSTOM_TEXT_DOMAIN); ?>" />
							<input type="password" name="tool-private-password" value="" placeholder="<?php _e("PASSWORD", CUSTOM_TEXT_DOMAIN); ?>" />
							<?php do_action('tool_private_form_before_submit_field'); ?>
							<input type="submit" name="tool-private-submit" value="<?php _e("Log in", CUSTOM_TEXT_DOMAIN); ?>" />
						</form>
					
						<div style="clear: both;"></div>
					
					</div><!-- #content -->
					
				</div><!-- #primary -->
				
				<div style="clear: both;"></div>
			
			</div><!-- main container -->
			
		</div><!-- #main -->
		
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>