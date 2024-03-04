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
        }elseif(!preg_match($patron, $contraseña)){
            return false;
        }elseif($contraseña != $contraConf){
            return false;
        }elseif($sentencia->num_rows > 0){
            return false;
        }else{
            $query = "INSERT INTO usuario (nombre, apellidos, usuario, email, contrasena) VALUES ('$nombre', '$apellidos','$usuario','$email', '$contraseña')";
            $sentencia2 = mysqli_query($connector, $query);
            if ($sentencia2 === TRUE) {
                return true;
            } else {
                echo "Error: " . $query . "<br>" . $connector->error;
                return false;
            }
        }
    }

    
    //Validar Inicio de sesion
    function validarLoginPhp($emailLogIn, $contraseñaLogIn){
        global $connector;
        
        $query = "SELECT id FROM usuario WHERE email='$emailLogIn' AND contrasena='$contraseñaLogIn'";
        $sentencia = mysqli_query($connector, $query);
        
        if($sentencia->num_rows > 0){
            $fila = $sentencia->fetch_assoc();
            $idUsuario = $fila['id'];
            $expiracion = time() + (1 * 24 * 60 * 60);
            setcookie("usuarioID", $idUsuario, $expiracion, "/");
            return true;
        }else{
            return false;
        }
    }
    // Funcion para guardar contraseña
    function guardarContraseña($id, $contraGen){
        global $connector;
        
        $query = "INSERT INTO `contrasenas` (`id`, `usuario_id`, `contrasena`) VALUES (NULL, '$id', '$contraGen')";
        $sentencia = mysqli_query($connector, $query);
        
        // Depuración
        if($sentencia){
            error_log("Contraseña guardada correctamente");
            return true;
        } else {
            error_log("Error al guardar la contraseña: " . mysqli_error($connector));
            return false;
        }
    }
    // Funcion para obtener el nombre de usuario
    function obtenerNombreUsuario(){
        if(isset($_COOKIE['usuarioID'])){
            global $connector;
            $idUsuario = intval($_COOKIE['usuarioID']);
            $query = "SELECT usuario FROM `usuario` WHERE id = '$idUsuario';";
            $sentencia = mysqli_query($connector, $query);
            if($sentencia){
                $fila = $sentencia->fetch_assoc();
                $nomUsuario = $fila['usuario'];
                return $nomUsuario;
            }else{
                return "El usuario no existe";
            }
        }
    }
    // Funcion para obtener el correo del usuario
    function obtenerCorreoUsuario(){
        if(isset($_COOKIE['usuarioID'])){
            global $connector;
            $idUsuario = intval($_COOKIE['usuarioID']);
            $query = "SELECT email FROM `usuario` WHERE id = '$idUsuario';";
            $sentencia = mysqli_query($connector, $query);
            if($sentencia){
                $fila = $sentencia->fetch_assoc();
                $correoUsuario = $fila['email'];
                return $correoUsuario;
            }else{
                return "El usuario no existe";
            }
        }
    }
    // Funcion para obtener la contraseña del usuario
    function obtenerContraUsuario(){
        if(isset($_COOKIE['usuarioID'])){
            global $connector;
            $idUsuario = intval($_COOKIE['usuarioID']);
            $query = "SELECT contrasena FROM `usuario` WHERE id = '$idUsuario';";
            $sentencia = mysqli_query($connector, $query);
            if($sentencia){
                $fila = $sentencia->fetch_assoc();
                $contraUsuario = $fila['contrasena'];
                return $contraUsuario;
            }else{
                return "El usuario no existe";
            }
        }
    }
    // Funcion para obtener las contraseñas guardadas
    function obtenerContrasGuardadas(){
        if(isset($_COOKIE['usuarioID'])){
            global $connector;
            $idUsuario = intval($_COOKIE['usuarioID']);
            $query = "SELECT contrasenas.contrasena FROM contrasenas,usuario WHERE contrasenas.usuario_id = usuario.id && usuario.id = '$idUsuario';";
            $sentencia = mysqli_query($connector, $query);
            if($sentencia){
                $resultado = mysqli_fetch_all($sentencia, MYSQLI_ASSOC);
                $salida = array();
                foreach($resultado as $contra){
                    $salida[] = $contra['contrasena'];
                }
                return $salida;
            }else{
                return "El usuario no existe";
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
            header("Location: ../index.html");
            exit();
        } else {
            echo "Error en el registro";
        }
    }
    // Procesar el formulario de login
    if (isset($_POST['inicioSesion'])) {
        $emailLogIn = $_POST['emailLogIn'];
        $contraseñaLogIn = $_POST['contraseñaLogIn'];
        
        if (validarLoginPhp($emailLogIn, $contraseñaLogIn)) {
            header("Location: ../inicio.html");
            exit();
        } else {
            echo "Error en el login";
        }
    }
    // try catch para obtener el valor de la etiqueta p con la clase password que nos envia la funcion guardarValor() de JavaScript mediante AJAX
    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE['usuarioID'])) {
            $idUsuario = intval($_COOKIE['usuarioID']); // Validar y convertir a entero
            $valor = mysqli_real_escape_string($connector, $_POST["valor"]);
            
            // Depuración
            error_log("ID de usuario: " . $idUsuario);
            error_log("Valor: " . $valor);
            
            if (guardarContraseña($idUsuario, $valor)) {
                echo "Contraseña guardada correctamente.";
            } else {
                http_response_code(500);
                echo "Error al guardar la contraseña.";
            }
        }
    } catch (Exception $e) {
        error_log("Excepción: " . $e->getMessage() . "\n" . $e->getTraceAsString());
        http_response_code(500);
        echo "Error interno en el servidor: " . $e->getMessage();
    }
    ?>