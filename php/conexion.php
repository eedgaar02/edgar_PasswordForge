<?php
    $user = "edib";//usuario base de datos
    $password = "edib";//contraseña
    $host = "localhost";//host
    $bbdd = "usuarios";//base de datos

    //connector con la base de datos
    $connector = mysqli_connect($host, $user, $password, $bbdd);

    //condicional verificacion de conexion
    if (!$connector) {
        die("Error de conexión: " . mysqli_connect_error());
    }