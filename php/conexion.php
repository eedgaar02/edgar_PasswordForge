<?php
    $user = "edib";
    $password = "edib";
    $host = "localhost";
    $bbdd = "usuarios";

    $connector = mysqli_connect($host, $user, $password, $bbdd);

    if (!$connector) {
        die("Error de conexión: " . mysqli_connect_error());
    }