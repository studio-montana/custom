/**
 * @package WordPress
 * @version 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com This file, like this theme, like WordPress, is licensed under the GPL.
 */

function isFloat(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

function isInt(n) {
	return !isNaN(parseInt(n)) && isFinite(n);
}

function getTotalOuterWidth(items_selector) {
	var w_total = 0;
	jQuery(items_selector).each(function(index) {
		var w_item = jQuery(this).outerWidth(true);
		// on n'aime pas les chiffres impaires ...
		if (w_item % 2 == 1) {
			w_item += 1;
		}
		w_total += w_item;
	});
	return w_total;
}

function isset(variable) {
	if (typeof (variable) == undefined || variable == null) {
		return false;
	}
	return true;
}

function empty(variable) {
	if (!isset(variable) || variable == '') {
		return true;
	}
	return false;
}

/**
 * Show wait box
 */
function wait($element) {
	if ($element.find('.custom-wait').length <= 0) {
		$element.append('<div class="custom-wait" style="display: none;">loading...</div>');
		$element.find('.custom-wait').css('position', 'absolute');
		$element.find('.custom-wait').css('top', '0');
		$element.find('.custom-wait').css('left', '0');
		$element.find('.custom-wait').css('background', '#e2e2e2');
		$element.find('.custom-wait').css('opacity', '0.5');
		$element.find('.custom-wait').css('width', '100%');
		$element.find('.custom-wait').css('height', '100%');
		$element.find('.custom-wait').css('text-align', 'center');
		$element.find('.custom-wait').css('padding', '70px');
		$element.find('.custom-wait').css('z-index', '10000');
		$element.find('.custom-wait').css('box-sizing', 'border-box');
		$element.find('.custom-wait').css('-moz-box-sizing', 'border-box');
		$element.find('.custom-wait').css('-webkit-box-sizing', 'border-box');
	}
	$element.find('.custom-wait').fadeIn(0);
}

/**
 * hide wait box
 */
function unwait($element) {
	$element.find('.custom-wait').fadeOut(0);
}

/**
 * convert hexadecimal color to rgb
 * @param hex
 * @returns
 */
function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

/**
 * Animated scroll-to on each <a> tag which references an anchor and has data-scrollto="true"
 */
(function($) {
	$("a[href^='#']").on('click', function(e) {
		if ($(this).data("scrollto") == true || $(this).data("scrollto") == "true" || $(this).data("scrollto") == "1") {
			e.preventDefault();
			var anchor = $(this).attr('href');
			var speed = 750; // ms
			$('html, body').animate({
				scrollTop : $(anchor).offset().top
			}, speed);
			return false;
		}
	});
})(jQuery);

/**
 * Image Loader jQuery Plugin
 */
(function($) {
	$.custom_image_load = function($element, on_load_function) {
		var load_timer = null;
		if ($element.prop("tagName") == 'IMG') {
			load_timer = setInterval(function() {
				if ($element.get(0).complete) {
					clearInterval(load_timer);
					on_load_function.call($element);
				}
			}, 200);
		}
		return this;
	};
	$.fn.custom_image_load = function(on_load_function) {
		return this.each(function() {
			if (!isset($(this).data('custom_image_load'))) {
				var plugin = new $.custom_image_load($(this), on_load_function);
				$(this).data('custom_image_load', plugin);
			}else{
				// already instanciated - nothing to do
			}
		});
	};
})(jQuery);