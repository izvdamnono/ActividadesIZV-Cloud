<?php

    $metodo = $_SERVER['REQUEST_METHOD'];
    $json   = file_get_contents('php://input');
    
    echo "Método de Conexion: $metodo";
    echo "Json Swift: ". $json;
?>