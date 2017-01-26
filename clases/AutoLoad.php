<?php
/*
class AutoLoad {
    static function load($clase) {
        $archivo = '' . $clase . '.php';
        if(file_exists($archivo)){
            require_once $archivo;
        } else {
            $archivo = '../datos/' . $clase . '.php';    
            if ( file_exists($archivo) ) {
                require_once $archivo;
            }
        }
    }
}

spl_autoload_register('AutoLoad::load');
*/
class AutoLoad {
    static function load($clase) {
        $carpetas = array(
            '/',
            '/datos/',
            '/doctrine/',
            '/gestores/',
            '/rest/',
            '/modelo/'
        );
        foreach($carpetas as $carpeta){
            $archivo = __DIR__ . $carpeta . $clase . '.php';
            if(file_exists($archivo)){
                require_once $archivo;
                return;
            }
        }
    }
}

spl_autoload_register('AutoLoad::load');