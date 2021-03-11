<?php
session_start();
try{
    include "../config/conexion.php";
    $cnx = conexion::conectarDB();
    $name = $_POST['name'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM acceso WHERE nombre = ?";
    $query = $cnx->prepare($sql);
    $query -> bindParam(1,$name);
    if($query->execute()){
        foreach($query as $data){
            if(password_verify($password,$data['password'])){
                $_SESSION["nombre"] = $data;
                header("Location: main.php");
            }else{
                header("Location: ../admin.php");
            }
        }
    }
}catch(PDOException $ex){
    die($ex->getMessage());
}


?>
