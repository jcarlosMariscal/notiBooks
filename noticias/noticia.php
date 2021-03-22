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
                        $id = $data['id_noticia']; $titulo = $data['titulo']; $entrada = $data['entrada']; $cuerpo = $data['cuerpo']; $fotografia = $data['fotografia']; $fecha = $data['fecha'];$periodista = $data['periodista']; $categoria = $data['categoria'];$id_periodista = $data['id_periodista'];
                    }
                }
            ?>
            <article>
                <img src="<?php echo $fotografia; ?>" alt="" height="260">
                <h2><?php echo $titulo; ?></h2>
                <h4><?php echo $entrada; ?></h4>
                <p>Por: <a class="c" href="busqueda.php?periodista=<?php echo $id_periodista; ?>"><?php echo $periodista; ?></a> - <?php echo $fecha; ?></p>
                <p><?php echo $cuerpo; ?></p>
                
            </article>
        </section>
        <section class="noti clear">
            <div class="notis">
                <div class="title">
                    <h3>Noticias similares</h3>
                </div>
                <?php
                $moreNoticia = $query->moreNoticia($categoria,$id);
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
            </div>
        </section>
    </main>
</body>
</html>