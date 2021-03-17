<?php
require "eliminar.php";
$query = new eliminar();
// if($_GET['id_noticia']){
//     $id = $_GET['id_noticia'];
//     $query -> eliminarNoticia($id);
// }elseif($_GET['id_categoria']){
//     $id = $_GET['id_categoria'];
//     $query -> eliminarCategoria($id);
// }elseif($_GET['acceso']){
//     $id = $_GET['acceso'];
//     $query -> eliminarAcceso($id);
// }elseif($_GET['autor']){
//     $id = $_GET['autor'];
//     $query -> eliminarAutor($id);
// }elseif($_GET['editorial']){
//     $id = $_GET['editorial'];
//     $query -> eliminarEditorial($id);
// }elseif($_GET['genero']){
//     $id = $_GET['genero'];
//     $query -> eliminarGenero($id);
// }elseif($_POST['tabla']){
//     $ISBN = $_POST['ISBN'];
//     $id_autor = $_POST['autor'];
//     $query->eliminarAutLibro($ISBN,$id_autor);
// }elseif($_POST['tablaGen']){
//     $ISBN = $_POST['ISBN'];
//     $id_genero = $_POST['genero'];
//     $query->eliminarGenLibro($ISBN,$id_genero);
// }elseif($_GET['ISBN']){
//     $ISBN = $_GET['ISBN'];
//     $query->eliminarLibro($ISBN);
// }
$tabla = $_POST['tabla'];
if($tabla == "acceso"){
    $id = $_POST['id'];
    $query -> eliminarAcceso($id);
}elseif($tabla == "autor"){
    $id = $_POST['id'];
    $query -> eliminarAutor($id);
}elseif($tabla == "editorial"){
    $id = $_POST['id'];
    $query -> eliminarEditorial($id);
}elseif($tabla == "genero"){
    $id = $_POST['id'];
    $query -> eliminarGenero($id);
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
        echo $titulo;
        $query -> eliminarNoticia($id_noticia);
    }
}elseif($tabla == "categoria"){
    $id_categoria = $_POST['id'];
    $columna = "nombre";
    $tabla = "categoria";
    $nombre = $query -> getTableID($id_categoria,$columna,$tabla);
    if($nombre){
        echo $nombre;
        $query -> eliminarCategoria($id);
    }
}
?>