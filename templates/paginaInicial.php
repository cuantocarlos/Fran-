<?php
include("../libs/config.php");
cabecera("Pagina inicial");

echo "<h1>SERVICIOS</h1>";
mostrarTitulos();
echo "<a href=\"../php/sanitRegistro.php\">Registrarse</><br>";
echo "<a href=\"../php/sanitLogin.php\">Iniciar sesion</><br>";

pie();


?>