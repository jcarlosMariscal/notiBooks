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
    <main class="mainNoticia">
        <section class="sectionNoticia">
            <?php
                include "noticias/selectNoticia.php";
                $id = $_GET['noticia'];
                $query = new selectNoticia();
                $noticia = $query->noticia($id);
                if($noticia){
                    foreach($noticia as $data){ 
                        $titulo = $data['titulo']; 
                        $entrada = $data['entrada']; 
                        $cuerpo = $data['cuerpo']; 
                        $fotografia = $data['fotografia']; 
                        $fecha = $data['fecha'];
                        $periodista = $data['periodista'];
                        $categoria = $data['categoria'];
                        $id_periodista = $data['id_periodista'];
                    }
                    // while($data->fetch($noticia)){  DE ESTA FORMA NO ES POSIBLE OBTENER MUCHOS DATOS 
                    //     $titulo = $data['titulo'];
                    //     $entrada = $data['entrada'];
                    //     $cuerpo = $data['cuerpo'];
                    // }
                }
            ?>
            <article>
                <img src="<?php echo $fotografia; ?>" alt="" height="260">
                <h2><?php echo $titulo; ?></h2>
                <h4><?php echo $entrada; ?></h4>
                <p>Por: <a class="c" href="busqueda.php?periodista=<?php echo $id_periodista; ?>"><?php echo $periodista; ?></a></p>
                <p><?php echo $fecha; ?></p>
                <p><?php echo $cuerpo; ?></p>
                
            </article>
        </section>
        <section class="noti clear">
            <div class="notis">
                <div class="title">
                    <h3>Noticias similares</h3>
                </div>
                <?php
                $moreNoticia = $query->moreNoticia($categoria);
                if($moreNoticia){
                    foreach($moreNoticia as $data){
                        $id = $data['id_noticia'];
                        $titulo = $data['titulo'];
                        $fecha = $data['fecha'];
                        $fotografia = $data['fotografia'];
                        ?>
                        <div class="not">
                            <img src="<?php echo $fotografia; ?>" alt="" >
                            <p><?php echo $titulo; ?></p>
                            <p><?php echo $fecha; ?></p>
                            <a class="a" href="index.php?noticia=<?php echo $id; ?>">Más información</a>
                        </div>
                        <?php
                    }
                }
                ?>
                <!-- <div class="not">
                    <img src="img/book2.jpg" alt="" >
                    <p>FCE: por pandemia, se cae la venta de libros en “La Joseluisa”</p>
                    <p>2021-02-15</p>
                    <a class="a" href="">Más información</a>
                </div>
                <div class="not">
                    <img src="img/book3.jpg" alt="" >
                    <p>La luna</p>
                    <p>2021-02-15</p>
                    <a class="a" href="">Más información</a>
                </div>
                <div class="not">
                    <img src="img/book4.jpg" alt="" >
                    <p>La luna</p>
                    <p>2021-02-15</p>
                    <a class="a" href="">Más información</a>
                </div>
                <div class="not">
                    <img src="img/book1.jpg" alt="" >
                    <p>La luna</p>
                    <p>2021-02-15</p>
                    <a class="a" href="">Más información</a>
                </div>
                <div class="not">
                    <img src="img/book2.jpg" alt="" >
                    <p>La luna</p>
                    <p>2021-02-15</p>
                    <a class="a" href="">Más información</a>
                </div> -->
            </div>
        </section>
    </main>
</body>
</html>