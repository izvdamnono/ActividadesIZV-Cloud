<?php

    /**
     * Recent post shortcode
     *
     * @package     PluginPackage
     * @author      Antonio Mudarra Machuca, Fernando Trujillo Benitez
     * @copyright   2017 Antonio Mudarra Machuca, Fernando Trujillo Benitez
     * @license     GPL-2.0+
     *
     * @wordpress-plugin
     * Plugin Name: Activity High School
     * Plugin URI:  https://example.com/plugin-name
     * Description: Recent post shortcode. Permite visualizar el contenido de nuestras actividades en posts.
     * Version:     1.0.0
     * Author:      Antonio Mudarra Machuca, Fernando Trujillo Benitez
     * Author URI:  https://example.com
     * Text Domain: notebook social media
     * License:     GPL-2.0+
     * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
     *
     * Date: 8/2/17
     * Time: 13:09
     */

	function activity_posts_shortcode($atts, $content) {
		
		/*
			Con la funcion shortcode_atts nos permite establecer los parámetros por defecto del
			shortcode en el caso que no se haya introducido ningun valor
			
			Extract: Importa variables desde un array a la tabla de símbolos actual.
				Ex:
					$var_array = array("color" => "azul",
									   "tamaño"  => "medio",
									   "forma" => "esfera");
					extract($var_array, EXTR_PREFIX_SAME, "wddx");

					echo "$color, $tamaño, $forma, $wddx_tamaño\n";
		*/
		
		$return_string  = "<h3>$content</h3>";
		$return_string .= '<ul>';
		
		extract(shortcode_atts(array('fecha' => '', 'profesor' => '', 'departamento' => ''), $atts));
			
		$query = new WP_Query_Activity( array(	'fecha' => $fecha, 
												'profesor' => $profesor, 
												'departamento' => $departamento));
		
		if ( $query->have_activities() ) : 
		    
		    while( $query->have_activities() ) : $query->the_activity();
		        
		        $return_string .= '<p>'.$query->get_the_title().'</p>';
		        
		    endwhile;
		    
		endif;
	
	    $query->wp_reset_activitydata();
		
		$return_string .= '<ul>';
		
		return $return_string;
	}

	function register_shortcodes(){
		
		add_shortcode('activity-posts', 'activity_posts_shortcode');
	}

	add_action( 'init', 'register_shortcodes');

?>