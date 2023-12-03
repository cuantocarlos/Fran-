<?php
/*
Teneis que comprobar que las escrituras han ido bien.
todas las funciones deben devolver algo en todas sus "salidas"
A estas funciones siempre le pasamos el fichero por parámetro, no lo dejamos fijo en el código
*/

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
/*
Mejor montarlo todo en un string y lanzar solo un fwrite. Aunque le incluyamos los saltos de línea al string
*/

function registrarAltaServicio(string $servicio, string $categoria, string $descripcion, string $tipoPago, string $precio_por_hora, string $ubicacion, array $disponibilidades, string $img){
    if($file = fopen("../assets/txt/servicios.txt","a+")){
        fwrite($file,"Servicio:$servicio".PHP_EOL);
        fwrite($file,"Categoria:$categoria".PHP_EOL);
        fwrite($file,"Descripcion:$descripcion".PHP_EOL);
        fwrite($file,"Tipo de pago:$tipoPago".PHP_EOL);
        if($precio_por_hora != "") fwrite($file,"Precio por hora:$precio_por_hora".PHP_EOL);
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

function mostrarServicios(){
    if($file = fopen("../assets/txt/servicios.txt","r")){
        while(!feof($file)){
            echo fgets($file);
            echo "<br>";
    }
    fclose($file);
}
}

function mostrarTitulos(){

    if($file = fopen("../assets/txt/servicios.txt","r")){
        while(!feof($file)){
            $linea = fgets($file);
            if(explode(":",$linea)[0] == "Servicio"){
                echo explode(":",$linea)[1];
                echo "<br>";

            }

        }
    }
}
function cambiarPasw(string $new_pass){ //Supongo que le faltarán parámetros xd
    $id = $_SESSION['id'];

    // Abro el archivo de usuarios en modo lectura
            $arxivoUsuarios = fopen("../assets/txt/usuarios.txt", "r");
    
    // Verifico si se pudo abrir el archivo correctamente
            if ($arxivoUsuarios) {
                // Abro un archivo temporal en modo escritura
                $arxivoTemporal = fopen("../assets/txt/usuarios_temp.txt", "w");
    
                // Verifico si se pudo abrir el archivo temporal correctamente
                if ($arxivoTemporal) {
                    // Recorro el archivo de usuarios línea por línea
                    while (!feof($arxivoUsuarios)) {
                        // Leo una línea del archivo
                        $linea = fgets($arxivoUsuarios);
    
                        // Verifico si la línea contiene el ID del usuario
                        if (strstr($linea, "ID: $id")) {
                            // Cojo los datos viejos
                            $lineaOldPass = fgets($arxivoUsuarios);
                            // Meto los nuevos datos
                            $lineaNewPass = "Contraseña: $new_pass" . PHP_EOL;
                            // Escribo los nuevos datos en el archivo temporal
                            fwrite($arxivoTemporal, $linea);
                            fwrite($arxivoTemporal, $lineaNewPass);
                        } else {
                            // Si no es la línea del usuario a modificar, la escribo tal cual en el archivo temporal
                            fwrite($arxivoTemporal, $linea);
                        }
                    }
    
                    // Cierro los archivos
                    fclose($arxivoUsuarios);
                    fclose($arxivoTemporal);
    
                    // Renombro el archivo temporal al original
                    rename("../assets/txt/usuarios_temp.txt", "../assets/txt/usuarios.txt");
                } else {
                    // Manejar el error al abrir el archivo temporal
                    echo "Error al abrir el archivo temporal.";
                }
            } else {
                // Manejar el error al abrir el archivo de usuarios
                echo "Error al abrir el archivo de usuarios.";
            }
    
}


?>
