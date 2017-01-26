<pre>
     ,-----.,--.                  ,--. ,---.   ,--.,------.  ,------.
    '  .--./|  | ,---. ,--.,--. ,-|  || o   \  |  ||  .-.  \ |  .---'
    |  |    |  || .-. ||  ||  |' .-. |`..'  |  |  ||  |  \  :|  `--, 
    '  '--'\|  |' '-' ''  ''  '\ `-' | .'  /   |  ||  '--'  /|  `---.
     `-----'`--' `---'  `----'  `---'  `--'    `--'`-------' `------'
    ----------------------------------------------------------------- 
</pre>

Hi there! Welcome to Cloud9 IDE!

To get you started, we have created a small hello world application.

1) Open the hello-world.php file

2) Follow the run instructions in the file's comments

3) If you want to look at the Apache logs, check out ~/lib/apache2/log

And that's all there is to it! Just have fun. Go ahead and edit the code, 
or add new files. It's all up to you! 

Happy coding!
The Cloud9 IDE team


## Support & Documentation

Visit http://docs.c9.io for support, or to learn more about using Cloud9 IDE. 
To watch some training videos, visit http://www.youtube.com/user/c9ide
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