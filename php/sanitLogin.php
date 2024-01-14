<?php
require "../libs/config.php";
session_start();
cabecera("Iniciar sesión");
//array donde almacenaremos el texto de los errores encontrados
$errores = [];
$correo = "";
$contrasenya = "";
if (!isset($_REQUEST['bAceptar'])) {
    include "../templates/formLogin.php";
} else {
    $correo = recoge("correo");
    $contrasenya = recoge("contrasenya");
    cEmail($correo, "correo", $errores);
    cPass($contrasenya, "contrasenya", $errores);
    if (empty($errores) && usuarioExiste_v2($correo, $contrasenya, $errores)) {
        //inicio sesion y redirecciono
        //$_SESSION["user"] -> Lo recogeremos cuando implantemos la BBDD.
        //$_SESSION["img"] -> Lo recogeremos cuando implantemos la BBDD.
        $_SESSION["ip"] = $_SERVER["REMOTE_ADDR"]; // -> Control de IP
        //hay que poner el nivel que haya en la BBDD
        $_SESSION['nivel'] = 1;
        $_SESSION['time'] = time() + 10 * 60;
        $_SESSION["email"] = $correo;
        header("location:../templates/paginaPrivada.php");
    } else {
        escribirLogLogin($correo, $contrasenya);
        include "../templates/formLogin.php";
    }
}
pie();
