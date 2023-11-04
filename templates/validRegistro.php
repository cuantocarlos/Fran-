<?php
require("libs/bGeneral.php");
require("libs/config.php");
include("cabecera.php");
include("pie.php");
$tittle = "Valid Form!";
cabecera($tittle);
?>
<h3>Bienvenido!</h3>
<h5>Has completado el formulario correctamente!</h5>
<?php
     $nombre = recoge("nombre");
     $correo = recoge("correo");
     $passw = recoge("passwd");
     $fecha_de_nacimiento = recoge("fecha_de_nacimiento");
     $idiomas = recoge("idiomas");
     $desc_personal = recoge("desc_personal");
    
    echo "Tu nombre de usuario: ".$name."<br>";
    echo "Tu correo: $correo <br>";
    echo "Tu contraseña: $passw<br>";
    echo "Tu fecha de nacimiento: $fecha_de_nacimiento<br>";
    echo "Tu idioma: $idiomas<br>";
    echo "Tu descripción personal: $desc_personal<br>";
    /**
     * Comprobamos si lo que se ha enviado es un fichero para poderlo mostrar
     */
    //echo (is_file ($file))?"Tu fichero $file se ha subido con éxito <br> <img src=\"$file\">":"";



pie();


//nombre=$nombre&correo=$correo&pass=$passw&fecha_de_nacimiento=$fecha_de_nacimiento&idioma=$idiomas&desc_personal=$desc_personal");

?>
