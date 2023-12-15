<?php
// NO TOCAR
include_once("../libs/config.php");
$pdo = new PDO("mysql:host=".$db_hostname.";dbname=".$db_nombre."",$db_usuario,$db_clave);
$pdo -> exec("set names utf8");
$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>