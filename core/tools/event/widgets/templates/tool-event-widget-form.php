<table>
	<tr>
		<td><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', CUSTOM_TEXT_DOMAIN); ?> : </label></td>
		<td><input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($title); ?>" /></td>
	</tr>
	<tr>
		<td><label for="<?php echo $this->get_field_id('nb'); ?>"><?php _e('Number', CUSTOM_TEXT_DOMAIN); ?> : </label></td>
		<td><input type="number" name="<?php echo $this->get_field_name('nb'); ?>" id="<?php echo $this->get_field_id('nb'); ?>" value="<?php echo esc_attr($nb); ?>" /></td>
	</tr>
</table>