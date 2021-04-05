<?php
include "../config/conexion.php";
class select{
    public $cnx;
    function __construct(){
        $this->cnx = conexion::conectarDB();
    }
    function paginador($tabla,$recibido,$id_acceso){
        $cantidad_pagina  = 18;
        if($recibido == 1){
            $pagina = 1;
        }else{
            $pagina = $recibido;
        }
        $inicio = ($pagina-1)*$cantidad_pagina;
        if($tabla == "noticia"){
            if($id_acceso == "todos"){
                $sql = "SELECT id_noticia FROM noticia";
                $query = $this->cnx->prepare($sql);
            }else{
                $sql = "SELECT A.id_noticia FROM noticia A INNER JOIN categoria B ON A.id_categoria = B.id_categoria INNER JOIN acceso C ON A.id_acceso = C.id_acceso WHERE C.id_acceso = ?";
                $query = $this->cnx->prepare($sql);
                $query -> bindParam(1,$id_acceso);
            }
        }elseif($tabla == "categoria"){
            $sql = "SELECT * FROM categoria";
            $query = $this->cnx->prepare($sql);
        }elseif($tabla == "libro"){
            $sql = "SELECT ISBN FROM libro";
            $query = $this->cnx->prepare($sql);
        }elseif($tabla == "autor"){
            $sql = "SELECT id_autor FROM autor";
            $query = $this->cnx->prepare($sql);
        }elseif($tabla == "editorial"){
            $sql = "SELECT * FROM editorial";
            $query = $this->cnx->prepare($sql);
        }elseif($tabla == "genero"){
            $sql = "SELECT * FROM genero";
            $query = $this->cnx->prepare($sql);
        }elseif($tabla == "acceso"){
            $sql = "SELECT A.id_acceso FROM acceso A INNER JOIN rol B ON A.id_rol = B.id_rol ORDER BY A.id_acceso";
            $query = $this->cnx->prepare($sql);
        }

        if($query->execute()){
            $num_registro = $query->rowCount();
            $total_pag = ceil($num_registro/$cantidad_pagina); //Total paginas
            return array($inicio,$cantidad_pagina,$total_pag,$num_registro);
        }
    }
    function getNoticias($id_acceso,$recibido){
        $paginador = $this->paginador("noticia",$recibido,$id_acceso);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        if($id_acceso == "todos"){
            $sql = "SELECT A.id_noticia,A.titulo,A.fecha, B.nombre FROM noticia A INNER JOIN categoria B ON A.id_categoria = B.id_categoria INNER JOIN acceso C ON A.id_acceso = C.id_acceso ORDER BY A.id_noticia ASC LIMIT $inicio,$cantidad_pagina";
            $query = $this->cnx->prepare($sql);
            if($query -> execute()){
                return $query;
            }
        }
        $sql = "SELECT A.id_noticia,A.titulo,A.fecha, B.nombre FROM noticia A INNER JOIN categoria B ON A.id_categoria = B.id_categoria INNER JOIN acceso C ON A.id_acceso = C.id_acceso WHERE C.id_acceso = ? ORDER BY A.id_noticia ASC LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_acceso);
        if($query -> execute()){
            return $query;
        }
    }
    function getCategorias($recibido){
        $paginador = $this->paginador("categoria",$recibido,null);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT * FROM categoria LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query -> execute()){
            return $query;
        }
    }

    function getPeriodistas(){
        $rol = 1;
        $sql = "SELECT id_acceso,nombre FROM acceso WHERE id_rol = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$rol);
        if($query -> execute()){
            return $query;
        }
    }
    function getPeriodistaID($id){
        $rol = 1;
        $sql = "SELECT id_acceso,nombre FROM acceso WHERE id_rol = ? AND id_acceso = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$rol);
        $query -> bindParam(2,$id);
        if($query -> execute()){
            return $query;
        }
    }
    function getLibros($recibido){
        $paginador = $this->paginador("libro",$recibido,null);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT A.ISBN,A.titulo,A.fecha_publi,B.nombre FROM libro A INNER JOIN editorial B ON A.id_editorial = B.id_editorial ORDER BY A.titulo ASC LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query -> execute()){
            return $query; 
        }
    }
    function getRol(){
        $sql = "SELECT * FROM rol";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function getAutores($recibido){
        $paginador = $this->paginador("autor",$recibido,null);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT * FROM autor LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query -> execute()){
            return $query;
        }
    }
    function getEditorial($recibido){
        $paginador = $this->paginador("editorial",$recibido,null);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT * FROM editorial LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query -> execute()){
            return $query;
        }
    }
    function getGenero($recibido){
        $paginador = $this->paginador("genero",$recibido,null);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT * FROM genero LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function getAcceso($recibido){
        $paginador = $this->paginador("acceso",$recibido,null);
        $inicio = $paginador[0];
        $cantidad_pagina = $paginador[1];
        $sql = "SELECT A.id_acceso,A.nombre,B.rol FROM acceso A INNER JOIN rol B ON A.id_rol = B.id_rol ORDER BY A.id_acceso LIMIT $inicio,$cantidad_pagina";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function getGeneroID($ISBN){
        $sql = "SELECT GROUP_CONCAT(C.nombre SEPARATOR ', ') as nombre FROM libro A INNER JOIN libro_genero B ON A.ISBN = B.ISBN INNER JOIN genero C ON B.id_genero = C.id_genero WHERE A.ISBN = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        if($query->execute()){
            return $query;
        }
        
    }

    function getAutorID($ISBN){
        $sql = "SELECT GROUP_CONCAT(C.nombre SEPARATOR ', ') as nombre FROM libro A INNER JOIN autor_libro B ON A.ISBN = B.ISBN INNER JOIN autor C ON B.id_autor = C.id_autor WHERE A.ISBN = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        if($query->execute()){
            return $query;
        }
    }
}
?>