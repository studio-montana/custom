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
 * CONTACTFORM7 Tool - Add module [captchanum] to Contact Form 7 plugin
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Shortcode handler
 */
function wpcf7_add_shortcode_captchanum() {
	wpcf7_add_shortcode(array('captchanum'),
		'wpcf7_captchanum_shortcode_handler', true);
}

function wpcf7_captchanum_shortcode_handler($tag) {
	$tag = new WPCF7_Shortcode($tag);
	if (empty($tag->name))
		return '';
	$validation_error = wpcf7_get_validation_error($tag->name);
	$html = '<span class="wpcf7-form-control-wrap '.sanitize_html_class($tag->name).'">';
	$html .= apply_filters('tool_contactform7_captchanum_field', $tag->name);
	$html .= '</span>';
	return $html;
}
add_action( 'wpcf7_init', 'wpcf7_add_shortcode_captchanum');

/**
 * Validation filter
 */
function wpcf7_captchanum_validation_filter($result, $tag) {
	$tag = new WPCF7_Shortcode($tag);
	$errors = apply_filters('tool_contactform7_captchanum_validatation', $tag->name);
	if (!empty($errors)){
		foreach ($errors as $error){
			$result->invalidate($tag, $error->get_error_message());
		}
	}
	return $result;
}
add_filter( 'wpcf7_validate_captchanum', 'wpcf7_captchanum_validation_filter', 10, 2 );

/**
 * Tag generator
 */
if (is_admin()){
	add_action('admin_init', 'wpcf7_add_tag_generator_captchanum', 20);
}

function wpcf7_add_tag_generator_captchanum() {
	$tag_generator = WPCF7_TagGenerator::get_instance();
	$tag_generator->add( 'captchanum', __( 'numeric captcha', CUSTOM_PLUGIN_TEXT_DOMAIN),
		'wpcf7_tag_generator_captchanum' );
}

function wpcf7_tag_generator_captchanum( $contact_form, $args = '' ) {
	$args = wp_parse_args( $args, array() );
	$type = 'captchanum';
	$description = __("Generate a form-tag for a numeric captcha.", CUSTOM_PLUGIN_TEXT_DOMAIN);

?>
<div class="control-box">
<fieldset>
<legend><?php echo esc_html($description); ?></legend>

<table class="form-table">
<tbody>
	<tr>
	<th scope="row"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></th>
	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr( $args['content'] . '-name' ); ?>" /></td>
	</tr>
</tbody>
</table>
</fieldset>
</div>

<div class="insert-box">
	<input type="text" name="<?php echo $type; ?>" class="tag code" readonly="readonly" onfocus="this.select()" />

	<div class="submitbox">
	<input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>" />
	</div>

	<br class="clear" />

	<p class="description mail-tag"><label for="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>"><?php echo sprintf( esc_html( __( "To use the value input through this field in a mail field, you need to insert the corresponding mail-tag (%s) into the field on the Mail tab.", 'contact-form-7' ) ), '<strong><span class="mail-tag"></span></strong>' ); ?><input type="text" class="mail-tag code hidden" readonly="readonly" id="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>" /></label></p>
</div>
<?php
}
