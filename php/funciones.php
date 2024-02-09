<?php
    include("conexion.php");

    //Validar Registro
    function validarRegisterPhp($nombre, $apellidos, $usuario, $email, $contraseña, $contraConf){
        global $connector;

        $query = "SELECT * FROM usuario WHERE email='$email'";
        $sentencia = mysqli_query($connector, $query);

        $patron = "/^(?=.*[A-Z])(?=.*\d).{8,16}$/";

        if(empty($nombre) || empty($apellidos) || empty($usuario) || empty($email) || empty($contraseña) || empty($contraConf)){
            return false;
        }elseif(preg_match($patron, $contraseña)){
            return false;
        }elseif($contraseña != $contraConf){
            return false;
        }elseif($sentencia->num_rows > 0){
            return false;
        }else{
            $query = "INSERT INTO usuario (nombre, apellidos, usuario, email, contraseña) VALUES ('$nombre', '$apellidos','$usuario','$email', '$contraseña')";
            $sentencia2 = mysqli_query($connector, $query);
            if ($sentencia2 === TRUE) {
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
            header("Location: ../inicio.html");
            exit();
        } else {
            echo "Error en el registro";
        }
    }

    //Validar Inicio de sesion
    function validarLoginPhp($emailLogIn, $contraseñaLogIn){
        global $connector;

        $query = "SELECT * FROM usuarios WHERE email='$emailLogIn' AND contraseña='$contraseñaLogIn'";
        $sentencia = mysqli_query($connector, $query);

        if($sentencia->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }
    // Procesar el formulario de login
    if (isset($_POST['inicioSesion'])) {
        $emailLogIn = $_POST['emailLogIn'];
        $contraseñaLogIn = $_POST['contraseñaLogIn'];

        if (validarLoginPhp($emailLogIn, $contraseñaLogIn)) {
            header("Location: inicio.html");
            exit();
        } else {
            echo "Error en el login";
        }
    }


