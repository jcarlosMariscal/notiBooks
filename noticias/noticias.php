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
        <section class="sectionNoticias">
            <!-- <div class="titleSection">
                <h2 class="center">Noticias mas recientes</h2>
            </div> -->
            <?php
            include "selectNoticia.php";
            $recibido = $_GET['pagina'];
            $query = new selectNoticia();
            $noticia = $query->mainNoticia($recibido);
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
                        <img src="<?php echo $fotografia; ?>" alt="20" >
                        <p class="spans"><?php echo $fecha; ?> - <?php echo $periodista; ?></p>
                        <h4><?php echo $titulo; ?></h4>
                        <p><?php echo $entrada; ?></p><br>
                        <div class="center">
                            <a class="btn" href="index.php?noticia=<?php echo $id_noticia; ?>">Leer más</a>
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
                    $paginador = $query ->paginador("id_noticia","noticia",$recibido);
                    $total_pag = $paginador[2];
                    $total_registro = $paginador[3];
                    $contador = $query->mainNoticia($recibido);
                    $rango = 10;
                    if($total_registro>=9){

                        ?><li class="<?php echo $recibido<=1 ? 'disabled' : '' ?>"><a href="index.php?id=noticias&pagina=<?php echo $recibido-1; ?>">«</a></li><?php

                        if($total_pag<=$rango){
                            for($i=1; $i<=$total_pag; $i++):?>
                                <li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="index.php?id=noticias&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor;
                        }else{

                            for($i=max(1, min($recibido-4,$total_pag-($rango-1))); $i<=max($rango, min($recibido+5,$total_pag)); $i++):?>
                            <!-- for($i=max(1, min($recibido-4,$total_pag-9)); $i<=max(10, min($recibido+5,$total_pag)); $i++):?> -->
                                <li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="index.php?id=noticias&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor;
                        }

                        ?><li class="<?php echo $recibido>=$total_pag ? 'disabled' : '' ?>"><a href="index.php?id=noticias&pagina=<?php echo $recibido+1; ?>">»</a></li><?php

                    }
                ?>
            </ul>
        </section>
    </main>
</body>
</html>