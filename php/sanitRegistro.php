<?php
require "../libs/config.php";
//añado el composer
require "../vendor/autoload.php";
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

cabecera("Registro");
// array donde almacenaremos el texto de los errores encontrados
$errores = [];
$nombre = "";
$correo = "";
$passw = "";
$fecha_de_nacimiento = "";
$img_perfil = "";
$idiomas = [];
$desc_personal = "";

//Compruebo si se ha pulsado el botón del formulario
if (!isset($_REQUEST["bAceptar"])) {

    //Sino se ha pulsado, incluyo el formulario
    include "../templates/formRegistro.php";

} // Si se ha pulsado procesamos los datos recibidos
else {
    //Sanitizamos
    $nombre = recoge("nombre");
    $correo = recoge("correo");
    $passw = recoge("passw");
    $fecha_de_nacimiento = recoge("fecha_de_nacimiento");
    $idiomas = recoge("idiomas");
    $desc_personal = recoge("desc_personal");

    //Validamos (por defecto, todos los campos son requeridos, si no, se envia false en el parámetro)
    cTexto($nombre, "nombre", $errores);
    cEmail($correo, "correo", $errores);
    cPass($passw, "contraseña", $errores);
    ValidaFechaamd($fecha_de_nacimiento, $errores);
    cSelect($idiomas, "idioma", $errores, $idiomasValidas, false);
    cTexto($desc_personal, "descripción personal", $errores, false, 140);

    if (empty($errores)) {
        /**
         * En este caso la subida del fichero es obligatoria
         **/
        $img = cFile("img_perfil", $errores, $extensionesValidas, $rutaImagenes, $maxFichero, false);

        /**
         * Sino ha habido error en la subida del fichero redireccionamos a valid.php pasando por GET (URL) los datos recogidos
         * Si ha habido error volveremos a mostrar el formulario
         **/
    }
    //Sino se han encontrado errores  guardamos el nuevo usuario y pasamos al documento con los datos validados
    if (empty($errores)) {

        //encripto la contraseña
        $passw = encriptarContrasenya($passw);
        registrarUsuario($nombre, $correo, $passw, $fecha_de_nacimiento, $img, $desc_personal, 1, 0);

//una vez registrado en la BD se le envia un correo de confirmacion

        $mail = new PHPMailer();
        try {
            // Configura el servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = 'losmanes-123';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configura los destinatarios
            $mail->setFrom('tucorreo@gmail.com', 'Tu Nombre');
            $mail->addAddress($correo, $nombre);

// Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Este correo es para que confirmes tu registro';
            $mail->Body = 'Haz click en este enlace para confirmar tu registro: el enlace';

// Enviar el correo
            $mail->send();
            echo 'El correo se ha enviado con éxito.';
        } catch (Exception $e) {
            echo "El correo no se pudo enviar. Error: {$mail->ErrorInfo}";
        }

        //reenvio a login para que inicie sesion
        header("location:sanitLogin.php");
    } else {
        //Volvemos a mostrar el formulario con errores
        include "../templates/formRegistro.php";
    }
}

pie();
