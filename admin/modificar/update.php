<?php
require "../../config/conexion.php";
class update{
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

    function validarID($buscar,$tabla,$columna,$condicion){
        $sql = "SELECT $columna as id FROM $tabla WHERE $condicion = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$buscar);
        if($query->execute()){
            foreach($query as $data){
                $result = $data['id'];
            }
            return $result;
        }else{
            return false;
        }
    }

    function getNoticia($id){
        $sql = "SELECT * FROM noticia WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query -> execute()){
            return $query;
        }
    }
    function getCategorias(){
        $sql = "SELECT * FROM categoria";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function getCategoriaId($id){
        $sql = "SELECT * FROM categoria WHERE id_categoria = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            return $query;
        }
    }
    function updateNoticia($id_noticia,$titulo,$entrada,$cuerpo,$id_categoria){
        $sql = "UPDATE noticia SET titulo = ?, entrada = ?, cuerpo = ?, id_categoria = ? WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$titulo);
        $query -> bindParam(2,$entrada);
        $query -> bindParam(3,$cuerpo);
        $query -> bindParam(4,$id_categoria);
        $query -> bindParam(5,$id_noticia);
        if($query -> execute()){
            // echo "<script> alert('Noticia Agregada'); window.location= '../main.php?id=1' </script>";
            return true;
        }
    }
    function updateNoticiaImage($id_noticia,$titulo,$entrada,$cuerpo,$id_categoria,$fotografia){
        $sql = "UPDATE noticia SET titulo = ?, entrada = ?, cuerpo = ?, fotografia = ?, id_categoria = ? WHERE id_noticia = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$titulo);
        $query -> bindParam(2,$entrada);
        $query -> bindParam(3,$cuerpo);
        $query -> bindParam(4,$fotografia);
        $query -> bindParam(5,$id_categoria);
        $query -> bindParam(6,$id_noticia);
        if($query -> execute()){
            // echo "<script> alert('Noticia Agregada'); window.location= '../main.php?id=1' </script>";
            return true;
        }
    }

    function updateCategoria($id_categoria,$nombre){
        $sql = "UPDATE categoria SET nombre = ? WHERE id_categoria = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$nombre);
        $query -> bindParam(2,$id_categoria);
        if($query -> execute()){
            return true;
        }
    }
    function getRol(){
        $sql = "SELECT * FROM rol";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function getAcceso($id){
        $sql = "SELECT id_acceso,nombre FROM acceso WHERE id_acceso = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            return $query;
        }
    }

    function updateAcceso($id_acceso,$nombre,$id_rol){
        $sql = "UPDATE acceso SET nombre = ?, id_rol = ? WHERE id_acceso = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$nombre);
        $query -> bindParam(2,$id_rol);
        $query -> bindParam(3,$id_acceso);
        if($query -> execute()){
            return true;
        }
    }

    function getAutor($id){
        $sql = "SELECT * FROM autor WHERE id_autor = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            return $query;
        }
    }

    function updateAutor($id_autor,$nombre,$profesion,$nacimiento,$fallecimiento,$biografia,$obras){
        $sql = "UPDATE autor SET nombre = ?, profesion = ?, nacimiento = ?, fallecimiento = ?, biografia = ?, obras = ? WHERE id_autor = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$nombre);
        $query -> bindParam(2,$profesion);
        $query -> bindParam(3,$nacimiento);
        $query -> bindParam(4,$fallecimiento);
        $query -> bindParam(5,$biografia);
        $query -> bindParam(6,$obras);
        $query -> bindParam(7,$id_autor);
        if($query->execute()){
            return true;
        }
    }

    function updateAutorImage($id_autor,$nombre,$profesion,$nacimiento,$fallecimiento,$biografia,$obras,$imagen){
        $sql = "UPDATE autor SET nombre = ?, profesion = ?, nacimiento = ?, fallecimiento = ?, biografia = ?, obras = ?, imagen = ? WHERE id_autor = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$nombre);
        $query -> bindParam(2,$profesion);
        $query -> bindParam(3,$nacimiento);
        $query -> bindParam(4,$fallecimiento);
        $query -> bindParam(5,$biografia);
        $query -> bindParam(6,$obras);
        $query -> bindParam(7,$imagen);
        $query -> bindParam(8,$id_autor);
        if($query->execute()){
            return true;
        }
    }

    function getEditorial($id){
        $sql = "SELECT * FROM editorial WHERE id_editorial = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            return $query;
        }
    }
    function updateEditorial($id_editorial,$nombre){
        $sql = "UPDATE editorial SET nombre = ? WHERE id_editorial = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$nombre);
        $query -> bindParam(2,$id_editorial);
        if($query->execute()){
            return true;
        }
    }

    function getGenero($id){
        $sql = "SELECT * FROM genero WHERE id_genero = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$id);
        if($query->execute()){
            return $query;
        }
    }
    function updateGenero($id_genero,$nombre){
        $sql = "UPDATE genero SET nombre = ? WHERE id_genero = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$nombre);
        $query -> bindParam(2,$id_genero);
        if($query->execute()){
            return true;
        }
    }
    function getEdit(){
        $sql = "SELECT * FROM editorial";
        $query = $this->cnx->prepare($sql);
        if($query->execute()){
            return $query;
        }
    }
    function getLibro($ISBN){
        $sql = "SELECT * FROM libro WHERE ISBN = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        if($query->execute()){
            return $query;
        }
    }

    function updateLibroImage($ISBN,$titulo,$prologo,$fecha_publi,$link,$id_editorial,$portada){
        $sql = "UPDATE libro SET ISBN = ?, titulo = ?, portada = ?, prologo = ?, fecha_publi = ?, link = ?, id_editorial = ? WHERE ISBN = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        $query -> bindParam(2,$titulo);
        $query -> bindParam(3,$portada);
        $query -> bindParam(4,$prologo);
        $query -> bindParam(5,$fecha_publi);
        $query -> bindParam(6,$link);
        $query -> bindParam(7,$id_editorial);
        $query -> bindParam(8,$ISBN);
        if($query->execute()){
            return true;
        }
    }
    function updateLibro($ISBN,$titulo,$prologo,$fecha_publi,$link,$id_editorial){
        $sql = "UPDATE libro SET ISBN = ?, titulo = ?, prologo = ?, fecha_publi = ?, link = ?, id_editorial = ? WHERE ISBN = ?";
        $query = $this->cnx->prepare($sql);
        $query -> bindParam(1,$ISBN);
        $query -> bindParam(2,$titulo);
        $query -> bindParam(3,$prologo);
        $query -> bindParam(4,$fecha_publi);
        $query -> bindParam(5,$link);
        $query -> bindParam(6,$id_editorial);
        $query -> bindParam(7,$ISBN);
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