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

    $con = "SELECT nombre FROM acceso WHERE nombre = ?";
    $query = $cnx->prepare($con);
    $query -> bindParam(1,$name);
    if($query->execute()){
        if($query->rowCount() >=1 ){
            echo'<script type="text/javascript">
            alert("Ya existe un usuario con el mismo nombre.");window.location.href="main.php?id=7";</script>';
            return false;
        }else{
            $sql = "INSERT INTO acceso(nombre,password,id_rol) VALUES (?,?,?)";
            $quer = $cnx->prepare($sql);
            $quer -> bindParam(1,$name);
            $encriptar = password_hash($contra,PASSWORD_BCRYPT);
            $quer -> bindParam(2,$encriptar);
            $quer -> bindParam(3,$rol);
            if($quer->execute()){
                if(isset($_SESSION["nombre"])){
                    header("Location: main.php?id=7");
                }else{
                    header("admin.php");
                }
            }else{
                header("Location: ../admin.php");
            }
        }
    }
}catch(PDOException $ex){
    die($ex->getMessage());
}


?>
