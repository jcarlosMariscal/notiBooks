<?php
include "config/conexion.php";
class selectLibro{
    public $cnx;
    function __construct(){
        $this->cnx = conexion::conectarDB();
    }
    function numberRandom($table, $dato){
        if($table == "libro"){
            $sql = "SELECT ISBN as id FROM libro WHERE id_editorial = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$dato);
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

    function moreLibro($editorial,$ISBN){
        $random1 = $this->numberRandom("libro",$editorial);
        $random2 = $this->numberRandom("libro",$editorial);
        $random3 = $this->numberRandom("libro",$editorial);
        $random4 = $this->numberRandom("libro",$editorial);
        $sql = "SELECT ISBN,titulo,portada,id_editorial FROM libro WHERE id_editorial = ? AND ISBN = ? OR ISBN = ? OR ISBN = ? OR ISBN = ? AND ISBN != ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$editorial);
        $query -> bindParam(2,$random1);
        $query -> bindParam(3,$random2);
        $query -> bindParam(4,$random3);
        $query -> bindParam(5,$random4);
        $query -> bindParam(6,$ISBN);
        if($query->execute()){
            return $query;
        }
    }

    function moreNoticia(){
        $categoria = "Libros";
        $random1 = $this->numberRandom("noticia",$categoria);
        $random2 = $this->numberRandom("noticia",$categoria);
        $random3 = $this->numberRandom("noticia",$categoria);
        $random4 = $this->numberRandom("noticia",$categoria);
        $random5 = $this->numberRandom("noticia",$categoria);
        $random6 = $this->numberRandom("noticia",$categoria);
        $sql = "SELECT A.id_noticia,A.titulo,A.fecha,A.fotografia FROM noticia A INNER JOIN categoria B ON A.id_categoria = B.id_categoria WHERE B.nombre = ? AND A.id_noticia = ? OR A.id_noticia = ? OR A.id_noticia = ? OR A.id_noticia = ? OR A.id_noticia = ? OR A.id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$categoria);
        $query -> bindParam(2,$random1);
        $query -> bindParam(3,$random2);
        $query -> bindParam(4,$random3);
        $query -> bindParam(5,$random4);
        $query -> bindParam(6,$random5);
        $query -> bindParam(7,$random6);
        if($query->execute()){
            return $query;
        }
    }

    function paginador($id,$tabla,$recibido){
        $cantidad_pagina  = 15;
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
    function mainBook($recibido){
        $paginador = $this->paginador("ISBN","libro",$recibido);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT A.ISBN, A.titulo,A.portada,A.fecha_publi,B.nombre as editorial FROM libro A INNER JOIN editorial B ON A.id_editorial = B.id_editorial ORDER BY A.titulo ASC LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
}
?>