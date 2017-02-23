<?php

//require_once('../clases/vendor/autoload.php');

use \Firebase\JWT\JWT;

class GestorUsuario {
    
    private $gestor;
    private $key = "izvkey";
    
    function __construct() {
        $bootstrap = new Bootstrap();
        $this->gestor = $bootstrap->getEntityManager();
    }
    
    /**
     * Consultar la peticion realizada por un usuario
     * Ejemplo https://iosapplication-fernan13.c9users.io/api/usuario/
     */
    public function consultarPeticion($mensaje) {
        
        $decoded = JWT::decode($mensaje, $this->key, array('HS256'));
        
        if ( is_null($decoded->token) ) {
            return $this->consultarUsuario($decoded);
        }
        else {
            
            return $this->consultarToken($decoded);
        }
         
    }
    
    /**
    * Comprobamos que el token enviado por el dispositivo es correcto y asi verificamos
    * su inicio de sesion automático
    */
    private function consultarToken($mensaje) {
        $query      = $this->gestor->getRepository('Usuario');
        $usuario    = $query->findOneBy(array('token' => $mensaje->token ));
        
        $response   = array('response' => is_null($usuario) ? 'error' : 'ok');  
        return JWT::encode($response, $this->key);
    }
    
    /**
    * Comprobamos el usuario y la contraseña enviada por el dispositivo y le devolvemos
    * si es correcto su login el token generado para validar el inicio de sesion
    * 
    * Estructura: [ username : "pepe", password : "alcachofa"]
    */
    
    /**
     * Usuarios con sus respectivas contraseñas FUTUROS OLVIDOS
     * Carmelo-> [ username: "carvegex123", password: "carvegex123"]
     * Pilar->   [ username: "pilferher123", password: "pilferher123"]
     * Modesto-> [ username: "modmarpal123", password: "modmarpal123"]
     */ 
    private function consultarUsuario($usuario) {
        
        //Genera una contraseña distinta cada vez que se ejecuta
        //$password = password_hash($usuario->password, PASSWORD_BCRYPT, array('cost' => 12));
        
        $usuario  = $this->gestor->getRepository('Usuario')
                                  ->findOneBy(array('nombre'   => $usuario->username,
                                                    'password' => md5($usuario->password)));
        $response;
        
        if ( is_null($usuario) ) {
            
            $response = array("response" => 'error'); 
            return JWT::encode($response, $this->key);   
        }
        else {
            
            $token    = JWT::encode($usuario->toArray(), $this->key);
            
            //Ese token generado debemos de almacenarlo en la BBDD
            $usuario->setToken($token);
            $this->gestor->flush();
            
            return $token;
        }
        
    }
    
}

?>