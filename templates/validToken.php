<?php
require "../libs/config.php";
cabecera("Validación cuenta");
$tokenURL = $_GET['token'];
$ID_user = selectID_UserFromToken($tokenURL);
if ($ID_user != false) {
    activarCuenta($ID_user);
}
pie()
?>
