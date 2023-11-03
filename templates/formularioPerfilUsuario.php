<?php
?>
<form action="index.php" method="post">
    <!--Cambiar contrasenya-->
    <label for="pass">Contrasenya</label>
    <input type="password" name="pass" id="pass" value="<?php echo $pass; ?>">
    <br>
    <label for="pass2">Repite Contrasenya</label>
    <input type="password" name="pass2" id="pass2" value="<?php echo $pass2; ?>">
    <br>
    <input type="submit" name="cambiarPass" value="Cambiar">

    <!-- Cammbiar foto de perfil-->
    <label for="foto">Foto de perfil</label>
    <input type="file" name="foto" id="foto" value="<?php echo $foto; ?>">
    <br>
    <input type="submit" name="cambiarFoto" value="Cambiar">

    <!--Seleccion de idioma preferente-->
    <label for="idioma" ></label>
    <?php
    $idiomas = ['es','en','cat','fr']
    ?>
    <!--Descripcion personal-->
    <label for="descripcion">Descripcion</label>
    <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo $descripcion; ?></textarea>
    <input type="submit" name="cambiarDescripcion" value="Cambiar">
</form>