<div class="main">
    <div class="sectionMain">
        <h3>Libros</h3>
        <a href="agregar/addLibro.php" class="btn-noticia">Agregar Libro</a>
        <a href="../admin/main.php?id=4" class="btn-noticia">Ver más</a>
        <a href="../admin/main.php?id=5" class="btn-noticia">Ver Libro-Autor</a>
    </div>
    <div class="select">
        <div class="resultLibro">
            <table>
                <!-- <caption>NOTICIA</caption> -->
                <tr>
                    <th>ISBN</th>
                    <th>Título</th>
                    <th>Publicación</th>
                    <th>Editorial</th>
                    <th>Genero</th>
                </tr>
                <?php
                require "select.php";
                $query = new select();
                $libros = $query->getLibros();
                if($libros){
                    foreach($libros as $data){
                        ?>
                        <tr>
                            <td><?php echo $data['ISBN'] ?></td>
                            <td><?php echo $data['titulo']; ?></td>
                            <td><?php echo $data['fecha_publi'] ?></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <?php
                            $genero = $query->getGeneroID($data['ISBN']);
                            if($genero){
                                foreach($genero as $dat){
                                    if($dat['nombre']==""){
                                        ?>
                                        <td><a class="addG" href="agregar/addLibroGenero.php?ISBN=<?php echo $data['ISBN']; ?>">Agrega un genero</a></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td><?php echo $dat['nombre']; ?></td>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <td class="modify"><a href="modificar/modificarLibro.php?ISBN=<?php echo $data['ISBN']; ?>"><i class="fas fa-marker"></i></a></td>
                            <td class="delete"><a href="eliminar/datoRecibido.php?ISBN=<?php echo $data['ISBN']; ?>"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>