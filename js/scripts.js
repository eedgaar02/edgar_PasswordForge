var validado = false;
var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)usuarioID\s*\=\s*([^;]*).*$)|^.*$/, "$1");
if(parseInt(cookieValue) > 0){
    var validado = true;
}
let generaciones = 5;

function overlayRegister(){
    let registro = document.getElementById("register");
    registro.style.display = "flex";
}
function overlayLogin(){
    let login = document.getElementById("login");
    login.style.display = "flex";
}
function hideRegister() {
    let registro = document.getElementById("register");
    registro.style.display="none";

}
function hideLogin() {
    let login = document.getElementById("login");
    login.style.display="none";

}
function validarRegister(){
    let nombre = document.getElementById("nombre").value;
    let apellidos = document.getElementById("apellidos").value;
    let usuario = document.getElementById("usuario").value;
    let email = document.getElementById("email").value;
    let contraseña = document.getElementById("contraseña").value;
    let contraConf = document.getElementById("contraseñaConf").value;

    let patron = /^(?=.*[A-Z])(?=.*\d).{8,16}$/;

    let errores = document.getElementById("errores");

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
        validado = true;
        return true;
    }    
}
function generarContraseña(){
    let password = document.getElementById("password");

    if(validado === true){
        const caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_-+=<>?";
        let contrasena = "";
      
        for (let i = 0; i < 8; i++) {
          const caracterAleatorio = caracteres.charAt(Math.floor(Math.random() * caracteres.length));
          contrasena += caracterAleatorio;
        }
      
        password.innerHTML = contrasena;

    }

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
        alert("Debes registrarte o iniciar sesion para poder seguir generando.")
    }
}
