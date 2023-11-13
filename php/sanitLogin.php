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
    if (empty($errores)) {
        if (usuarioExiste()) {
                 //inicio sesion y redirecciono
  
                 header("location:../templates/validLogin.php?correo=$correo&contrasenya=$contrasenya");
     
        } else {
            $errores['usuario'] = "El usuario no existe";

        }

    }

}
pie();
//No se continuaría con la validación del login porque no se como va eso de la base de datos guardar la sesion, etc.
function usuarioExiste()
{
    //busco el usuario en el fichero
    $file = fopen("../assets/txt/usuarios.txt");
    while (!feof($file)) { //mientras no sea el final del archivo
        $linea = fgets($file);
        if (strstr($linea,"ID:")) { //si la linea contiene el ID
            $id = substr($linea, 4); //guardo el id
            if (strstr($linea, $correo)) { //si la linea contiene el correo
                $linea = fgets($file); //leo la siguiente linea
                if (strstr($linea, $contrasenya)) { //si la linea contiene la contraseña
                   //inicio sesion
                     session_start();
                        $_SESSION['correo'] = $correo;
                        $_SESSION['contrasenya'] = $contrasenya;
                        $_SESSION['id'] = $id;
                        return true;
                }
            }
        }

    }
    return false;
}
