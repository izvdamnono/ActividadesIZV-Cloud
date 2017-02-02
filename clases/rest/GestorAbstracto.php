<?php
class GestorAbstracto {
    private $gestor;
    private $clase;
    
    function __construct($clase) {
        $bootstrap = new Bootstrap();
        $this->gestor = $bootstrap->getEntityManager();
        $this->clase = $clase;
    }
    
    /**
     * Consultar todas las actividades
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/actividad
     */
    public function consultarTodos() {
        $clase = ucfirst($this->clase);
        $objeto_clase = $this->clase;
        
        $objeto_clase = new $clase();
        $query = $this->gestor->getRepository($clase);
        $objeto_clase = $query->findAll();
        if ( !is_null($objeto_clase) ) {
            $data_to_json = array();
            foreach ($objeto_clase as $item) {
                $data_to_json[] = $item->getArray();
            }
        
            header("HTTP/1.1 200 OK");
            return (json_encode($data_to_json));      
        } else {
            header("HTTP/1.1 404 Not found");
            return '{"response":"error"}'; 
        }
    } 
    
    /**
     * Consultar una actividad por id 
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/actividad/4
     */
    public function consultarId($id) {
        $clase = ucfirst($this->clase);
        $objeto_clase = $this->clase;
        
        $query = $this->gestor->getRepository($clase);
        $objeto_clase = $query->findOneBy(array('id' => $id));
        if ( !is_null($objeto_clase) ) {
            header("HTTP/1.1 200 OK");
            return json_encode(array($objeto_clase->getArray()));
        } else {
            header("HTTP/1.1 404 Not found");
            return '{"response":"error"}'; 
        }
    }
    
    /**
     * Consultar todas las actividades de un dia en concreto YYYY-MM-DD
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/actividad/2017-01-29
     * Si le pasas una fecha en la que no hay datos devuelve [] y si le pasas una fecha mal formada no devuelve nada
     */
    public function consultarFecha($fecha) {
        $clase = ucfirst($this->clase);
        $objeto_clase = $this->clase;
        
        $objeto_clase = $this->gestor->getRepository($clase)->findBy(array('fecha' => date_create($fecha)));
        if ( !is_null($objeto_clase) ) {
            $data_to_json = array();
            foreach ($objeto_clase as $item) {
                $data_to_json[] = $item->getArray();
            }    
            header("HTTP/1.1 200 OK");
            return (json_encode($data_to_json));
        } else {
            header("HTTP/1.1 404 Not found");
            return '{"response":"error"}'; 
        }
    }
    
    /**
     * Consultar todas las actividades de un profesor en concreto
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/actividad/profesor/1
     */
    public function consultarProfesor($id_profesor) {
        $clase = ucfirst($this->clase);
        $objeto_clase = $this->clase;
        
        $objeto_clase = $this->gestor->getRepository($clase)->findBy(array('idap' => $id_profesor));
        if ( !is_null($objeto_clase) ) {
            $data_to_json = array();
            foreach ($objeto_clase as $item) {
                $data_to_json[] = $item->getArray();
            }
            
            header("HTTP/1.1 200 OK");
            return (json_encode($data_to_json));
        } else {
            header("HTTP/1.1 404 Not found");
            return '{"response":"error"}';
        }
    }

