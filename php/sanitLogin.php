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

        if($file=fopen("../assets/txt/logLogin.txt","a+")){

            $usr=fopen("../assets/txt/usuarios.txt","r");
            
            while(!feof($usr)){
                $contenido=fgets($usr);
            }
            if($contenido==$contrasenya){
                fwrite($file, "Usuario Logueado" . PHP_EOL);
            }else{
                fwrite($file, "ERROR DE AUTENTICACION" . PHP_EOL);
            }
            }

        header("location:../templates/validLogin.php?correo=$correo&contrasenya=$contrasenya");  
    }
    
}
pie();
//No se continuaría con la validación del login porque no se como va eso de la base de datos guardar la sesion, etc.