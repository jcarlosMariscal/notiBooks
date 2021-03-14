<?php
include "config/conexion.php";
    class selectMain{
        public $cnx;
        function __construct(){
            $this->cnx = conexion::conectarDB();
        }

        function numberRandom($id,$table){
            $sql = "SELECT id_$table as id FROM $table";
            $query = $this->cnx->prepare($sql);
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

        function limitTable($id,$table,$canti){
            $sql = "SELECT $id as id FROM $table";
            $query = $this->cnx->prepare($sql);
            if($query->execute()){
                $id = array(2,4,6,8,10,12);
                $i=0;
                while($datos = $query->fetch()){
                    $id_table = $datos['id'];
                    $i++;
                }
                $pos = count($id);
                $t = $pos-1;
                $posicion = array();
                for($c=0;$c<$canti;$c++){
                    $posicion[$c]=$id[$pos-($c+1)]; 
                }
                // print_r($posicion);
                return $posicion;
            }
        }

        function pageMainAutor(){
            $random = $this->numberRandom("id_autor","autor");
            // echo $random;
            $sql = "SELECT id_autor,nombre,obras FROM autor WHERE id_autor = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$random);
            if($query->execute()){
                return $query;
            }
        }

        function pageMainNoticia(){
            $max = $this->limitTable("id_noticia","noticia",4);
            // echo "DESDE PAGE MAIN NOTICIA";

            $p1 = $max[0];
            $p2 = $max[1];
            $p3 = $max[2];
            $p4 = $max[3];
            $rol = "periodista";
            $sql = "SELECT A.titulo,A.fotografia,A.fecha,A.id_noticia,B.nombre FROM noticia A INNER JOIN acceso B ON A.id_acceso = B.id_acceso INNER JOIN rol C ON B.id_rol = C.id_rol WHERE id_noticia > ? and C.rol = ? ORDER BY A.id_noticia DESC";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$limit);
            $query -> bindParam(2,$rol);
            if($query->execute()){
                return $query;
            }
        }

        function pageMainLibros(){
            $max = $this-> limitTable("ISBN","libro",4);
            $p1 = $max[0];
            $p2 = $max[1];
            $p3 = $max[2];
            $p4 = $max[3];
            $sql = "SELECT ISBN, portada,titulo FROM libro";
            $query = $this->cnx->prepare($sql);
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

        function pageNameAutor(){
            $random1 = $this->numberRandom("id_autor","autor");
            $random2 = $this->numberRandom("id_autor","autor");
            $sql = "SELECT id_autor,nombre FROM autor WHERE id_autor=? or id_autor=?";
            $query = $this->cnx->prepare($sql);
            $query ->bindParam(1,$random1);
            $query ->bindParam(2,$random2);
            if($query->execute()){
                return $query;
            }
        }

        function pageMainGenero(){
            $random1 = $this->numberRandom("id_genero","genero");
            $random2 = $this->numberRandom("id_genero","genero");
            $random3 = $this->numberRandom("id_genero","genero");
            $sql = "SELECT id_genero,nombre FROM genero WHERE id_genero = ? or id_genero = ? or id_genero = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$random1);
            $query -> bindParam(2,$random2);
            $query -> bindParam(3,$random3);
            if($query->execute()){
                return $query;
            }
        }

        function pageMainEditorial(){
            $random1 = $this->numberRandom("id_editorial","editorial");
            $random2 = $this->numberRandom("id_editorial","editorial");
            $random3 = $this->numberRandom("id_editorial","editorial");
            $sql = "SELECT id_editorial,nombre FROM editorial WHERE id_editorial = ? or id_editorial = ? or id_editorial = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$random1);
            $query -> bindParam(2,$random2);
            $query -> bindParam(3,$random3);
            if($query->execute()){
                return $query;
            }
        }

    }
?>