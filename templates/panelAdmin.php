<?php
session_start();
include("../libs/config.php");

cabecera("Panel de Administrador");
//controlAcceso();

echo '<label for="Tablas">Tablas: </label>';
pintaSelect(["disponibilidad", "idioma"], "tablas");


?>

<script>
    var select, table;
    window.onload = function () {
        select = document.getElementsByName("tablas")[0];
        table = document.createElement("table");
        imprimirTabla();
        select.onchange = imprimirTabla;
    }

    function imprimirTabla() {
        var peticion = new Request(
            "../libs/Modelo/modelo.php?ctl=" + select.value,
            { method: "get", }
        );

        fetch(peticion)
            .then(response => {
                if (response.ok) return response.json();
            })
            .then(json => {
                json = Object.entries(json);
                table.innerHTML="";
                table.style.width = "100px";
                table.style.border = "1px solid black";


                var rowTitulo = table.insertRow();
                var titulos =Object.entries(json[1][1]);
                titulos.forEach(element =>{
                    let cell = rowTitulo.insertCell();
                    cell.innerHTML = "<b>"+element[0]+"</b>";
                })

                json.forEach(element => {
                    let row = table.insertRow();
                    for (let key in element[1] ){
                        let cell = row.insertCell();
                        cell.innerHTML = element[1][key];
                    }
                });
                document.body.appendChild(table);

            });

    }
</script>
<?php

?>