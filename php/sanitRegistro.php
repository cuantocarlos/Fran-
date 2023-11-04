<?php
include './libs/bGeneral.php';
cabecera();
$error = false;

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
if (!isset($_REQUEST['bAceptar'])) {

//Sino se ha pulsado, incluyo el formulario
    include 'form.php';

} // Si se ha pulsado procesamos los datos recibidos
else {
    //Sanitizamos
    $nombre = recoge("nombre");
    $edad = recoge('edad');
    //Validamos
    if ((!cTexto($nombre))) {
        $errores['nombre'] = 'El nombre no es correcto';
        $error = true;
    }
    if ((!cNum($edad))) {
        $errores['edad'] = 'La edad no es correcta';
        $error = true;
    }
    //Sino se han encontrado errores pasamos a otra página
    if (empty($errores)) {
        header("location:correcto.php?nombre=$nombre&edad=$edad");
    } else {
        //Volvemos a mostrar el formulario con errores
        include 'form.php';
    }
}
?>


<?php

pie();
?>