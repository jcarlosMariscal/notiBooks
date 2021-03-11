<?php
include "config/conexion.php";
class selectNoticia{
    public $cnx;
    function  __construct(){
        $this->cnx = conexion::conectarDB();
    }
    function noticia($id){
        $sql = "SELECT A.titulo,A.entrada,A.cuerpo,A.fotografia,A.fecha,B.nombre as periodista,C.nombre as categoria,B.id_acceso as id_periodista FROM noticia A INNER JOIN acceso B ON A.id_acceso = B.id_acceso INNER JOIN categoria C ON A.id_categoria = C.id_categoria WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            return $query;
        }
    }

    function moreNoticia($categoria){
        $sql = "SELECT A.id_noticia,A.titulo,A.fecha,A.fotografia FROM noticia A INNER JOIN categoria B ON A.id_categoria = B.id_categoria WHERE B.nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$categoria);
        if($query->execute()){
            return $query;
        }
    }

    function mainNoticia(){
        $sql = "SELECT A.id_noticia,A.titulo,A.fotografia,A.fecha,A.entrada,B.nombre as periodista FROM noticia A INNER JOIN acceso B ON A.id_acceso = B.id_acceso ORDER BY A.id_noticia DESC";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    
}
?>