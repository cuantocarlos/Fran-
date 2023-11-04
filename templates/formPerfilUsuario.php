<?php
?>
<form action="index.php" method="post" enctype="multipart/form-data">
    <!--Cambiar contraseña-->
    <label for="pass">Contraseña actual</label>
    <input type="password" name="current_pass" id="current_pass"><br>
    <label for="new_pass">Nueva Contraseña</label>
    <input type="password" name="new_pass" id="new_pass"><br>
    <label for="confirm_pass">Confirmar nueva contraseña</label>
    <input type="password" name="confirm_pass" id="confirm_pass"><br>
    <input type="submit" name="cambiarPass" value="Cambiar Contrasenya"><br>

    <!-- Cammbiar foto de perfil-->
    <label for="new_foto">Nueva foto de perfil</label><br>
    <input type="file" name="new_foto" id="new_foto" value="<?php echo $foto; ?>"><br>
    <input type="submit" name="cambiarFoto" value="Cambiar foto"><br>

    <!--Seleccion de idioma preferente-->
    <label for="idioma" >Idioma preferente</label>
    <?php
$idiomas = ['es', 'en', 'cat', 'fr']
?><br>

    <!--Descripcion personal-->
    <label for="descripcion">Descripcion personal</label><br>
    <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo $descripcion; ?></textarea><br>
    <input type="submit" name="cambiarDescripcion" value="Cambiar descripción"><br>
</form>

<!--El formulario de idioma no sé bien como ponerlo-->