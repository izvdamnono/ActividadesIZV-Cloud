<?php
/**
 * Activamos los soportes del tema, 
 * formatos de post, la imagen del header y el fondo del sitio, 
 * la imagen destacada y el menu dinamico del Back-end
 */ 
$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
add_theme_support( 'post-formats', $formats );

add_theme_support( 'custom-header' );

add_theme_support( 'custom-background' );

add_theme_support( 'post-thumbnails' );

function teaching_register_nav_menu() {
	register_nav_menu( 'primary', 'Header Navigation Menu' );
}
add_action( 'after_setup_theme', 'teaching_register_nav_menu' );