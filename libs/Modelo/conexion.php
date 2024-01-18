<?php
// NO TOCAR


$db_hostname = "localhost";
$db_nombre = "evaluable_7w";
$db_usuario = "root";
$db_clave = "";


$pdo = new PDO("mysql:host=".$db_hostname.";dbname=".$db_nombre."",$db_usuario,$db_clave);
$pdo -> exec("set names utf8");
$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>