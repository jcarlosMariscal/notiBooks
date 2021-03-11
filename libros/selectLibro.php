<?php
include "config/conexion.php";
class selectLibro{
    public $cnx;
    function __construct(){
        $this->cnx = conexion::conectarDB();
    }

    function libro ($id){
        $sql = "SELECT A.ISBN,A.titulo,A.portada,A.prologo,A.fecha_publi, B.nombre as editorial,B.id_editorial as id_editorial FROM libro A INNER JOIN editorial B ON A.id_editorial = B.id_editorial WHERE ISBN = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            return $query;
        }
    }
    function getGenero($ISBN){
        $sql = "SELECT GROUP_CONCAT(C.nombre SEPARATOR ', ') as nombre,C.id_genero FROM libro A INNER JOIN libro_genero B ON A.ISBN = B.ISBN INNER JOIN genero C ON B.id_genero = C.id_genero WHERE A.ISBN = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        if($query->execute()){
            return $query;
        }
    }
    function getAutor($ISBN){
        $sql = "SELECT GROUP_CONCAT(C.nombre SEPARATOR ', ') as nombre FROM libro A INNER JOIN autor_libro B ON A.ISBN = B.ISBN INNER JOIN autor C ON B.id_autor = C.id_autor WHERE A.ISBN = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        if($query->execute()){
            return $query;
        }
    }

    function moreLibro($editorial){
        // $sql = "SELECT A.ISBN,A.titulo,A.portada FROM libro A INNER JOIN libro_genero B ON A.ISBN = B.ISBN INNER JOIN genero C ON B.id_genero = C.id_genero  WHERE C.id_genero = ?";
        $sql = "SELECT ISBN,titulo,portada,id_editorial FROM libro WHERE id_editorial = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$editorial);
        if($query->execute()){
            return $query;
        }
    }

    function moreNoticia(){
        $categoria = "libro";
        $sql = "SELECT A.id_noticia,A.titulo,A.fecha,A.fotografia FROM noticia A INNER JOIN categoria B ON A.id_categoria = B.id_categoria WHERE B.nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$categoria);
        if($query->execute()){
            return $query;
        }
    }

    function mainBook(){
        $sql = "SELECT A.ISBN, A.titulo,A.portada,A.fecha_publi,B.nombre as editorial FROM libro A INNER JOIN editorial B ON A.id_editorial = B.id_editorial ORDER BY A.titulo ASC";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
}
?>