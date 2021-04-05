<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/busqueda.css">
    <title>Document</title>
</head>
<body>
    <main class="main">
        <section class="sectionNoticias">
            <?php
            include "selectResultado.php";
            $query = new selectResultado();
            $periodista = ( empty ($_GET['periodista'] ) ? NULL : $_GET['periodista']);
            $recibido = $_GET['pagina'];

            if($periodista){
                $id_periodista = $periodista;
                $name = $query->getPeriodista($periodista);
                if($name){ foreach($name as $data){ $namePeriodista = $data['nombre']; } }
                ?><h2>Noticias de: <b><?php echo $namePeriodista; ?></b></h2><?php
                $perio = $query->getNoticia($periodista,$recibido);
                if($perio){
                    foreach($perio as $data){
                        $titulo = $data['titulo'];
                        $fotografia = $data['fotografia'];
                        $fecha = $data['fecha'];
                        $periodista = $data['nombre'];
                        $id = $data['id_noticia'];
                        ?>
                        <article class="noticiaPeriodista">
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
            }
            ?>
        </section>
        <section class="paginacion clear">
            <ul class="paginador">
                <?php
                    $paginador = $query->paginador("periodista",$recibido,$id_periodista);
                    $total_pag = $paginador[2];
                    $total_registro = $paginador[3];
                    // $contador = $query->getNoticia($periodista,$recibido);
                    $rango = 10;
                    if($total_registro>=9){

                        ?><li class="<?php echo $recibido<=1 ? 'disabled' : '' ?>"><a href="busqueda.php?periodista=<?php echo $id_periodista; ?>&pagina=<?php echo $recibido-1; ?>">«</a></li><?php

                        if($total_pag<=$rango){
                            for($i=1; $i<=$total_pag; $i++):?>
                                <li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="busqueda.php?periodista=<?php echo $id_periodista; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor;
                        }else{

                            for($i=max(1, min($recibido-4,$total_pag-($rango-1))); $i<=max($rango, min($recibido+5,$total_pag)); $i++):?>
                            <!-- for($i=max(1, min($recibido-4,$total_pag-9)); $i<=max(10, min($recibido+5,$total_pag)); $i++):?> -->
                                <li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="busqueda.php?periodista=<?php echo $id_periodista; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor;
                        }

                        ?><li class="<?php echo $recibido>=$total_pag ? 'disabled' : '' ?>"><a href="busqueda.php?periodista=<?php echo $id_periodista; ?>&pagina=<?php echo $recibido+1; ?>">»</a></li><?php

                    }
                ?>
            </ul>
        </section>
    </main>
</body>
</html>