<?php
    include("conexion.php");

    
    $emailLogIn = $_POST["emailLogIn"];
    $contraseñaLogIn = $_POST["contraseñaLogIn"];
    
    //Validar Registro
    function validarRegisterPhp($nombre, $apellidos, $usuario, $email, $contraseña, $contraConf){
        global $connector;

        $query = "SELECT * FROM usuarios WHERE email='$email'";
        $sentencia = mysqli_query($connector, $query);

        if(empty($nombre) || empty($apellidos) || empty($usuario) || empty($email) || empty($contraseña) || empty($contraConf)){
            return false;
        }elseif($contraseña != "^(?=.*[A-Z])(?=.*\d).{8,16}$"){
            return false;
        }elseif($contraseña != $contraConf){
            return false;
        }elseif($sentencia->num_rows > 0){
            return false;
        }else{
            $query = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$apellidos','$usuario','$email', '$contraseña')";
            if ($connector->query($query) === TRUE) {
                return true;
            } else {
                echo "Error: " . $query . "<br>" . $connector->error;
                return false;
            }
        }
    }

    //Procesar registro
    if (isset($_POST['registro'])) {
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellido"];
        $usuario = $_POST["usuario"];
        $email = $_POST["email"];
        $contraseña = $_POST["contraseña"];
        $contraConf = $_POST["contraseñaConf"];
    
        if (validarRegisterPhp($nombre, $apellidos, $usuario, $email, $contraseña, $contraConf)) {
            header("Location: inicio.html");
            exit();
        } else {
            echo "Error en el registro";
        }
    }

    //Validar Inicio de sesion


