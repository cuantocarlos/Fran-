<?php
//Aquí iran las funciones relacionadas con la BBDD

function insertarUsuario($nombre, $email, $pass, $f_nacimiento, $foto_perfil, $descripcion, $nivel, $activo){

    try{
        include("conexion.php");
        $stmt = $pdo -> prepare("INSERT INTO usuario (nombre, email, pass, f_nacimiento, foto_perfil, descripcion, nivel, activo) 
        values (:nombre, :email, :pass, :f_nacimiento, :foto_perfil, :descripcion, :nivel, :activo)");
        $stmt -> bindParam(":nombre",$nombre);
        $stmt -> bindParam(":email",$email);
        $stmt -> bindParam(":pass",$pass);
        $stmt -> bindParam(":f_nacimiento",$f_nacimiento);
        $stmt -> bindParam(":foto_perfil",$foto_perfil);
        $stmt -> bindParam(":descripcion",$descripcion);
        $stmt -> bindParam(":nivel",$nivel);
        $stmt -> bindParam(":activo",$activo);
        
        if($stmt -> execute()){
            echo "";//Llevar a algun sitio
        }else{
            echo "";//Llevar a otro sitio
        }
}catch(PDOException $e){
    error_log($e->getMessage()."###Codigo: ".$e->getCode()." ".microtime(). PHP_EOL,3,"logBD.txt");
}
$pdo = NULL;
}

function insertarServicio($titulo, $id_user, $descripcion, $precio, $tipo, $foto_servicio){
    try{
        include("conexion.php");
        $stmt = $pdo -> prepare("INSERT INTO servicios (titulo, id_user, descripcion, precio, tipo, foto_servicio) 
        values (:titulo, :id_user, :descripcion, :precio, :tipo, :foto_servicio)");
        $stmt -> bindParam(":titulo",$titulo);
        $stmt -> bindParam(":id_user",$id_user);
        $stmt -> bindParam(":descripcion",$descripcion);
        $stmt -> bindParam(":precio",$precio);
        $stmt -> bindParam(":tipo",$tipo);
        $stmt -> bindParam(":foto_servicio",$foto_servicio);

        if($stmt -> execute()){
            //hacer algo
        }else{
            //hacer otra cosa
        }

    }catch(PDOException $e){
        error_log($e->getMessage()."###Codigo: ".$e->getCode()." ".microtime() . PHP_EOL, 3, "logBD.txt");
    }
    $pdo = NULL;
}


?>