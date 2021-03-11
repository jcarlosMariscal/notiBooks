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
    <main class="mainBook">
        <section class="sectionBook">
            <article>
                <?php 
                require "selectAutor.php";
                $id_autor = $_GET['autor'];
                $query = new selectAutor();
                $autor = $query->autor($id_autor); 
                if($autor){
                    while($data = $autor->fetch()){
                        $nombre = $data['nombre']; 
                        $profesion = $data['profesion']; 
                        $nacimiento = $data['nacimiento']; 
                        $fallecimiento = $data['fallecimiento']; 
                        $biografia = $data['biografia']; 
                        $obras = $data['obras']; 
                        $imagen = $data['imagen']; 
                    }
                }
                ?>
                <img src="<?php echo $imagen?>" alt="">
                <p></p>
                <h2><?php echo $nombre; ?></h2>
                <h4><?php echo $profesion; ?></h4>
                <p><?php echo $nacimiento; echo " - ".$fallecimiento ?></p>
                <p><?php echo $biografia; ?></p>
            </article>
        </section>
        <section class="autorBook">
            <div><h3>Libros escritos</h3></div>
            <div class="books">
                <?php
                $libro = $query->libroAutor($id_autor);
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
        </section>
    </main>
</body>
</html>