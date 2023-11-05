<?php include("../libs/bComponentes.php");
include('../libs/config.php');
?>

<p>
	<?php
		foreach ($errores as $error) {
			echo "<br>Error: " . $error . "<br>";
		}

	?>
</p>


<form action="" method='post' enctype="multipart/form-data">
	Servicio: <input TYPE="text" NAME="servicio" VALUE="<?= isset($servicio) ? $servicio : ""; ?>"/><br>
    Categorias: 
    <?php
    pintaSelect($categoriasValidas,"categorias");
    ?>
    <br>
	Descripción:<br> <textarea NAME="desc_servicio" rows="10" cols="20"><?= isset($descripcion) ? $descripcion : ""; ?>"</textarea><br>
    Tipos:<br>
    <?php
    pintaRadio($tiposValidas,"tipos");
    ?>
    <br>
    <!-- Falta añadir el precio_por_hora -->
    Ubicacion: <input TYPE="text" NAME="ubicacion" VALUE="<?= isset($ubicacion) ? $ubicacion : ""; ?>"/><br>
    Disponibilidad:<br>
    <?php
    pintaCheck($disponibilidadesValidas,"disponibilidad");
    ?>
    <br>
    Foto del servicio: <input TYPE="file" name="img_servicio" /><br>
	<input TYPE="submit" name="bAceptar" VALUE="Registrar">
</form>


