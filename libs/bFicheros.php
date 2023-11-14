<?php

function escribirLogLogin(string $correo, string $contrasenya){
    if ($file2 = fopen("../assets/txt/logLogin.txt", "a")) {

        fwrite($file2, "Correo: $correo" . PHP_EOL);
        fwrite($file2, "Contraseña: $contrasenya" . PHP_EOL);
        fwrite($file2, "Fecha: " . date('Y-m-d H.i.s') . PHP_EOL);
        fwrite($file2, "-----" . PHP_EOL);
    }
    fclose($file2);
}

function usuarioExiste_v2(string $correo, string $contrasenya, array &$errores)
{
    if ($file = fopen("../assets/txt/usuarios.txt", "r")) {
        fgets($file);
        while (!feof($file)) {
            $linea = fgets($file);
            $correoTemp = trim(explode(":", $linea)[1]);
            if ($correoTemp == $correo) {
                $linea = fgets($file);
                $contrTemp = trim(explode(":", $linea)[1]);
                if ($contrTemp == $contrasenya) {
                    return true;
                } else {
                    $errores["contrasenya"] = "Contrasenya incorrecta";
                    return false;
                }
            } else {
                fgets($file);
                fgets($file);
                fgets($file);
                fgets($file);
            }

        }
        $errores["correo"] = "Correo incorrecto";
        fclose($file);
        return false;
    }
}

function registrarAltaServicio(string $servicio, string $categoria, string $descripcion, string $tipoPago, string $ubicacion, array $disponibilidades, string $img){
    if($file = fopen("../assets/txt/servicios.txt","a+")){
        fwrite($file,"Servicio:$servicio".PHP_EOL);
        fwrite($file,"Categoria:$categoria".PHP_EOL);
        fwrite($file,"Descripcion:$descripcion".PHP_EOL);
        fwrite($file,"Tipo de pago:$tipoPago".PHP_EOL);
        fwrite($file,"Ubicacion:$ubicacion".PHP_EOL);
        fwrite($file,"Disponibilidades:");
        foreach($disponibilidades as $d){
            fwrite($file," $d ");
        }
        fwrite($file,"".PHP_EOL);
        fwrite($file,"Img:$img".PHP_EOL);
        fwrite($file,"------".PHP_EOL);
        fclose($file);
    }
}

function registrarUsuario(string $correo, string $passw, string $fecha_de_nacimiento){
    $id = uniqid();

    if ($file = fopen("../assets/txt/usuarios.txt", "a+")) {
        echo $file;
        fwrite($file, "ID: $id" . PHP_EOL);
        fwrite($file, "Correo: $correo" . PHP_EOL);
        fwrite($file, "Contraseña: $passw" . PHP_EOL);
        fwrite($file, "Fecha: $fecha_de_nacimiento" . PHP_EOL);
        fwrite($file, "-----" . PHP_EOL);
        fclose($file);

    }
}

?>