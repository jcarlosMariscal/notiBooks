<?php
require "update.php";
$query = new update();
$tabla = $_POST["tabla"];
if($tabla === "noticia"){
    $id_noticia = $_POST["id_noticia"];
    $titulo = $_POST["titulo"];
    $entrada = $_POST["entrada"];
    $cuerpo = $_POST["cuerpo"];
    $id_categoria = $_POST["categoria"];
    $img = ( empty ($_FILES['archivo'] ) ? NULL : $_FILES['archivo']);
    if($img){
        $archivo = $_FILES["archivo"];
        $nombre_img = basename($archivo["name"]);
        $nombre_mod = date("m-d-y").$nombre_img;
        $ruta = "../../img/noticia/" . $nombre_mod;
        $subirArchivo = move_uploaded_file($archivo["tmp_name"],$ruta);
        if($subirArchivo){
            $fotografia = "img/noticia/$nombre_mod";
            $query -> updateNoticiaImage($id_noticia,$titulo,$entrada,$cuerpo,$id_categoria,$fotografia);
        }
    }else{
        $query -> updateNoticia($id_noticia,$titulo,$entrada,$cuerpo,$id_categoria);
    }
}elseif($tabla == "categoria"){
    $id_categoria = $_POST['id_categoria'];
    $nombre = $_POST['categoria'];
    $query -> updateCategoria($id_categoria,$nombre);
}elseif($tabla == "acceso"){
    $id_acceso = $_POST['id_acceso'];
    $nombre = $_POST['name'];
    $id_rol = $_POST['rol'];
    $query->updateAcceso($id_acceso,$nombre,$id_rol);
}elseif($tabla == "autor"){
    $id_autor = $_POST['id_autor'];
    $nombre = $_POST['nombre'];
    $profesion = $_POST['profesion'];
    $nacimiento = $_POST['nacimiento'];
    $fallecimiento = $_POST['fallecimiento'];
    $biografia = $_POST['biografia'];
    $obras = $_POST['obras'];
    $img = ( empty ($_FILES['archivo'] ) ? NULL : $_FILES['archivo']);
    if($img){
        $archivo = $_FILES["archivo"];
        $nombre_img = basename($archivo["name"]);
        $nombre_mod = date("m-d-y").$nombre_img;
        $ruta = "../../img/autor/".$nombre_mod;
        $subirArchivo = move_uploaded_file($archivo["tmp_name"],$ruta);
        if($subirArchivo){
            $imagen = "img/autor/$nombre_mod";
            $query -> updateAutorImage($id_autor,$nombre,$profesion,$nacimiento,$fallecimiento,$biografia,$obras,$imagen);
        }
    }else{
        $query -> updateAutor($id_autor,$nombre,$profesion,$nacimiento,$fallecimiento,$biografia,$obras);
    }
}elseif($tabla == "editorial"){
    $id_categoria = $_POST['id_editorial'];
    $nombre = $_POST['nombre'];
    $query -> updateEditorial($id_categoria,$nombre);
}elseif($tabla == "genero"){
    $id_genero = $_POST['id_genero'];
    $nombre = $_POST['nombre'];
    $query -> updateGenero($id_genero,$nombre);
}elseif($tabla == "libro"){
    $ISBN = $_POST["ISBN"];
    $titulo = $_POST["titulo"];
    $prologo = $_POST["prologo"];
    $fecha_publi = $_POST["fecha_publi"];
    $link = $_POST["url"];
    $id_editorial = $_POST["editorial"];
    $img = ( empty ($_FILES['archivo'] ) ? NULL : $_FILES['archivo']);
    if($img){
        $archivo = $_FILES["archivo"];
        $nombre_img = basename($archivo["name"]);
        $nombre_mod = date("m-d-y").$nombre_img;
        $ruta = "../../img/libro/" . $nombre_mod;
        $subirArchivo = move_uploaded_file($archivo["tmp_name"],$ruta);
        if($subirArchivo){
            $portada = "img/libro/$nombre_mod";
            $query -> updateLibroImage($ISBN,$titulo,$prologo,$fecha_publi,$link,$id_editorial,$portada);
        }
    }else{
        $query -> updateLibro($ISBN,$titulo,$prologo,$fecha_publi,$link,$id_editorial);
    }
}else{
    echo "Algo salio mal";
}
?>