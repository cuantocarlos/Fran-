<?php
include "libs/bGeneral.php";
include "libs/config.php";
include "libs/bComponentes.php";
include "templates/cabecera.php";
include "templates/pie.php";
$errores = false;
session_start();

cabecera("Iniciar sesión");
//array donde almacenaremos el texto de los errores encontrados
$errores = [];
$correo = "";
$contrasenya = "";
if (!isset($_REQUEST['bAceptar'])) {
    include "templates/formLogin.php";
} else {
    $correo = recoge("correo");
    $contrasenya = recoge("contrasenya");
    cEmail($correo, "correo", $errores);
    cPass($contrasenya, "contraseña", $errores);
    if (empty($errores)) {
        
    }
    
}
pie();
//No se continuaría con la validación del login porque no se como va eso de la base de datos guardar la sesion, etc.