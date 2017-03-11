<?php
/**
 * 
 */

function IZV_back_end_options_admin() {
	echo '<p>Personaliza tu tema con el soporte que quieras</p>';
}

function IZV_back_end_data_admin(){
	$options = get_option( 'data_admin_support_format' )?get_option( 'data_admin_support_format' ):array();
	$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
	$output = '';
	// echo "<pre>";
	// var_dump($options);
	// echo "</pre>";
	foreach ( $formats as $format ){
		$checked = ( $options[$format] == 1 ? 'checked' : '' );
		echo '<label><input type="checkbox" id="'.$format.'" name="data_admin_support_format['.$format.']" value="1" '.$checked.' /> '.$format.'</label><br>';
	}
	
}