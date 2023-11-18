<?php

//if (isset($_SESSION['correo'])) {
require "../libs/config.php";

cabecera("Alta servicio");
// Array de errores a presentar
$errores = [];
$servicio = "";
$categoria = "";
$descripcion = "";
$tipoPago = "";
//$precio_por_hora = "";
$ubicacion = "";
$disponibilidades = [];

//Compruebo si se ha pulsado el botón del formulario
if (!isset($_REQUEST["bAceptar"])) {

    //Sino se ha pulsado, incluyo el formulario
    include "../templates/formAltaServicio.php";

} // Si se ha pulsado procesamos los datos recibidos
else {
    //Sanitizamos
    $servicio = recoge("servicio");
    $categoria = recoge("categorias");
    $descripcion = recoge("desc_servicio");
    $tipoPago = recoge("tipos");
    $ubicacion = recoge("ubicacion");
    $disponibilidades = recogeArray("disponibilidad");

    //Validamos (por defecto, todos los campos son requeridos, si no, se envia false en el parámetro)
    cTexto($servicio, "servicio", $errores);
    cSelect($categoria, "categorias", $errores, $categoriasValidas);
    cTexto($descripcion, "descripcion", $errores, true, 140);
    cRadio($tipoPago, "tipo de pago", $errores, $tiposValidas);
    cTexto($ubicacion, "ubicacion", $errores);
    cCheck($disponibilidades, "disponibilidades", $errores, $disponibilidadesValidas);

    if (empty($errores)) {
        /**
         * En este caso la subida del fichero es obligatoria
         **/
        $img = cFile("img_servicio", $errores, $extensionesValidas, $rutaImagenes, $maxFichero, false);

        /**
         * Sino ha habido error en la subida del fichero redireccionamos a valid.php pasando por GET (URL) los datos recogidos
         * Si ha habido error volveremos a mostrar el formulario
         **/
    }
    //Sino se han encontrado errores pasamos a otra página
    if (empty($errores)) {

        /**
         * Antes de pasar al documento con los datos validados, registramos el servicio en servicios.txt
         */
        registrarAltaServicio($servicio, $categoria, $descripcion, $tipoPago, $ubicacion, $disponibilidades, $img);

        $disponibilidades = serialize($disponibilidades);
        header("location:../templates/validAltaServicio.php?servicio=$servicio&categoria=$categoria&descripcion=$descripcion&tipoPago=$tipoPago&ubicacion=$ubicacion&disponibilidad=$disponibilidades&img=$img");
    } else {
        //Volvemos a mostrar el formulario con errores
        include "../templates/formAltaServicio.php";
    }
}

pie();
/*
}else {
header("location:../php/sanitLogin.php");
exit();
}
 */
