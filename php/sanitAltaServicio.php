 <?php
/*
Hay que bloquear para que solo puedan crear servicios los usuarios logueados, por
ejemplo if (!isset($_SESSION['correo'])) hago un header location a login o al inicio
*/

//if (isset($_SESSION['correo'])) {
require "../libs/config.php";

cabecera("Alta servicio");
// Array de errores a presentar
$errores = [];
$servicio = "";
//$_SESSION["titulo"]=$servicio;
//$_SESSION ["id_user"]=$id_user; La añadiremos cuando funcione lo de Login
$categoria = "";
$descripcion = "";
$tipoPago = "";
$precio_por_hora = "";
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
    $precio_por_hora = recoge("precio_por_hora");
    $ubicacion = recoge("ubicacion");
    $disponibilidades = recogeArray("disponibilidad");

    //Validamos (por defecto, todos los campos son requeridos, si no, se envia false en el parámetro)
    cTexto($servicio, "servicio", $errores);
    cSelect($categoria, "categorias", $errores, $categoriasValidas);
    cTexto($descripcion, "descripcion", $errores, true, 140);
    cRadio($tipoPago, "tipo de pago", $errores, $tiposValidas);
    cNum($precio_por_hora,"precio por hora",$errores,false);
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

        /*****
        Compuerbo si la escritura en el fichero ha ido bien
        *****/
        insertarServicio($servicio, $idUser, $descripcion, $precio_por_hora,$tipoPago, $img,$errores);
/************
Ya no paso nada por la URL.
Si necesito algo lo guardo en sesiones aunque en este caso no se si es necesario mostrar todos los datos del servicio creado
*****/
        $disponibilidades = serialize($disponibilidades);
        header("location:../templates/validAltaServicio.php?servicio=$servicio&categoria=$categoria&descripcion=$descripcion&tipoPago=$tipoPago&precio_por_hora=$precio_por_hora&ubicacion=$ubicacion&disponibilidad=$disponibilidades&img=$img");
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
