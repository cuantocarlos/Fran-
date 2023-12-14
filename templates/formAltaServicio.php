<p>
    <?php
    foreach ($errores as $error) {
        echo "<br>Error: " . $error . "<br>";
    }

    ?>
</p>
<?php
session_start();
//Si no tiene acceso=1, se le lleva de vuelta a la página inicial.
if($_SESSION["acceso"]!=1){
    header("location:paginaInicial.php");
}
//Control de cierre por inactividad
controlAcceso();

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
 <script src="../assets/js/formAltaServicio.js"></script>
