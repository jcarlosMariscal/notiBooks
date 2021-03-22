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
        <section class="sectionBook">
            <!-- <div class="titleSection">
                <h2 class="center">Noticias mas recientes</h2>
            </div> -->
            <?php
            require "selectLibro.php";
            $recibido = $_GET['pagina'];
            $query = new selectLibro();
            $libro = $query->mainBook($recibido);
            if($libro){
                foreach($libro as $data){
                    $titulo = $data['titulo'];
                    $ISBN = $data['ISBN'];
                    $portada = $data['portada'];
                    $fecha_publi = $data['fecha_publi'];
                    $editorial = $data['editorial'];
                    ?>
                    <article class="pageBook">
                        <img src="<?php echo $portada; ?>" alt="20" >
                        <h4><?php echo $titulo; ?></h4>
                        <p >Fecha Publicación: <?php echo $fecha_publi; ?></p>
                        <p >Editorial: <?php echo $editorial; ?></p>
                        <p >Genero: <?php $genero=$query->getGenero($ISBN); if($genero){ foreach($genero as $data){ echo $data['nombre']; } } ?></p><br>
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
                    $paginador = $query ->paginador("ISBN","libro",$recibido);
                    $total_pag = $paginador[2];
                    $total_registro = $paginador[3];
                    $contador = $query->mainBook($recibido);
                    $rango = 10;
                    if($total_registro>=5){

                        ?><li class="<?php echo $recibido<=1 ? 'disabled' : '' ?>"><a href="index.php?id=libros&pagina=<?php echo $recibido-1; ?>">«</a></li><?php

                        if($total_pag<=$rango){
                            for($i=1; $i<=$total_pag; $i++):?>
                                <li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="index.php?id=libros&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor;
                        }else{

                            for($i=max(1, min($recibido-4,$total_pag-($rango-1))); $i<=max($rango, min($recibido+5,$total_pag)); $i++):?>
                            <!-- for($i=max(1, min($recibido-4,$total_pag-9)); $i<=max(10, min($recibido+5,$total_pag)); $i++):?> -->
                                <li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="index.php?id=libros&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor;
                        }

                        ?><li class="<?php echo $recibido>=$total_pag ? 'disabled' : '' ?>"><a href="index.php?id=libros&pagina=<?php echo $recibido+1; ?>">»</a></li><?php

                    }
                ?>
            </ul>
        </section>
    </main>
</body>
</html>