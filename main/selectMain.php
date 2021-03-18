<?php
include "config/conexion.php";
    class selectMain{
        public $cnx;
        function __construct(){
            $this->cnx = conexion::conectarDB();
        }

        function numberRandom($id,$table){
            if($table == "libro"){
                $sql = "SELECT ISBN as id FROM $table";
            }else{
                $sql = "SELECT id_$table as id FROM $table";
            }
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
                $id = array();
                $i=0;
                while($datos = $query->fetch()){
                    $id_table = $datos['id'];
                    $id[$i] = $id_table;
                    $i++;
                }
                $pos = count($id);
                $t = $pos-1;
                $posicion = array();
                if($query->rowCount() < $canti){
                    $maxOb = $query->rowCount();
                    for($c=0;$c<$maxOb;$c++){
                        $posicion[$c]=$id[$pos-($c+1)]; 
                    }
                    return $posicion;
                }else{
                    for($c=0;$c<$canti;$c++){
                        $posicion[$c]=$id[$pos-($c+1)]; 
                    }
                    return $posicion;
                }
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
            $limit = count($max);
            // echo "El maximo es: ".$limit;
            $rol = 1;
            if($limit == 1){
                $p1 = $max[0];
                $sql = "SELECT A.titulo,A.fotografia,A.fecha,A.id_noticia,B.nombre FROM noticia A INNER JOIN acceso B ON A.id_acceso = B.id_acceso INNER JOIN rol C ON B.id_rol = C.id_rol WHERE id_noticia = ? AND C.rol = ? ORDER BY A.id_noticia DESC";
                $query = $this->cnx->prepare($sql);
                $query -> bindParam(1,$p1);
                $query -> bindParam(2,$rol);
            }
            if($limit == 2){
                $p1 = $max[0];
                $p2 = $max[1];
                $sql = "SELECT A.titulo,A.fotografia,A.fecha,A.id_noticia,B.nombre FROM noticia A INNER JOIN acceso B ON A.id_acceso = B.id_acceso INNER JOIN rol C ON B.id_rol = C.id_rol WHERE id_noticia = ? OR id_noticia = ? AND C.rol = ? ORDER BY A.id_noticia DESC";
                $query = $this->cnx->prepare($sql);
                $query -> bindParam(1,$p1);
                $query -> bindParam(2,$p2);
                $query -> bindParam(3,$rol);
            }
            if($limit == 3){
                $p1 = $max[0];
                $p2 = $max[1];
                $p3 = $max[2];
                $sql = "SELECT A.titulo,A.fotografia,A.fecha,A.id_noticia,B.nombre FROM noticia A INNER JOIN acceso B ON A.id_acceso = B.id_acceso INNER JOIN rol C ON B.id_rol = C.id_rol WHERE id_noticia = ? OR id_noticia = ? OR id_noticia = ? AND C.rol = ? ORDER BY A.id_noticia DESC";
                $query = $this->cnx->prepare($sql);
                $query -> bindParam(1,$p1);
                $query -> bindParam(2,$p2);
                $query -> bindParam(3,$p3);
                $query -> bindParam(4,$rol);
            }
            if($limit == 4){
                $p1 = $max[0];
                $p2 = $max[1];
                $p3 = $max[2];
                $p4 = $max[3];
                $rol = "periodista";
                $sql = "SELECT A.titulo,A.fotografia,A.fecha,A.id_noticia,B.nombre FROM noticia A INNER JOIN acceso B ON A.id_acceso = B.id_acceso INNER JOIN rol C ON B.id_rol = C.id_rol WHERE id_noticia = ? OR id_noticia = ? OR id_noticia = ? OR id_noticia = ? and C.rol = ? ORDER BY A.id_noticia DESC";
                $query = $this->cnx->prepare($sql);
                $query -> bindParam(1,$p1);
                $query -> bindParam(2,$p2);
                $query -> bindParam(3,$p3);
                $query -> bindParam(4,$p4);
                $query -> bindParam(5,$rol);
            }
            if($query->execute()){
                return $query;
            }
        }

        function pageMainLibros(){
            $random1 = $this->numberRandom("ISBN","libro");
            $random2 = $this->numberRandom("ISBN","libro");
            $random3 = $this->numberRandom("ISBN","libro");
            $random4 = $this->numberRandom("ISBN","libro");
            $random5 = $this->numberRandom("ISBN","libro");
            $sql = "SELECT ISBN, portada,titulo FROM libro WHERE ISBN = ? OR ISBN = ? OR ISBN = ? OR ISBN = ? OR ISBN = ?";
            $query = $this->cnx->prepare($sql);
            $query -> bindParam(1,$random1);
            $query -> bindParam(2,$random2);
            $query -> bindParam(3,$random3);
            $query -> bindParam(4,$random4);
            $query -> bindParam(5,$random5);
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