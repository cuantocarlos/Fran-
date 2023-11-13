<?php
include("../libs/config.php");
cabecera("Pagina inicial");

echo "<h1>SERVICIOS</h1>";
mostrarTitulos();
echo "<a href=\"../php/sanitRegistro.php\">Registrarse</><br>";
echo "<a href=\"../php/sanitLogin.php\">Iniciar sesion</><br>";

pie();

function mostrarTitulos(){

    if($file = fopen("../assets/txt/servicios.txt","r")){
        while(!feof($file)){
            $linea = fgets($file);
            if(explode(":",$linea)[0] == "Servicio"){
                echo explode(":",$linea)[1];
                echo "<br>";

            }

        }
    }
}
?>