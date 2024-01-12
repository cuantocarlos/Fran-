<?php
//Aquí iran las funciones relacionadas con la BBDD
function insertarToken($correo)
{
    //genero el token que vamos a introducir
    $token = uniqid();
    $validez = time() * 24 * 60 * 60;
    $id_user = sacarID_Usuario($correo);
    try {
        //ponemos el token en la BBDD
        include "conexion.php";
        $stmt = $pdo->prepare("INSERT INTO tokens (token, validez, id_user) VALUES(:token, :validez, :id_user)");
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":validez", $validez);
        $stmt->bindParam(":id_user", $id_user);
        if ($stmt->execute()) {
            return $token; //devolvemos el token
        }
    } catch (\Throwable $th) {
    }
    $pdo = null;
    //sin comprobar
}

function sacarID_Usuario($correo)
{
    $consulta = "SELECT id_user FROM usuario WHERE email=:correo";
    try {
        include "conexion.php";
        $resultado = $pdo->prepare($consulta);
        if ($resultado->execute(array(":correo" => $correo))) {
            return $row["id_user"];
        }
    } catch (PDOException $e) {
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
    }
    $pdo = null;
}
function selectID_UserFromToken($token)
{
    $consulta = "SELECT id_user FROM tokens WHERE token=:token";
    try {
        include "conexion.php";
        $resultado = $pdo->prepare($consulta);
        if ($resultado->execute(array(":token" => $token))) {
            return $row["id_user"];
        }
        return false;
    } catch (PDOException $e) {
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
    }
    $pdo = null;
} //falta comprobar tiempo

function activarCuenta($id_user)
{
    $consulta = "UPDATE usuario SET activo = 1 WHERE id_user =:id_user";
    try {
        include "conexion.php";
        $resultado = $pdo->prepare($consulta);
        if ($resultado->execute(array(":id_user" => $id_user))) {
            return true;
        }
        return false;
    } catch (PDOException $e) {
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
    }
    $pdo=null;
}

function usuarioExiste(string $correo)
{
    $consulta = "SELECT * FROM 'usuario' WHERE 'email' =  :correo";
    $stmt = $pdo->prepare($consulta);
    $stmt->bindParam(":correo", $correo);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
}

function registrarUsuario($nombre, $email, $pass, $f_nacimiento, $foto_perfil, $descripcion, $nivel, $activo)
{
    try {
        include "conexion.php";
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
            $token = insertarToken($email);
            include ("../enviarMail.php");
            header("location:../php/sanitLogin.php");
        } else {
            echo ""; //Llevar a otro sitio
            header("location:../php/sanitRegistro.php");
        }
    } catch (PDOException $e) {
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
    }
    $pdo = null;
}

function insertarServicio($titulo, $id_user, $descripcion, $precio, $tipo, $foto_servicio, &$errores)
{
    try {
        include "conexion.php";

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
        include "conexion.php";

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
    $pdo = null;

}

function selectJSON($tabla)
{
    $consulta = "SELECT * FROM $tabla";
    try {
        include "conexion.php";
        $resultado = $pdo->prepare($consulta);
        if ($resultado->execute()) {
            return json_encode($resultado->fetchAll(PDO::FETCH_ASSOC));
        }
    } catch (PDOException $e) {
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
    }
    $pdo = null;
}

function insertarDisponibilidad()
{
    try {
        include "conexion.php";
        $stmt = $pdo->prepare("INSERT INTO disponibilidad VALUES(:disponibilidad)");
        $stmt->bindParam(":disponibilidad", $disponibilidad);

        if ($stmt->execute()) {
            // Hacer algo
        } else {
            //Hacer otra cosa
        }

    } catch (PDOException $e) {
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
    }
    $pdo = null;
}

function deleteDB($tabla, $id)
{
    try {
        include "conexion.php";
        $stmt = $pdo->prepare("DELETE FROM $tabla WHERE id_$tabla=:id");
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            echo "Eliminado con exito";
        } else {
            echo "Fallo al eliminar";
        }

    } catch (PDOException $e) {
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
    }
    $pdo = null;
}

function insertDB($tabla, $valor)
{
    try {
        include "conexion.php";
        $stmt = $pdo->prepare("INSERT INTO $tabla ($tabla) VALUES (:valor)");
        $stmt->bindParam(":valor", $valor);

        if ($stmt->execute()) {
            echo "Añadido con exito";
        } else {
            echo "Fallo al insertar";
        }

    } catch (PDOException $e) {
        error_log($e->getMessage() . "###Codigo: " . $e->getCode() . " " . microtime() . PHP_EOL, 3, "../logBD.txt");
    }
    $pdo = null;
}

if (isset($_GET["ctl"])) {

    if ($_GET["ctl"] == "select") {
        echo selectJSON($_GET["tabla"]);
    }

    if ($_GET["ctl"] == "delete") {
        deleteDB($_GET["tabla"], $_GET["id"]);
    }

    if ($_GET["ctl"] == "insert") {
        insertDB($_GET["tabla"], $_GET["valor"]);
    }

}
