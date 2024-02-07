<?php
    $user = "edib";
    $password = "edib";
    $host = "localhost";
    $bbdd = "usuarios";

    $connector = mysqli_connect($user, $password, $host, $bbdd);

    if($connector){
        
    }else{
        echo("Error de conexion a la base de datos");
    }