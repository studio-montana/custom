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

?>

<div class="custom-dashboard-widget">
	<p><?php _e("Thanks for using custom."); ?></p>
	<p><?php _e("Custom offers you lots of awesome tools to improve your experience on wordpress, on the Web. SEO, security, private site, social publication, ..."); ?></p>
	<p><?php _e("You can discover and manage tools"); ?>&nbsp;<a href="<?php echo esc_url(get_admin_url(null, 'options-general.php?page=custom_options')); ?>"><?php _e("here"); ?></a>.</p>
	<p><?php _e("Do you need some"); ?>&nbsp;<a href="<?php echo esc_url(CUSTOM_DOCUMENTATION_URL); ?>" target="_blank"><?php _e("documentation"); ?></a> ?</p>
	<p style="text-align: right;"><a href="<?php echo esc_url("http://www.studio-montana.com"); ?>" target="_blank">Studio Montana</a></p>
</div>