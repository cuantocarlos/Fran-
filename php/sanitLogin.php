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
        if ($file2 = fopen("../assets/txt/logLogin.txt", "a")) {

            fwrite($file2, "Correo: $correo" . PHP_EOL);
            fwrite($file2, "Contraseña: $contrasenya" . PHP_EOL);
            fwrite($file2, "Fecha: " . date('Y-m-d H.i.s') . PHP_EOL);
            fwrite($file2, "-----" . PHP_EOL);
        }
        fclose($file2);
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

function usuarioExiste_v2(string $correo, string $contrasenya, array &$errores)
{
    if ($file = fopen("../assets/txt/usuarios.txt", "r")) {
        fgets($file);
        while (!feof($file)) {
            $linea = fgets($file);
            $correoTemp = trim(explode(":", $linea)[1]);
            if ($correoTemp == $correo) {
                $linea = fgets($file);
                $contrTemp = trim(explode(":", $linea)[1]);
                if ($contrTemp == $contrasenya) {
                    return true;
                } else {
                    $errores["contrasenya"] = "Contrasenya incorrecta";
                    return false;
                }
            } else {
                fgets($file);
                fgets($file);
                fgets($file);
                fgets($file);
            }

        }
        $errores["correo"] = "Correo incorrecto";
        fclose($file);
        return false;
    }
}

?>