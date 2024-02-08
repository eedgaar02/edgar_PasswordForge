<?php
    $user = "edib";
    $password = "edib";
    $host = "localhost";
    $bbdd = "usuarios";

    $connector = mysqli_connect($user, $password, $host, $bbdd);

    if(!$connector){
        echo("Error al conectar a la base de datos.");
    }