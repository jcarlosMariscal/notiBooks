<?php
require "eliminar.php";
$query = new eliminar();
if($_GET['id_noticia']){
    $id = $_GET['id_noticia'];
    $query -> eliminarNoticia($id);
}elseif($_GET['id_categoria']){
    $id = $_GET['id_categoria'];
    $query -> eliminarCategoria($id);
}elseif($_GET['acceso']){
    $id = $_GET['acceso'];
    $query -> eliminarAcceso($id);
}elseif($_GET['autor']){
    $id = $_GET['autor'];
    $query -> eliminarAutor($id);
}elseif($_GET['editorial']){
    $id = $_GET['editorial'];
    $query -> eliminarEditorial($id);
}elseif($_GET['genero']){
    $id = $_GET['genero'];
    $query -> eliminarGenero($id);
}
?>