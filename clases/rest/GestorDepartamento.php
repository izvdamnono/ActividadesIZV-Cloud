<?php
class GestorDepartamento {
    private $gestor;
    
    function __construct() {
        $bootstrap = new Bootstrap();
        $this->gestor = $bootstrap->getEntityManager();
    }
    
    /**
     * Consultar todos los departamentos
     * Ejemplo https://iosapplication-fernan13.c9users.io/api_pruebas/departamento
     */
    public function consultarTodos() {
        $query = $this->gestor->getRepository('Departamento');
        $grupos = $query->findAll();
        $data_to_json = array();
        foreach($grupos as $item){
            $data_to_json[] = $item->getArray();
        }
        return (json_encode($data_to_json));
    } 
    
    /**
     * Consultar una actividad por id 
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/actividad/4
     */
    public function consultarId($id) {
        $grupo = $this->gestor->getRepository('Departamento')->findOneBy(array('id' => $id));
        return !is_null($grupo) ? json_encode(array($grupo->getArray())) : '{"response":"error"}';
    }
    
   
    /**
     *  Consultar los profesores de un departamento
     *  Ejemplo https://iosapplication-fernan13.c9users.io/api_pruebas/departamento/1/profesor
     */
    public function consultarProfesor($id_profesor) {
        $profesores = $this->gestor->getRepository('Profesor')->findBy(array('idpd' => $id_profesor));
        $data_to_json = array();
        foreach ( $profesores as $item ) {
            $data_to_json[] = $item->getArray();
        }
        
        return json_encode($data_to_json);
    }

    /**
     * ARC -> Content-Type: application/json
     * https://iosapplication-fernan13.c9users.io/api/departamento
     * {"nombre": "Fisica"}
     * {"response": "ok"} o {"response": "error"}
     */
    public function insertar($object) {
        try {
            $departamento = new Departamento();
            $departamento = $departamento->jsonToObject($object);
            $this->gestor->persist($departamento);

            $this->gestor->flush();
        
            return '{"response":"ok"}';
        } catch(Exception $e) {
            return '{"response":"error"}';
        }
    }
    
    /**
     * ARC -> Content-Type: application/json --> PUT
     * https://iosapplication-fernan13.c9users.io/api/actividad
     * {"idap":3,"descripcion":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam lobortis libero id ipsum consectetur feugiat. Donec iaculis convallis lorem, at.","resumen":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam lobortis libero id ipsum consectetur feugiat. Donec iaculis convallis lorem, at.","idag":2,"fecha":"2017-01-26 00:00:00","hini":"1970-01-01 00:03:01","hfin":"1970-01-01 00:04:02"}
     * {"response": "ok"} o {"response": "error"}
     */
    public function actualizar($object) {
        try {
            $departamento = new Departamento();
            $departamento  = $this->gestor->find('Departamento', $object->id);
            if ( is_null($departamento) ) throw new Exception('Departamento no encontrado');
            $departamento  = $departamento->jsonToObject($object);
            $this->gestor->flush();
             
            return '{"response":"ok"}';
        } catch( Exception $e ) {
            return '{"response":"error"}';
        }
    }    
    
    /**
     * ARC -> Content-Type: application/json --> DELETE
     * https://iosapplication-fernan13.c9users.io/api/departamento
     * {"id":3}
     * {"response": "ok"} o {"response": "error"}
     */ 
    public function borrar($object) {
        try {  
            $departamento  = $this->gestor->find('Departamento', $object->id);
            $this->gestor->remove($departamento);
            $this->gestor->flush();
                
            return '{"response":"ok"}';
        } catch(Exception $e) {
            return '{"response":"error"}';
        }
    }
}
