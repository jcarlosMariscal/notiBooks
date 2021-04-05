<?php
require "../../config/conexion.php";
class eliminar{
    public $cnx;
    function __construct(){
        $this->cnx = conexion::conectarDB();
    }

    function validar($tabla,$buscar){
        if($tabla == "autor"){
            $sql = "SELECT A.ISBN FROM libro A INNER JOIN autor_libro B ON A.ISBN = B.ISBN INNER JOIN autor C ON B.id_autor = C.id_autor WHERE C.id_autor = ?";
        }else if($tabla == "editorial"){
            $sql = "SELECT ISBN FROM libro WHERE id_editorial = ?";
        }else if($tabla == "genero"){
            $sql = "SELECT A.ISBN FROM libro A INNER JOIN libro_genero B ON A.ISBN = B.ISBN INNER JOIN genero C ON B.id_genero = C.id_genero WHERE C.id_genero = ?";
        }else if($tabla == "categoria"){
            $sql = "SELECT id_noticia FROM noticia WHERE id_categoria = ?";
        }
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$buscar);
        if($query->execute()){
            if($query->rowCount() >= 1){
                return true;
            }else{
                return false;
            }
        }
    }

    function eliminarNoticia($id){
        $sql = "DELETE FROM noticia WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        $query -> execute();
    }

    function eliminarCategoria($id){
        $sql = "DELETE FROM categoria WHERE id_categoria = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query -> execute()){
            return true;
        }
    }

    function eliminarAcceso($id){
        $sql = "DELETE FROM acceso WHERE id_acceso = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
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
    function getAutorID($autor){
        $sql = "SELECT id_autor FROM autor WHERE nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$autor);
        if($query->execute()){
            foreach($query as $data){
                $id_autor = $data['id_autor'];
            }
            return $id_autor;
        }
    }
    function getGeneroID($autor){
        $sql = "SELECT id_genero FROM genero WHERE nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$autor);
        if($query->execute()){
            foreach($query as $data){
                $id_genero = $data['id_genero'];
            }
            return $id_genero;
        }
    }
    function getTableID($id,$columna,$tabla){
        $sql = "SELECT $columna FROM $tabla WHERE id_$tabla = ?";
        $query = $this->cnx->prepare($sql);
        $query->bindParam(1,$id);
        if($query->execute()){
            foreach($query as $data){
                $titulo = $data["$columna"];
                // echo $titulo;
            }
            return $titulo;
        }
    }

    function eliminarAutLibro($ISBN,$autor){
        $id_autor = $this->getAutorID($autor);
        $sql = "DELETE FROM autor_libro WHERE ISBN = ? AND id_autor = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        $query -> bindParam(2,$id_autor);
        if($query->execute()){
            return true;
        }
    }
    function eliminarGenLibro($ISBN,$genero){
        $id_genero = $this->getGeneroID($genero);
        $sql = "DELETE FROM libro_genero WHERE ISBN = ? AND id_genero = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        $query -> bindParam(2,$id_genero);
        if($query->execute()){
            return true;
        }
    }

    function deleteGenero($ISBN){
        $sql = "DELETE FROM libro_genero WHERE ISBN = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        if($query->execute()){
            return true;
        }
    }
    function deleteAutor($ISBN){
        $sql = "DELETE FROM autor_libro WHERE ISBN = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        if($query->execute()){
            return true;
        }
    }
    function eliminarLibro($ISBN){
        $genero = $this->deleteGenero($ISBN);
        $autor = $this->deleteAutor($ISBN);
        if($genero && $autor){
            $sql = "DELETE FROM libro WHERE ISBN = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$ISBN);
            if($query->execute()){
                header("Location: ../main.php?id=3");
                return true;
            }
        }
    }
}
?>