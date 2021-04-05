<?php
include "config/conexion.php";
class selectNoticia{
    public $cnx;
    function  __construct(){
        $this->cnx = conexion::conectarDB();
    }
    function paginador($id,$tabla,$recibido){
        $cantidad_pagina  = 9;
        if($recibido == 1){
            $pagina = 1;
        }else{
            $pagina = $recibido;
        }
        $inicio = ($pagina-1)*$cantidad_pagina;
        $sql = "SELECT $id FROM $tabla";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            $num_registro = $query->rowCount();
            $total_pag = ceil($num_registro/$cantidad_pagina); //Total paginas
            return array($inicio,$cantidad_pagina,$total_pag,$num_registro);
        }
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
        $random2 = $this->numberRandom("noticia",$categoria);
        $random3 = $this->numberRandom("noticia",$categoria);
        $random4 = $this->numberRandom("noticia",$categoria);
        $random5 = $this->numberRandom("noticia",$categoria);
        $random6 = $this->numberRandom("noticia",$categoria);

        $sql = "SELECT A.id_noticia,A.titulo,A.fecha,A.fotografia FROM noticia A INNER JOIN categoria B ON A.id_categoria = B.id_categoria WHERE A.id_noticia = ? OR A.id_noticia = ? OR A.id_noticia = ? OR A.id_noticia = ? OR A.id_noticia = ? OR A.id_noticia = ? AND A.id_noticia != ? AND B.nombre = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$random1);
        $query -> bindParam(2,$random2);
        $query -> bindParam(3,$random3);
        $query -> bindParam(4,$random4);
        $query -> bindParam(5,$random5);
        $query -> bindParam(6,$random6);
        $query -> bindParam(7,$id);
        $query -> bindParam(8,$categoria);
        if($query->execute()){
            return $query;
        }
    }

    function mainNoticia($recibido){
        $paginador = $this->paginador("id_noticia","noticia",$recibido);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT A.id_noticia,A.titulo,A.fotografia,A.fecha,A.entrada,B.nombre as periodista FROM noticia A INNER JOIN acceso B ON A.id_acceso = B.id_acceso ORDER BY A.id_noticia DESC LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    
}
?>