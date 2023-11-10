<?php
require "../libs/config.php";

cabecera("Iniciar sesión");
//array donde almacenaremos el texto de los errores encontrados
$errores = [];
$correo = "";
$contrasenya = "";
if (!isset($_REQUEST['bAceptar'])) {
    include "../templates/formLogin.php";
} else {
    $correo = recoge("correo");
    $contrasenya = recoge("contrasenya");
    cEmail($correo, "correo", $errores);
    cPass($contrasenya, "contrasenya", $errores);
    if (empty($errores)) {

        if($file=fopen("../assets/logLogin.txt","a+")){

            fwrite($file,">>>>>>>>>>>>".PHP_EOL);
            fwrite($file,"Correo: $correo".PHP_EOL);
            fwrite($file,"Contrase&nacute;a: $contrasenya".PHP_EOL);

            if($contrasenya!=recoge("contrasenya")){
                
                fwrite($file,"ERROR de autenticación".PHP_EOL);
                fwrite($file,"Fecha: ".time().PHP_EOL);
                fwrite($file,"<<<<<<<<<<<<<<<<<<<<".PHP_EOL);

            }  
            header("location:../templates/validLogin.php?correo=$correo&contrasenya=$contrasenya");  
        }
        
    }
    
}
pie();
//No se continuaría con la validación del login porque no se como va eso de la base de datos guardar la sesion, etc.