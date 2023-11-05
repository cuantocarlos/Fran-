<?php

function pintaRadio(array $array, string $grupo){
    for ($i = 0; $i < count($array); $i++) {
        echo "<input type=\"radio\" name=\"$grupo\" value=\"$array[$i]\"> $array[$i] <br>";
    }

}

function pintaCheck(array $array, string $grupo){
    for ($i = 0; $i < count($array); $i++) {
        echo "<input type=\"checkbox\" name=\"" . $grupo . "[]\" value=\"$array[$i]\"> $array[$i] <br>";
    }
}

function pintaSelect(array $array, string $nombreGrupo){//hay que pasarle un array de opciones y el nombre del desplegable
    echo "<select name=\"$nombreGrupo\">";
    for ($i = 0; $i < count($array); $i++) {
        echo "<option value=\"$array[$i]\">$array[$i]</option>";
    }
    echo "</select>";

}
