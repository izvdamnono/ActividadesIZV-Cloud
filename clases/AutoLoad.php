<?php

class AutoLoad {
    static function load($clase) {
        $archivo = '' . $clase . '.php';
        if(file_exists($archivo)){
            require_once $archivo;
        } else {
            $archivo = '../doctrine/' . $clase . '.php';    
            if ( file_exists($archivo) ) {
                require_once $archivo;
            }
        }
    }
}

spl_autoload_register('AutoLoad::load');