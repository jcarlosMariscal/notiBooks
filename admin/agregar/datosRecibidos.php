<?php
require "agregar.php";
$query = new agregar();
$tabla = $_POST['tabla'];
if($tabla == 'noticia'){
    $titulo = $_POST['titulo'];
    $entrada = $_POST['entrada'];
    $id_acceso = $_POST['id_acceso'];
    $categoria = $_POST['categoria'];
    $cuerpo = $_POST['cuerpo'];
    $archivo = $_FILES["archivo"];
    if($archivo){
        $nombre_img = basename($archivo['name']);
        $nombre_mod = date("m-d-y").$nombre_img;
        $ruta = "../../img/" . $nombre_mod;
        $subirArchivo = move_uploaded_file($archivo["tmp_name"],$ruta);
        if($subirArchivo){
            $fotografia = "img/$nombre_mod";
            $query->addNoticia($titulo,$entrada,$fotografia,$id_acceso,$categoria,$cuerpo);
        }else{
            ?>
            <script>alert("Error al subir archivo")</script>
            <?php
        }
    }
}elseif($tabla == 'categoria'){
    $categoria = $_POST['categoria'];
    $query -> addCategoria($categoria);
}elseif($tabla == "autor"){
    $nombre = $_POST['nombre'];
    $profesion = $_POST['profesion'];
    $nacimiento = $_POST['nacimiento'];
    $fallecimiento = $_POST['fallecimiento'];
    $biografia = $_POST['biografia'];
    $obras = $_POST['obras'];
    $archivo = $_FILES['archivo'];
    if($archivo){
        $nombre_img = basename($archivo['name']);
        $nombre_mod = date("m-d-y").$nombre_img;
        $ruta = "../../img/autor/".$nombre_mod;
        $subirArchivo = move_uploaded_file($archivo["tmp_name"],$ruta);
        if($subirArchivo){
            $imagen = "img/autor/$nombre_mod";
            $query -> addAutor($nombre,$profesion,$nacimiento,$fallecimiento,$biografia,$obras,$imagen);
        }
    }
}elseif($tabla == "editorial"){
    $nombre = $_POST['nombre'];
    $query -> addEditorial($nombre);
}elseif($tabla == "genero"){
    $nombre = $_POST['nombre'];
    $query->addGenero($nombre);
}elseif($tabla == "libro"){
    $ISBN = $_POST['ISBN'];
    $titulo = $_POST['titulo'];
    $prologo = $_POST['prologo'];
    $fecha_publi = $_POST['fecha_publi'];
    $link = $_POST['url'];
    $id_editorial = $_POST['editorial'];
    $archivo = $_FILES['archivo'];
    if($archivo){
        $nombre_img = basename($archivo['name']);
        $nombre_mod = date("m-d-y").$nombre_img;
        $ruta = "../../img/libro/".$nombre_mod;
        $subirArchivo = move_uploaded_file($archivo["tmp_name"],$ruta);
        if($subirArchivo){
            $portada = "img/libro/$nombre_mod";
            $query -> addLibro($ISBN,$titulo,$portada,$prologo,$fecha_publi,$link,$id_editorial);
        }
    }
}elseif($tabla == "libroGenero"){
    $ISBN = $_POST['ISBN'];
    $id_genero = $_POST['genero'];
    $query->addLibroGenero($ISBN,$id_genero);
}elseif($tabla == "autorLibro"){
    $ISBN = $_POST['ISBN'];
    $id_autor = $_POST['autor'];
    $query->addLibroAutor($ISBN,$id_autor);
}else{
    echo ("UN NUEVO ERROR");
}
?>