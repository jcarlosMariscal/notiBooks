<?php
include "config/conexion.php";
class selectNoticia{
    public $cnx;
    function  __construct(){
        $this->cnx = conexion::conectarDB();
    }
    function noticia($id){
        $sql = "SELECT A.id_noticia,A.titulo,A.entrada,A.cuerpo,A.fotografia,A.fecha,B.nombre as periodista,C.nombre as categoria,B.id_acceso as id_periodista FROM noticia A INNER JOIN acceso B ON A.id_acceso = B.id_acceso INNER JOIN categoria C ON A.id_categoria = C.id_categoria WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            return $query;
        }
    }

    function numberRandom($table,$dato){
        if($table == "libro"){
            $sql = "SELECT ISBN as id FROM libro";
        }elseif($table == "noticia"){
            $sql = "SELECT A.id_noticia as id FROM noticia A INNER JOIN categoria B ON A.id_categoria = B.id_categoria WHERE B.nombre = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$dato);
        }
        if($query->execute()){
            $id = array();
            $i=0;
            while($datos = $query->fetch()){
                $id_table = $datos['id'];
                $id[$i] = $id_table;
                $random = $id[array_rand($id)];
                $i++;
            }
            return $random;
        }
    }

    function moreNoticia($categoria,$id){
        $random1 = $this->numberRandom("noticia",$categoria);

        $sql = "SELECT A.id_noticia,A.titulo,A.fecha,A.fotografia FROM noticia A INNER JOIN categoria B ON A.id_categoria = B.id_categoria WHERE A.id_noticia = ? AND A.id_noticia != ? AND B.nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$random1);
        $query -> bindParam(2,$id);
        $query -> bindParam(3,$categoria);
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