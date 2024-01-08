<?php
require "../libs/config.php";
?>
<h3>Genial!</h3>
<h5>tu perfil de usuario ha sido modificado correctamente!</h5>
<?php
$new_pass = recoge("new_pass");
$img_perfil = recoge("img_perfil");
$idioma = recoge("idioma");
$desc_personal = recoge("desc_personal");


?>
<p>Estos son los datos de tu perfil ahora:</p>
<ul>
    <li>Nombre: <?php echo $_SESSION["nombre"] ?></li>
    <li>Apellidos: <?php echo $_SESSION["apellidos"] ?></li>
    <li>Correo: <?php echo $_SESSION["correo"] ?></li>
    <li>Contraseña: <?php echo $new_pass ?></li>
    <li>Imagen de perfil: <?php echo $img_perfil ?></li>
    <li>Idioma: <?php echo $idioma ?></li>
    <li>Descripción personal: <?php echo $desc_personal ?></li>
</ul>
