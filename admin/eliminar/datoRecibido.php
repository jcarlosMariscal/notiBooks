<?php
require "eliminar.php";
$query = new eliminar();
$tabla = $_POST['tabla'];
if($tabla == "acceso"){
    $id = $_POST['id'];
    $query -> eliminarAcceso($id);
}elseif($tabla == "autor"){
    $id = $_POST['id'];
    $validar = $query->validar($tabla,$id);
    if($validar){
        echo "ocupado";
    }else{
        echo "vacio";
        $query -> eliminarAutor($id);
    }
}elseif($tabla == "editorial"){
    $id = $_POST['id'];
    $validar = $query->validar($tabla,$id);
    if($validar){
        echo "ocupado";
    }else{
        echo "vacio";
        $query -> eliminarEditorial($id);
    }
}elseif($tabla == "genero"){
    $id = $_POST['id'];
    $validar = $query->validar($tabla,$id);
    if($validar){
        echo "ocupado";
    }else{
        echo "vacio";
        $query -> eliminarGenero($id);
    }
}elseif($tabla == "autBook"){
    $ISBN = $_POST['ISBN'];
    $id_autor = $_POST['autor'];
    $query->eliminarAutLibro($ISBN,$id_autor);
}elseif($tabla == "getBook"){
    $ISBN = $_POST['ISBN'];
    $id_genero = $_POST['genero'];
    $query->eliminarGenLibro($ISBN,$id_genero);
}elseif($tabla == "noticia"){
    $id_noticia = $_POST['id'];
    $columna = "titulo";
    $tabla = "noticia";
    $titulo = $query -> getTableID($id_noticia,$columna,$tabla);
    if($titulo){
        $query -> eliminarNoticia($id_noticia);
        echo $titulo;
    }
}elseif($tabla == "categoria"){
    $id_categoria = $_POST['id'];
    $columna = "nombre";
    $validar = $query->validar($tabla,$id_categoria);
    if($validar){
        echo "ocupado";
    }else{
        echo "vacio";
        $nombre = $query -> getTableID($id_categoria,$columna,$tabla);
        if($nombre || $nombre == ""){
            $query -> eliminarCategoria($id_categoria);
            echo $nombre;
        }
    }
}
?>