<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/busqueda.css">
</head>
<body>
    <main class="mainEditorial">
        <section class="sectionEditorial">
            <?php
                include "selectResultado.php";
                $query = new selectResultado();
                $editorial = ( empty ($_GET['editorial'] ) ? NULL : $_GET['editorial']);
                $autor = ( empty ($_GET['autor'] ) ? NULL : $_GET['autor']);
                $genero = ( empty ($_GET['genero'] ) ? NULL : $_GET['genero']);
                $temas = ( empty ($_POST['temas'] ) ? NULL : $_POST['temas']);
                $frase = ( empty ($_POST['frase'] ) ? NULL : $_POST['frase']);
                
                if($temas == "nombre"){
                    $libro = $query->getNameBook($frase);
                    if($libro->rowCount()){
                        ?><h2>Libros relacionados con el <?php echo $temas; ?>: <?php echo $frase ?></h2><?php
                    }else{
                        ?><h2>No se encontraron libros relacionados con el <?php echo $temas; ?>: <?php echo $frase ?></h2><?php
                    }
                }elseif($autor or $temas=="autor"){
                    $tablaRelacion = "autor_libro";
                    $tablaDestino = "autor";
                    $idTabla = "id_autor";
                    if($autor){
                        $tabla = "autor";
                        $nombreAutor = $query-> getIDTable($autor,$tabla);
                        if($nombreAutor){foreach($nombreAutor as $data){$nomAutor = $data['nombre'];}}
                        ?><h2>Libros del Autor: <a class="a" href="index.php?autor=<?php echo $autor; ?>"><?php echo $nomAutor ?></a></h2><?php
                        $libro = $query->libro($nomAutor,$idTabla,$tablaRelacion,$tablaDestino);
                    }elseif($temas=="autor"){
                        $libro = $query->libro($frase,$idTabla,$tablaRelacion,$tablaDestino);
                        if($libro->rowCount()>0){
                            ?><h2>Libros encontrados del <?php echo $temas; ?>: <?php echo $frase ?></h2><?php
                        }else{
                            ?><h2>No se encontraron libros sobre el <?php echo $temas; ?>: <?php echo $frase ?></h2><?php
                        }
                    }
                }elseif($editorial or $temas=="editorial"){
                    if($editorial){
                        $tabla = "editorial";
                        $nombreEditorial = $query->getIDTable($editorial,$tabla);
                        if($nombreEditorial){ foreach($nombreEditorial as $data) { $nomEditorial = $data['nombre']; } }
                        $libro = $query->getBookEditorial($nomEditorial);
                        ?><h2>Libros con la editorial: <?php echo $nomEditorial ?></h2><?php
                    }elseif($temas=="editorial"){
                        $libro = $query->getBookEditorial($frase);
                        if($libro->rowCount() > 0){
                            ?><h2>Libros encontrados con la <?php echo $temas; ?>: <?php echo $frase ?></h2><?php
                        }else{
                            ?><h2>No se encontraron libros con la <?php echo $temas; ?>: <?php echo $frase ?></h2><?php
                        }
                    }
                }elseif($genero or $temas=="genero"){
                    $tablaRelacion = "libro_genero";
                    $tablaDestino = "genero";
                    $idTabla = "id_genero";
                    if($genero){
                        $tabla = "genero";
                        $nombreGenero = $query-> getIDTable($genero,$tabla);
                        if($nombreGenero){foreach($nombreGenero as $data){$nomGenero = $data['nombre']; }}
                        $libro =$query->libro($nomGenero,$idTabla,$tablaRelacion,$tablaDestino);
                        ?><h2>Libros con el genero: <?php echo $nomGenero ?></h2><?php
                    }elseif($temas=="genero"){
                        $libro = $query->libro($frase,$idTabla,$tablaRelacion,$tablaDestino);
                        if($libro->rowCount() > 0){
                            ?><h2>Libros encontrados con el <?php echo $temas; ?>: <?php echo $frase ?></h2><?php
                        }else{
                            ?><h2>No se encontraron libros con el <?php echo $temas; ?>: <?php echo $frase ?></h2><?php
                        }
                    }
                }


                if($libro){
                    foreach($libro as $data){
                        $titulo = $data['titulo'];
                        $ISBN = $data['ISBN'];
                        $fecha_publi = $data['fecha_publi'];
                        $portada = $data['portada'];
                        $editorial = $data['editorial'];
                        ?>
                        <article class="pageEditorial">
                            <h4><?php echo $titulo; ?></h4>
                            <img src="<?php echo $portada; ?>" alt="20" >
                            <p >Autor: <?php $autor=$query->getAutor($ISBN); if($autor){ foreach($autor as $data){ echo $data['nombre']; } } ?></p>
                            <p >Genero: <?php $genero=$query->getGenero($ISBN); if($genero){foreach($genero as $data){ echo $data[0]; }} ?></p>
                            <p >Editorial: <?php echo $editorial; ?></p> <br>
                            <div class="center">
                                <a class="btn" href="index.php?libro=<?php echo $ISBN; ?>">Leer más</a>
                            </div>
                        </article>
                        <?php
                    }
                }

            ?>
        </section>
    </main>
</body>
</html>