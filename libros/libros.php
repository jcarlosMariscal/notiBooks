<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main class="mainBooks">
        <section class="sectionBooks">
            <?php
            require "selectLibro.php";
            $query = new selectLibro();
            $libro = $query->mainBook();
            if($libro){
                foreach($libro as $data){
                    $titulo = $data['titulo'];
                    $ISBN = $data['ISBN'];
                    $portada = $data['portada'];
                    $fecha_publi = $data['fecha_publi'];
                    $editorial = $data['editorial'];
                    ?>
                    <article class="pageBook">
                        <h4><?php echo $titulo; ?></h4>
                        <img src="<?php echo $portada; ?>" alt="20" >
                        <p >ISBN: <?php echo $ISBN; ?></p>
                        <p >Fecha p.: <?php echo $fecha_publi; ?></p>
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
            <!-- <article class="pageBook">
                <h4>El atardecer dorado</h4>
                <img src="img/portada2.jpg" alt="20">
                <p >ISBN: 12-325-255-52</p>
                <p >Fecha p.: 2021-02-14</p>
                <p >Editorial: El planeta</p>
                <p >Genero: Fantasía</p><br>
                <div class="center">
                    <a class="btn" href="index.php?libro=6">Leer más</a>
                </div>
            </article>
            <article class="pageBook">
                <h4>El atardecer dorado</h4>
                <img src="img/portada3.jpg" alt="20">
                <p >ISBN: 12-325-255-52</p>
                <p >Fecha p.: 2021-02-14</p>
                <p >Editorial: El planeta</p>
                <p >Genero: Fantasía</p><br>
                <div class="center">
                    <a class="btn" href="index.php?libro=6">Leer más</a>
                </div>
            </article> -->
            <!-- <article class="pageBook">
                <h4>El atardecer dorado</h4>
                <img src="img/portada4.jpg" alt="20">
                <p >ISBN: 12-325-255-52</p>
                <p >Fecha p.: 2021-02-14</p>
                <p >Editorial: El planeta</p>
                <p >Genero: Fantasía</p><br>
                <div class="center">
                    <a class="btn" href="index.php?libro=6">Leer más</a>
                </div>
            </article> -->
            <!-- <article class="pageBook">
                <h4>El atardecer dorado</h4>
                <img src="img/portada5.jpg" alt="20">
                <p >ISBN: 12-325-255-52</p>
                <p >Fecha p: 2021-02-14</p>
                <p >Editorial: El planeta</p>
                <p >Genero: Fantasía</p><br>
                <div class="center">
                    <a class="btn" href="index.php?libro=6">Leer más</a>
                </div>
            </article> -->
            <!-- <article class="pageBook">
                <h4>El atardecer dorado</h4>
                <img src="img/portada6.jpg" alt="20">
                <p >ISBN: 12-325-255-52</p>
                <p >Fecha p.: 2021-02-14</p>
                <p >Editorial: El planeta</p>
                <p >Genero: Fantasía</p><br>
                <div class="center">
                    <a class="btn" href="index.php?libro=6">Leer más</a>
                </div>
            </article> -->
            <!-- <article class="pageBook">
                <h4>El atardecer dorado</h4>
                <img src="img/portada1.jpg" alt="20">
                <p >ISBN: 12-325-255-52</p>
                <p >Fecha p.: 2021-02-14</p>
                <p >Editorial: El planeta</p>
                <p >Genero: Fantasía</p><br>
                <div class="center">
                    <a class="btn" href="index.php?libro=6">Leer más</a>
                </div>
            </article> -->
            <!-- <article class="pageBook">
                <h4>El atardecer dorado</h4>
                <img src="img/portada2.jpg" alt="20">
                <p >ISBN: 12-325-255-52</p>
                <p >Fecha p.: 2021-02-14</p>
                <p >Editorial: El planeta</p>
                <p >Genero: Fantasía</p><br>
                <div class="center">
                    <a class="btn" href="index.php?libro=6">Leer más</a>
                </div>
            </article> -->
            <!-- <article class="pageBook">
                <h4>El atardecer dorado</h4>
                <img src="img/portada3.jpg" alt="20">
                <p >ISBN: 12-325-255-52</p>
                <p >Fecha p.: 2021-02-14</p>
                <p >Editorial: El planeta</p>
                <p >Genero: Fantasía</p><br>
                <div class="center">
                    <a class="btn" href="index.php?libro=6">Leer más</a>
                </div>
            </article> -->
            <!-- <article class="pageBook">
                <h4>El atardecer dorado</h4>
                <img src="img/portada4.jpg" alt="20">
                <p >ISBN: 12-325-255-52</p>
                <p >Fecha p.: 2021-02-14</p>
                <p >Editorial: El planeta</p>
                <p >Genero: Fantasía</p><br>
                <div class="center">
                    <a class="btn" href="index.php?libro=6">Leer más</a>
                </div>
            </article> -->
            <!-- <article class="pageBook">
                <h4>El atardecer dorado</h4>
                <img src="img/portada5.jpg" alt="20">
                <p >ISBN: 12-325-255-52</p>
                <p >Fecha p.: 2021-02-14</p>
                <p >Editorial: El planeta</p>
                <p >Genero: Fantasía</p><br>
                <div class="center">
                    <a class="btn" href="index.php?libro=6">Leer más</a>
                </div>
            </article> -->
        </section>
    </main>
</body>
</html>