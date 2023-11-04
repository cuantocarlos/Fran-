<?php
//Función que sustituye las vocales con tilde por la misma sin tildes
function sinTildes($frase)
{
    $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "à", "è", "ì", "ò", "ù", "À", "È", "Ì", "Ò", "Ù");
    $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
    $texto = str_replace($no_permitidas, $permitidas, $frase);
    return $texto;
}

//Función que elimina los espacios sobrantes,
//al inicio de la cadena y más de uno en los caracteres intermedios
function sinEspacios($frase)
{
    $texto = trim(preg_replace('/ +/', ' ', $frase));
    return $texto;
}

//Función que sanitiza la información. Además si no existe el control lo pone a ""
function recoge($var)
{
    if (isset($_REQUEST[$var]) && (!is_array($_REQUEST[$var]))) {
        $tmp = sinEspacios($_REQUEST[$var]);
        $tmp = strip_tags($tmp);
    } else {
        $tmp = "";
    }

    return $tmp;
}
/*
Función que permite validar cadenas de texto.
Le pasamos cadena, nombre de campo y array de errores y
de manera voluntaria mínimo y máximo de caracteres (si = sería campo no requerido) ,
si permitimos o no espacios en nuestra cadena y si la cadena es o no sensible a mayúsculas
 */

function cTexto(string $text, string $campo, array &$errores, int $max = 30, int $min = 1, bool $espacios = true, bool $case = true)
{
    $case = ($case === true) ? "i" : "";
    $espacios = ($espacios === true) ? " " : "";
    if ((preg_match("/^[a-zñ$espacios]{" . $min . "," . $max . "}$/u$case", sinTildes($text)))) {
        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}

/*
Función que valida una cadena que contiene sólo números.
Además valida si el campo es o no requerido y el valor máximo
 */
function cNum(string $num, string $campo, array &$errores, bool $requerido = true, int $max = PHP_INT_MAX)
{$cuantificador = ($requerido) ? "+" : "*";
    if ((preg_match("/^[0-9]" . $cuantificador . "$/", $num)) && ($num <= $max)) {

        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}

/*
Función que valida el dato recogido en un control radio.
La validación la hace de acuerdo con los datos posibles que pasamos por un array
Validamos también si el campo es o no requerido
 */

function cRadio(string $text, string $campo, array &$errores, array $valores, bool $requerido = true)
{
    if (!$requerido && $text == "") {
        return true;
    }
    if (in_array($text, $valores)) {
        return true;
    }

    $errores[$campo] = "Error en el campo $campo";
    return false;

}

function cEmail(string $email, string $campo, array &$errores)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}

function cPass(string $contrasenya, string $campo, array &$errores, int $min = 10, int $max = 150) {
    if (strlen($contrasenya) < $min || strlen($contrasenya) > $max) {
        $errores[$campo] = "Error en el campo $campo: la contraseña debe tener entre $min y $max caracteres.";
        return false;
    }

    if (!preg_match('/[A-ZÑÇ]/', $contrasenya) || !preg_match('/[a-zñç]/', $contrasenya)) {
        $errores[$campo] = "Error en el campo $campo: la contraseña debe contener al menos una letra mayúscula y una letra minúscula.";
        return false;
    }

    if (!preg_match('/\d/', $contrasenya)) {
        $errores[$campo] = "Error en el campo $campo: la contraseña debe contener al menos un número.";
        return false;
    }

    if (!preg_match('/[^A-Za-z\d]/', $contrasenya)) {
        $errores[$campo] = "Error en el campo $campo: la contraseña debe contener al menos un carácter especial.";
        return false;
    }

    return true;
}


/**
 * Funcion cFile
 *
 * Valida la subida de un archivo a un servidor.
 *
 * @param string $nombre
 * @param array $extensiones_validas
 * @param string $directorio
 * @param integer $max_file_size
 * @param array $errores
 * @param boolean $required
 * @return boolean|string
 */
function cFile(string $nombre, array &$errores, array $extensionesValidas, string $directorio, int $max_file_size, bool $required = true)
{
    // Caso especial que el campo de file no es requerido y no se intenta subir ningun archivo
    if ((!$required) && $_FILES[$nombre]['error'] === 4) {
        return true;
    }

    // En cualquier otro caso se comprueban los errores del servidor
    if ($_FILES[$nombre]['error'] != 0) {
        $errores["$nombre"] = "Error al subir el archivo " . $nombre . ". Prueba de nuevo";
        return false;
    } else {

        $nombreArchivo = strip_tags($_FILES["$nombre"]['name']);
        /*
         * Guardamos nombre del fichero en el servidor
         */
        $directorioTemp = $_FILES["$nombre"]['tmp_name'];
        /*
         * Calculamos el tamaño del fichero
         */
        $tamanyoFile = filesize($directorioTemp);

        /*
         * Extraemos la extensión del fichero, desde el último punto.
         */
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        /*
         * Comprobamos la extensión del archivo dentro de la lista que hemos definido al principio
         */
        if (!in_array($extension, $extensionesValidas)) {
            $errores["$nombre"] = "La extensión del archivo no es válida";
            return false;
        }
        /*
         * Comprobamos el tamaño del archivo
         */
        if ($tamanyoFile > $max_file_size) {
            $errores["$nombre"] = "La imagen debe de tener un tamaño inferior a $max_file_size kb";
            return false;
        }

        // Almacenamos el archivo en ubicación definitiva si no hay errores ( al compartir array de errores TODOS LOS ARCHIVOS tienen que poder procesarse para que sea exitoso. Si cualquiera da error, NINGUNO  se procesa)

        if (empty($errores)) {
            /**
             * Comprobamos si el directorio pasado es válido
             */
            if (is_dir($directorio)) {
                /**
                 * Tenemos que buscar un nombre único para guardar el fichero de manera definitiva.
                 * Podemos hacerlo de diferentes maneras, en este caso se hace añadiendo microtime() al nombre del fichero
                 * si ya existe un archivo guardado con ese nombre.
                 * */
                $nombreArchivo = is_file($directorio . DIRECTORY_SEPARATOR . $nombreArchivo) ? time() . $nombreArchivo : $nombreArchivo;
                $nombreCompleto = $directorio . DIRECTORY_SEPARATOR . $nombreArchivo;
                /**
                 * Movemos el fichero a la ubicación definitiva.
                 * */
                if (move_uploaded_file($directorioTemp, $nombreCompleto)) {
                    /**
                     * Si todo es correcto devuelve la ruta y nombre del fichero como se ha guardado
                     */

                    return $nombreCompleto;
                } else {
                    $errores["$nombre"] = "Ha habido un error al subir el fichero";
                    return false;
                }
            } else {
                $errores["$nombre"] = "Ha habido un error al subir el fichero";
                return false;
            }
        }
    }
}
