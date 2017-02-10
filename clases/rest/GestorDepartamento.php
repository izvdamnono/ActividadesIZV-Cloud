<?php
class GestorDepartamento {
    private $gestor;
    
    function __construct() {
        $bootstrap = new Bootstrap();
        $this->gestor = $bootstrap->getEntityManager();
    }
    
    /**
     * Consultar todos los departamentos
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/departamento
     */
    public function consultarTodos() {
        $query = $this->gestor->getRepository('Departamento');
        $grupos = $query->findAll();
        $data_to_json = array();
        foreach($grupos as $item){
            $data_to_json[] = $item->getArray();
        }
        if ( !is_null($grupos) ) {
            header("HTTP/1.1 200 OK");
            return (json_encode($data_to_json));      
        } else {
            header("HTTP/1.1 404 Not found");
            return '{"response":"error"}'; 
        }    
    } 
    
    /**
     * Consultar una actividad por id 
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/departamento/4
     */
    public function consultarId($id) {
        $grupo = $this->gestor->getRepository('Departamento')->findOneBy(array('id' => $id));
        if ( !is_null($grupo) ) {
            header("HTTP/1.1 200 OK");
            return json_encode(array($grupo->getArray()));
        } else {
            header("HTTP/1.1 404 Not found");
            return '{"response":"error"}'; 
        }    
    }
    
   
    /**
     *  Consultar los profesores de un departamento
     *  Ejemplo https://iosapplication-fernan13.c9users.io/api/departamento/1/profesor
     */
    public function consultarProfesor($id_profesor) {
        $profesores = $this->gestor->getRepository('Profesor')->findBy(array('idpd' => $id_profesor));
        if ( !is_null($profesores) ) {
            $data_to_json = array();
            foreach ($profesores as $item) {
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
     * https://iosapplication-fernan13.c9users.io/api/departamento
     * {"nombreDepartamento": "Fisica"}
     * {"response": "ok"} o {"response": "error"}
     */
    public function insertar($object) {
        try {
            $departamento = new Departamento();
            $departamento = $departamento->jsonToObject($object);
            $this->gestor->persist($departamento);
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
     * https://iosapplication-fernan13.c9users.io/api/departamento/2
     * {"id":3,"nombreDepartamento":"Ciencias"}
     * {"response": "ok"} o {"response": "error"}
     */
    public function actualizar($object, $id) {
        try {
            $departamento = new Departamento();
            $departamento  = $this->gestor->find('Departamento', $id);
            if ( is_null($departamento) ) throw new Exception('Departamento no encontrado');
            $departamento  = $departamento->jsonToObject($object);
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
     * https://iosapplication-fernan13.c9users.io/api/departamento/2
     * {"id":3}
     * {"response": "ok"} o {"response": "error"}
     */ 
    public function borrar($object, $id) {
        try {
            $departamento  = $this->gestor->find('Departamento', $id);
            $this->gestor->remove($departamento);
            $this->gestor->flush();
                
            //header("HTTP/1.1 204 Delete");
            return '{"response":"ok"}';
        } catch(Exception $e) {
            header("HTTP/1.1 400 Bad Request");
            return '{"response":"error"}';
        }
    }
}
