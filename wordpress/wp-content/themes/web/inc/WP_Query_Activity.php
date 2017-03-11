<?php


class WP_Query_Activity {
    
    /*
        Array que almacenara todos los parámetros por los cuales nosotros filtraremos
        nuestras actividades
    */
    protected $args = array('fecha' => '',
                            'departamento' => '',
                            'profesor' => '');
    private $activities;
    private $position;
    private $curactivity;
    
    function __construct($args = array()) {
        
        $this->position = 0;
        
        if ( count($args) > 0 ) {
            
            $keysQ = array_keys($args);
           
            foreach ( $keysQ as $key ) {
                
                if ( array_key_exists($key, $this->args) ) {
                    
                    $this->args[$key] = $args[$key];
                }
            }
        }
        
        $this->do_query();
    }
    
    function do_query() {
    
        /*
            En proceso se debe de utilizar los argumentos en la busqueda si se introducen!!
        */
        
        //Variable de WP que nos permite realizar consultar a su BBDD
        global $wpdb;
        
        $query  = "select * from (select a.* from actividad a order by if (a.fecha = date(now()), 1, 0) desc,
                        if(datediff(a.fecha, date(now())) > 0, - datediff(a.fecha, date(now())),null) desc,
                        datediff(a.fecha, date(now())) desc,
                        a.hini) actividad";
                        
        /*$query       = "select * from (
                            select * from ( 
                                select * from actividad 
                                    where DATE_FORMAT(fecha, '%Y-%m-%d') >= DATE_FORMAT(now(), '%Y-%m-%d' ) 
                                    order by fecha asc, hini asc) a1 
                            union all 
                            select * from ( 
                                select * from actividad 
                                    where DATE_FORMAT(fecha, '%Y-%m-%d') < DATE_FORMAT(now(), '%Y-%m-%d' ) 
                                    order by fecha desc) a2) actividad";*/
        
        //Comprobamos los distintos filtros habilitados
        if ( !empty($dpt = $this->args['departamento']) && !empty($prf = $this->args['profesor']) ) {
            
            //Se realiza un filtrado por departamento y profesor
            $subquery = "( select profesor.id from profesor 
                           inner join departamento on 
                           profesor.iddepartamento = departamento.id 
                           where departamento.". (is_numeric($dpt) ? "id = $dpt" : "nombre = '$dpt'")." 
                           and profesor.". (is_numeric($prf) ? "id = $prf" : "nombre = '$prf'"). ") profesor";
                                      
            $query .= " inner join " .$subquery. " on actividad.idprofesor = profesor.id";
        }
        else {
            
            if ( !empty($dpt = $this->args['departamento']) ) {
                
                //Si introducimos un id busca por id en su defecto busca por nombre
                if ( is_numeric($dpt) ) {
                        
                    $query .= " inner join ( select id from profesor where iddepartamento = $dpt ) 
                                p on actividad.idprofesor = p.id";
                }
                else 
                {
                    /*
                    
                        Obtener los ids de los profesores de un departamento dado su nombre:
                        
                        select profesor.id from profesor inner join ( select departamento.id from departamento where nombre = 'informatica') d on profesor.iddepartamento = d.id
                    */
                        
                    $query .= " inner join  (
                                    select profesor.id from profesor 
                                    inner join ( select departamento.id from departamento where nombre = '$dpt') d 
                                    on profesor.iddepartamento = d.id) 
                                profesor on actividad.idprofesor = profesor.id";
                }
            }
            elseif ( $prf = $this->args['profesor']) {
                
                if ( !is_numeric($prf) ) {
                        
                    $query .= " inner join ( select id from profesor where nombre = '$prf') p
                                on actividad.idprofesor = p.id";
                }
                else 
                {
                    $query  .= " where actividad.idprofesor = $prf";     
                }
                            
            }
        }
        
        //Comprobamos el filtro para la fecha
        if ( $fecha = $this->args['fecha'] ) {
            
            $query .= " where actividad.fecha = '".date_format(date_create($fecha), 'Y-m-d')."'";
        }
        //Lo he solucionado, pero no se muestran ahora las tildes
        
        $this->activities = $wpdb->get_results($query);
        
    }
    
    function have_activities() {
        
        return count($this->activities) > 0 && $this->position != count($this->activities);
    }
    
    function the_activity() {
        
        $this->curactivity = $this->activities[$this->position];
        $this->position+=1;
    }
    
    function wp_reset_activitydata() {
        
        $this->args = array('fecha' => '',
                            'profesor' => '',
                            'departamento' => '');
                      
        $this->activities   = null;
        $this->position     = 0;
        $this->curactivity  = null;
    }
    
    function activity_count() {
        
        return count($this->activities);
    }
    
    /**
     * Funciones personalizadas para obtener o visualizar los distintos datos
     * de nuestras actividades
     */ 
    
    /**
     * Titulo
     * 
     */
    function the_title() {
        
        echo $this->get_the_title();
    }
    
    function get_the_title() {
        
        return $this->curactivity->titulo;
    }
    
    /**
     * Profesor
     * 
     */ 
    function the_teacher() {
        
        echo $this->get_the_teacher()->teacher_name;
    }
    
    
    function get_the_teacher() {
        
        //La consulta devuelve un array de objetos como preguntamos por uno solo nos quedamos con el primero
        global $wpdb;
        
        $query = 'SELECT profesor.nombre as teacher_name, departamento.nombre as department_name 
                  FROM profesor 
                  inner join departamento on profesor.iddepartamento = departamento.id 
                  where profesor.id = %d';
        return $wpdb->get_results($wpdb->prepare($query, $this->curactivity->idprofesor))[0];
        
    }
    
    /**
     * Resumen
     */ 
    function the_excerpt(){
        
        echo $this->get_the_excerpt();
    }
    
    function get_the_excerpt() {
        
        return $this->curactivity->resumen;
    }
    
    /**
     * Descripcion
     */
    function the_content(){
        
        echo $this->get_the_content();
    }
    
    function get_the_content() {
        
        return $this->curactivity->descripcion;
    }
    
    /**
     * Imagen destacada si no la tiene se muestra una por defecto
     */
    function get_thumbnail_activity() {
        
        $scheme = $_SERVER['REQUEST_SCHEME'];
        $domain = $_SERVER['SERVER_NAME'];
        $path   = '/assets/img/';
        
        return $scheme.'://'.$domain.$path.(!empty($imagen = $this->curactivity->imagen) ? $imagen : 'excursion-default.jpg');
    }
    
    function the_thumbnail_activity() {
        
        echo $this->get_thumbnail_activity();
    }
    
    /**
     * Fecha
     */
    
    function the_date($format = ''){
        
        echo $this->get_the_date($format);
    }
    
    function get_the_date($format) {
        
        return date_format( date_create($this->curactivity->fecha), !empty($format) ? $format : 'd-m-Y');
    }
    
    /**
     * Hora Inicial
     */
     
    function the_time($fin = false, $format = ''){
        
        echo $this->get_the_time($fin, $format);
    }
    
    function get_the_time($fin , $format) {
        
        return date_format( date_create($fin ? $this->curactivity->hfin : $this->curactivity->hini), 
                                        !empty($format) ? $format : 'H:i:s');
    }
    
    
    /**
     * Permalink
     */ 
    
    function the_permalink() {
        
        echo $this->get_permalink();
    }
    
    function get_the_permalink() {
        
        return home_url().'/single-actividad';
    }
    
}



?>