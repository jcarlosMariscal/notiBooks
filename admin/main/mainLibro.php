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
                    <th>Id_Genero</th>
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
                            <td>2</td>
                            <td class="delete"><i class="far fa-trash-alt"></i></td>
                            <td class="modify"><i class="fas fa-marker"></i></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>