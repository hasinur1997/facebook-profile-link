<div class="wrap">
	<h2><?php _e('Facebook Footer Link Settings', 'ffl_domain')?></h2>
</div>

<form action="options.php" method="post">

	<?php settings_fields('ffl_register_setting_group');?>
	<table class="form-table">

		<tr>
			<th><label for="profile-link-enable">Enable</label></th>
			<td><label for="">
				<input type="checkbox" name="ffl_field_settings[enable]" id="profile-link-enable" value="1" <?php checked(1, $ffl_options['enable'])?>>

				<span class="description">Enable or Disable Facebook Profile Link</span>
			</label></td>
		</tr>
		<tr>
			<th><label for="profile-link">Facebook Profile Link</label></th>
			<td><input type="text" name="ffl_field_settings[profile-link]" id="profile-link" class="regular-text" value="<?php echo $ffl_options['profile-link'] ?>">
			<p class="description">Please enter your facebook profile link.</p>
			</td>
		</tr>

		<tr>
			<th><label for="show-feed">Enable</label></th>
			<td><label for="">
				<input type="checkbox" name="ffl_field_settings[show-feed]" id="show-feed" value="1" <?php checked(1, $ffl_options['show-feed'])?>>

				<span class="description">Show Facebook Profile Link in posts</span>
			</label></td>
		</tr>
	</table>

	<p><button class="button button-primary" type=submit>Save Profile Link</button></p>
</form>

