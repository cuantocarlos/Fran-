<p>
    <?php
    foreach ($errores as $error) {
        echo "<br>Error: " . $error . "<br>";
    }

    ?>
</p>
<?php
session_start();
?>

<form action="" method="post" enctype="multipart/form-data">

    <label for="nombre" >Nombre:</label><br>
    <input type="text" name="nombre" id="nombre" value="<?=$_SESSION["nombre"]?>">
    <label for="contrasenya" >Contraseña actual:</label><br>
    <input type="text" name="contrasenya" id="contrasenya" value="<?=$_SESSION["contrasenya"]?>">
    <label for="contrasenya" >Nueva contraseña:</label><br>
    <input type="text" name="contrasenya" id="contrasenya" value="<?=$_SESSION["contrasenya"]?>">
    <!---->
    <label for="fotoPerfil" >Cambiar foto de perfil:</label><br>
    <input type="file" name="fotoPerfil" id="fotoPerfil"><br>
    <input type="submit" value="fotoPerfil"><br>


</form>