<?php
require "../libs/config.php";

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
    if (empty($errores) && usuarioExiste_v2($correo,$contrasenya,$errores)) {
        //inicio sesion y redirecciono
        header("location:../templates/paginaPrivada.php");
} else {
    //$errores['usuario'] = "El usuario no existe";
    escribirLogLogin($correo, $contrasenya);
    include("../templates/formLogin.php");
}
}
pie();
//No se continuaría con la validación del login porque no se como va eso de la base de datos guardar la sesion, etc.
function usuarioExiste(string $correo, string $contrasenya)
{
    //busco el usuario en el fichero
    $file = fopen("../assets/txt/usuarios.txt", "r");
    while (!feof($file)) { //mientras no sea el final del archivo
        $linea = fgets($file);
        if (strstr($linea, "ID:")) { //si la linea contiene el ID
            $id = substr($linea, 4); //guardo el id
            if (strstr($linea, $correo)) { //si la linea contiene el correo
                $linea = fgets($file); //leo la siguiente linea
                if (strstr($linea, $contrasenya)) { //si la linea contiene la contraseña
                    //inicio sesion
                    session_start();
                    $_SESSION['correo'] = $correo;
                    $_SESSION['contrasenya'] = $contrasenya;
                    $_SESSION['id'] = $id;
                    fclose($file);
                    return true;
                }
            }
        }

    }
    return false;
}



?>