<?php

include("cabecera.php");

foreach ($errores as $error) {
    echo $error . "<br>";
}

?>
<h1>Inicio de sesión</h1>
<form method="post" action="" enctype="multipart/form-data">
    <br>
    Email:
    <input type="email" name="correo" value="<?= isset($correo) ? $correo : ""; ?>">
    <br>
    <?php
    echo (isset($errores['correo'])) ? "$errores[correo] <br>" : "";
    ?>
    Contraseña:
    <input type="password" name="contrasenya" value="<?= isset($contrasenya) ? $contrasenya : ""; ?>">
    <br>
    <input type="submit" name="bAceptar" value="Entrar"/>
    <br>
</form>

<?php
include("pie.php");
?>