    /**
     * ARC -> Content-Type: application/json --> POST
     * https://iosapplication-fernan13.c9users.io/api/actividad
     * {"idap":3,"descripcion":"Lorem ipsum dolor sit amet, lorem, at.","resumen":"Lorem ipsum dolor sit amet.","idag":2,"fecha":"2017-01-26 00:00:00","hini":"1970-01-01 00:03:01","hfin":"1970-01-01 00:04:02"}
     * {"response": "ok"} o {"response": "error"}
     * 
     * {"titulo":"1","idap":2,"idag":2,"fecha":"2017-01-26 00:00:00","hini":"1970-01-01 00:03:01","hfin":"1970-01-01 00:04:02","descripcion":"String descripcion","resumen":"String resumen"}
     */
    public function insertar($object) {
        try {
            $clase = ucfirst($this->clase);
            $objeto_clase = $this->clase;
            $objeto_clase = new $clase();

            $profesor = $this->gestor->getReference('Profesor', $object->idap);
            $grupo = $this->gestor->getReference('Grupo', $object->idag);
            
            $objeto_clase = $objeto_clase->jsonToObject($object);
            $objeto_clase->setIdProfesor($profesor)->setIdGrupo($grupo);
            $this->gestor->persist($actividad);

            $this->gestor->flush();
            
            header("HTTP/1.1 201 Created");
            return '{"response":"ok"}';
        } catch(Exception $e) {
            header("HTTP/1.1 400 Bad Request");
            return '{"response":"error"}';
        }
    }
    
    /**
     * ARC -> Content-Type: application/json --> PUT
     * https://iosapplication-fernan13.c9users.io/api/actividad/1
     * {"idap":3,"descripcion":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam lobortis libero id ipsum consectetur feugiat. Donec iaculis convallis lorem, at.","resumen":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam lobortis libero id ipsum consectetur feugiat. Donec iaculis convallis lorem, at.","idag":2,"fecha":"2017-01-26 00:00:00","hini":"1970-01-01 00:03:01","hfin":"1970-01-01 00:04:02"}
     * {"response": "ok"} o {"response": "error"}
     */
    public function actualizar($object, $id) {
        try {
            $actividad = new Actividad();
            $actividad = $this->gestor->find("Actividad", $id);
            if ( is_null($actividad) ) throw new Exception('Actividad no encontrada');
            
            //Debemos de obtener las referencias a las Entidades de cada objeto
            $profesor = $this->gestor->getReference('Profesor', $object->idap);
            $grupo = $this->gestor->getReference('Grupo', $object->idag);
                
            $actividad = $actividad->jsonToObject($object);
            $actividad->setIdProfesor($profesor)->setIdGrupo($grupo);
            //Finalizamos y validamos la operacion
            $this->gestor->flush();
            
            header("HTTP/1.1 200 Updated");
            return '{"response":"ok"}';
        } catch( Exception $e ) {
            header("HTTP/1.1 304 Not Modified");
            return '{"response":"error"}';
        }
    }    
    
    /**
     * ARC -> Content-Type: application/json --> DELETE
     * https://iosapplication-fernan13.c9users.io/api/actividad/1
     * {"id":1}
     * {"response": "ok"} o {"response": "error"}
     */ 
    public function borrar($object, $id) {
        try {  
            $actividad  = $this->gestor->find('Actividad', $id);
            $this->gestor->remove($actividad);
            $this->gestor->flush();
            
            header("HTTP/1.1 204 Delete");
            return '{"response":"ok"}';
        } catch(Exception $e) {
            header("HTTP/1.1 400 Bad Request");
            return '{"response":"error"}';
        }
    }
    
    /**
     * ARC -> Content-Type: application/json --> DELETE
     * https://iosapplication-fernan13.c9users.io/api/actividad/delete
     * [{"id":3},{"id":4},{"id":6}]
     * {"response": "ok"} o {"response": "error"}
     */ 
    public function borrarJson($object) {
        try {  
            $objectArray = json_decode(json_encode($object), true);
            foreach ($objectArray as $value) {
                $actividad  = $this->gestor->find('Actividad', $value["id"]);
                if(!is_null($actividad)) {
                    $nameIMG = $actividad->getImagen();
                    if(!empty($nameIMG) and file_exists("../assets/img/".$nameIMG)) {
                        unlink("../assets/img/".$nameIMG);
                    }
                    $this->gestor->remove($actividad);
                    $this->gestor->flush();
                }
            }
                
            //header("HTTP/1.1 204 Delete all rows");
            return '{"response":"ok"}';
        } catch(Exception $e) {
            header("HTTP/1.1 400 Bad Request");
            return '{"response":"error"}';
        }
    }
}
