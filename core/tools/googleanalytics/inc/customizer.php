<?php
/**
 * @package Custom
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 * License: GPL2
 * Text Domain: custom
 * 
 * Copyright 2016 Sébastien Chandonay (email : please contact me from my website)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
defined('ABSPATH') or die("Go Away!");

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
			'label'      => __('Code', CUSTOM_PLUGIN_TEXT_DOMAIN ),
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