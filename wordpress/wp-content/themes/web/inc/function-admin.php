<?php

function izv_add_admin_page() {
	
	add_menu_page( 'IZV Theme Options', 'IZV vergeles', 'manage_options', 'nonodev96-fernan13', 'izv_theme_create_page', get_template_directory_uri() . '/assets/images/icon-16.png', 110 );
	
}
add_action( 'admin_menu', 'izv_add_admin_page' );
function izv_theme_create_page() {
	//generation of our admin page
}