<?php
require "../../config/conexion.php";
class eliminar{
    public $cnx;
    function __construct(){
        $this->cnx = conexion::conectarDB();
    }

    function eliminarNoticia($id){
        $sql = "DELETE FROM noticia WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query -> execute()){
            header("Location: ../main.php");
            return true;
        }
    }

    function eliminarCategoria($id){
        $sql = "DELETE FROM categoria WHERE id_categoria = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query -> execute()){
            header("Location: ../main.php?id=2");
            return true;
        }
    }

    function eliminarAcceso($id){
        $sql = "DELETE FROM acceso WHERE id_acceso = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            header("Location: ../main.php?id=7");
            return true;
        }
    }
    function eliminarAutor($id){
        $sql = "DELETE FROM autor WHERE id_autor = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            header("Location: ../main.php?id=6");
            return true;
        }
    }
    function eliminarEditorial($id){
        $sql = "DELETE FROM editorial WHERE id_editorial = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            header("Location: ../main.php?id=4");
            return true;
        }
    }
    function eliminarGenero($id){
        $sql = "DELETE FROM genero WHERE id_genero = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            header("Location: ../main.php?id=4");
            return true;
        }
    }
}
?>