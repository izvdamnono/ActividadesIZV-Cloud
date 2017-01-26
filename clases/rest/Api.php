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
                ${"api".$class} = new $apiClass($this->metodo, $this->json, $this->parametros, $this->get);
            }else{
                echo "La clase: ".$apiClass. " me da que no existe";
            }
   
            switch ($this->metodo) {
                case "GET":
                    if ($rest_0 == "actividad") {
                        if (is_numeric($rest[1])) {
                            $actividades = $apiActividad->consultarId($rest[1]);
                        } elseif (!is_null($rest[1]) and $rest[1] == "profesor" and is_numeric($rest[2]) ) {
                            $actividades = $apiActividad->consultarProfesor($rest[2]);
                        } elseif (!is_null($rest[1]) and preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $rest[1])) {
                            $actividades = $apiActividad->consultarFecha($rest[1]);
                        } elseif(!is_null($rest[1])) {
                            $actividades = $apiActividad->consultarTodos();
                        }
                        $this->response = $actividades;
                    }
                    
                    if ($rest_0 == "departamento") {
                        if (!is_null($rest[1]) and is_numeric($rest[1])and ($rest[2]) == "profesor" ) {
                            $departamento = $apiDepartamento->consultarProfesor($rest[1]);
                        } elseif (is_numeric($rest[1])) {
                            $departamento = $apiDepartamento->consultarId($rest[1]);
                        } elseif(!is_null($rest[1])) {
                            $departamento = $apiDepartamento->consultarTodos();
                        }
                        $this->response = $departamento;
                    }
                    break;
                
                case "POST":
                    if ($rest_0 == "actividad") {
                        $actividad = $apiActividad->insertar($this->json);
                        $this->response = $actividad;
                    }
                    
                    if ($rest_0 == "departamento") {
                        $departamento = $apiDepartamento->insertar($this->json);
                        $this->response = $departamento;
                    }
                    break;
               
                case "PUT":
                    if ($rest_0 == "actividad") {
                        $actividad = $apiActividad->actualizar($this->json);
                        $this->response = $actividad;
                    }
                    if ($rest_0 == "departamento") {
                        $departamento = $apiDepartamento->actualizar($this->json);
                        $this->response = $departamento;
                    }
                    break;
               
                case "DELETE": 
                    if ($rest_0 == "actividad") {
                        $actividad = $apiActividad->borrar($this->json);
                        $this->response = $actividad;
                    }
                    if ($rest_0 == "departamento") {
                        $departamento = $apiDepartamento->borrar($this->json);
                        $this->response = $departamento;
                    }
                    break;
            }
        } else {
            $this->response = "nada";
        }
    }
    
    public function getResponse(){
        return $this->response;
    }
}