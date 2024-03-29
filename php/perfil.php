<?php
      include 'funciones.php';
      $nombreUsuario = obtenerNombreUsuario();//obtener nombre de usuario
      $emailUsuario = obtenerCorreoUsuario();//obtener correo del usuario
      $contrasenaUsuario = obtenerContraUsuario();//obtener la contraseña del usuario
      $contasenasGuardadas = obtenerContrasGuardadas();//contraseñas guardadas
    ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- SEO = Básico -->
    <!-- Cada página del sitio tiene que ser diferente el título y la descripción -->
    <title></title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Etiquetas Open Graph y Twitter Card, para crear el SEO de Redes Sociales -->
    <meta property="og:title" content="Título de tu página" />
    <meta property="og:description" content="Descripción de tu página" />
    <meta
      property="og:image"
      content="URL de la imagen que quieres mostrar en las redes sociales"
    />
    <meta property="og:url" content="URL de tu página" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Título de tu página" />
    <meta name="twitter:description" content="Descripción de tu página" />
    <meta
      name="twitter:image"
      content="URL de la imagen que quieres mostrar en Twitter"
    />

    <!-- App Web, inidicar al navegador que elementos mostrar en un JSON -->
    <link rel="manifest" href="site.webmanifest" />
    <!-- icono de acceso para IOS -->
    <link rel="apple-touch-icon" href="icon.png" />
    <!-- Recordar que favicon.ico tiene que estar en el directorio inicial -->

    <!-- links de estilos -->
    <link rel="stylesheet" href="../css/style.css" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    
    <!-- Se cambia el tema de algunos navegadores -->
    <meta name="theme-color" content="#fafafa" />
    <!-- Código de las plataformas de Análisis -->
    <script src="js/scripts.js"></script>
    <!-- Scripts a cargar antes de la renderización -->
    <script src="preloader.js"></script>
  </head>
  <body>
    <div id="container">
      <!-- *** ESTRUCTURA SEMÁNTICA *** -->
      <!-- Header (encabezado de la página, zona superior) -->
      <header class="cabecera">
        <a href="../inicio.html"><img class="logo" src="../img/desktop/Logo.webp" alt="Logo"></a>
        <h1 class="password_forge">Password Forge</h1>
        <nav class="botones">
        </nav>
      </header>
      <!-- Main (centro de la página, zona central) -->
      <main class="cuerpo">
        <section class="perfil">
            <section>
                <p>Nombre:</p>
                <p class="nombreUsuario"><?php echo $nombreUsuario ?></p>
            </section>
            <section>
                <p>Correo:</p>
                <p class="correoUsuario"><?php echo $emailUsuario ?></p>
            </section>
            <section>
                <p>Contraseña:</p>
                <p class="contrasenaUsuario"><?php echo $contrasenaUsuario ?></p>
            </section>
            <section class="contrasenasGuardadas">
                <p>Contraseñas Guardadas:</p>
                <ul>
                  <?php
                    foreach($contasenasGuardadas as $contrasena){
                        echo "<li>$contrasena</li>";
                    }
                  ?>
                </ul>
            </section>
        </section>
        
      </main>
      <!--Final de la seccion de que es Password Forge-->


      <!-- Footer (final de la página, zona inferior) -->
      <footer class="pie">
        <section class="imagen">
          <img class="logo_footer" src="../img/desktop/Logo.webp" alt="">
        </section>
        <section class="iconos">
          <a href=""><img src="../img/desktop/instagram.png" alt="Instagram"></a>
          <a href=""><img src="../img/desktop/x.png" alt="X"></a>
          <a href=""><img src="../img/desktop/pinterest.png" alt="Pinterest"></a>
          <a href=""><img src="../img/desktop/github.png" alt="GitHub"></a>
        </section>
        <section class="redes_sociales">
          <a href=""><p>Instagram</p></a>
          <a href=""><p>X</p></a>
          <a href=""><p>Pinterest</p></a>
          <a href=""><p>GitHub</p></a>
        </section>
      </footer>
    </div>

  </body>
</html>
