<?php
include("../libs/config.php");
cabecera("Pagina privada");

echo "<h1>LISTA DE SERVICIOS</h1><br>";
mostrarServicios();
echo "<a href=\"../php/sanitAltaServicio.php\">Dar de alta un servicio nuevo</>";
pie();

?>