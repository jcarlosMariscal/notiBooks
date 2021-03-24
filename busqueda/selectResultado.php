<?php
include "config/conexion.php";
class selectResultado{
    public $cnx;
    function __construct(){
        $this->cnx = conexion::conectarDB();
    }

    function paginador($tabla,$recibido,$buscar){
        $cantidad_pagina  = 1;
        if($recibido == 1){
            $pagina = 1;
        }else{
            $pagina = $recibido;
        }
        $inicio = ($pagina-1)*$cantidad_pagina;
        if($tabla == "libro"){
            $sql = "SELECT A.ISBN FROM libro A INNER JOIN autor_libro B ON A.ISBN = B.ISBN INNER JOIN autor C ON B.id_autor = C.id_autor WHERE C.nombre LIKE '%$buscar%'";
            $query = $this->cnx->prepare($sql);
        }elseif($tabla == "editorial"){
            $sql = "SELECT A.ISBN FROM libro A INNER JOIN editorial B ON A.id_editorial = B.id_editorial WHERE B.nombre LIKE '%$buscar%'";
            $query = $this->cnx->prepare($sql);
        }elseif($tabla == "genero"){
            $sql = "SELECT A.ISBN FROM libro A INNER JOIN libro_genero B ON A.ISBN = B.ISBN INNER JOIN genero C ON B.id_genero = C.id_genero WHERE C.nombre LIKE '%$buscar%'";
            $query = $this->cnx->prepare($sql);
        }elseif($tabla == "libroName"){
            $sql = "SELECT ISBN FROM libro WHERE titulo LIKE '%$buscar%'";
            $query = $this->cnx->prepare($sql);
        }elseif($tabla == "periodista"){
            $sql = "SELECT A.titulo FROM noticia A INNER JOIN acceso B ON A.id_acceso = B.id_acceso WHERE B.id_acceso = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$buscar);
        }
        if($query->execute()){
            $num_registro = $query->rowCount();
            // echo "Esto desde select: ".$num_registro;
            $total_pag = ceil($num_registro/$cantidad_pagina); //Total paginas
            return array($inicio,$cantidad_pagina,$total_pag,$num_registro);
        }
    }

    function getIDTable($id,$tabla){
        $sql = "SELECT nombre FROM $tabla WHERE id_$tabla = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            return $query;
        }
    }
    function libro($buscar,$idTabla,$tablaRelacion,$tablaDestino,$recibido){
        if($tablaDestino == "autor"){
            $paginador = $this->paginador("libro",$recibido,$buscar);
        }elseif($tablaDestino == "genero"){
            $paginador = $this->paginador("genero",$recibido,$buscar);
        }
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT A.ISBN,A.titulo,A.fecha_publi,A.portada,D.nombre as editorial FROM libro A INNER JOIN $tablaRelacion B ON A.ISBN = B.ISBN INNER JOIN $tablaDestino C ON B.$idTabla = C.$idTabla INNER JOIN editorial D ON A.id_editorial = D.id_editorial WHERE C.nombre LIKE '%$buscar%' LIMIT $inicio,$cantidad_pagina";
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

    function getBookEditorial($buscar,$recibido){
        $paginador = $this->paginador("editorial",$recibido,$buscar);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT A.ISBN,A.titulo,A.fecha_publi,A.portada,B.nombre as editorial FROM libro A INNER JOIN editorial B ON A.id_editorial = B.id_editorial WHERE B.nombre LIKE '%$buscar%' LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }

    function getNameBook($buscar,$recibido){
        $paginador = $this->paginador("libroName",$recibido,$buscar);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT A.ISBN,A.titulo,A.fecha_publi,A.portada,B.nombre as editorial FROM libro A INNER JOIN editorial B ON A.id_editorial = B.id_editorial WHERE A.titulo LIKE '%$buscar%' LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }

    function getNoticia($periodista,$recibido){
        $paginador = $this->paginador("periodista",$recibido,$periodista);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT A.titulo,A.fotografia,A.fecha,B.nombre,A.id_noticia FROM noticia A INNER JOIN acceso B ON A.id_acceso = B.id_acceso WHERE B.id_acceso = ? LIMIT $inicio,$cantidad_pagina";
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