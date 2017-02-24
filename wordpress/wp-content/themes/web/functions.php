<?php
/**
 * 
 * 
 */ 
add_action( 'after_setup_theme', 'my_theme_setup' );
function my_theme_setup(){
	load_theme_textdomain("web", get_template_directory() . '/languages');
	
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable($locale_file) ) {
		require_once($locale_file);
	}
	//echo "<p>hello world!</p> <p>".get_template_directory()."</p> <p>".get_locale()."</p>";
}
require_once ("inc/function-admin.php");
require_once ("inc/theme-support.php");
require_once ("inc/custom-post.php");
require_once ("inc/header-nav.php");
require_once ("inc/hooks.php");
require_once ("inc/WP_Query_Activity.php");
require_once ("inc/custom-post-teacher.php");

function custom_pagination($page, $wp_query) {
    $return = "";
    $big = 999999999; 
    $pages = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, $page ),
        'total' => $wp_query->max_num_pages,
        'prev_next' => false,
        'type'  => 'array',
        'prev_next'   => TRUE,
		'prev_text'    => __('«'),
		'next_text'    => __('»'),
    ) );
    if( is_array( $pages ) ) {
        $paged = ( $page == 0 ) ? 1 : $page;
        $return .= '<ul class="pagination">';
        foreach ( $pages as $page1 ) {
                $return .= "<li>" . $page1 . "</li>";
        }
       $return .= '</ul>';
    }
    return $return;
}

function the_excerpt_max_charlength($excerpt = "", $charlength = 80, $return_read_more = true) {
	$charlength++;
	$return = "";
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			$return .= mb_substr( $subex, 0, $excut );
		} else {
			$return .= $subex;
		}
		if ($return_read_more == true) {
			$return .= '...';
		} 
	} else {
		$return .= $excerpt;
	}
	return $return;
}

function get_post_format_spam() {
    $ret = "";
    switch (get_post_format()) {
        case 'quote':
            $ret = '<i class="fa fa-quote-left"></i>';
            break;
        case'video':
            $ret = '<i class="fa fa-video-camera"></i>';
            break;
        case 'gallery':
            $ret = '<i class="fa fa-picture-o"></i>';
            break;
        case'audio':
            $ret = '<i class="fa fa-music" ></i>';
            break;
        case 'aside':
            $ret = '<i class="fa fa-align-left"></i>';
            break;
        case 'link';
            $ret = '<i class="fa fa-link"></i>';
            break;
        default:
            $ret = '<span class="glyphicon glyphicon-align-left"></span>';
            break;
    }
    return $ret;
}

//Funcion utilizada para habilitar la paginación en nuestros posts
	function get_paginate_page_link( $max_pages = 0, $type = 'plain', $endsize = 1, $midsize = 1 ) {
		
		//Nos permite trabajar con la query de WP y reescribir la URL
		global $wp_query, $wp_rewrite;
		/*
			Obtenemos el numero actual de página -> en una plantilla tpo index
			OJO! si queremos obtener el número de página de una página estática ->
			tipo front-page tenemos que cambiar 'paged' por 'page'
			
			También estamos validando el número de la página incluyendo si es inferior
			a 1 le asignamos el valor 1
		*/
		$current = get_query_var('paged') > 1 ? get_query_var('paged') : 1;
		
		//Saneamos los valores de los argumentos de entrada
		//Tipos de elementos que se devolverán en la paginacion por defecto en WP es plain
		if ( !in_array($type, array('plain', 'list', 'array') ) ) $type = 'plain';
		
		/*
			absint es una función de WP que convierte un número a su entero no negativo, hace  lo mismo que abs(intval($num))
		*/
		$endsize = absint($endsize);
		$midsize = absint($midsize);
		
		//Establecemos los valores de los argumentos de la funcion paginate_links()
		$pagination = array(
			//Metemos en la consulta realizada el parámetro paged indicando que paginaremos nuestra consulta
			'base' 		=> @add_query_arg( 'paged', '%#%'),
			'format'	=> '',
			//Numero total de paginas de nuestra consulta
			'total'		=> $max_pages == 0 ? $wp_query->max_num_pages : $max_pages,
			//Pagina actual (Numero)
			'current'	=> $current,
			//Mostrar todos los enlaces de cada num de pagina
			'show_all'	=> false,
			//How many numbers on either the start and the end list edges. 
			'end_size'	=> $endsize,
			//How many numbers to either side of current page, but not including current page.
			'mid_size'	=> $mid_size,
			'type'		=> $type,
			//Texto que se indica como previous text
			'prev_text'	=> '&lt;&lt;',
			//Texto que se indica como next text
			'next_text'	=> '&gt;&gt;'		
			
		);
		
		/*
			El método using_permalinks() dek objeto wp_rewrite de WP devuelve TRUE si nuestro 
			sitio usa alguna clase de permalinks
		*/
		if ( $wp_rewrite->using_permalinks() ) {
			
			/*
				Si usamos permalinks hay que rehacer la URL donde pasaremos el número de página, quitando el argumento s de la url porque puede estar a partir de la última barra de directorio en la propia url
				
				user_trailingslashit -> Si los permalinks están configurados para acavar en /, le añade la barra a la url que genere
			*/
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s', get_pagenum_link(1) ) ).'page/%#%/', 'paged');
		}
		
		/*
			Si estamos en el template search o archive tenemos que tener en cuenta la variable s que es la que tiene el valor de búsqueda
		*/
		if( !empty( $wp_query->query_vars['s']) ){
			
			$pagination['add_args'] = array( 's' => get_query_var('s') );
		}
		
		return paginate_links($pagination);
	}


