<?php
include "/libs/bGeneral.php";
include "/libs/config.php";
include "/libs/bComponentes.php";
include "/templates/cabecera.php";
include "/templates/pie.php";
$errores = false;

cabecera("Perfil de usuario");
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

} else { //Si el formulario si ha aparecido
    //sanitizamos
    $new_pass = recoge("new_pass");
    $img_perfil = recoge("img_perfil");
    $idiomas = recoge("idiomas");
    $desc_personal = recoge("desc_personal");
    // procesamos validando los datos
    cPass($new_pass, "nueva contraseña", $errores);
    cSelect($idiomas, "idioma", $errores, $idiomasValidos);
    cTexto($desc_personal,"descripcion personal", $errores);
    if (empty($errores)) {
        cFile($img_perfil, $errores, $extensionesValidas, $rutaImagenes);
    }
    if (empty($errores)) {
        header("location:../templates/validPerfilUsuario.php?new_pass=$new_pass&img_perfil=$img_perfil&idioma=$idiomas&desc_personal=$desc_personal");
    } else {
        //Volvemos a mostrar el formulario con errores
        include "../templates/formPerfilUsuario.php";

    }

}
pie();
?>


