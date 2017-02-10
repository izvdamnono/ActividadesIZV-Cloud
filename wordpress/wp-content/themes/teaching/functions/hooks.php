<?php

function textdomain_jquery_enqueue() {
    
    /* Eliminamos el jquery de WP */
    wp_deregister_script('jquery');
    
    /*Registramos el jquery de GOOGLE*/
    wp_register_script('jquery', "http". ($_SERVER['SERVER_PORT'] == 443 ? "s" : "").
    "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js", false, null );
    
    /*Añade a la cola de scripts*/
    wp_enqueue_script('jquery');
    
    /* Añadimos todos los scripts personalizados de nuestra plantilla */
    wp_enqueue_script( 'script1', get_template_directory_uri() . '/assets/js/jquery.js', false, null);
    wp_enqueue_script( 'script2', get_template_directory_uri() . '/assets/js/bootstrap.min.js', false, null);
    
    wp_enqueue_script( 'script3', get_template_directory_uri() . '/assets/js/move-top.js', false, null);
    wp_enqueue_script( 'script4', get_template_directory_uri() . '/assets/js/easing.js', false, null);
    
    wp_enqueue_script( 'script5', get_template_directory_uri() . '/assets/js/jquery-2.1.4.min.js', false, null);
    wp_enqueue_script( 'script6', get_template_directory_uri() . '/assets/js/wow.min.js', false, null);
    

    /*
    
    after wp_enqueue_script
    
    <?php wp_localize_script( $handle, $name, $data ); ?> 
    
    Parameters
    $handle
    (string) (required) The registered script handle you are attaching the data for.
    Default: None
    $name
    (string) (required) The name of the variable which will contain the data. Note that this should be unique to both the script and to the plugin or theme. Thus, the value here should be properly prefixed with the slug or another unique value, to prevent conflicts. However, as this is a JavaScript object name, it cannot contain dashes. Use underscores or camelCasing.
    Default: None
    $data
    (array) (required) The data itself. The data can be either a single- or multi- (as of 3.3) dimensional array. Like json_encode(), the data will be a JavaScript object if the array is an associate array (a map), otherwise the array will be a JavaScript array.
    Default: None
    
    */    

    
}
    
if ( !is_admin() ) {
    add_action( 'wp_enqueue_scripts', 'textdomain_jquery_enqueue', 11 );
}