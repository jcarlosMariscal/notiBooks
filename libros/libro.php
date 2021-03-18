<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/notiBooks.css">
</head>
<body>
    <main class="bookMain">
        <section class="bookSection">
            <?php
            require "libros/selectLibro.php";
            $id = $_GET['libro'];
            $query = new selectLibro();
            $autor = $query->libro($id);
            if($autor){
                foreach($autor as $data){
                    $ISBN = $data['ISBN']; $titulo = $data['titulo']; $portada = $data['portada']; $prologo = $data['prologo']; $fecha_publi = $data['fecha_publi']; $editorial = $data['editorial']; $id = $data['id_editorial'];
                }
            }
            ?>
            <article>
                <img src="<?php echo $portada; ?>" alt="">
                <h2><?php echo $titulo; ?></h2>
                <p>ISBN: <?php echo $ISBN; ?></p>
                <p><?php echo $fecha_publi; ?> - <?php echo $editorial; ?></p>
                <p><?php $genero = $query->getGenero($ISBN); if($genero){foreach($genero as $data){echo $data['nombre']; }} ?></p>
                <p><?php $autor = $query-> getAutor($ISBN); if($genero){foreach($autor as $data){echo $data['nombre']; }} ?></p>
                <p><?php echo $prologo; ?></p>
            </article>
        </section>

        <section class="bookGener">
            <div><h3>Libros similares</h3></div>
            <div class="books">
                <?php
                $moreLibro = $query->moreLibro($id);
                if($moreLibro){
                    foreach($moreLibro as $data){
                        $ISBN = $data['ISBN'];
                        $titulo = $data['titulo'];
                        $portada = $data['portada'];
                        ?>
                        <div class="book">
                            <img src="<?php echo $portada; ?>" alt="">
                            <p><?php echo $titulo; ?></p>
                            <p><?php $autor = $query-> getAutor($ISBN); if($genero){foreach($autor as $data){echo $data['nombre']; }} ?></p>
                            <p><?php $genero = $query->getGenero($ISBN); if($genero){foreach($genero as $data){echo $data['nombre']; }} ?></p>
                            <a class="a" href="index.php?libro=<?php echo $ISBN; ?>">Más información</a>
                        </div>&nbsp
                        <?php
                    }
                }
                ?>
            </div>
        </section>

        <section class="noti clear">
            <div class="notis">
                <div class="title">
                    <h3>Noticias que le puede interesar</h3>
                </div>
                <?php
                $moreNoticia = $query -> moreNoticia();
                if($moreNoticia){
                    foreach($moreNoticia as $data){
                        $id = $data['id_noticia'];
                        $titulo = $data['titulo'];
                        $fecha = $data['fecha'];
                        $fotografia = $data['fotografia'];
                        ?>
                        <div class="not">
                            <img src="<?php echo $fotografia; ?>" alt="" width="80">
                            <p><?php echo $titulo; ?></p>
                            <p><?php echo $fecha; ?>5</p>
                            <a class="a" href="index.php?noticia=<?php echo $id; ?>">Más información</a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </section>
    </main>
</body>
</html>