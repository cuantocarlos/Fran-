<?php
session_start();
include("../libs/config.php");

//Si no tiene acceso=1, se le lleva de vuelta a la página inicial.
if($_SESSION["acceso"]!=1){
    header("location:paginaInicial.php");
}

cabecera("Pagina privada");
echo "<h1>LISTA DE SERVICIOS</h1><br>";
mostrarServicios();
echo "<a href=\"../php/sanitAltaServicio.php\">Dar de alta un servicio nuevo</>";
pie();

?>