<?php include("templates/cabecera.php");
include('libs/config.php');
?>

<p>
	<?php
		foreach ($errores as $error) {
			echo "<br>Error: " . $error . "<br>";
		}

	?>
</p>


<form action="" method='post' enctype="multipart/form-data">
	Servicio: <input TYPE="text" NAME="servicio" VALUE=""/><br>
    Categorias: 
    <?php
    $categorias = ["IT","Fontaneria","Electricidad","Chofer","Traductor"];
    pintaSelect($categorias,"categorias");
    ?>
    <br>
	Descripción:<br> <textarea NAME="desc_servicio" rows="10" cols="20">Escribe aquí tu descripcion...</textarea><br>
    Tipos:<br>
    <?php
    $tipos = ["Intercambio","Pago"];
    pintaRadio($tipos,"tipos");
    ?>
    <br>
    <!-- Falta añadir el precio_por_hora -->
    Ubicacion: <input TYPE="text" NAME="ubicacion" VALUE=""/><br>
    Disponibilidad:<br>
    <?php
    $disponibilidades = ["Mañanas","Tardes","Noches","Completa","Fines de semana"];
    pintaCheck($disponibilidades,"disponibilidad");
    ?>
    <br>
    Foto del servicio: <input TYPE="file" name="img_perfil" /><br>
	<input TYPE="submit" name="bAceptar" VALUE="Registrar">
</form>

<?php include("pie.php")?>