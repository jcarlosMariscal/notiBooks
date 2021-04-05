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
    <main class="main">
        <section class="sectionBook">
            <?php
                include "selectResultado.php";
                $query = new selectResultado();
                $editorial = ( empty ($_GET['editorial'] ) ? NULL : $_GET['editorial']);
                $autor = ( empty ($_GET['autor'] ) ? NULL : $_GET['autor']);
                $genero = ( empty ($_GET['genero'] ) ? NULL : $_GET['genero']);
                $temas = ( empty ($_GET['temas'] ) ? NULL : $_GET['temas']);
                $frase = ( empty ($_GET['frase'] ) ? NULL : $_GET['frase']);
                $recibido = ( empty ($_GET['pagina'] ) ? NULL : $_GET['pagina']);
                if(!$recibido){
                    $recibido = 1;
                }
                
                if($temas == "nombre"){
                    $libro = $query->getNameBook($frase,$recibido);
                    $nom = $frase;
                    $referencia = "libroName";
                    $tabla = "libro";
                    $aut = $_GET['frase'];
                    if($libro->rowCount()){
                        ?><h2>Libros encontrados que se relacionan con el <?php echo $temas; ?>: <b><?php echo $frase ?></b> </h2><?php
                    }else{
                        ?><h2>No se encontraron libros relacionados con la búsqueda: <b><?php echo $frase ?></b> <br> Intente con otro</h2><?php
                    }
                }elseif($autor or $temas=="autor"){
                    $tablaRelacion = "autor_libro";
                    $tablaDestino = "autor";
                    $idTabla = "id_autor";
                    $referencia = "libro";
                    if($autor){
                        $aut = $_GET['autor'];
                        $tabla = "autor";
                        $nombreAutor = $query-> getIDTable($autor,$tabla);
                        if($nombreAutor){foreach($nombreAutor as $data){$nom = $data['nombre'];}}
                        $libro = $query->libro($nom,$idTabla,$tablaRelacion,$tablaDestino,$recibido);
                        if($libro->rowCount()){
                            ?><h2>Libros del Autor: <a class="a" href="index.php?autor=<?php echo $autor; ?>"><?php echo $nom ?></a></h2><?php
                        }else{
                            ?><h2>Actualmente no hay ningún libro de este autor en la base de datos: <b><?php echo $nom ?></b><?php
                        }
                    }elseif($temas=="autor"){
                        $aut = $_GET['frase'];
                        $nom = $aut;
                        $libro = $query->libro($frase,$idTabla,$tablaRelacion,$tablaDestino,$recibido);
                        if($libro->rowCount()>0){
                            ?><h2>Libros encontrados que se relacionan con el <?php echo $temas; ?>: <b><?php echo $frase ?></b> </h2><?php
                        }else{
                            ?><h2>No se encontraron libros relacionados con la búsqueda: <b><?php echo $frase ?></b> <br> Intente con otro</h2><?php
                        }
                    }
                }elseif($editorial or $temas=="editorial"){
                    $referencia = "editorial";
                    if($editorial){
                        $aut = $_GET['editorial'];
                        $tabla = "editorial";
                        $nombreEditorial = $query->getIDTable($editorial,$tabla);
                        if($nombreEditorial){ foreach($nombreEditorial as $data) { $nom = $data['nombre']; } }
                        $libro = $query->getBookEditorial($nom,$recibido);
                        if($libro->rowCount()){
                            ?><h2>Libros con la editorial: <b><?php echo $nom ?></b></h2><?php
                        }else{
                            ?><h2>Actualmente no hay ningún libro con esta editorial en la base de datos: <b><?php echo $nom ?></b><?php
                        }
                    }elseif($temas=="editorial"){
                        $aut = $_GET['frase'];
                        $nom = $aut;
                        $libro = $query->getBookEditorial($frase,$recibido);
                        if($libro->rowCount() > 0){
                            ?><h2>Libros encontrados que se relacionan con el <?php echo $temas; ?>: <b><?php echo $frase ?></b> </h2><?php
                        }else{
                            ?><h2>No se encontraron libros relacionados con la búsqueda: <b><?php echo $frase ?></b> <br> Intente con otro</h2><?php
                        }
                    }
                }elseif($genero or $temas=="genero"){
                    $tablaRelacion = "libro_genero";
                    $idTabla = "id_genero";
                    $referencia = "genero";
                    if($genero){
                        $aut = $_GET['genero'];
                        $tabla = "genero";
                        $nombreGenero = $query-> getIDTable($genero,$tabla);
                        if($nombreGenero){foreach($nombreGenero as $data){$nom = $data['nombre']; }}
                        $libro =$query->libro($nom,$idTabla,$tablaRelacion,$referencia,$recibido);
                        if($libro->rowCount()){
                            ?><h2>Libros con el genero: <b><?php echo $nom ?></b> </h2><?php
                        }else{
                            ?><h2>Actualmente no hay ningún libro con esta editorial en la base de datos: <b><?php echo $nom ?></b><?php
                        }
                    }elseif($temas=="genero"){
                        $aut = $_GET['frase'];
                        $nom = $aut;
                        $libro = $query->libro($frase,$idTabla,$tablaRelacion,$referencia,$recibido);
                        if($libro->rowCount() > 0){
                            ?><h2>Libros encontrados que se relacionan con el <?php echo $temas; ?>: <b><?php echo $frase ?></b> </h2><?php
                        }else{
                            ?><h2>No se encontraron libros relacionados con la búsqueda: <b><?php echo $frase ?></b> <br> Intente con otro</h2><?php
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
                        <article class="pageBook">
                            <img src="<?php echo $portada; ?>" alt="20" >
                            <h4><?php echo $titulo; ?></h4>
                            <p >Genero: <?php $genero=$query->getGenero($ISBN); if($genero){foreach($genero as $data){ echo $data[0]; }} ?></p>
                            <p >Editorial: <?php echo $editorial; ?></p>
                            <p class="">De: <?php $autor=$query->getAutor($ISBN); if($autor){ foreach($autor as $data){ echo $data['nombre']; } } ?></p>
                            <div class="center">
                                <a class="btn" href="index.php?libro=<?php echo $ISBN; ?>">Leer más</a>
                            </div>
                        </article>
                        <?php
                    }
                }

            ?>
        </section>
        <section class="paginacion clear">
            <ul class="paginador">
                <?php
                    $paginador = $query ->paginador($referencia,$recibido,$nom);
                    $inicio = $paginador[0];
                    $limit_pag = $paginador[1];
                    $total_pag = $paginador[2];
                    $total_registro = $paginador[3];

                    $rango = 10;
                    if($total_registro>=9){
                        if($temas){
                            $tema = $_GET['temas'];
                            ?><li class="<?php echo $recibido<=1 ? 'disabled' : '' ?>"><a href="busqueda.php?temas=<?php echo $tema; ?>&frase=<?php echo $aut; ?>&pagina=<?php echo $recibido-1; ?>">«</a></li><?php
                        }else{
                            ?><li class="<?php echo $recibido<=1 ? 'disabled' : '' ?>"><a href="busqueda.php?<?php echo $tabla; ?>=<?php echo $aut ?>&pagina=<?php echo $recibido-1; ?>">«</a></li><?php
                        }

                        if($total_pag<=$rango){
                            for($i=1; $i<=$total_pag; $i++):
                            if($temas){
                                $tema = $_GET['temas'];
                                ?>
                                <li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="busqueda.php?temas=<?php echo $tema; ?>&frase=<?php echo $aut; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                            }else{
                                ?>
                                <li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="busqueda.php?<?php echo $tabla; ?>=<?php echo $aut ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                            }
                             endfor;
                        }else{

                            for($i=max(1, min($recibido-4,$total_pag-($rango-1))); $i<=max($rango, min($recibido+5,$total_pag)); $i++):
                            if($temas){
                                $tema = $_GET['temas'];
                                ?>
                                <li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="busqueda.php?temas=<?php echo $tema; ?>&frase=<?php echo $aut; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                            }else{
                                ?>
                                <li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="busqueda.php?<?php echo $tabla; ?>=<?php echo $aut ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                            }
                            endfor;
                        }

                        if($temas){
                            $tema = $_GET['temas'];
                            ?>
                            <li class="<?php echo $recibido>=$total_pag ? 'disabled' : '' ?>"><a href="busqueda.php?temas=<?php echo $tema; ?>&frase=<?php echo $aut; ?>&pagina=<?php echo $recibido+1; ?>">»</a></li>
                            <?php
                        }else{
                            ?>
                            <li class="<?php echo $recibido>=$total_pag ? 'disabled' : '' ?>"><a href="busqueda.php?<?php echo $tabla; ?>=<?php echo $aut ?>&pagina=<?php echo $recibido+1; ?>">»</a></li>
                            <?php
                        }
                    }
                ?>
            </ul>
        </section>
    </main>
</body>
</html>