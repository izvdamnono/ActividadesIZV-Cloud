<?php



require_once ("inc/theme-support.php");
require_once ("inc/custom-post.php");
require_once ("inc/header-nav.php");
require_once ("inc/hooks.php");
require_once ("inc/WP_Query_Activity.php");

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
function get_paginate_page_link( $type = 'plain', $endsize = 1, $midsize = 1 ) {
		
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
			'total'		=> $wp_query->max_num_pages,
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

   

