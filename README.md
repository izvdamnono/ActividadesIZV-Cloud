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
        <pre>        [
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
        </pre></td>
        <td>
        <pre>        
        Codigos de respuesta HTTP: 200 ok
        {
            "response": "ok"
        }
        
        Para elementos no encontrados
        Codigos de respuesta HTTP: 404 Not found
        {
            "response": "error"    
        }
        </pre></td>
        <td>
          <pre>          
          Codigos de respuesta HTTP: 201 Created        
          {
               "response": "ok"
          }
          No se ha podido actualizar
          Codigos de respuesta HTTP: 304 Not Modified
          {
               "response": "error"    
          }
          </pre>
        </td>
        <td colspan="2">
          <pre>          
          Codigos de respuesta HTTP: 200 Bad Request        
          {
               "response": "ok"
          }
          Codigos de respuesta HTTP: 400 Bad Request
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
