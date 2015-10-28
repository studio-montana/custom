/**
 * SOCIAL Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Widget background check
 */
(function($) {
	$(".backgrounded-check").on('click', function(e) {
		console.log("backgrounded-check : "+$(this).prop('checked'));
		if ($(this).prop('checked')){
			$(this).parent().parent().parent().find("label").addClass("backgrounded");
		}else{
			$(this).parent().parent().parent().find("label").removeClass("backgrounded");
		}
	});
})(jQuery);