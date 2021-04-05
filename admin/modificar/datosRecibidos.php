<?php
require "update.php";
$query = new update();
$tabla = $_POST["tabla"];
if($tabla == "noticia"){
    $id_noticia = $_POST["id_noticia"];
    $titulo = $_POST["titulo"];
    $entrada = $_POST["entrada"];
    $cuerpo = $_POST["cuerpo"];
    $id_categoria = $_POST["categoria"];
    $img = ( empty ($_FILES['archivo'] ) ? NULL : $_FILES['archivo']);

    $validarID = $query->validarID($id_noticia,$tabla,"titulo","id_noticia");
    $validarTitulo = $query -> validar("titulo",$tabla,$titulo);

    if($img){
        $archivo = $_FILES["archivo"];
        $nombre_img = basename($archivo["name"]);
        $nombre_mod = date("m-d-y").$nombre_img;
        $ruta = "../../img/noticia/" . $nombre_mod;
        $subirArchivo = move_uploaded_file($archivo["tmp_name"],$ruta);
        if($subirArchivo){
            $fotografia = "img/noticia/$nombre_mod";
            if($validarID == $titulo){
                echo "noCambioNoticia";
                $query -> updateNoticiaImage($id_noticia,$validarID,$entrada,$cuerpo,$id_categoria,$fotografia);
            }else{
                if($validarTitulo){
                    echo "repetido";
                }else{
                    echo "insertarNoticia";
                    $query -> updateNoticiaImage($id_noticia,$titulo,$entrada,$cuerpo,$id_categoria,$fotografia);
                }
            }
        }
    }else{
        if($validarID == $titulo){
            echo "noCambioNoticia";
            $query -> updateNoticia($id_noticia,$validarID,$entrada,$cuerpo,$id_categoria);
        }else{
            if($validarTitulo){
                echo "repetido";
            }else{
                echo "insertarNoticia";
                $query -> updateNoticia($id_noticia,$titulo,$entrada,$cuerpo,$id_categoria);
            }
        }
    }
}elseif($tabla == "categoria"){
    $id_categoria = $_POST['id_categoria'];
    $nombre = $_POST['categoria'];
    $validarID = $query->validarID($id_categoria,$tabla,"nombre","id_categoria");
    if($validarID == $nombre){
        echo "noCambioCategoria";
    }else{
        $validar = $query -> validar("nombre",$tabla,$nombre,$id_categoria);
        if($validar){
            echo "repetido";
        }else{
            echo "insertarCategoria";
            $query -> updateCategoria($id_categoria,$nombre);
        }
    }
}elseif($tabla == "modificarAcceso"){
    $table = "acceso";
    $id_acceso = $_POST['id_acceso'];
    $nombre = $_POST['nombre'];
    $id_rol = $_POST['rol'];
    $validarID = $query->validarID($id_acceso,$table,"nombre","id_acceso");
    if($validarID == $nombre){
        echo "noCambio";
        $query->updateAcceso($id_acceso,$validarID,$id_rol);
    }else{
        $validar = $query -> validar("nombre",$table,$nombre);
        if($validar){
            echo "repetido";
        }else{
            echo "insertar";
            $query->updateAcceso($id_acceso,$nombre,$id_rol);
        }
    }
}elseif($tabla == "autor"){
    $id_autor = $_POST['id_autor'];
    $nombre = $_POST['nombre'];
    $profesion = $_POST['profesion'];
    $nacimiento = $_POST['fecha_nac'];
    $fallecimiento = $_POST['fecha_fal'];
    $biografia = $_POST['cuerpo'];
    $obras = $_POST['obras'];
    $img = ( empty ($_FILES['archivo'] ) ? NULL : $_FILES['archivo']);

    $validarID = $query->validarID($id_autor,$tabla,"nombre","id_autor");
    $validar = $query -> validar("nombre",$tabla,$nombre);

    if($img){
        $archivo = $_FILES["archivo"];
        $nombre_img = basename($archivo["name"]);
        $nombre_mod = date("m-d-y").$nombre_img;
        $ruta = "../../img/autor/".$nombre_mod;
        $subirArchivo = move_uploaded_file($archivo["tmp_name"],$ruta);
        if($subirArchivo){
            $imagen = "img/autor/$nombre_mod";
            if($validarID == $nombre){
                echo "noCambioAutor";
                $query -> updateAutorImage($id_autor,$validarID,$profesion,$nacimiento,$fallecimiento,$biografia,$obras,$imagen);
            }else{
                if($validar){
                    echo "repetido";
                }else{
                    echo "insertarAutor";
                    $query -> updateAutorImage($id_autor,$nombre,$profesion,$nacimiento,$fallecimiento,$biografia,$obras,$imagen);
                }
            }
        }
    }else{
        if($validarID == $nombre){
            echo "noCambioAutor";
            $query -> updateAutor($id_autor,$validarID,$profesion,$nacimiento,$fallecimiento,$biografia,$obras);
        }else{
            if($validar){
                echo "repetido";
            }else{
                echo "insertarAutor";
                $query -> updateAutor($id_autor,$nombre,$profesion,$nacimiento,$fallecimiento,$biografia,$obras);
            }
        }
    }
}elseif($tabla == "editorial"){
    $id_editorial = $_POST['id_editorial'];
    $nombre = $_POST['editorial'];
    $validarID = $query->validarID($id_editorial,$tabla,"nombre","id_editorial");
    if($validarID == $nombre){
        echo "noCambioEditorial";
    }else{
        $validar = $query -> validar("nombre",$tabla,$nombre);
        if($validar){
            echo "repetido";
        }else{
            echo "insertarEditorial";
            $query -> updateEditorial($id_editorial,$nombre);
        }
    }
}elseif($tabla == "genero"){
    $id_genero = $_POST['id_genero'];
    $nombre = $_POST['genero'];
    $validarID = $query->validarID($id_genero,$tabla,"nombre","id_genero");
    if($validarID == $nombre){
        echo "noCambioGenero";
    }else{
        $validar = $query -> validar("nombre",$tabla,$nombre);
        if($validar){
            echo "repetido";
        }else{
            echo "insertarGenero";
            $query -> updateGenero($id_genero,$nombre);
        }
    }
}elseif($tabla == "libro"){
    $ISBN = $_POST["ISBN"];
    $titulo = $_POST["titulo"];
    $prologo = $_POST["cuerpo"];
    $fecha_publi = $_POST["fecha"];
    $link = $_POST["url"];
    $id_editorial = $_POST["editorial"];
    $img = ( empty ($_FILES['archivo'] ) ? NULL : $_FILES['archivo']);

    // $valISBN = $query->validarID($titulo,$tabla,"ISBN","titulo");
    $valTitulo = $query->validarID($ISBN,$tabla,"titulo","ISBN"); //Valor titulo
    $validarTitulo = $query -> validar("titulo",$tabla,$titulo);
    
    if($img){
        $archivo = $_FILES["archivo"];
        $nombre_img = basename($archivo["name"]);
        $nombre_mod = date("m-d-y").$nombre_img;
        $ruta = "../../img/libro/" . $nombre_mod;
        $subirArchivo = move_uploaded_file($archivo["tmp_name"],$ruta);
        if($subirArchivo){
            $portada = "img/libro/$nombre_mod";
            if($valTitulo == $titulo){
                echo "noCambioLibro";
                $query -> updateLibroImage($ISBN,$valTitulo,$prologo,$fecha_publi,$link,$id_editorial,$portada);
            }else{
                if($validarTitulo){
                    echo "repetido";
                }else{
                    echo "insertarLibro";
                    $query -> updateLibroImage($ISBN,$titulo,$prologo,$fecha_publi,$link,$id_editorial,$portada);
                }
            }
        }
    }else{
        if($valTitulo == $titulo){
            echo "noCambioLibro";
            $query -> updateLibro($ISBN,$valTitulo,$prologo,$fecha_publi,$link,$id_editorial);
        }else{
            if($validarTitulo){
                echo "repetido";
            }else{
                echo "insertarLibro";
                $query -> updateLibro($ISBN,$titulo,$prologo,$fecha_publi,$link,$id_editorial);
            }
        }
    }
}else{
    echo "Algo salio mal";
}
?>