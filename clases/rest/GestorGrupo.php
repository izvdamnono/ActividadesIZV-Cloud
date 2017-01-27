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
        $Profesores = $query->findAll();
        $data_to_json = array();
        foreach($Profesores as $item){
            $data_to_json[] = $item->getArray();
        }
        return (json_encode($data_to_json));
    } 
    
    /**
     * Consultar un grupo por id 
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/grupo/4
     */
    public function consultarId($id) {
        $grupo = $this->gestor->find('Grupo',$id);
        return !is_null($grupo) ? json_encode(array($grupo->getArray())) : '{"response":"error"}';
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

            return '{"response":"ok"}';
        } catch(Exception $e) {
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
             
            return '{"response":"ok"}';
        } catch( Exception $e ) {
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
                
            return '{"response":"ok"}';
        } catch(Exception $e) {
            return '{"response":"error"}';
        }
    }
}
