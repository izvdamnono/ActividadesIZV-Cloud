<?php
/**
 * 
 */

function IZV_back_end_options_footer() {

	echo '<p>Personaliza tu footer con informacion personal, enlaces y mucho más</p>';
}
/**
 * 
 */ 
function IZV_back_end_footer_left() {
//	<input type="text" name="footer_left" value="'.$footer_left.'" placeholder="Footer left" /> 

	$footer_left = esc_attr( get_option( 'footer_left' ) );
	echo '
	<textarea name="footer_left" rows="5" cols="88">'.$footer_left.'</textarea>
	<p class="description">Footer description left.</p>';
}

function IZV_back_end_footer_center() {
//	<input type="text" name="footer_center" value="'.$footer_center.'" placeholder="Footer center" /> 

	$footer_center = esc_attr( get_option( 'footer_center' ) );
	echo '
	<textarea name="footer_center" rows="5" cols="88">'.$footer_center.'</textarea>
	<p class="description">Footer description center.</p>';
}

function IZV_back_end_footer_right() {
//	<input type="text" name="footer_right" value="'.$footer_right.'" placeholder="Footer right" /> 

	$footer_right = esc_attr( get_option( 'footer_right' ) );
	echo '
	<textarea name="footer_right" rows="5" cols="88">'.$footer_right.'</textarea>
	<p class="description">Footer description right.</p>';
}
