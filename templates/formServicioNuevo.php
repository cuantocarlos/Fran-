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
    <input type="text" id="titulo" name="titulo"required><br>

    <label for="categoria" name="categoria">Categorias profesionales</label><br>
        <?php
        $categoriasValidas = ["IT","Fontaneria","Electricidad","Chofer","Traductor"];
        pintaSelect($categoriasValidas,"categoria");
        ?>
    <br>

    <label for="descripcion">Describe detalladamente el servicio que ofreces</label>
    <input type="text" name="descripcion" id="descripcion" required>

    <label for="tipoPago">Prefieres intercambiar tus servicios por otros o pago por servicio</label>
    <?php
        $tipoPago = ["Intercambio","Pago"];
        pintaRadio($tipoPago,"tipoPago");
    ?>

    <label for="precio_por_hora">Precio por hora (opcional): </label>
    <input type="number" id="precio_por_hora" name="precio_por_hora" step="0.01"><br>

    <label for="ubicacion">Ubicació<nav></nav>: </label>
    <input type="text" id="ubicacion" name="ubicacion" required><br>

    <label for="disponibilidad">Marca una o varias casillas con tu disponibilidad</label>
    <?php
        $disponibilidadesValidas = ["Mañanas","Tardes","Noches","Completa","Fines de semana"];
        pintaCheckbox($disponibilidadesValidas,"disponibilidad");
    ?>

    <label for="fotoServicio">¿Deseas subir alguna foto de tus servicios?</label>
    <input type="file" name="fotoServicio" id="fotoServicio">

</form>
<!--
hay que quitar los idiomas de ahi, estan en config.php y no se muestra la mitad 
falta hacer que algunos sean + sean requeridos mirar enunciado
-->