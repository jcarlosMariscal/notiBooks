<?php
include "config/conexion.php";
class selectResultado{
    public $cnx;
    function __construct(){
        $this->cnx = conexion::conectarDB();
    }

    function getIDTable($id,$tabla){
        $sql = "SELECT nombre FROM $tabla WHERE id_$tabla = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            return $query;
        }
    }
    function libro($buscar,$idTabla,$tablaRelacion,$tablaDestino){
        $sql = "SELECT A.ISBN,A.titulo,A.fecha_publi,A.portada,D.nombre as editorial FROM libro A INNER JOIN $tablaRelacion B ON A.ISBN = B.ISBN INNER JOIN $tablaDestino C ON B.$idTabla = C.$idTabla INNER JOIN editorial D ON A.id_editorial = D.id_editorial WHERE C.nombre LIKE '%$buscar%'";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function getGenero($ISBN){
        $sql = "SELECT GROUP_CONCAT(C.nombre SEPARATOR ', ') FROM libro A INNER JOIN libro_genero B ON A.ISBN = B.ISBN INNER JOIN genero C ON B.id_genero = C.id_genero WHERE A.ISBN = ?";
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

    function getBookEditorial($editorial){
        $sql = "SELECT A.ISBN,A.titulo,A.fecha_publi,A.portada,B.nombre as editorial FROM libro A INNER JOIN editorial B ON A.id_editorial = B.id_editorial WHERE B.nombre LIKE '%$editorial%'";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }

    function getNameBook($name){
        $sql = "SELECT A.ISBN,A.titulo,A.fecha_publi,A.portada,B.nombre as editorial FROM libro A INNER JOIN editorial B ON A.id_editorial = B.id_editorial WHERE A.titulo LIKE '%$name%'";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }

    function getNoticia($periodista){
        $sql = "SELECT A.titulo,A.fotografia,A.fecha,B.nombre,A.id_noticia FROM noticia A INNER JOIN acceso B ON A.id_acceso = B.id_acceso WHERE B.id_acceso = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$periodista);
        if($query->execute()){
            return $query;
        }
    }
    function getPeriodista($periodista){
        $sql = "SELECT nombre FROM acceso WHERE id_acceso = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$periodista);
        if($query->execute()){
            return $query;
        }
    }
}
?>