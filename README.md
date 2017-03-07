<pre>
     ,-----.,--.                  ,--. ,---.   ,--.,------.  ,------.
    '  .--./|  | ,---. ,--.,--. ,-|  || o   \  |  ||  .-.  \ |  .---'
    |  |    |  || .-. ||  ||  |' .-. |`..'  |  |  ||  |  \  :|  `--, 
    '  '--'\|  |' '-' ''  ''  '\ `-' | .'  /   |  ||  '--'  /|  `---.
     `-----'`--' `---'  `----'  `---'  `--'    `--'`-------' `------'
    ----------------------------------------------------------------- 
</pre>

<table border="1">
    <tbody><tr>
        <th>Consultar todos</th>
        <th>Consultar por Id</th>
        <th>Insertar</th>
        <th>Actualizar</th>
        <th>Borrar por id</th>
        <th>Borrar conjunto</th>
    </tr>
    <tr>
        <td colspan="2">Methods GET</td>
        <td>Methods POST</td>
        <td>Methods PUT</td>
        <td colspan="2">Methods DELETE</td>
    </tr>
    <tr>
        <td><a href="https://iosapplication-fernan13.c9users.io/api/actividad/">https://iosapplication-fernan13.c9users.io/api/actividad/</a></td>
        <td><a href="https://iosapplication-fernan13.c9users.io/api/actividad/4">https://iosapplication-fernan13.c9users.io/api/actividad/4</a></td>
        <td><a href="https://iosapplication-fernan13.c9users.io/api/actividad/">https://iosapplication-fernan13.c9users.io/api/actividad/</a></td>
        <td><a href="https://iosapplication-fernan13.c9users.io/api/actividad/3">https://iosapplication-fernan13.c9users.io/api/actividad/3</a></td>
        <td><a href="https://iosapplication-fernan13.c9users.io/api/actividad/3">https://iosapplication-fernan13.c9users.io/api/actividad/3</a></td>
        <td><a href="https://iosapplication-fernan13.c9users.io/api/actividad/">https://iosapplication-fernan13.c9users.io/api/actividad/</a></td>
    </tr>
    <tr>
        <th colspan="5">Enviar json</th>
        <th>Enviar conjunto de id por json</th>
    </tr>
    <tr>
        <td colspan="2"> </td>
        <td>
            <pre>               
{
    "idap":3,
    "idag":2,
    "descripcion":"Lorem ipsum dolor sit amet, lorem, at.",
    "resumen":"Lorem ipsum dolor sit amet.",
    "fecha":"2017-01-26 00:00:00",
    "hini":"1970-01-01 00:03:01",
    "hfin":"1970-01-01 00:04:02"
}
            </pre>
        </td>
        <td>
            <pre>               
{
    "idap":3,
    "idag":2,
    "descripcion":"Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
    "resumen":"Lorem ipsum dolor sit amet.",
    "fecha":"2017-01-26 00:00:00",
    "hini":"1970-01-01 00:03:01",
    "hfin":"1970-01-01 00:04:02"
}
          </pre>
        </td>
        <td>
            <pre>               
{
    "id":3
}
            </pre>
        </td>
        <td>
            <pre>          
[
     {
          "id":3
     },
     {
          "id":4
     },
     {
          "id":6
     }
]
            </pre>
        </td>
    </tr>
    <tr>
        <th colspan="2">Recibe json</th>
        <th colspan="4">Recibe confirmación</th>
    </tr>
    <tr>
        <td colspan="2">
            <pre>        
[
     {
     "id":4,
     "idap":{
          "id":1,
          "nombreProfesor":"Carmelo",
          "idpd":{
               "id":1,
               "nombreDepartamento":"Informatica"
          }
     },
     "idag":{
          "id":1,
          "nombreGrupo":"DAM"
     },
     "titulo":"Titulo id Modificado",
     "descripcion":"Descripcion actividad\t\t",
     "resumen":"Resumen id 4 Modificadoo !!!!!!",
     "fecha":"2017-02-28",
     "hini":"00:00:00",
     "hfin":"12:07:56",
     "imagen":"701868d2ebaf9dce1382996e2739a113.png"
     }
]
          </pre>
        </td>
        <td>
            <p>Codigos de respuesta HTTP: 200 ok</p> 
            <pre>        
{
  "response": "ok"
}
            </pre>
            <p>Para elementos no encontrados</p>
            <p>Codigos de respuesta HTTP: 404 Not found</p>
            <pre>
{
  "response": "error"    
}
            </pre>
        </td>
        <td>      
            <p>Codigos de respuesta HTTP: 201 Created</p> 
            <pre>
{
     "response": "ok"
}
            </pre>
            <p>No se ha podido actualizar</p>
            <p>Codigos de respuesta HTTP: 304 Not Modified</p>
            <pre>
{
   "response": "error"    
}
            </pre>
        </td>
        <td colspan="2">        
            <p>Codigos de respuesta HTTP: 200 Bad Request</p>
            <pre>
{
     "response": "ok"
}
            </pre>
            <p>Codigos de respuesta HTTP: 400 Bad Request</p>
            <pre>
{
   "response": "error"    
}
            </pre>
        </td>
    </tr>
</tbody>
</table>






## Consultas a actividades
<p>https://iosapplication-fernan13.c9users.io/api/actividad/4</p>
<img src="/assets/Actividades.png" alt="">

<pre>

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
        
 
</pre>

##Rutas
En la carpeta raiz se encuentra la carpeta "clases" con el autoload y bootstrap de doctrine,
las clases pojo orm que generan la base de datos y las funciones para el control de la api,
en la carpeta "rest" se encuentra los gestores de la clases pojo y de la Api.
Cada gestor se encarga de su tabla ORM. 

En la carpeta de "graficos" se encuentra la libreria de chart.js y el generador de graficos segun 
la base datos.
-rw-r--r-- 1 ubuntu ubuntu    6159 Feb  2 13:25 README.md
drwxr-xr-x 2 ubuntu ubuntu    4096 Jan 30 09:31 api/
drwxr-xr-x 3 ubuntu ubuntu    4096 Feb 11 09:50 assets/
drwxr-xr-x 5 ubuntu ubuntu    4096 Feb 21 17:23 clases/
-rw-r--r-- 1 ubuntu ubuntu     226 Jan 27 08:52 gitsh.sh
drwxr-xr-x 3 ubuntu ubuntu    4096 Feb 11 13:29 graficos/
-rw-rw-r-- 1 ubuntu ubuntu     261 Nov  1 05:45 hello-world.php
-rw-r--r-- 1 ubuntu ubuntu     213 Feb 21 12:31 index.html
drwxr-xr-x 2 ubuntu ubuntu    4096 Feb 21 08:21 ios/
-rw-rw-r-- 1 ubuntu ubuntu   69095 Feb 12 23:06 php.ini
drwxr-xr-x 3 ubuntu ubuntu    4096 Feb  7 17:45 trabajo/
drwxr-xr-x 5 ubuntu ubuntu    4096 Mar  7 01:16 wordpress/
