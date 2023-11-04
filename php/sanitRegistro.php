<?php
include('../libs/bGeneral.php');
include("../libs/config.php");
include("../templates/cabecera.php");

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
    include("./templates/registro.php");

} // Si se ha pulsado procesamos los datos recibidos
else {
    //Sanitizamos
    $nombre = recoge("nombre");
    $correo = recoge("correo");
    $passw = recoge("passwd");
    $fecha_de_nacimiento = recoge("fecha_de_nacimiento");
    $idiomas = recoge("idiomas");
    $desc_personal = recoge("desc_personal");
    
    //Validamos
    cTexto($nombre,"nombre",$errores,);
    cEmail($correo,"correo",$errores);
    cTexto($passw,"contraseña",$errores);
    validaFechadma($fecha_de_nacimiento,$errores);
    cSelect($idiomas,"idioma",$errores,$idiomasValidas);
    cTexto($desc_personal,"descripción personal",$errores);
    //Sino se han encontrado errores pasamos a otra página
    if (empty($errores)) {
        header("location:validRegistro.php?nombre=$nombre&correo=$correo&pass=$passw&fecha_de_nacimiento=$fecha_de_nacimiento&idioma=$idiomas&desc_personal=$desc_personal");
    } else {
        //Volvemos a mostrar el formulario con errores
        include("../templates/registro.php");
    }
}
?>


<?php

include("../templates/pie.php");
?>