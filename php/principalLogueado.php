<!--Esta será la pagina principal del usuario logueado, donde se mostrarán los servicios que puede contratar, una seccion para acceder a modificar su perfil, etc.-->
<?php

session_start();
if (isset($_SESSION['correo'])) {
    include("../libs/config.php");
    cabecera("Ya puedes intercambiar tus servicios!");
    pie();
}else {
    header("location:../php/sanitLogin.php");
}



?>