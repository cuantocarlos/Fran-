<?php
/****
 * Librería donde incluimos aquellos datos (constantes, variables)
 * que utilizaremos en todo el proyecto/ejercicio
 * @author Heike Bonilla
 *
 */
/**
 * Todos los archivos que incluyan este fichero tendrán acceso a las funciones de validación
 */

include "bComponentes.php";
include "bGeneral.php";
include "../templates/cabecera.php";
include "../templates/pie.php";
include "bFicheros.php";


/**
 * Donde almacenaremos las imágenes que nos suben los usuarios
 */
$rutaImagenes = "../imgUsuarios/";
/**
 * Array que guarda las extensiones válidas
 */
$extensionesValidas = ["jpeg", "gif", "jpg", "png"];
/**
 * Tamaño máximo del fichero subido. En bytes
 */
$maxFichero = 300000;

/**
 * Arrays de posibles valores]
 */
$categoriasValidas = ["IT", "Fontaneria", "Electricidad", "Chofer", "Traductor"];
$disponibilidadesValidas = ["Mañanas", "Tardes", "Noches", "Completa", "Fines de semana"];
$idiomasValidas = ["es", "en", "it", "cat", "fr"];
$tiposValidas = ["Intercambio", "Pago"];


/*
* Valores de acceso para la BBDD
*/

$db_hostname = "localhost";
$db_nombre = "evaluable_7W";
$db_usuario = "root";
$db_clave = "";

?>