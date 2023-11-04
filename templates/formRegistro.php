<?php include("../libs/bComponentes.php");?>

<p>
	<?php
	
    foreach ($errores as $error) {
			echo "<br>Error: " . $error . "<br>";
		}

	?>
</p>



<form action="" method='post' enctype="multipart/form-data">
	Nombre: <input TYPE="text" NAME="nombre" VALUE="<?= isset($nombre) ? $nombre : ""; ?>"/><br>
	Correo: <input TYPE="text" NAME="correo" VALUE="<?= isset($correo) ? $correo : ""; ?>"/><br>
    Contraseña: <input TYPE="password" NAME="passw" VALUE="<?= isset($passw) ? $passw : ""; ?>"/><br>
    Fecha de nacimiento: <input TYPE="date" name="fecha_de_nacimiento" VALUE="<?= isset($fecha_de_nacimiento) ? $fecha_de_nacimiento : ""; ?>"/><br>
    Foto de perfil: <input TYPE="file" name="img_perfil" /><br>
    Idioma: 
    <?php
    $idiomas = ["es","en","it","cat","fr"];
    pintaSelect($idiomas,"idiomas");
    ?>
    <br>
    Descripción personal: <textarea name="desc_personal" rows="10" cols="20" ><?= isset($desc_personal) ? $desc_personal : ""; ?></textarea><br>



	<br>
	<input TYPE="submit" name="bAceptar" VALUE="Registrar">
</form>
