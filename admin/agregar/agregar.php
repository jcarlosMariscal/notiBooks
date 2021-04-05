<?php
include "../../config/conexion.php";
class agregar{
    public $cnx;
    function __construct(){
        $this->cnx = conexion::conectarDB();
    }
    function validar($id,$tabla,$buscar){
        if($id == "id_genero"){
            $sql = "SELECT * FROM libro_genero WHERE ISBN = ? AND id_genero = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$tabla);
            $query -> bindParam(2,$buscar);
        }elseif($id == "id_autor"){
            $sql = "SELECT * FROM autor_libro WHERE ISBN = ? AND id_autor = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$tabla);
            $query -> bindParam(2,$buscar);
        }else{
            $sql = "SELECT $id FROM $tabla WHERE $id = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$buscar);
        }
        if($query->execute()){
            if($query->rowCount() >= 1){
                return true;
            }else{
                return false;
            }
        }
    }

    function addNoticia($titulo,$entrada,$fotografia,$id_acceso,$categoria,$cuerpo){
        $sql = "INSERT INTO noticia(titulo,entrada,cuerpo,fotografia,id_acceso,id_categoria) VALUES (?,?,?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$titulo);
        $query -> bindParam(2,$entrada);
        $query -> bindParam(3,$cuerpo);
        $query -> bindParam(4,$fotografia);
        $query -> bindParam(5,$id_acceso);
        $query -> bindParam(6,$categoria);
        if($query -> execute()){
            // echo "<script> alert('Noticia Agregada'); window.location= '../main.php?id=1' </script>";
            return true;
        }
    }

    function getCategorias(){
        $sql = "SELECT * FROM categoria";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }

    function addCategoria($cat){
        $sql = "INSERT INTO categoria(nombre) VALUES (?)";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$cat);
        if($query -> execute()){
            return true;
        }
    }

    function addAutor($nombre,$profesion,$nacimiento,$fallecimiento,$biografia,$obras,$imagen){
        $sql = "INSERT INTO autor(nombre,profesion,nacimiento,fallecimiento,biografia,obras,imagen) VALUES (?,?,?,?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$nombre);
        $query -> bindParam(2,$profesion);
        $query -> bindParam(3,$nacimiento);
        $query -> bindParam(4,$fallecimiento);
        $query -> bindParam(5,$biografia);
        $query -> bindParam(6,$obras);
        $query -> bindParam(7,$imagen);
        if($query -> execute()){
            return true;
        }
    }
    function addEditorial($editorial){
        $sql = "INSERT INTO editorial(nombre) VALUES (?)";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$editorial);
        if($query -> execute()){
            return true;
        }
    }
    function addGenero($genero){
        $sql = "INSERT INTO genero(nombre) VALUE (?)";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$genero);
        if($query -> execute()){
            return true;
        }
    }
    function getEditorial(){
        $sql = "SELECT * FROM editorial";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
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
    function getAutor(){
        $sql = "SELECT id_autor,nombre FROM autor";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function addLibro($ISBN,$titulo,$portada,$prologo,$fecha_publi,$link,$id_editorial){
        $sql = "INSERT INTO libro(ISBN,titulo,portada,prologo,fecha_publi,link,id_editorial) VALUES (?,?,?,?,?,?,?)";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        $query -> bindParam(2,$titulo);
        $query -> bindParam(3,$portada);
        $query -> bindParam(4,$prologo);
        $query -> bindParam(5,$fecha_publi);
        $query -> bindParam(6,$link);
        $query -> bindParam(7,$id_editorial);
        if($query->execute()){
            return true;
        }
    }
    function addLibroGenero($ISBN,$id_genero){
        $sql = "INSERT INTO libro_genero(ISBN,id_genero) VALUES (?,?)";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        $query -> bindParam(2,$id_genero);
        if($query->execute()){
            return true;
        }
    }
    function addLibroAutor($ISBN,$id_autor){
        $sql = "INSERT INTO autor_libro(ISBN,id_autor) VALUES (?,?)";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        $query -> bindParam(2,$id_autor);
        if($query->execute()){
            return true;
        }
    }

    function getPeriodista(){
        $rol = 1;
        $sql = "SELECT id_acceso,nombre FROM acceso WHERE id_rol = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$rol);
        if($query->execute()){
            return $query;
        }
    }
}
?>