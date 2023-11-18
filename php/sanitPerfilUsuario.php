<?php
include "../libs/config.php";
session_start();
cabecera("Perfil de usuario");
//array donde almacenaremos el texto de los errores encontrados
$errores = [];
$new_pass = "";
$img_perfil = "";
$idioma = [];
$desc_personal = "";

//Compruebo si se ha pulsado el botón del formulario
if (!isset($_REQUEST['bAceptar'])) {
    //Si no se ha pulsado, incluyo el formulario
    include "../templates/formPerfilUsuario.php";

} else { //Si el formulario si ha aparecido
    //sanitizamos
    $new_pass = recoge("new_pass");
    $idioma = recoge("idioma");
    $desc_personal = recoge("desc_personal");

    // procesamos validando los datos
    cPass($new_pass, "nueva contraseña", $errores);
    cSelect($idioma, "idioma", $errores, $idiomasValidos);
    cTexto($desc_personal, "descripcion personal", $errores);

    if (empty($errores)) {
        $imagenResultado = cFile("new_foto", $errores, $extensionesValidas, $rutaImagenes, $maxFichero);
    }
    if (empty($errores)) { //Si no hay errores guardo los nuevos datos en el fichero y redireccionamos al validPerfilUsuario.php pasando por GET los datos recogidos
        // Cojo el ID del usuario de la sesión
        $id = $_SESSION['id'];

// Abro el archivo de usuarios en modo lectura
        $arxivoUsuarios = fopen("../assets/txt/usuarios.txt", "r");

// Verifico si se pudo abrir el archivo correctamente
        if ($arxivoUsuarios) {
            // Abro un archivo temporal en modo escritura
            $arxivoTemporal = fopen("../assets/txt/usuarios_temp.txt", "w");

            // Verifico si se pudo abrir el archivo temporal correctamente
            if ($arxivoTemporal) {
                // Recorro el archivo de usuarios línea por línea
                while (!feof($arxivoUsuarios)) {
                    // Leo una línea del archivo
                    $linea = fgets($arxivoUsuarios);

                    // Verifico si la línea contiene el ID del usuario
                    if (strstr($linea, "ID: $id")) {
                        // Cojo los datos viejos
                        $lineaOldPass = fgets($arxivoUsuarios);
                        // Meto los nuevos datos
                        $lineaNewPass = "Contraseña: $new_pass" . PHP_EOL;
                        // Escribo los nuevos datos en el archivo temporal
                        fwrite($arxivoTemporal, $linea);
                        fwrite($arxivoTemporal, $lineaNewPass);
                    } else {
                        // Si no es la línea del usuario a modificar, la escribo tal cual en el archivo temporal
                        fwrite($arxivoTemporal, $linea);
                    }
                }

                // Cierro los archivos
                fclose($arxivoUsuarios);
                fclose($arxivoTemporal);

                // Renombro el archivo temporal al original
                rename("../assets/txt/usuarios_temp.txt", "../assets/txt/usuarios.txt");
            } else {
                // Manejar el error al abrir el archivo temporal
                echo "Error al abrir el archivo temporal.";
            }
        } else {
            // Manejar el error al abrir el archivo de usuarios
            echo "Error al abrir el archivo de usuarios.";
        }

        header("location:../templates/validPerfilUsuario.php?new_pass=$new_pass&img_perfil=$imagenResultado&idioma=$idioma&desc_personal=$desc_personal");
    } else {
        //Volvemos a mostrar el formulario con errores
        include "../templates/formPerfilUsuario.php";
    }

}
pie();
//descripcion, idioma y foto de perfil aun no esta implementado a la espera de que continue la actividad y se implemente la base de datos