<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $editorial = ( empty ($_GET['editorial'] ) ? NULL : $_GET['editorial']);
        $autor = ( empty ($_GET['autor'] ) ? NULL : $_GET['autor']);
        $genero = ( empty ($_GET['genero'] ) ? NULL : $_GET['genero']);
        $periodista = ( empty ($_GET['periodista'] ) ? NULL : $_GET['periodista']);
        $temas = ( empty ($_GET['temas'] ) ? NULL : $_GET['temas']);
        $frase = ( empty ($_GET['frase'] ) ? NULL : $_GET['frase']);

        if($editorial){
            ?>
                <title>Search | Editorial</title>
            <?php
        }
    ?>
</head>
<body>
    <?php include  "header.php"; ?>
    <?php
        if($editorial or $temas){
            if($editorial == $editorial){
                include  "busqueda/resultado.php";
            }elseif($temas == "editorial"){
                include "busqueda/resultado.php?editorial=$frase";
            }
        }elseif($autor or $temas){
            if($editorial == $editorial){
                include  "busqueda/resultado.php";
            }elseif($temas == "autor"){
                include "busqueda/resultado.php?autor=$frase";
            }
        }elseif($genero){
            if($editorial == $editorial){
                include  "busqueda/resultado.php";
            }elseif($temas == "genero"){
                include "busqueda/resultado.php?genero=$frase";
            }
        }elseif($periodista){
            include "busqueda/periodista.php";
        }else{
            echo "No se encontró, intenta con otra cosa o verficando la redaccion";
        }
        include  "footer.php";
    ?>
</body>
</html>