<?php
require "../libs/config.php";

?>
<h3>Bienvenido!</h3>
<h5>Has completado el formulario correctamente!</h5>
<?php
$nombre = recoge("nombre");
$correo = recoge("correo");
$passw = recoge("passw");
$fecha_de_nacimiento = recoge("fecha_de_nacimiento");
$idiomas = recoge("idioma");
$desc_personal = recoge("desc_personal");
$img = recoge("img_perfil");

echo "Tu nombre de usuario: $nombre<br>";
echo "Tu correo: $correo <br>";
echo "Tu contraseña: $passw<br>";
echo "Tu fecha de nacimiento: $fecha_de_nacimiento<br>";
echo "Tu idioma: $idiomas<br>";
echo "Tu descripción personal: $desc_personal<br>";
/**
 * Comprobamos si lo que se ha enviado es un fichero para poderlo mostrar
 */
echo (is_file($img)) ? "Tu fichero $img se ha subido con éxito <br> <img src=\"../img/$img\">" : "";

?>



