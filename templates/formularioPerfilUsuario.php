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
    <!--Seleccion de idioma preferente-->
    <label for="idioma" ></label>
    <!--Descripcion personal-->
    <label for="descripcion">Descripcion</label>
</form>