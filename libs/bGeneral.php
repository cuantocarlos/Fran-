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

function recogeArray(string $var): array
{
    $array = [];
    if (isset($_REQUEST[$var]) && (is_array($_REQUEST[$var]))) {
        foreach ($_REQUEST[$var] as $valor) {
            $array[] = strip_tags(sinEspacios($valor));
        }

    }

    return $array;
}

/*
Función que permite validar cadenas de texto.
Le pasamos cadena, nombre de campo y array de errores y
de manera voluntaria mínimo y máximo de caracteres (si = sería campo no requerido) ,
si permitimos o no espacios en nuestra cadena y si la cadena es o no sensible a mayúsculas
 */

function cTexto(string $text, string $campo, array &$errores, bool $requerido = true, int $max = 30, int $min = 1, bool $espacios = true, bool $case = true)
{

    $case = ($case === true) ? "i" : "";
    $espacios = ($espacios === true) ? " " : "";
    if (!$requerido && $text == "") {
        return true;
    }
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
{
    $cuantificador = ($requerido) ? "+" : "*";
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
function cSelect(string $text, string $campo, array &$errores, array $valores, bool $requerido = true)
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
function cCheck(array $text, string $campo, array &$errores, array $valores, bool $requerido = true)
{
    if (!$requerido && $text == "") {
        return true;
    }

    foreach ($text as $t) {
        if (!in_array($t, $valores)) {
            $errores[$campo] = "Error en el campo $campo";
            return false;
        }
    }

    return true;

}

function cEmail(string $email, string $campo, array &$errores, bool $requerido = true)
{
    if (!$requerido && $email == "") {
        return true;
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}

function cPass(string $contrasenya, string $campo, array &$errores, bool $requerido = true, int $min = 10, int $max = 150)
{
    if (!$requerido && $contrasenya == "") {
        return true;
    }
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

function ValidaFechaamd($fecha, array &$errores, bool $requerido = true)
{
    if (!$requerido && $fecha == "") {
        return true;
    }
    $fechaArray = explode("-", $fecha);
    if ((count($fechaArray) == 3) && (checkdate($fechaArray[1], $fechaArray[2], $fechaArray[0]))) {

        return mktime($fechaArray[1], $fechaArray[2], $fechaArray[0]);
    } else {
        $errores["fecha"] = "La fecha no es válida";
        return false;
    }
}

function cookiesObligatorios()
{
    // si se ha aceptado previamente la politica de cookies
    if (isset($_GET['aceptarCookies']) && $_GET['aceptarCookies'] === 'true') {
        setcookie("politicaCookies", "aceptada", time() + 365 * 24 * 60 * 60, "/"); // Caduca en un año

        // Después de establecer la cookie, recarga la página.
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    // si NO se ha aceptado previamente la politica de cookies
    if (!isset($_COOKIE["politicaCookies"]) || $_COOKIE["politicaCookies"] !== "aceptada") {
        echo "<div id='avisoCookies' style='display:none; position: fixed; bottom: 0; left: 0; width: 100%; background: #333; color: #fff; text-align: center; padding: 10px;'>
                <p>Esta página web utiliza cookies para su funcionamiento. <br> Al continuar navegando, acepta su uso.
                <a href='?aceptarCookies=true' id='aceptarCookies'>Aceptar</a></p>
            </div>";

        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var avisoCookies = document.getElementById('avisoCookies');
                    var aceptarCookies = document.getElementById('aceptarCookies');

                    // Muestra el aviso si la cookie no ha sido aceptada
                    if(avisoCookies && aceptarCookies) {
                        avisoCookies.style.display = 'block';

                        // Agrega un evento al enlace de aceptar cookies
                        aceptarCookies.addEventListener('click', function() {
                            // Hace una petición al mismo script con el parámetro aceptarCookies=true
                            window.location.href = '?aceptarCookies=true';
                        });
                    }
                });
            </script>";
    }
}

//opcion seleccion color de fondo
function colorFondo()
{
    // Verifica si la sesión está iniciada y el nivel de acceso es mayor que 0
    if (isset($_SESSION["acceso"]) && $_SESSION["acceso"] > 0) {
        // Verifica si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verifica si se ha seleccionado un color
            if (isset($_POST["colorFondo"])) {
                $colorSeleccionado = $_POST["colorFondo"];

                // Establece la cookie con el color seleccionado durante un año
                setcookie("colorFondo", $colorSeleccionado, time() + 365 * 24 * 60 * 60, "/");
            }
        }

        echo "<form method='post'>";
        // Imprime el select con las opciones y el nombre "colorFondo"
        pintaSelect(["claro", "oscuro"], "colorFondo");

        // Botón para enviar el formulario
        echo "<input type='submit' value='Guardar'>";
        echo "</form>";

        // Verifica si la cookie "colorFondo" está establecida y aplica el estilo
        if (isset($_COOKIE["colorFondo"])) {
            if ($_COOKIE["colorFondo"] == "claro") {
                $colorPoner = "white";
            } else {
                $colorPoner = " #b2babb ";
            }
            echo "<style>body{background-color:" . $colorPoner . ";}</style>";
        }
    }
}
function otorgarAcceso(int $tiempo, int $nivel =0, &$errores){
    //si no se le pasa tiempo que ponga 10 minutos por defecto
    if ($tiempo==null) {
        $tiempo =time() + 60 * 10;
    }
    
}
function controlAcceso()
{ //verifica que el que navega por la pagina contenga tiempo y renueva el tiempo, controla que se acceda con el nivel correcto
    //Sino existe $_SESSION['acceso'] lo ponemos a 0. Será un usuario invitado
    if (!isset($_SESSION['nivel'])) {
        $_SESSION['nivel'] = 0;
    }
    //si no cumples con los requisitos de seguridad, te echa
    if ($_SESSION['nivel'] > 0 && $_SESSION['time'] > time()) {
        //si cumple los requisitos se renueva el tiempo
        $_SESSION['time'] = time() + 60 * 10;
    } else {
        header("location: ../php/salir.php");
    }

}

