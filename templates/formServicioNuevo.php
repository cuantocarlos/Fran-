<?php 
include "libs/bComponentes.php";
include "libs/config.php";
?>

<p>
    <?php
    
    foreach ($errores as $error) {
        echo "<br>Error: " . $error . "<br>";
    }
    ?>
</p>

<h2>Formulario Alta Servicio</h2>
<form action="" method="post" enctype="multipart/form-data">

    <label for="titulo">¿Qué ofreces?</label><br>
    <input type="text" id="titulo" name="titulo"><br>

    <label for="categoria" name="categoria"></label><br>
    
        <?php
        pintaSelect($categoriasValidas,"Categorias profesionales");
        ?>
    <br>



</form>

