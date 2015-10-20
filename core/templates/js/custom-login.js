/**
 * @package WordPress
 * @version 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * This file, like this theme, like WordPress, is licensed under the GPL.
 */
jQuery(window).ready(function($) {
	$(".login #login h1 a").attr('title', CustomLogin.url_title);
	$(".login #login h1 a").attr('href', CustomLogin.url_site);
	$('.login-action-register .register.message').html(CustomLogin.message);
});
