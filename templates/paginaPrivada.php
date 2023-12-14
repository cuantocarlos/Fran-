<?php
session_start();
include "../libs/config.php";

//Si no tiene acceso=1, se le lleva de vuelta a la página inicial.

cabecera("Pagina privada");
controlAcceso();
echo "<br><p>Bienvenido, " . $_SESSION["email"] . " !<p><br>";
//echo "<img src=\"../assets/imgUsuarios/".$_SESSION["img"]."\">";
echo "<h1>Servicios que puedes contratar </h1><br>";
mostrarServicios();
echo "<br><a href=\"../php/sanitAltaServicio.php\">Dar de alta un servicio nuevo</>";
echo "<br><a href=\"../php/salir.php\">Salir del sistema</a>";
pie();
