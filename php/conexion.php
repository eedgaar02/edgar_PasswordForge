<?php
    $user = "edib";
    $password = "edib";
    $host = "localhost";
    $bbdd = "usuarios";

    $connector = mysqli_connect($hot, $user, $password, $bbdd);

    if ($connector->connect_error) {
        die("Error de conexión: " . $connector->connect_error);
    }