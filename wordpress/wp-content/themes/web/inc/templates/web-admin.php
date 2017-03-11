<h1>IZV options of Admin</h1>
<?php settings_errors(); ?>
<form method="post" action="options.php">
	<?php settings_fields( 'IZV-admin-group' ); ?>
	<?php do_settings_sections( 'nonodev96_fernan13_admin' ); ?>
	<?php submit_button(); ?>
</form>