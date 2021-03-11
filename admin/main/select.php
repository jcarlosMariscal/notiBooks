<?php
include "../config/conexion.php";
class select{
    public $cnx;
    function __construct(){
        $this->cnx = conexion::conectarDB();
    }

    function getNoticias($id_acceso){
        if($id_acceso == "todos"){
            $sql = "SELECT A.id_noticia,A.titulo,A.fecha, B.nombre FROM noticia A INNER JOIN categoria B ON A.id_categoria = B.id_categoria INNER JOIN acceso C ON A.id_acceso = C.id_acceso";
            $query = $this->cnx->prepare($sql);
            if($query -> execute()){
                return $query;
            }
        }
        $sql = "SELECT A.id_noticia,A.titulo,A.fecha, B.nombre FROM noticia A INNER JOIN categoria B ON A.id_categoria = B.id_categoria INNER JOIN acceso C ON A.id_acceso = C.id_acceso WHERE C.id_acceso = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id_acceso);
        if($query -> execute()){
            return $query;
        }
    }
    function getCategorias(){
        $sql = "SELECT * FROM categoria";
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
    function getLibros(){
        $sql = "SELECT A.ISBN,A.titulo,A.fecha_publi,B.nombre FROM libro A INNER JOIN editorial B ON A.id_editorial = B.id_editorial";
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
    function getAutores(){
        $sql = "SELECT * FROM autor";
        $query = $this->cnx->prepare($sql);
        if($query -> execute()){
            return $query;
        }
    }
    function getEditorial(){
        $sql = "SELECT * FROM editorial";
        $query = $this->cnx->prepare($sql);
        if($query -> execute()){
            return $query;
        }
    }
    function getGenero(){
        $sql = "SELECT * FROM genero";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function getAcceso(){
        $sql = "SELECT A.id_acceso,A.nombre,B.rol FROM acceso A INNER JOIN rol B ON A.id_rol = B.id_rol ORDER BY A.id_acceso";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
}
?>