<?php
class GestorActividad {
    private $gestor;
    
    function __construct() {
        $bootstrap = new Bootstrap();
        $this->gestor = $bootstrap->getEntityManager();
    }
    
    /**
     * Consultar todas las actividades
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/actividad
     */
    public function consultarTodos() {
        $actividad = new Actividad();
        $query = $this->gestor->getRepository('Actividad');
        $actividades = $query->findAll();
        $data_to_json = array();
        foreach ($actividades as $item) {
            $data_to_json[] = $item->getArray();
        }
        if ( !is_null($actividades) ) {
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
        $query = $this->gestor->getRepository('Actividad');
        $actividad = $query->findOneBy(array('id' => $id));
        if ( !is_null($actividad) ) {
            header("HTTP/1.1 200 OK");
            return json_encode(array($actividad->getArray()));
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
        $actividades = $this->gestor->getRepository('Actividad')->findBy(array('fecha' => date_create($fecha)));
        if ( !is_null($actividades) ) {
            $data_to_json = array();
            foreach ($actividades as $item) {
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
        $actividades = $this->gestor->getRepository('Actividad')->findBy(array('idap' => $id_profesor));
        if ( !is_null($actividades) ) {
            $data_to_json = array();
            foreach ($actividades as $item) {
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
            $actividad = new Actividad();

            $profesor = $this->gestor->getReference('Profesor', $object->idap);
            $grupo = $this->gestor->getReference('Grupo', $object->idag);
            
            $actividad = $actividad->jsonToObject($object);
            $actividad->setIdProfesor($profesor)->setIdGrupo($grupo);
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
{
  "idap":3,
  "idag":2,
  "titulo":"titulo 1",
  "descripcion":"Lorem ipsum dolor sit amet. Donec iaculis convallis lorem, at.",
  "resumen":"Lorem ipsum dolor sit amet",
  "fecha":"2017-01-26 00:00:00",
  "hini":"1970-01-01 00:03:01",
  "hfin":"1970-01-01 00:04:02"
}
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
                
            //Esta comentado porque con esta cabecera no le llega ninguna respuesta al dispositivo iO
            //header("HTTP/1.1 204 No content");
            return '{"response":"ok"}';
        } catch(Exception $e) {
            header("HTTP/1.1 400 Bad Request");
            return '{"response":"error"}';
        }
    }
}
