<?php
session_start();
include "../libs/config.php";

//Si no tiene nivel=1, se le lleva de vuelta a la página inicial.

cabecera("Pagina privada");
controlAcceso();
?>
    <br><img src="../assets/imgUsuarios/<?=$_SESSION["img"]?>" alt="foto_perfil"><br>
    <h1>Servicios que puedes contratar</h1>
<?php
//echo "<br>";
//echo "<img src=\"../assets/imgUsuarios/".$_SESSION["img"]."\">";
//echo "<h1>Servicios que puedes contratar </h1><br>";
mostrarServicios();
echo "<br><a href=\"../php/sanitAltaServicio.php\">Dar de alta un servicio nuevo</>";
echo "<br><a href=\"../php/salir.php\">Salir del sistema</a>";
pie();


//Registro (activo = 0), guardo en bd, envio correo con token (por get), validar token del get con token de BD, activar cuenta (activo = 1), redirigir a login 

?>
