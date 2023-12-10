<?php
session_start();
include("../libs/config.php");

//Si no tiene acceso=1, se le lleva de vuelta a la página inicial.
if($_SESSION["acceso"]!=1){
    header("location:paginaInicial.php");
}
//Control de cierre por inactividad
if(isset($_SESSION["time"])){
    $vidaSesion = time() - $_SESSION["time"];

    if($vidaSesion > 10){
        header("location:../php/salir.php");
    }else{
        $_SESSION["time"] = time();
    }
}

cabecera("Pagina privada");
echo "<h1>LISTA DE SERVICIOS</h1><br>";
echo "<br><p>Bienvenido, ".$_SESSION["email"]." !<p><br>";
//echo "<img src=\"../assets/imgUsuarios/".$_SESSION["img"]."\">";
mostrarServicios();
echo "<br><a href=\"../php/sanitAltaServicio.php\">Dar de alta un servicio nuevo</>";
echo "<br><a href=\"../php/salir.php\">Salir del sistema</a>";
pie();

?>