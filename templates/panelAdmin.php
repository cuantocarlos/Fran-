<?php   
session_start();
include("../libs/config.php");

cabecera("Panel de Administrador");
//controlAcceso();

echo '<label for="Tablas">Tablas: </label>';
pintaSelect(["disponibilidad","idioma"],"tablas");


?>

<script>
    var select, table;
    window.onload =function(){
        select = document.getElementsByName("tablas")[0];

        select.onchange = imprimirTabla;
    }

    function imprimirTabla(){
        var peticion = new Request(
            "../libs/Modelo/modelo.php?ctl="+select.value,
            {method:"get",}
        );

        fetch(peticion)
        .then(response =>{
            if(response.ok) return response.json();
        })
        .then(json =>{
            table = document.createElement("table");
            table.style.width = "100px";
            table.style.border = "1px solid black";
            
            json =Object.entries(json);
            console.log(json);
            json.forEach(element => {
            
            });

        });

    }
</script>
<?php

?>