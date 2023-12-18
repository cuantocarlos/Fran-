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
            "../libs/Modelo/modelo.php?ctl=select&tabla="+select.value,
            { method: "get", }
        );

        fetch(peticion)
            .then(response => {
                if (response.ok) return response.json();
            })
            .then(json => {
                table.innerHTML="";
                if(json[0] == undefined) return;
                json = Object.entries(json);
                table.style.width = "100px";
                table.style.border = "1px solid black";


                var rowTitulo = table.insertRow();
                var titulos =Object.entries(json[0][1]);
                titulos.forEach(element =>{
                    let cell = rowTitulo.insertCell();
                    cell.innerHTML = "<b>"+element[0]+"</b>";
                })

                json.forEach(element => {
                    let row = table.insertRow();
                    let cell;
                    for (let key in element[1] ){
                        cell = row.insertCell();
                        cell.innerHTML = element[1][key];
                    }
                    cell = row.insertCell();
                    let btn = document.createElement("button");
                    btn.innerText = "x";
                    btn.onclick = eliminarBD;
                    btn.id = element[1]["id_"+select.value];
                    cell.appendChild(btn);
                });
                document.body.appendChild(table);

            });

    }

    function eliminarBD(){
        var peticion = new Request(
            "../libs/Modelo/modelo.php?ctl=delete&tabla="+select.value+"&id="+this.id,
            { method: "get", }
        );

        fetch(peticion)
            .then(response => {
                if (response.ok) imprimirTabla();
            })
        }

</script>
<?php

?>