<?php
session_start();
if (!isset($_SESSION["nombre"])){
        header("Location: ../admin.php");
    }
try{
    include "../config/conexion.php";
    $cnx = conexion::conectarDB();
    $name = $_POST['name'];
    $contra = $_POST['password'];
    $rol = $_POST['rol'];

    $sql = "INSERT INTO acceso(nombre,password,id_rol) VALUES (?,?,?)";
    $query = $cnx->prepare($sql);
    $query -> bindParam(1,$name);
    $encriptar = password_hash($contra,PASSWORD_BCRYPT);
    $query -> bindParam(2,$encriptar);
    $query -> bindParam(3,$rol);
    if($query->execute()){
        if(isset($_SESSION["nombre"])){
            header("Location: main.php?id=7");
        }else{
            header("admin.php");
        }
    }else{
        header("Location: ../admin.php");
    }
}catch(PDOException $ex){
    die($ex->getMessage());
}


?>