function get_breadcrumbs() {
	global $post;
	$return_array = array();
	$return_array[0]["page"] = "Home";
	$return_array[0]["permalink"] = home_url();
	$return_array[0]["title"] = get_bloginfo('name');
	if (is_home()) {
		$return_array[0]["page"] = "Home";
		$return_array[0]["permalink"] = home_url();
		$return_array[0]["title"] = get_bloginfo('name');
	} elseif (is_category()){
		$get_the_category = get_the_category();
		$get_the_category = array_reverse($get_the_category);
		foreach($get_the_category as $category){
			$return_array[] = array(
				"page" => "is_category",
				"permalink" => get_permalink($category->term_id),
				"title" => $category->name
			);
		}
		
	} elseif (is_single()) {
		$return_array[1]["page"] = "is_post_format";
		$return_array[1]["permalink"] = get_post_type_archive_link(get_post_type());
		$return_array[1]["title"] = get_post_type();
		$return_array[2]["page"] = "is_single";
		$return_array[2]["permalink"] = get_permalink($post->ID);
		$return_array[2]["title"] = get_the_title($post->ID);
	} elseif (is_page()) {
		$return_array[1]["page"] = "is_page";
		$return_array[1]["permalink"] = get_permalink();
		$return_array[1]["title"] = get_the_title();
		if($post->post_parent){
			$anc = get_post_ancestors( $post->ID );
			$title = get_the_title();
			$i=2;
			foreach ( $anc as $ancestor ) {
				$return_array[$i] = array(
					"permalink" => get_permalink($ancestor),
					"title" => get_the_title($ancestor)
				);
				$i++;
			}
		} else {
			
		}
	} elseif (is_tag()) {
		$return_array[1]["permalink"] = get_permalink();
		$return_array[1]["title"] = single_tag_title("", false);
	} elseif (is_day() || is_month() || is_year()) {
		$return_array[1]["permalink"] = get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d'));
		$return_array[1]["title"] = "Archive for " . get_the_date();
	} elseif (is_author()) {
		$return_array[1]["permalink"] = get_author_posts_url(get_the_author_meta('ID')); 
		$return_array[1]["title"] = "Author Archive";
	} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		$return_array[1]["permalink"] = "";
		$return_array[1]["title"] = "Blog Archives";
	} elseif (is_search()) {
		$return_array[1]["permalink"] = get_search_link();
		$return_array[1]["title"] = "Search Results";
	}
	return $return_array;
}

function get_departaments() {

	global $wpdb;
	
	$query			= "select nombre from departamento";
	$departaments	= $wpdb->get_results($query);

	$departaments_str = array();
	
	foreach ( $departaments as $departament ) {
		
		$departaments_str[] = $departament->nombre;
	}
	
	return $departaments_str;
}


function get_teachers($departament = '') {
	
	$departament = isset($_POST['name_teacher']) ? $_POST['name_teacher'] : $departament;
	global $wpdb;
	
	$query		= $departament ? "select profesor.nombre from profesor inner join departamento on departamento.id = profesor.iddepartamento where departamento.nombre = '$departament'" : 
								"select nombre from profesor";
	$teachers	= $wpdb->get_results($query);

	$teachers_str = array();
	$var = 0;
	foreach ( $teachers as $teacher ) {
		
		$teachers_str["t".$var++] = $teacher->nombre;
	}
	
	//Si se realiza una llamada ajax existe una constante con valor a TRUE
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
		echo json_encode($teachers_str);
		die();
	}
	else {
		return $teachers_str;
	}
	
}

add_action( 'wp_enqueue_scripts', 'custom_enqueue_scripts' );

