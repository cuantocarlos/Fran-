<?php
include "/libs/bGeneral.php";
$errores = false;
cabecera();

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
    cPass($new_pass, );
    cFile($img_perfil);
    cTexto($desc_personal);

}

?>
<!--falta idiomas-->
