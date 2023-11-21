<?php
require "../libs/config.php";

?>
<h3>Bienvenido!</h3>
<h5>Has completado el formulario correctamente!</h5>
<?php
    $servicio = recoge("servicio");
    $categoria = recoge("categoria");
    $descripcion = recoge("descripcion");
    $tipoPago = recoge("tipoPago");
    $precio_por_hora = recoge("precio_por_hora");
    $ubicacion = recoge("ubicacion");
    $disponibilidades = unserialize(recoge("disponibilidad"));
    $img = recoge("img");
    
echo "Tu servicio: $servicio<br>";
echo "Tu categoria: $categoria <br>";
echo "Tu descripcion: $descripcion<br>";
echo "Tu tipo de pago: $tipoPago<br>";
if($precio_por_hora != "") echo "Precio por hora: $precio_por_hora<br>"; 
echo "Tu ubicacion: $ubicacion<br>";
echo "Tu disponibilidad: ";
foreach ($disponibilidades as $dispo) {
    echo " - $dispo <br>";
}
/**
 * Comprobamos si lo que se ha enviado es un fichero para poderlo mostrar
 */
echo (is_file($img)) ? "Imagen de tus servicio: <br> <img src=\"../img/$img\">" : "";

?>



