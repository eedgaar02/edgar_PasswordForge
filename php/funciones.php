<?php
    include("conexion.php");

    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellido"];
    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $contraseña = $_POST["contraseña"];
    $contraConf = $_POST["contraseñaConf"];

    $emailLogIn = $_POST["emailLogIn"];
    $contraseñaLogIn = $_POST["contraseñaLogIn"];

    function validarRegisterPhp(){
        if(empty($nombre) || empty($apellidos) || empty($usuario) || empty($email) || empty($contraseña) || empty($contraConf)){
            
        }
    }