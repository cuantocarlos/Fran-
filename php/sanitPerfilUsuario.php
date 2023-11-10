<?php
include "../libs/config.php";

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
    cTexto($desc_personal,"descripcion personal", $errores);
    if (empty($errores)) {
        $imagenResultado=cFile("new_foto", $errores, $extensionesValidas, $rutaImagenes);
    }
    if (empty($errores)) {
        header("location:../templates/validPerfilUsuario.php?new_pass=$new_pass&img_perfil=$imagenResultado&idioma=$idioma&desc_personal=$desc_personal");
    } else {
        //Volvemos a mostrar el formulario con errores
        include "../templates/formPerfilUsuario.php";
    }

}
pie();
?>


