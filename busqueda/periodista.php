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
        <section class="section">
        <?php
        include "selectResultado.php";
        $query = new selectResultado();
        $periodista = ( empty ($_GET['periodista'] ) ? NULL : $_GET['periodista']);
        if($periodista){
            $name = $query->getPeriodista($periodista);
            if($name){ foreach($name as $data){ $namePeriodista = $data['nombre']; } }
            ?><h3>Noticias esritas por el periodista: <?php echo $namePeriodista; ?></h3><?php
            $perio = $query->getNoticia($periodista);
            if($perio){
                foreach($perio as $data){
                    $titulo = $data['titulo'];
                    $fotografia = $data['fotografia'];
                    $fecha = $data['fecha'];
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
        }
        ?>
        </section>
    </main>
</body>
</html>