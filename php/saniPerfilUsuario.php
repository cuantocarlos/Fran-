<?php
include "/libs/bGeneral.php";
include "/libs/config.php";
include "/templates/cabecera.php";
$errores = false;


//array donde almacenaremos el texto de los errores encontrados
$errores = [];
$new_pass = "";
$img_perfil = "";
$idiomas = [];
$desc_personal = "";

//Compruebo si se ha pulsado el botón del formulario
if (!isset($_REQUEST['bAceptar'])) {
    //Si no se ha pulsado, incluyo el formulario
    include 'formPerfilUsuario.php';

} else { //sanitizamos
    //Si el formulario si ha aparecido, procesamos los datos
    cPass($new_pass );
    cFile($img_perfil);
    cTexto($desc_personal);

    if (empty($errores)) {
    //Si no hay errores redireccionamos a validPerfilUsuario.php
        header("location:validPerfilUsuario.php?new_pass=$new_pass&img_perfil=$img_perfil&idiomas=$idiomas&desc_personal=$desc_personal");
    } else {
    //Si hay errores volvemos a mostrar el formulario
        include 'formPerfilUsuario.php';
    }

}
include "/templates/pie.php";
?>
<!--falta idiomas-->
