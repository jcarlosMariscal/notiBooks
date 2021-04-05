<?php
require "agregar.php";
$query = new agregar();
$tabla = $_POST['tabla'];
if($tabla == 'noticia'){
    $titulo = $_POST['titulo'];
    $entrada = $_POST['entrada'];
    $id_acceso = $_POST['id_acceso'];
    $categoria = $_POST['categoria'];
    // $cuerpo = $_POST['cuerpo'];
    $cuerpo = $_POST['cuerpo'];
    $archivo = $_FILES["archivo"];
    $validarTitulo = $query -> validar("titulo",$tabla,$titulo);
    if($archivo){
        $nombre_img = basename($archivo['name']);
        $nombre_mod = date("m-d-y").$nombre_img;
        $ruta = "../../img/noticia/" . $nombre_mod;
        $subirArchivo = move_uploaded_file($archivo["tmp_name"],$ruta);
        if($subirArchivo){
            $fotografia = "img/noticia/$nombre_mod";
            if($validarTitulo){
                echo "repetido";
            }else{
                echo "insertarNoticia";
                $query -> addNoticia($titulo,$entrada,$fotografia,$id_acceso,$categoria,$cuerpo);
                // echo "El titulo es ".$titulo.", entrada es ".$entrada.", id acceso es ".$id_acceso.", categoria es ".$categoria.", cuerpo es ".$cuerpo.", el archivo es ".$archivo;
                // echo "cuerpo es: ".$cuerpo;
            }
        }
    }
}elseif($tabla == 'categoria'){
    $categoria = $_POST['categoria'];
    $validarCategoria = $query -> validar("nombre",$tabla,$categoria);
    if($validarCategoria){
        echo "repetido";
    }else{
        echo "insertarCategoria";
        $query -> addCategoria($categoria);
    }
}elseif($tabla == "autor"){
    $nombre = $_POST['nombre'];
    $profesion = $_POST['profesion'];
    $nacimiento = $_POST['fecha_nac'];
    $fallecimiento = $_POST['fecha_fal'];
    $biografia = $_POST['cuerpo'];
    $obras = $_POST['obras'];
    $archivo = $_FILES['archivo'];
    if($archivo){
        $nombre_img = basename($archivo['name']);
        $nombre_mod = date("m-d-y").$nombre_img;
        $ruta = "../../img/autor/".$nombre_mod;
        $subirArchivo = move_uploaded_file($archivo["tmp_name"],$ruta);
        if($subirArchivo){
            $imagen = "img/autor/$nombre_mod";
            $validar = $query -> validar("nombre",$tabla,$nombre);
            if($validar){
                echo "repetido";
            }else{
                echo "insertarAutor";
                $query -> addAutor($nombre,$profesion,$nacimiento,$fallecimiento,$biografia,$obras,$imagen);
                // echo "El nombre es ".$nombre.", profesion es ".$profesion.", nacimiento es ".$nacimiento.", muerte es ".$fallecimiento.", biografia es ".$biografia.", el archivo es ".$archivo.", la obra es ".$obras;
            }
        }
    }
}elseif($tabla == "editorial"){
    $nombre = $_POST['editorial'];
    $validar = $query -> validar("nombre",$tabla,$nombre);
    if($validar){
        echo "repetido";
    }else{
        echo "insertarEditorial";
        $query -> addEditorial($nombre);
    }
}elseif($tabla == "genero"){
    $nombre = $_POST['genero'];
    $validar = $query -> validar("nombre",$tabla,$nombre);
    if($validar){
        echo "repetido";
    }else{
        echo "insertarGenero";
        $query->addGenero($nombre);
    }
}elseif($tabla == "libro"){
    $ISBN = $_POST['ISBN'];
    $titulo = $_POST['titulo'];
    $prologo = $_POST['cuerpo'];
    $fecha_publi = $_POST['fecha'];
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
            // echo "EL TITULO ES: ".$titulo;
            $validarISBN = $query -> validar("ISBN",$tabla,$ISBN);
            $validarTitulo = $query -> validar("titulo",$tabla,$titulo);
            if($validarISBN || $validarTitulo){
                echo "repetido";
            }else{
                echo "insertarLibro";
                $query -> addLibro($ISBN,$titulo,$portada,$prologo,$fecha_publi,$link,$id_editorial);
                // echo "El ISBN es ".$ISBN.", titulo es ".$titulo.", prologo es ".$prologo.", fecha es ".$fecha_publi.", link es ".$link.", el archivo es ".$archivo.", el editorial es: ".$id_editorial;
            }
        }
    }
}elseif($tabla == "libroGenero"){
    $ISBN = $_POST['ISBN'];
    $id_genero = $_POST['genero'];
    $validar = $query -> validar("id_genero",$ISBN,$id_genero);
    if($validar){
        echo "repetido";
    }else{
        echo "insertar";
        $query->addLibroGenero($ISBN,$id_genero);
    }
}elseif($tabla == "autorLibro"){
    $ISBN = $_POST['ISBN'];
    $id_autor = $_POST['autor'];
    $validar = $query -> validar("id_autor",$ISBN,$id_autor);
    if($validar){
        echo "repetido";
    }else{
        echo "insertar";
        $query->addLibroAutor($ISBN,$id_autor);
    }
}elseif($tabla == "acceso"){
    $name = $_POST['nombre'];
    $contra = $_POST['password'];
    $rol = $_POST['rol'];
    $validar = $query -> validar("nombre",$tabla,$name);
    if($validar){
        echo "repetido";
    }else{
        $insertar = $query->addUser($name,$contra,$rol);
        if($insertar){
            echo "insertar";
        }else{
            echo "nuevo";
        }
    }
}else{
    echo ("UN NUEVO ERROR");
}
?>