function custom_enqueue_scripts() {
	
	/* Eliminamos el jquery de WP */
    wp_deregister_script('jquery');
        
    /*Registramos el jquery de GOOGLE*/
    wp_register_script('jquery', "http". ($_SERVER['SERVER_PORT'] == 443 ? "s" : "").
    					"://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js", false, null );
	//wp_enqueue_script( 'main2', get_template_directory_uri().'/assets/js/bootstrap-select.min.js', false, null);
	wp_enqueue_script( 'main', get_template_directory_uri().'/assets/js/main.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'main1', get_template_directory_uri().'/assets/js/wow.min.js', array('jquery'), '1.0', true );

	wp_localize_script( 'main', 'teachers', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
	

}

//Con estos hooks indicamos que funcion se agregará al archivo admin-ajax para poder ejecutarlo desde una llamada ajax
add_action( 'wp_ajax_nopriv_get_teachers', 'get_teachers' );
add_action( 'wp_ajax_get_teachers', 'get_teachers' );
add_action( 'wp_ajax_nopriv_wpsx_redefine_locale', 'wpsx_redefine_locale' );
add_action( 'wp_ajax_wpsx_redefine_locale', 'wpsx_redefine_locale' );

/*
	Action Hook que activa un area de widgets en nuestro header, sidebar y footer
        
    __ es un echo especial
    %2$s estamos permitiendo que se coloquen las clases de los widgets dentro de la 
    estructura HTML
*/

function generaltheme_widgets_init() {
        
        register_sidebar( array(
            'name' => __('Header Widgets'),
            'id' => 'header',
            'description' => __('Header Widget Area'),
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
        ));
        
        register_sidebar( array(
            'name' => __('Sidebar Widgets'),
            'id' => 'sidebar',
            'description' => __('Sidebar Widget Area'),
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
        ));
        
        register_sidebar( array(
            'name' => __('Footer Widgets'),
            'id' => 'footer',
            'description' => __('Footer Widget Area'),
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
        ));
    }
    
    add_action('widgets_init', 'generaltheme_widgets_init');
    
    function get_my_categoty_links($ids){
        
        $title = '';
        
        for ( $i = 0; $i < count($ids); $i++ ) {
            
            $title .= '<a href="'.get_category_link($ids[$i]).'">'.get_cat_name($ids[$i]).'</a>';
            $title .= $i < (count($ids) -1) ? '<span class="catspace">, </span>' : '';
            
        }
        
        return $title;
    }
    
    function add_responsive_class( $content ){
        
        if ( empty($content) ) return $content;
        
        /*
            Convertimos el contenido a una codificacion HTML en UTF8
            Obtenemos todos los nodos HTML a traves del segundo atributo    
            
            Convertir el contenido que devuelve the_content() lo convertimos
            en codigo HTML y nos aseguramos que toma la codificacion UTF-8
            para que conozca los caracteres de acentuación
        */
        
        $content    = mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8');
        
        //Representa el documento HTML
        $document   = new DOMDocument();
        
        /*
            Deshabilitamos los errores de la libreria libxml y habilita el manejo
            de errores por parte del usuario, ya que el post se almacena el contenido
            XML y nosotros lo trabajamos en HTML
        */
        libxml_use_internal_errors(true);
        
        //Cargamos el contenido del post en el objeto DOMDocument
        $document->loadHTML(utf8_decode($content));
        
        switch (get_post_format($post->ID)) {
                
            case "quote": {
                $ps = $document->getElementsByTagName('p'); 
            
                if ($ps[0]) $ps[0]->setAttribute('class','title-quote');
                if ($ps[1]) $ps[1]->setAttribute('class','author-quote');
                break;
            }
                
        }
        
        /*
            Eliminamos si existe la altura y la anchura del div que contiene a la imagen
            si a esta se le agrego una leyenda a mano en WP
        */
        
        /*
            Recogemos en el array $imgs todos las etiquetas img que tenga el documento
        */
        $imgs       = $document->getElementsByTagName('img');
        
        //Lo recorremos y a cada uno le asignamos el atributo class con el valor img-responsive
        
        foreach( $imgs as $img ) {
        
            $img->setAttribute('class','img-responsive');
            
        }
        
        //Salvamos los cambios
        $html = $document->saveHTML();
                  
        return $html;
    }


    add_filter('the_content', 'add_responsive_class');
    
    
    //Filtro para limitar el numero de palabras del excerpt
    function custom_excerpt_length($length) {
    	
    	return is_front_page() ? "35" : ( is_search() ? "20" : $length);
    }
    
    add_filter('excerpt_length', 'custom_excerpt_length');
    
    function custom_excerpt_more($more){
    	
    	global $post;
    	
    	$more = is_front_page() ? '<div class="about-btn"><a href="'.get_permalink($post).'">'.__('Read more', "web").'</a></div>' : '';
    	
    	return $more;
    }
    
    add_filter('excerpt_more', 'custom_excerpt_more');
    
    //Funcion para que el m... de WP reconozca bien el numero de paginas de nuestra p.. consulta :)
    function my_post_count_queries( $query ) {
	  if (!is_admin() && $query->is_main_query()){
	    if(is_home()){
	       $query->set('posts_per_page', 1);
	    }
	  }
	}
	add_action( 'pre_get_posts', 'my_post_count_queries' );
	
	
	function wpsx_redefine_locale() {
	    
	    $locale = isset($_POST['locale']) ? $_POST['locale'] : $_GET['locale'];
	    
	    //$_GET['locale'] = $locale;
	    $_GET['locale'] = 'en_EN';
	}
	
	//add_action('init', 'wpsx_redefine_locale');
	
	