<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main class="main">
        <div class="cabeza">
            <?php 
                require "main/selectMain.php";
                $query = new selectMain();
                $autor = $query->pageMainAutor(); 
                if($autor){
                    foreach($autor as $data){
                        ?>
                        <h2><?php echo $data['nombre']; ?></h2>
                        <p><?php echo $data['obras']; ?> <a class="a" href="index.php?autor=<?php  echo $data['id_autor']; ?>">Leer más...</a></p>
                        <?php
                    }
                }
            ?>
        </div>
        <section class="section">
            <div class="titleSection">
                <h2 class="center">Noticias mas recientes</h2>
            </div>
            <?php
                $noticia = $query->pageMainNoticia(); 
                if($noticia){
                    foreach($noticia as $data){
                        $titulo = $data[0];
                        $fotografia = $data[1];
                        $fecha = $data[2];
                        $periodista = $data['nombre'];
                        $id = $data['id_noticia'];
                        ?>
                            <article class="noticiaMain">
                                <h4><?php echo $titulo; ?></h4>
                                <img src="<?php echo $fotografia ?>" alt="">
                                <p class="spans"><?php echo $fecha; ?> - <?php echo $periodista; ?></p>
                                <div class="center">
                                    <a class="btn" href="index.php?noticia=<?php echo $id; ?>">Leer más</a>
                                </div>
                            </article>
                        <?php
                    }
                }
            ?>
        </section>
        <aside >
            <div><h3>Libros escritos</h3></div>
            <div class="books">
                <?php
                $libro = $query->pageMainLibros();
                if($libro){
                    foreach($libro as $data){
                        $ISBN = $data[0];
                        $portada = $data[1];
                        $titulo = $data[2];
                        ?>
                        <div class="book">
                            <img src="<?php echo $portada; ?>" alt="" >
                            <p><?php echo $titulo; ?></p>
                            <p><?php $get = $query -> getAutor($ISBN); 
                                if($get){foreach($get as $autor){echo $autor[0];}}
                            ?></p>
                            <p><?php $genero = $query -> getGenero($ISBN); 
                                if($genero){foreach($genero as $data){echo $data[0]." " ;}}
                            ?></p>
                            <a class="a" href="index.php?libro=<?php echo $ISBN; ?>">Más información</a>
                        </div>&nbsp
                        <?php
                    }
                }
                ?>
            </div>
            </aside>
        <section class="autors clear">
            <h3>Puede encontrar libros por el autor, genero o editorial. Pruebe las siguientes:</h3>
            <div class="busc">
                <?php
                $nameAutor = $query->pageNameAutor();
                if($nameAutor){
                    ?><p>Autores: <?php
                    foreach($nameAutor as $data){
                        $id=$data[0];
                        $nombre=$data[1];
                        ?>
                        <a class="c" href="busqueda.php?autor=<?php echo $id; ?>"> <?php echo $nombre; ?> </a>
                        <?php
                    }
                    ?></p><?php
                }
                ?>
            </div>
            <div class="busc">
                <?php
                $genero = $query->pageMainGenero();
                if($genero){
                    ?><p>Genero: <?php
                    foreach($genero as $data){
                        $id=$data[0];
                        $nombre=$data[1];
                        ?>
                        <a class="c" href="busqueda.php?genero=<?php echo $id; ?>"> <?php echo $nombre; ?></a>
                        <?php
                    }
                    ?></p><?php
                }
                ?>
            </div>
            <div class="busc">
                <?php
                $editorial = $query->pageMainEditorial();
                if($editorial){
                    ?><p>Editorial: <?php
                    foreach($editorial as $data){
                        $id=$data[0];
                        $nombre=$data[1];
                        ?>
                        <a class="c" href="busqueda.php?editorial=<?php echo $id; ?>"> <?php echo $nombre; ?></a>
                        <?php
                    }
                    ?></p><?php
                }
                ?>
            </div>
        </section>
    </main>
</body>
</html>