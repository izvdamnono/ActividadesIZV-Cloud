<pre>
     ,-----.,--.                  ,--. ,---.   ,--.,------.  ,------.
    '  .--./|  | ,---. ,--.,--. ,-|  || o   \  |  ||  .-.  \ |  .---'
    |  |    |  || .-. ||  ||  |' .-. |`..'  |  |  ||  |  \  :|  `--, 
    '  '--'\|  |' '-' ''  ''  '\ `-' | .'  /   |  ||  '--'  /|  `---.
     `-----'`--' `---'  `----'  `---'  `--'    `--'`-------' `------'
    ----------------------------------------------------------------- 
</pre>

<table border="1">
    <tr>
        <th>Consultar</th>
        <th>Insertar</th>
        <th>Actualizar</th>
        <th>Borrar por id</th>
        <th>Borrar conjunto</th>
    </tr>
    <tr>
        <td>https://iosapplication-fernan13.c9users.io/api/actividad/4</td>
        <td>https://iosapplication-fernan13.c9users.io/api/actividad/</td>
        <td>https://iosapplication-fernan13.c9users.io/api/actividad/3</td>
        <td>https://iosapplication-fernan13.c9users.io/api/actividad/3</td>
        <td>https://iosapplication-fernan13.c9users.io/api/actividad/delete</td>
    </tr>
    <tr>
        <th> </th>
        <th>Enviar json</th>
        <th>Enviar json</th>
        <th>Enviar conjunto de id por json</th>
    </tr>
    <tr>
        <td> </td>
        <td>{"idap":3,"descripcion":"Lorem ipsum dolor sit amet, lorem, at.","resumen":"Lorem ipsum dolor sit amet.","idag":2,"fecha":"2017-01-26 00:00:00","hini":"1970-01-01 00:03:01","hfin":"1970-01-01 00:04:02"}</td>
        <td>{"idap":3,"descripcion":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam lobortis libero id ipsum consectetur feugiat. Donec iaculis convallis lorem, at.","resumen":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam lobortis libero id ipsum consectetur feugiat. Donec iaculis convallis lorem, at.","idag":2,"fecha":"2017-01-26 00:00:00","hini":"1970-01-01 00:03:01","hfin":"1970-01-01 00:04:02"}</td>
        <td>{"id":3}</td>
        <td>[{"id":3},{"id":4},{"id":6}]</td>
    </tr>
    
    <tr>
        <th>Recibe json</th>
        <th>Recibe confirmación</th>
        <th>Recibe confirmación</th>
        <th>Recibe confirmación</th>
    </tr>
    <tr>
        <td>[{"id":4,"idap":{"id":1,"nombreProfesor":"Carmelo","idpd":{"id":1,"nombreDepartamento":"Informatica"}},"idag":{"id":1,"nombreGrupo":"DAM"},"titulo":"Titulo id Modificado jsjsjsjs","descripcion":"Descripcion actividad\t\t","resumen":"Resumen id 4 Modificadoo !!!!!!","fecha":"2017-02-28","hini":"00:00:00","hfin":"12:07:56","imagen":"701868d2ebaf9dce1382996e2739a113.png"}]</td>
        <td>{"response": "ok"} o {"response": "error"}</td>
        <td>{"response": "ok"} o {"response": "error"}</td>
        <td>{"response": "ok"} o {"response": "error"}</td>
        <td>{"response": "ok"} o {"response": "error"}</td>
    </tr>
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
        
 
</pre>