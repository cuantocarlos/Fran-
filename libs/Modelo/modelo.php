<?php
//Aquí iran las funciones relacionadas con la BBDD

function registrarUsuario($nombre, $email, $pass, $f_nacimiento, $foto_perfil, $descripcion, $nivel, $activo)
{

    try {
        include("conexion.php");
        $stmt = $pdo->prepare("INSERT INTO usuario (nombre, email, pass, f_nacimiento, foto_perfil, descripcion, nivel, activo) 
        values (:nombre, :email, :pass, :f_nacimiento, :foto_perfil, :descripcion, :nivel, :activo)");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pass", $pass);
        $stmt->bindParam(":f_nacimiento", $f_nacimiento);
        $stmt->bindParam(":foto_perfil", $foto_perfil);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":nivel", $nivel);
        $stmt->bindParam(":activo", $activo);

        if ($stmt->execute()) {
            echo ""; //Llevar a algun sitio
            header("location:../php/sanitLogin.php");
        } else {
            echo ""; //Llevar a otro sitio
            header("location:../php/sanitRegistro.php");
        }
    } catch (PDOException $e) {
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
    }
    $pdo = NULL;
}
?>
<?php
function consultarServicios($pdo){

    include('libs\config.php');
    include('modelo\conexion.php');
    include('modelo\consultas.php');

    try{
    $cons="SELECT titulo, descripcion, precio, tipo, foto_servicio FROM servicios";

    if($res=$pdo->query($cons)){
        $arrayres=$res->fetchAll(PDO::FETCH_ASSOC);
        $res->closeCursor();
        $res=null;
        return $arrayres;

    }
    
    if(count($arrayres)===0){?>
    <p>No hay servicios</p>
    <?php
    }else {
        foreach ($arrayres as $row) {?> 
             Titulo: <a href="#"><?=$row['titulo']?></a> <br>
             Descripción: <?=$row['descripcion'] ?><br>
             Precio: <?=$row['precio']?><br>
             Tipo: <?=$row['tipo']?> <br>
             Foto de servicio: <?=$row['foto_servicio'] ?><br>
             <hr><br>
             <?
        }
    }
    }catch(PDOException $e){


        error_log($e->getMessage() . "##Código: " . $e->getCode()."  ". /*$fechaformatoddmmaaaa*/microtime()  . PHP_EOL, 3, "logBD.txt");
        // guardamos en ·errores el error que queremos mostrar a los usuarios
        $errores['datos'] = "Ha habido un error <br>";
    
    }
}
?>
<?php
function insertarServicio($titulo, $id_user, $descripcion, $precio, $tipo, $foto_servicio, &$errores)
{
    try {
        include("conexion.php");

        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO servicios (titulo, id_user, descripcion, precio, tipo, foto_servicio) 
        VALUES (:titulo, :id_user, :descripcion, :precio, :tipo, :foto_servicio)");
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":id_user", $id_user);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":foto_servicio", $foto_servicio);

        if ($stmt->execute()) {
            $pdo->commit();
            return true; // Insert successful
        } else {
            $pdo->rollBack();
            $errores = "Ha habido un problema en el registro";
            return false; // Insert failed
        }
    } catch (PDOException $e) {
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
        $pdo->rollBack();
        $errores = "Error en la base de datos. Por favor, contacte al administrador.";
        return false; // Exception caught
    } finally {
        $pdo = null;
    }
}

function insertarIdioma($idioma)
{
    try {
        include("conexion.php");

        $stmt = $pdo->prepare("INSERT INTO idioma (idioma) values (:idioma) ");
        $stmt->bindParam(":idioma", $idioma);

        if ($stmt->execute()) {
            //Hacer algo
        } else {
            //Hacer otra cosa
        }
    } catch (PDOException $e) {
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
    }
    $pdo = NULL;

}

function selectJSON($tabla){
    $consulta = "SELECT * FROM $tabla";
    try{
        include("conexion.php");
        $resultado = $pdo -> prepare($consulta);
        if($resultado -> execute()){
           return json_encode($resultado -> fetchAll(PDO::FETCH_ASSOC));
        }
    }catch (PDOException $e) {
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
    }
    $pdo = NULL;
}

function insertarDisponibilidad(){
    try{
        include("conexion.php");
        $stmt = $pdo -> prepare("INSERT INTO disponibilidad VALUES(:disponibilidad)");
        $stmt -> bindParam(":disponibilidad",$disponibilidad);

        if($stmt -> execute()){
            // Hacer algo
        }else{
            //Hacer otra cosa
        }

    }catch(PDOException $e){
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
    }
    $pdo = NULL;
}


if(isset($_GET["ctl"])){
    echo selectJSON($_GET["ctl"]);
}

consultarServicios($pdo);
?>