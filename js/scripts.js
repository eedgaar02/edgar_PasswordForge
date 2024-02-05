var validado = false;

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

    let errores = document.getElementById("errores");

    if(nombre === "" || apellidos === "" || usuario === "" || email === "" || contraseña === "" || contraConf === ""){
        errores.innerHTML = "Te has dejado algun campo sin rellenar"
    }if(contraseña != "^(?=.*[A-Z])(?=.*\d).{8,16}$"){
        errores.innerHTML = "La contraseña debe poseer al menos una mayuscula, un numero minimo y tiene que tener una longitud entre 8 y 16 caracteres"
    }if(contraConf != contraseña){
        errores.innerHTML = "La confirmacion de la contraseña no coincide con la contraseña"
    }
    
}
function generarContraseña(){
    if(validado){

    }if(!validado){

    }

}