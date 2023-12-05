<p>
    <?php
    foreach ($errores as $error) {
        echo "<br>Error: " . $error . "<br>";
    }

    ?>
</p>
<?php
//Si no tiene acceso=1, se le lleva de vuelta a la página inicial.
if($_SESSION["acceso"]!=1){
    header("location:paginaInicial.php");
}
?>

<form action="" method='post' enctype="multipart/form-data">
    Servicio: <input TYPE="text" NAME="servicio" VALUE="<?= isset($servicio) ? $servicio : ""; ?>" /><br>
    Categorias:
    <?php
    pintaSelect($categoriasValidas, "categorias");
    ?>
    <br>
    Descripción:<br> <textarea NAME="desc_servicio" rows="10"
        cols="20"><?= isset($descripcion) ? $descripcion : ""; ?>"</textarea><br>
    Tipos:<br>
    <?php
    pintaRadio($tiposValidas, "tipos");
    ?>
    <br>
    Precio por hora: <input TYPE="number" NAME="precio_por_hora" disabled> €<br>
    <!-- Falta añadir el precio_por_hora -->
    Ubicacion: <input TYPE="text" NAME="ubicacion" VALUE="<?= isset($ubicacion) ? $ubicacion : ""; ?>" /><br>
    Disponibilidad:<br>
    <?php
    pintaCheck($disponibilidadesValidas, "disponibilidad");
    ?>
    <br>
    Foto del servicio: <input TYPE="file" name="img_servicio" /><br>
    <input TYPE="submit" name="bAceptar" VALUE="Registrar">
</form>

<script>
    var radio = document.getElementsByName("tipos");
    console.log(radio);

    [...radio].forEach(element => {
        element.onclick = function(){
            console.log(element.value);
            if (element.value == "Pago") {
                document.getElementsByName("precio_por_hora")[0].disabled = false;
            } else {
                document.getElementsByName("precio_por_hora")[0].value = "";
                document.getElementsByName("precio_por_hora")[0].disabled = true;
            }

        }
    });


</script>