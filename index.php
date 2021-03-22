<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $pagina = ( empty ($_GET['id'] ) ? NULL : $_GET['id']);
    $libro = ( empty ($_GET['libro'] ) ? NULL : $_GET['libro']);
    $autor = ( empty ($_GET['autor'] ) ? NULL : $_GET['autor']);
    $noticia = ( empty ($_GET['noticia'] ) ? NULL : $_GET['noticia']);
    // $libroPag = ( empty ($_GET['pagina'] ) ? NULL : $_GET['pagina']);
    if($pagina){
        if($pagina=="inicio"){
            ?><title>INICIO</title><?php
        }elseif($pagina=="noticias"){
            ?><title>NOTICIAS</title><?php
        }elseif($pagina=="libros"){
            ?><title>LIBROS</title><?php
        }
    }elseif($libro){
        ?><title>LIBRO</title><?php
    }
    elseif($autor){
        ?><title>AUTOR</title><?php
    }elseif($noticia){
        ?><title>NOTICIA</title><?php
    }
    ?>
</head>
<body>
    <?php
        include "header.php";
        if($pagina){
            if($pagina=="inicio"){
                include "main/main.php";
            }elseif($pagina=="noticias"){
                include "noticias/noticias.php";
            }elseif($pagina=="libros"){
                include "libros/libros.php";
            }
        }elseif($libro){
            if($libro==$libro){
                include "libros/libro.php";
            }
        }elseif($autor){
            if($autor==$autor){
                include "autor/autor.php";
            }
        }elseif($noticia){
            if($noticia == $noticia){
                include "noticias/noticia.php";
            }

        }else{
            include "main/main.php";
        }
        include "footer.php";
    ?>
</body>
</html>