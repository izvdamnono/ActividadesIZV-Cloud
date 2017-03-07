<h1>IZV options of footer</h1>
<?php settings_errors(); ?>
<form method="post" action="options.php">
	<?php settings_fields( 'IZV-footer-group' ); ?>
	<?php do_settings_sections( 'nonodev96_fernan13_footer' ); ?>
	<?php submit_button(); ?>
</form>