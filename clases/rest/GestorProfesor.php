<?php
class GestorProfesor {
    private $gestor;
    
    function __construct() {
        $bootstrap = new Bootstrap();
        $this->gestor = $bootstrap->getEntityManager();
    }
    
    /**
     * Consultar todos los profesors
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/profesor/
     */
    public function consultarTodos() {
        $query = $this->gestor->getRepository('Profesor');
        $Profesores = $query->findAll();
        $data_to_json = array();
        foreach($Profesores as $item){
            $data_to_json[] = $item->getArray();
        }
        return (json_encode($data_to_json));
    } 
    
    /**
     * Consultar una actividad por id 
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/profesor/4
     */
    public function consultarId($id) {
        $grupo = $this->gestor->find('Profesor',$id);
        return !is_null($grupo) ? json_encode(array($grupo->getArray())) : '{"response":"error"}';
    }
    

    /**
     * ARC -> Content-Type: application/json --> POST
     * https://iosapplication-fernan13.c9users.io/api/profesor
     * {"nombre": "Jesus","idap":3,"idpd":2}
     * {"response": "ok"} o {"response": "error"}
     */
    public function insertar($object) {
        try {
            $profesor = new Profesor();
            $profesor = $profesor->jsonToObject($object);
            $profesor = $this->gestor->getReference('Departamento', $object->idpd);
            $this->gestor->persist($profesor);
            $this->gestor->flush();

            return '{"response":"ok"}';
        } catch(Exception $e) {
            return '{"response":"error"}';
        }
    }
    
    /**
     * ARC -> Content-Type: application/json --> PUT
     * https://iosapplication-fernan13.c9users.io/api/profesor/1
     * {"id":3,"nombre":"Pedro"}
     * {"response": "ok"} o {"response": "error"}
     */
    public function actualizar($object, $id) {
        try {
            $profesor = new Profesor();
            $profesor  = $this->gestor->find('Profesor', $id);
            if ( is_null($profesor) ) throw new Exception('Profesor no encontrado');
            $profesor  = $profesor->jsonToObject($object);
            $this->gestor->flush();
             
            return '{"response":"ok"}';
        } catch( Exception $e ) {
            return '{"response":"error"}';
        }
    }    
    
    /**
     * ARC -> Content-Type: application/json --> DELETE
     * https://iosapplication-fernan13.c9users.io/api/profesor/1
     * {"id":3}
     * {"response": "ok"} o {"response": "error"}
     */ 
    public function borrar($object, $id) {
        try {  
            $profesor  = $this->gestor->find('Profesor', $id);
            $this->gestor->remove($profesor);
            $this->gestor->flush();
                
            return '{"response":"ok"}';
        } catch(Exception $e) {
            return '{"response":"error"}';
        }
    }
}
