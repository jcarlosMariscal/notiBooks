<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main class="mainNoticias">
        <section class="sectionNoticias">
            <?php
            include "selectNoticia.php";
            $query = new selectNoticia();
            $noticia = $query->mainNoticia();
            if($noticia){
                foreach($noticia as $data){
                    $titulo = $data['titulo'];
                    $fotografia = $data['fotografia'];
                    $fecha = $data['fecha'];
                    $entrada = $data['entrada'];
                    $periodista = $data['periodista'];
                    $id_noticia = $data['id_noticia'];
                    ?>
                    <article class="noticias">
                        <h4><?php echo $titulo; ?></h4>
                        <img src="<?php echo $fotografia; ?>" alt="20" >
                        <p class="spans"><?php echo $fecha; ?> - <?php echo $periodista; ?></p>
                        <p><?php echo $entrada; ?></p><br>
                        <div class="center">
                            <a class="btn" href="index.php?noticia=<?php echo $id_noticia; ?>">Leer más</a>
                        </div>
                    </article>
                    <?php
                }
            }
            ?>
            <!-- <article class="noticias">
                <h4>Por pandemia, se cae la venta de texcoco</h4>
                <img src="img/book2.jpg" alt="20">
                <p class="spans">13-02-2021 07:08:16 - Sasha Esparta</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat a eum perferendis atque fugiat placeat voluptatem Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat a eum perferendis</p><br>
                <div class="center">
                    <a class="btn" href="index.php?noticia=10">Leer más</a>
                </div>
            </article>
            <article class="noticias">
                <h4>Por pandemia, se cae la venta de texcoco</h4>
                <img src="img/book3.jpg" alt="20">
                <p class="spans">13-02-2021 07:08:16 - Sasha Esparta</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat a eum perferendis atque fugiat placeat voluptatem</p><br>
                <div class="center">
                    <a class="btn" href="index.php?noticia=10">Leer más</a>
                </div>
            </article>
            <article class="noticias">
                <h4>Por pandemia, se cae la venta de texcoco</h4>
                <img src="img/book4.jpg" alt="20">
                <p class="spans">13-02-2021 07:08:16 - Sasha Esparta</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat a eum perferendis atque fugiat placeat voluptatem</p><br>
                <div class="center">
                    <a class="btn" href="index.php?noticia=10">Leer más</a>
                </div>
            </article>
            <article class="noticias">
                <h4>Por pandemia, se cae la venta de texcoco</h4>
                <img src="img/book1.jpg" alt="20">
                <p class="spans">13-02-2021 07:08:16 - Sasha Esparta</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat a eum perferendis atque fugiat placeat voluptatem</p><br>
                <div class="center">
                    <a class="btn" href="index.php?noticia=10">Leer más</a>
                </div>
            </article>
            <article class="noticias">
                <h4>Por pandemia, se cae la venta de texcoco</h4>
                <img src="img/book3.jpg" alt="20">
                <p class="spans">13-02-2021 07:08:16 - Sasha Esparta</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat a eum perferendis atque fugiat placeat voluptatem</p><br>
                <div class="center">
                    <a class="btn" href="index.php?noticia=10">Leer más</a>
                </div>
            </article>
            <article class="noticias">
                <h4>Por pandemia, se cae la venta de texcoco</h4>
                <img src="img/book2.jpg" alt="20" >
                <p class="spans">13-02-2021 07:08:16 - Sasha Esparta</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat a eum perferendis atque fugiat placeat voluptatem</p><br>
                <div class="center">
                    <a class="btn" href="index.php?noticia=10">Leer más</a>
                </div>
            </article> -->
        </section>
    </main>
</body>
</html>