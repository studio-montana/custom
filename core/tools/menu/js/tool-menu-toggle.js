/**
 * MENU Tool
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Responsive Menu Toogle
 */
(function($) {
	$('.menu-toggle').on('click', function(e) {
		if ($("#primary-navigation").hasClass("toggled")){
			$("#primary-navigation").removeClass("toggled");
		}else{
			$("#primary-navigation").addClass("toggled");
		}i
	});
})(jQuery);