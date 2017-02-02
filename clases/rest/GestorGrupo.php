<?php
class GestorGrupo {
    private $gestor;
    
    function __construct() {
        $bootstrap = new Bootstrap();
        $this->gestor = $bootstrap->getEntityManager();
    }
    
    /**
     * Consultar todos los grupos
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/grupo/
     */
    public function consultarTodos() {
        $query = $this->gestor->getRepository('Grupo');
        $profesores = $query->findAll();
        $data_to_json = array();
        foreach($profesores as $item){
            $data_to_json[] = $item->getArray();
        }
        if ( !is_null($profesores) ) {
            header("HTTP/1.1 200 OK");
            return (json_encode($data_to_json));      
        } else {
            header("HTTP/1.1 404 Not found");
            return '{"response":"error"}'; 
        }
    } 
    
    /**
     * Consultar un grupo por id 
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/grupo/4
     */
    public function consultarId($id) {
        $grupo = $this->gestor->find('Grupo',$id);
        if ( !is_null($grupo) ) {
            header("HTTP/1.1 200 OK");
            return json_encode(array($grupo->getArray()));
        } else {
            header("HTTP/1.1 404 Not found");
            return '{"response":"error"}'; 
        }
    }
    

    /**
     * ARC -> Content-Type: application/json --> POST
     * https://iosapplication-fernan13.c9users.io/api/grupo
     * {"nombreGrupo":"Grupo nuevo","idpd":2}
     * {"response": "ok"} o {"response": "error"}
     */
    public function insertar($object) {
        try {
            $grupo = new Grupo();
            $grupo = $grupo->jsonToObject($object);
            $grupo = $this->gestor->getReference('Grupo', $object->idpd);
            $this->gestor->persist($grupo);
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
     * https://iosapplication-fernan13.c9users.io/api/grupo/1
     * {"id":3,"nombre":"Pedro"}
     * {"response": "ok"} o {"response": "error"}
     */
    public function actualizar($object, $id) {
        try {
            $grupo = new Grupo();
            $grupo  = $this->gestor->find('Grupo', $id);
            //echo $object->id;
            if ( is_null($grupo) ) throw new Exception('Grupo no encontrado');
            $grupo  = $grupo->jsonToObject($object);
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
     * https://iosapplication-fernan13.c9users.io/api/grupo/1
     * {"id":3}
     * {"response": "ok"} o {"response": "error"}
     */ 
    public function borrar($object, $id) {
        try {  
            $grupo  = $this->gestor->find('Profesor', $id);
            $this->gestor->remove($grupo);
            $this->gestor->flush();
                
            header("HTTP/1.1 204 Delete");
            return '{"response":"ok"}';
        } catch(Exception $e) {
            header("HTTP/1.1 400 Bad Request");
            return '{"response":"error"}';
        }
    }
}
