<?php
class Api {
    private $metodo;
    private $json;
    private $parametros;
    private $get;
    private $response;
    
    function __construct($metodo, $json, $parametros, $get){
        $this->metodo = $metodo;
        $this->json = json_decode($json);
        $this->parametros = $parametros;
        $this->get = $get;
    }
    
    public function doJob(){
        if(!empty($this->parametros[0])){
            $rest = $this->parametros;
            $rest_0 = $rest[0];
            //Cargamos las clases de forma dinamica
            $class = ucfirst($rest_0);
            $apiClass = "Gestor" . $class;
            if (class_exists($apiClass)){
                ${"api" . $class} = new $apiClass($this->metodo, $this->json, $this->parametros, $this->get);
            }else{
                echo "La clase: " . $apiClass . " me da que no existe";
            }
   
            switch ($this->metodo) {
                case "GET":
                    if ($rest_0 == "actividad") {
                        if (is_numeric($rest[1])) {
                            $return = $apiActividad->consultarId($rest[1]);
                        } elseif (!is_null($rest[1]) and $rest[1] == "profesor" and is_numeric($rest[2]) ) {
                            $return = $apiActividad->consultarProfesor($rest[2]);
                        } elseif (!is_null($rest[1]) and preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $rest[1])) {
                            $return = $apiActividad->consultarFecha($rest[1]);
                        } elseif(!is_null($rest[1])) {
                            $return = $apiActividad->consultarTodos();
                        }
                    }
                    
                    if ($rest_0 == "departamento") {
                        if (!is_null($rest[1]) and is_numeric($rest[1]) and ($rest[2]) == "profesor" ) {
                            $return = $apiDepartamento->consultarProfesor($rest[1]);
                        } elseif (is_numeric($rest[1])) {
                            $return = $apiDepartamento->consultarId($rest[1]);
                        } elseif(!is_null($rest[1])) {
                            $return = $apiDepartamento->consultarTodos();
                        }
                    }
                    
                    if ($rest_0 == "profesor") {
                        if (is_numeric($rest[1])) {
                            $return = $apiProfesor->consultarId($rest[1]);
                        } elseif(!is_null($rest[1])) {
                            $return = $apiProfesor->consultarTodos();
                        }
                    }
                    
                    if ($rest_0 == "grupo") {
                        if (is_numeric($rest[1])) {
                            $return = $apiGrupo->consultarId($rest[1]);
                        } elseif(!is_null($rest[1])) {
                            $return = $apiGrupo->consultarTodos();
                        }
                    }
                    break;
                
                case "POST":
                    if ($rest_0 == "actividad") {
                        $return = $apiActividad->insertar($this->json);
                    }
                    if ($rest_0 == "departamento") {
                        $return = $apiDepartamento->insertar($this->json);
                    }
                    if ($rest_0 == "profesor") {
                        $return = $apiProfesor->insertar($this->json);
                    }
                    if ($rest_0 == "grupo") {
                        $return = $apiGrupo->insertar($this->json);
                    }
                    break;
               
                case "PUT":
                    $id = $rest_1;
                    if ($rest_0 == "actividad" and !is_null($id)) {
                        $return = $apiActividad->actualizar($this->json, $id);
                    }
                    if ($rest_0 == "departamento" and !is_null($id)) {
                        $return = $apiDepartamento->actualizar($this->json, $id);
                    }
                    if ($rest_0 == "profesor" and !is_null($id)) {
                        $return = $apiProfesor->actualizar($this->json, $id);
                    }
                    if ($rest_0 == "grupo" and !is_null($id)) {
                        $return = $apiGrupo->actualizar($this->json, $id);
                    }
                    break;
               
                case "DELETE": 
                    $id = $rest_1;
                    if ($rest_0 == "actividad") {
                        $return = $apiActividad->borrar($this->json, $id);
                    }
                    if ($rest_0 == "departamento") {
                        $return = $apiDepartamento->borrar($this->json, $id);
                    }
                    if ($rest_0 == "profesor") {
                        $return = $apiProfesor->borrar($this->json, $id);
                    }
                    if ($rest_0 == "grupo") {
                        $return = $apiGrupo->borrar($this->json, $id);
                    }
                    break;
            }
        $this->response = $return;
        } else {
            $this->response = "nada";
        }
    }
    
    public function getResponse(){
        return $this->response;
    }
}