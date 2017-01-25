<?php
//Entrada de peticiones 
/*
->GET:      consultar(R)
->POST:	    crear(C)
->PUT:	    modificar(U)
->DELETE:   eliminar(D) 3.0 Api (Direcciones amigables)
*/
echo "Método: " . $_SERVER['REQUEST_METHOD'];
echo "<br>";
echo "JSON: ". file_get_contents("php://input");

$scheme = $_SERVER['REQUEST_SCHEME'];
$domain = $_SERVER['SERVER_NAME'];
$path   = $_SERVER['REQUEST_URI'];

$url = $scheme.'://'.$domain.$path;

echo "URL: $url</br>";
echo "Domain: $domain</br>";
echo "Path: $path</br>";
/*
las BD ya están creadas tio!
ok, ya la he visto, voy a crear la api 
ok, con que me pongo yo?
creo que nada, hemos hecho bastante, la semana que viene haremos la app ¿no?
ok tio, de mientras busco la forma de conectarnos desde swift al server :)
y las relaciones entre las tablas tambien estan declaradas las he probado y funcionan
teniendo en cuenta profesores y grupos!
ok perfecto 

--> he añadido getArray en la clase Actividad, Profesor y Grupo
Ok tio ¿Es para cuando se tengan que listar todos sus componentes?
Si, simplemente te devuelve todos los datos de una tupla.
De lujo :)!
        $disk = new Disk();
        
        $query = $gestor->createQuery('SELECT r FROM disk r');
        $disks = $query->getResult();
        $data_to_json=array();
        foreach($disks as $item){
            $data_to_json[] = $item->getArray();//Todos los datos 
        }
        header('Content-Type: application/json');
        echo json_encode($data_to_json);
        
Con eso debe devolver todos los datos de x consulta, es de la practica de la clase
*/
$servidor = $_SERVER['HTTP_HOST'];
$ruta = $_SERVER['REQUEST_URI'];
echo 'servidor: ' . $servidor . '<br>';
echo 'ruta: ' . $ruta . '<br>';
echo 'trozo pasado por la regla .htaccess: ' . $_GET['url'] . '<br>';
$parametros = explode('/', $_GET['url']);
foreach($parametros as $indice => $parametro) {
    echo '&nbsp;&nbsp;parametro: ' . $indice . ' => ' . $parametro . '<br>';
}
$metodo = $_SERVER['REQUEST_METHOD'];
echo 'metodo: ' . $metodo . '<br>';
$json = file_get_contents('php://input');
echo 'parámetros json: ' . $json . '<br>';
$objeto = json_decode($json);
var_dump($objeto);

/*

REST 1.0

json -> json_encode
        json_decode

2.0 Métodos HTTP (CRUD)
    ->GET:      consultar(R)
    ->POST:	    crear(C)
    ->PUT:	    modificar(U)
    ->DELETE:   eliminar(D) 
3.0 Api (Direcciones amigables)
    -> Normal:  https://www.izv.org/ver.php?alumno=2334
            GET:    http://www.izv.org/alumno/2334 -> informacion del alumno 2334
            POST:	http://www.izv.org/alumno + {json} -> Crear alumno
            PUT:	http://www.izv.org/alumno/2334 + {json} -> Modificar alumno
            DELETE: http://www.izv.org/alumno/2334 -> borrar http://www.izv.org/alumno + {json}
    -> borrar where -> 1 sola página web que recibe todas las peticiones
            apache+php -> .htaccess -> reglas de reescritura {
                si pido una página que no existe te mando a una página concreta
            }

    1º Averiguar el método utilizado ( PUT, POST, DELETE, GET ) $_SERVER['REQUEST_METHOD']
    2º Descomponer la URL: alumno/2334 -> array( alumno, 2334 )
    3º Obtener los parámetros json: php://input
    4º Operar: Cuando se tengan los datos se trabajan con ellos
    5º Respuesta json

    //BD Proyecto
    Nombre BD: wp
    Usuario: uwp
    Clave: cwp
    
    
    Doctrine -> Aplicación para melomanos
    disco 
        -> id 
        -> titulo
          
    Cancion 
        -> id
        -> titulo
    
    Artista
        -> id 
        -> nombre
    
    Disco_cancion
        -> id
        -> id_disco   }
        -> id_cancion } unique 
        -> id_artista }
        
 */