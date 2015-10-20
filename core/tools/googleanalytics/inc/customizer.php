<?php
/**
 * GOOGLE ANALYTICS Customizer
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Add GoogleAnalytics fields for the Customizer.
 *
 * @since Custom SEO 1.0
 *
 * @param WP_Customize_Manager $wp_customize_manager Customizer object.
 */
function googleanalytics_customize_register($wp_customize_manager) {
	// googleanalytics section
	$wp_customize_manager->add_section('googleanalytics_customizer', array(
			'title' => 'Google Analytics'
	) );

	// meta title
	$wp_customize_manager->add_setting('googleanalytics_code', array('type' => 'theme_mod', 'transport'=>'postMessage'));
	$wp_customize_manager->add_control('googleanalytics_code', array(
			'label'      => __('Code', CUSTOM_TEXT_DOMAIN ),
			'section'    => 'googleanalytics_customizer',
			'settings'   => 'googleanalytics_code',
	));
}
add_action('customize_register', 'googleanalytics_customize_register');

/**
 * WP_Footer hook
 *
 * @since Custom 1.0
 * @return void
*/
function googleanalytics_wp_footer() {
	$googleanalytics_code = get_theme_mod('googleanalytics_code');
	if (!empty($googleanalytics_code)){
		?>
<script type="text/javascript">
				var _gaq = _gaq || [];
				_gaq.push(['_setAccount', '<?php echo get_theme_mod('googleanalytics_code'); ?>']);
				_gaq.push(['_trackPageview']);
				(function() {
					var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
					ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				})();
			</script>
<?php
	}
}
add_action('wp_footer', 'googleanalytics_wp_footer');