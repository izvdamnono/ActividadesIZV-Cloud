<?php
/*
header('Content-Type: application/json');

$scheme = $_SERVER['REQUEST_SCHEME'];
$domain = $_SERVER['SERVER_NAME'];
$path   = $_SERVER['REQUEST_URI'];

$url = $scheme.'://'.$domain.$path;

$servidor = $_SERVER['HTTP_HOST'];
$ruta = $_SERVER['REQUEST_URI'];
$json = file_get_contents('php://input');
$objeto = json_decode($json)
*/

/**
 * FRONT CONTROLLER
 */


$parametros = explode('/', $_GET['url']);
$api = array();
foreach($parametros as $indice => $parametro) {
    $api[$indice] = $parametro;
}

$metodo = $_SERVER['REQUEST_METHOD'];
 
 
if(!is_null($api[0])) {
    /**
    * Estructura de clases de Carmelo, funciona AutoLoad
    *
    */
    //require_once('../doctrine/AutoLoad.php');
    require_once('../clases/AutoLoad.php');
    $bootstrap = new Bootstrap();
    $gestor = $bootstrap->getEntityManager();
    // Cabeceras de tipo json
    header('Content-Type: application/json');

    switch ($api[0]) {
        case 'actividad':
            $actividad = new Actividad();
            break;
        case 'profesor':
            $profesor = new Profesor();
            break;
        case 'grupo':
            $grupo = new Grupo();
            break;
    }
    
    // Cabeceras de tipo json
    header('Content-Type: application/json');
    
    //En ambos casos se recibe un json
    $json   = file_get_contents('php://input');
    $object = json_decode($json);
    $id     = $api[1];
}
switch($metodo) {
    
    /**
     * Consultar
     */
    case "GET": {
        if ($api[0]=="actividad" and is_numeric($api[1]) and $api[1]>=1) {
            /**
             * Consultar una actividad por id 
             * Ejemplo https://iosapplication-fernan13.c9users.io/api_pruebas/actividad/4
             */
            $query = $gestor->createQuery('SELECT r FROM actividad r WHERE r.id = ' . $api[1]);
            $actividades = $query->getResult();
            $data_to_json = array();
            foreach($actividades as $item){
                $data_to_json[] = $item->getArray();
            }
            echo (json_encode($data_to_json));
        } else if ($api[0]=="actividad" and is_null($api[1])) {
            /**
             * Consultar todas las actividades
             * Ejemplo https://iosapplication-fernan13.c9users.io/api_pruebas/actividad
             */
            $query = $gestor->createQuery("SELECT r FROM actividad r");
            $actividades = $query->getResult();
            $data_to_json = array();
            foreach($actividades as $item){
                $data_to_json[] = $item->getArray();
            }
            echo (json_encode($data_to_json));
        } else if ($api[0]=="actividad" and $api[1]=="profesor" and is_numeric($api[2]) and $api[2]>=1) {
            /**
             * Consultar todas las actividades de un profesor en concreto
             * Ejemplo https://iosapplication-fernan13.c9users.io/api_pruebas/actividad/profesor/1
             */
            $profesor = new Profesor();
            $query = $gestor->createQuery("SELECT a FROM actividad a, profesor p WHERE a.idap = p.id and p.id = ".$api[2]);
            $actividades = $query->getResult();
            $data_to_json = array();
            foreach($actividades as $item){
                $data_to_json[] = $item->getArray();
            }    
            echo (json_encode($data_to_json));
        } else if ($api[0]=="actividad" and  !is_null($api[1]) and preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $api[1])) {
            /**
             * Consultar todas las actividades de un dia en concreto YYYY-MM-DD
             * Ejemplo https://iosapplication-fernan13.c9users.io/api_pruebas/actividad/profesor/1
             */
            $query = $gestor->createQuery("SELECT a FROM actividad a WHERE a.fecha = '" . $api[1] . "'");
            $actividades = $query->getResult();
            $data_to_json = array();
            foreach($actividades as $item){
                $data_to_json[] = $item->getArray();
            }    
            echo (json_encode($data_to_json));
        }
        
        /**
         * Profesor
         */
        if ($api[0]=="profesor" and is_numeric($api[1]) and $api[1]>=1) {
            /**
             * Consultar un profesor por su id
             * Ejemplo https://iosapplication-fernan13.c9users.io/api_pruebas/profesor/1
             */
            $query = $gestor->createQuery('SELECT r FROM profesor r WHERE r.id = ' . $api[1]);
            $profesores = $query->getResult();
            $data_to_json = array();
            foreach($profesores as $item){
                $data_to_json[] = $item->getArray();
            }
            echo (json_encode($data_to_json));
        } else if ($api[0]=="profesor" and is_null($api[1])) {
            /**
             * Consultar todos los profesores
             * Ejemplo https://iosapplication-fernan13.c9users.io/api_pruebas/profesor
             */
            $query = $gestor->createQuery("SELECT r FROM profesor r");
            $profesores = $query->getResult();
            $data_to_json = array();
            foreach($profesores as $item){
                $data_to_json[] = $item->getArray();
            }
            echo (json_encode($data_to_json));
        }
        
        /**
         * Grupo
         */ 
        if ($api[0]=="grupo" and is_numeric($api[1]) and $api[1]>=1) {
            /**
             * Consultar un grupo por su id
             * Ejemplo https://iosapplication-fernan13.c9users.io/api_pruebas/grupo/1
             */
            $query = $gestor->createQuery('SELECT r FROM grupo r WHERE r.id = ' . $api[1]);
            $grupos = $query->getResult();
            $data_to_json = array();
            foreach($grupos as $item){
                $data_to_json[] = $item->getArray();//Todos los datos 
            }
            echo (json_encode($data_to_json));
        } else if ($api[0]=="grupo" and is_null($api[1])) {
            /**
             * Consultar todos los grupos
             * Ejemplo https://iosapplication-fernan13.c9users.io/api_pruebas/grupo
             */
            $query = $gestor->createQuery("SELECT r FROM grupo r");
            $grupos = $query->getResult();
            $data_to_json = array();
            foreach($grupos as $item){
                $data_to_json[] = $item->getArray();
            }
            echo (json_encode($data_to_json));
        }
        
        break;
    }
    
    /**
     * Insertar
     */
    case "POST": {
        if ( !is_null($api[0]) ) {
            if (!is_null($object)) {
                try {
                    if ( $api[0] == "actividad" ) {
                        /**
                         * ARC -> Content-Type: application/json
                         * https://iosapplication-fernan13.c9users.io/api_pruebas/actividad
                         * {"nombre": "Jesus"}
                         * {"response": "ok"} o {"response": "error"}
                         */
                        $actividad = new Actividad();
                        
                        //Debemos de obtener las referencias a las Entidades de cada objeto
                        $profesor = $gestor->getReference('Profesor', $object->idap);
                        $grupo    = $gestor->getReference('Grupo', $object->idag);
                        
                        $actividad = $actividad->jsonToObject($object);
                        $actividad->setIdProfesor($profesor)->setIdGrupo($grupo);
                        $gestor->persist($actividad);
                        
                    } else if ( $api[0] == "profesor" ) {
                        /**
                         * ARC -> Content-Type: application/json
                         * https://iosapplication-fernan13.c9users.io/api_pruebas/profesor
                         * {"nombre": "Jesus"}
                         * {"response": "ok"} o {"response": "error"}
                         */
                        $profesor = new Profesor();
                        $profesor = $profesor->jsonToObject($object);
                        $gestor->persist($profesor);
                    } else if ( $api[0] == "grupo" ) {
                        /**
                         * ARC -> Content-Type: application/json
                         * https://iosapplication-fernan13.c9users.io/api_pruebas/grupo
                         * {"nombre": "ADE"}
                         * {"response": "ok"} o {"response": "error"}
                         */
                        $grupo = new Grupo();
                        $grupo = $grupo->jsonToObject($object);
                        $gestor->persist($grupo);
                        
                    }
                    
                    //Finalizamos y validamos la operacion
                    $gestor->flush();
                    
                    echo '{"response": "ok"}';
                    
                    break;
                } catch(Exception $e){

                }
                
            }
            
        }
        
        echo '{ "response" : "error" }';
        
        break;
    }
    
    case "PUT": {
        if (!is_null($api[0] && !is_null($api[1]) ) && is_numeric($api[1]) ) {
            
            if (!is_null($object)) {
             
                try {
                    if ( $api[0] == "actividad" ) {
                        $actividad  = $gestor->find('Actividad', $id);
                        
                        if ( is_null($actividad) ) throw new Exception('Actividad no encontrada');
                        
                        //Debemos de obtener las referencias a las Entidades de cada objeto
                        $profesor = $gestor->getReference('Profesor', $object->idap);
                        $grupo    = $gestor->getReference('Grupo', $object->idag);
                            
                        $actividad = $actividad->jsonToObject($object);
                        $actividad->setIdProfesor($profesor)->setIdGrupo($grupo);
                    } else if ( $api[0] == "profesor" ) {
                        $profesor  = $gestor->find("Profesor", $id);
                        
                        if ( is_null($profesor) ) {
                            throw new Exception('Profesor no encontrado');
                        }
                        $profesor  = $profesor->jsonToObject($object);
                    } else if ( $api[0] == "grupo" ) {
                        $grupo  = $gestor->find('Grupo', $id);
                        
                        if ( is_null($grupo) ) throw new Exception('Grupo no encontrado');
                        $grupo  = $grupo->jsonToObject($object);
                    }
                        
                    //Finalizamos y validamos la operacion
                    $gestor->flush();
                        
                    echo '{"response": "ok"}';
                        
                    break;
                } catch( Exception $e ){
                    
                }
                    
            }
            
        }
        
        echo '{ "response" : "error" }';
        
        break;
    }
    
    case "DELETE": {
        if ((!is_null($api[0]) && !is_null($api[1]) ) && is_numeric($api[1])) {

            try {
                if ( $api[0] == "actividad" ) {
                    $actividad  = $gestor->find('Actividad', $id);
                    $gestor->remove($actividad);//borro provisional
                } else if ( $api[0] == "profesor" ) {
                    $profesor  = $gestor->find('Profesor', $id);
                    $gestor->remove($profesor);//borro provisional
                } else if ( $api[0] == "grupo" ) {
                    $grupo  = $gestor->find('Grupo', $id);
                    $gestor->remove($grupo);//borro provisional
                } 
                    
                //Finalizamos y validamos la operacion
                $gestor->flush();
                    
                echo '{"response": "ok"}';
                    
                break;
            } catch(Exception $e){
                
            }
        }
        
        echo '{ "response" : "error" }';
        
        break;
    }
 }


// print_r(json_decode(json_encode($data_to_json)));
