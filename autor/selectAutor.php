<?php
include "config/conexion.php";
    class selectAutor{
        public $cnx;
        function __construct(){
            $this->cnx = conexion::conectarDB();
        }

        function autor($id_autor){
            $sql = " SELECT * FROM autor WHERE id_autor = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$id_autor);
            if($query->execute()){
                return $query;
            }
        }

        function libroAutor($id_autor){
            $sql = "SELECT A.ISBN,A.portada,A.titulo FROM libro A INNER JOIN autor_libro B ON A.ISBN = B.ISBN INNER JOIN autor C ON B.id_autor = C.id_autor WHERE C.id_autor = ? LIMIT 0,4";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$id_autor);
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
        function getGenero($ISBN){
            $sql = "SELECT GROUP_CONCAT(C.nombre SEPARATOR ', ') as nombre FROM libro A INNER JOIN libro_genero B ON A.ISBN = B.ISBN INNER JOIN genero C ON B.id_genero = C.id_genero WHERE A.ISBN = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$ISBN);
            if($query->execute()){
                return $query;
            }
        }
    }
?>