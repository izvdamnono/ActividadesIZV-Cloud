<?php

function izv_add_admin_page() {
	
	add_menu_page( 'IZV Theme Options', 'IZV vergeles', 'manage_options', 'nonodev96-fernan13', 'izv_theme_create_page_admin', get_template_directory_uri() . '/assets/images/icon-16.png', 110 );
	/**
	 * Submenu
	 */ 
	add_submenu_page( 'nonodev96-fernan13', 'IZV options', 'Footer ', 'manage_options', 'nonodev96_fernan13_IZV', 'izv_theme_create_page' );

}
add_action( 'admin_menu', 'izv_add_admin_page' );

function IZV_custom_settings() {
	/**
	 * Campos personalizados para la personalizacion general
	 */ 
	register_setting( 'IZV-footer-group', 'footer_left' );
	register_setting( 'IZV-footer-group', 'footer_center' );
	register_setting( 'IZV-footer-group', 'footer_right' );

	add_settings_section( 'IZV-back_end-options-footer', 'Footer option', 'IZV_back_end_options_footer', 'nonodev96_fernan13_footer');

	add_settings_field( 'back_end-footer_left', 'Footer left', 'IZV_back_end_footer_left', 'nonodev96_fernan13_footer', 'IZV-back_end-options-footer');
	add_settings_field( 'back_end-footer_center', 'Footer center', 'IZV_back_end_footer_center', 'nonodev96_fernan13_footer', 'IZV-back_end-options-footer');
	add_settings_field( 'back_end-footer_right', 'Footer right', 'IZV_back_end_footer_right', 'nonodev96_fernan13_footer', 'IZV-back_end-options-footer');
}
add_action( 'admin_init', 'IZV_custom_settings' );

/**
 * Footer
 */ 
require_once( get_template_directory() . '/inc/functions/web-footer.php' );

function izv_theme_create_page_admin(){
	
}

function izv_theme_create_page() {
	//generation of our admin page
	require_once( get_template_directory() . '/inc/templates/web-footer.php' );

}