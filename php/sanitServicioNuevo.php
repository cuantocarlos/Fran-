<?php
include "libs/bGeneral.php";

// Array de errores a presentar
$errores = [];
$titulo ="";
$categoria = "";
$descripcion = "";
$tipoPago = "";
$precio_por_hora = "";
$ubicaion = "";
$disponibilidad = "";



if (!isset($_REQUEST['bAceptar'])) {
    include "templates/formServicioNuevo.php";
} else {
    //Sanitizamos
    
}

?>