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
//Control de cierre por inactividad
if(isset($_SESSION["time"])){
    $vidaSesion = time() - $_SESSION["time"];

    if($vidaSesion > 10){
        header("location:../php/salir.php");
    }else{
        $_SESSION["time"] = time();
    }
}
?>

<form action="index.php" method="post" enctype="multipart/form-data">
    <!--Cambiar contraseña-->
    <label for="current_pass">Contraseña actual</label>
    <input type="password" name="current_pass" id="current_pass"><br>
    <label for="new_pass">Nueva Contraseña</label>
    <input type="password" name="new_pass" id="new_pass"><br>
    <label for="confirm_pass">Confirmar nueva contraseña</label>
    <input type="password" name="confirm_pass" id="confirm_pass"><br>
    <input type="submit" name="cambiarPass" value="Cambiar Contrasenya"><br>

    <!-- Cammbiar foto de perfil-->
    <label for="new_foto">Nueva foto de perfil</label><br>
    <input type="file" name="new_foto" id="new_foto"><br>
    <input type="submit" name="cambiarFoto" value="Cambiar foto"><br>

    <!--Seleccion de idioma preferente-->
    <label for="idioma" >Idioma preferente</label>
    <?php
      
        pintaSelect($idiomasValidas, "idioma");
    ?>
    <br>

    <!--Descripcion personal-->
    <label for="descripcion">Descripcion personal:</label><br>
    <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo $desc_personal; ?></textarea><br>
    <input type="submit" name="bAceptar" value="Cambiar descripción"><br>
</form>

