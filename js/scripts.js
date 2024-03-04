//variable para controlar si el usuario ha iniciado sesion o no.
var validado = false;
//variable que almacena valor de una cookie
var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)usuarioID\s*\=\s*([^;]*).*$)|^.*$/, "$1");
//condicional para comprobar si la cookie fue creada
if(parseInt(cookieValue) > 0){
    var validado = true;
}
let generaciones = 5;
//funcion pop up del register
function overlayRegister(){
    let registro = document.getElementById("register");
    registro.style.display = "flex";
}
//funcion pop up log in
function overlayLogin(){
    let login = document.getElementById("login");
    login.style.display = "flex";
}
//funcion esconder el register
function hideRegister() {
    let registro = document.getElementById("register");
    registro.style.display="none";

}
//funcion para esconder log in
function hideLogin() {
    let login = document.getElementById("login");
    login.style.display="none";

}
//funcion validar registro
function validarRegister(){
    //obtencion de valores de los camos
    let nombre = document.getElementById("nombre").value;
    let apellidos = document.getElementById("apellidos").value;
    let usuario = document.getElementById("usuario").value;
    let email = document.getElementById("email").value;
    let contraseña = document.getElementById("contraseña").value;
    let contraConf = document.getElementById("contraseñaConf").value;

    //expresion regular
    let patron = /^(?=.*[A-Z])(?=.*\d).{8,16}$/;

    //etiqueta de errores
    let errores = document.getElementById("errores");

    //condiciones
    if(nombre === "" || apellidos === "" || usuario === "" || email === "" || contraseña === "" || contraConf === ""){
        errores.innerHTML = "Te has dejado algun campo sin rellenar";
        return false;
    }else if(!patron.test(contraseña)){
        errores.innerHTML = "La contraseña debe poseer al menos una mayuscula, un numero minimo y tiene que tener una longitud entre 8 y 16 caracteres";
        return false;
    }else if(contraConf != contraseña){
        errores.innerHTML = "La confirmacion de la contraseña no coincide con la contraseña";
        return false;
    }else{
        return true;
    }    
}
//funcion generar contraseña
function generarContraseña(){
    //etiqueta donde esta la contraseña
    let password = document.getElementById("password");

    //el usuario ha iniciado sesion
    if(validado === true){
        //todos los caracteres
        const caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_-+=<>?";
        let contrasena = "";
      
        for (let i = 0; i < 8; i++) {
          //random de los caracteres
          const caracterAleatorio = caracteres.charAt(Math.floor(Math.random() * caracteres.length));
          //añadir caracter random a la contraseña
          contrasena += caracterAleatorio;
        }
      
        password.innerHTML = contrasena;

    }

    //el usuario no ha iniciado sesion
    if(validado === false && generaciones > 0){
        const caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_-+=<>?";
        let contrasena = "";
      
        for (let i = 0; i < 8; i++) {
          const caracterAleatorio = caracteres.charAt(Math.floor(Math.random() * caracteres.length));
          contrasena += caracterAleatorio;
        }
      
        password.innerHTML = contrasena;
        generaciones --;

    }if(validado === false && generaciones === 0){
        //aviso de que no quedan generaciones
        alert("Debes registrarte o iniciar sesion para poder seguir generando.")
    }
}
//funcion con AJAX para mandar a php la contraseña
function guardarValor() {
    console.log("guardarValor está siendo llamada.");
    // Obtener el valor de la etiqueta p
    var valor = document.getElementById("password").innerText;

    // Enviar el valor al servidor mediante una solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/funciones.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            console.log("Respuesta del servidor (status: " + xhr.status + "):", xhr.responseText);
            if (xhr.status == 200) {
                // Manejar la respuesta del servidor si es necesario
                console.log(xhr.responseText);
            }
        }
    };
    xhr.send("valor=" + encodeURIComponent(valor));
}