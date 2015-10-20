/**
 * @package WordPress
 * @version 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com This file, like this theme, like WordPress, is licensed under the GPL.
 */

(function($) {

	/**
	 * ISOTOPE & MASONRY GALLERY RESPONSIVE FUNCTION
	 */
	function custom_resize_isotope_items($isotope, item_selector) {
		var isotope_matrice = custom_resize_gallery_matrix();
		var isotope_data_columns = parseInt($isotope.data('columns'));
		if (isset(isotope_data_columns)) {
			var resized = false;
			for ( var window_size in isotope_matrice) {
				if (isotope_matrice.hasOwnProperty(window_size) && $(window).width() < parseInt(window_size)) {
					var window_matrice = isotope_matrice[window_size];
					if (window_matrice.hasOwnProperty(isotope_data_columns)) {
						var columns_matrice = window_matrice[isotope_data_columns];
						$isotope.find(item_selector).each(function(i) {
							// width
							var item_data_columns = parseInt($(this).data('columns'));
							if (columns_matrice.hasOwnProperty(item_data_columns)) {
								var new_width = columns_matrice[item_data_columns];
								$(this).css("width", new_width);
							}
							// height
							custom_resize_isotope_items_height($(this));
						});
					}
					// isotope columnWidth
					$isotope.isotope({
						masonry : {
							columnWidth : $isotope.width() / window_matrice.columns
						}
					});
					resized = true;
					break;
				}
			}
			if (resized == false) { // initial values
				$isotope.find(item_selector).each(function(i) {
					// width
					var item_data_columns = parseInt($(this).data('columns'));
					var new_width = (100 / isotope_data_columns) * item_data_columns;
					$(this).css("width", new_width + '%');
					// height
					custom_resize_isotope_items_height($(this));
				});
				// isotope columnWidth
				$isotope.isotope({
					masonry : {
						columnWidth : $(this).width() / $(this).data("columns")
					}
				});
			}
		}
	}

	/**
	 * ISOTOPE & MASONRY GALLERY HEIGHT REESIZING
	 */
	function custom_resize_isotope_items_height($isotope_item) {
		if ($isotope_item.data("autoresponsive") != true) {
			var ratio_width_height = $isotope_item.data('ratio-width-height');
			if (!empty(ratio_width_height)) {
				$isotope_item.css("height", Math.ceil(parseInt($isotope_item.width()) * parseFloat(ratio_width_height)) + "px");
			} else {
				$isotope_item.css("height", Math.ceil((parseInt($isotope_item.data("height")) * $isotope_item.width()) / parseInt($isotope_item.data("width"))) + "px");
			}
		}
	}

	/**
	 * CLASSIC GALLERY RESPONSIVE FUNCTION
	 */
	function custom_resize_classic_items($classic, item_selector) {
		var classic_matrice = custom_resize_gallery_matrix();
		var classic_data_columns = parseInt($classic.data('columns'));
		if (isset(classic_data_columns)) {
			var resized = false;
			for ( var window_size in classic_matrice) {
				if (classic_matrice.hasOwnProperty(window_size) && $(window).width() < parseInt(window_size)) {
					var window_matrice = classic_matrice[window_size];
					if (window_matrice.hasOwnProperty(classic_data_columns)) {
						var columns_matrice = window_matrice[classic_data_columns];
						$classic.find(item_selector).each(function(i) {
							// width
							var item_data_columns = parseInt($(this).data('columns'));
							if (columns_matrice.hasOwnProperty(item_data_columns)) {
								var new_width = columns_matrice[item_data_columns];
								$(this).css("width", new_width);
							}
							// height
							custom_resize_classic_items_height($(this));
						});
					}
					// isotope reload
					$classic.isotope();
					resized = true;
					break;
				}
			}
			if (resized == false) { // initial values
				$classic.find(item_selector).each(function(i) {
					// width
					var item_data_columns = parseInt($(this).data('columns'));
					var new_width = (100 / classic_data_columns) * item_data_columns;
					$(this).css("width", new_width + '%');
					// height
					custom_resize_classic_items_height($(this));
				});
				// isotope reload
				$classic.isotope();
			}
		}
	}

	/**
	 * CLASSIC GALLERY HEIGHT RESIZING
	 */
	function custom_resize_classic_items_height($classic_item) {
		if ($classic_item.data("autoresponsive") != true) {
			var ratio_width_height = $classic_item.data('ratio-width-height');
			if (!empty(ratio_width_height)) {
				$classic_item.css("height", Math.ceil(parseInt($classic_item.width()) * parseFloat(ratio_width_height)) + "px");
			} else {
				$classic_item.css("height", Math.ceil((parseInt($classic_item.data("height")) * $classic_item.width()) / parseInt($classic_item.data("width"))) + "px");
			}
		}
	}

	/**
	 * ISOTOPE & MASONRY & CLASSIC GALLERY ON WIDOW RESIZE
	 */
	function on_custom_resize_gallery_timer() {
		$(".isotope[data-columns]").each(function(i) {
			custom_resize_isotope_items($(this), '.isotope-item');
		});
		$(".masonry[data-columns]").each(function(i) {
			custom_resize_isotope_items($(this), '.masonry-item');
		});
		$(".classic[data-columns]").each(function(i) {
			custom_resize_classic_items($(this), '.classic-item');
		});
	}
	var custom_resize_gallery_timer = null;
	$(window).resize(function() {
		clearTimeout(custom_resize_gallery_timer);
		custom_resize_gallery_timer = setTimeout(on_custom_resize_gallery_timer, 100);
	});

	/**
	 * ISOTOPE & MASONRY GALLERY INIT - LISTEN TRIGGER EVENT 'gallery-isotope-ready'
	 */
	$(document).on('gallery-isotope-ready', function(e, $isotope, item_selector) {
		custom_resize_isotope_items($isotope, item_selector);
	});

	/**
	 * CLASSIC GALLERY INIT - LISTEN TRIGGER EVENT 'gallery-classic-ready'
	 */
	$(document).on('gallery-classic-ready', function(e, $classic, item_selector) {
		custom_resize_classic_items($classic, item_selector);
	});

})(jQuery);