/**
 * @package WordPress
 * @version 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com This file, like this theme, like WordPress, is licensed under the GPL.
 */
jQuery(window).ready(function($) {
	$(".login #login h1 a").attr('title', CustomLogin.url_title);
	$(".login #login h1 a").attr('href', CustomLogin.url_site);
	$('.login-action-register .register.message').html(CustomLogin.message);
	
	// remove user_login text - add placeholder
	var $text = $(".login #login label[for='user_login']").contents().filter(function() {
		return this.nodeType === 3;
	});
	if (!empty($text))
		$text.remove();
	$(".login #login label[for='user_login'] br").remove();
	$(".login #login #user_login").attr("placeholder", CustomLogin.placeholder_login);
	
	// remove user_pass text - add placeholder
	var $text = $(".login #login label[for='user_pass']").contents().filter(function() {
		return this.nodeType === 3;
	});
	if (!empty($text))
		$text.remove();
	$(".login #login label[for='user_pass'] br").remove();
	$(".login #login #user_pass").attr("placeholder", CustomLogin.placeholder_password);
});
