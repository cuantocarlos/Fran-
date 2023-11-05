<?php
include("../libs/bGeneral.php");
include("config.php");

// Array de errores a presentar
$errores = [];
$servicio ="";
$categoria = "";
$descripcion = "";
$tipoPago = "";
//$precio_por_hora = "";
$ubicacion = "";
$disponibilidades = [];

//sesssion_start();
//Compruebo si se ha pulsado el botón del formulario
if (!isset($_REQUEST["bAceptar"])) {

    //Sino se ha pulsado, incluyo el formulario
    include "../templates/altaServicio.php";

} // Si se ha pulsado procesamos los datos recibidos
else {
    //Sanitizamos
    $servicio = recoge("servicio");
    $categoria = recoge("categorias");
    $descripcion = recoge("desc_servicio");
    $tipoPago = recoge("tipos");
    $ubicacion = recoge("ubicacion");
    $disponibilidades = recogeArray("disponibilidad");
    
    //Validamos
    cTexto($nombre, "nombre", $errores);
    cSelect($categoria,"categorias",$errores,$categoriasValidas);
    cTexto($descripcion, "descripcion", $errores);
    cRadio($tipoPago,"tipo de pago",$errores,$tiposValidas);
    cTexto($ubicacion,"ubicacion",$errores);
    cCheck($disponibilidades,"disponibilidades",$errores,$disponibilidadesValidas);

    if (empty($errores)) {
        /**
         * En este caso la subida del fichero es obligatoria
         **/
        $img = cFile("img_servicio", $errores, $extensionesValidas, $rutaImagenes, $maxFichero);

        /**
         * Sino ha habido error en la subida del fichero redireccionamos a valid.php pasando por GET (URL) los datos recogidos
         * Si ha habido error volveremos a mostrar el formulario
         **/
    }
    //Sino se han encontrado errores pasamos a otra página
    if (empty($errores)) {
        header("location:../templates/validRegistro.php?nombre=$nombre&correo=$correo&passwº=$passw&fecha_de_nacimiento=$fecha_de_nacimiento&idioma=$idiomas&desc_personal=$desc_personal&img_perfil=$img");
    } else {
        //Volvemos a mostrar el formulario con errores
        include "../templates/altaServicio.php";
    }
}
?>


