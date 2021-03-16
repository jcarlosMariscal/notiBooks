<div class="main">
    <div class="sectionMain">
    <label for="">Libros por genero</label>
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
                    <th>Genero(s)</th>
                </tr>
                <?php
                require "select.php";
                $query = new select();
                $autor = $query->getLibros();
                if($autor){
                    foreach($autor as $data){
                        ?>
                        <tr>
                            <td><?php echo $data['ISBN']; ?></td>
                            <td><?php echo $data['titulo']; ?></td>
                            <?php
                            $aut = $query->getGeneroID($data['ISBN']);
                            if($aut){
                                foreach($aut as $dat){
                                    if($dat['nombre'] == ""){
                                        ?><td><a class="addG" href="agregar/addLibroGenero.php?ISBN=<?php echo $data['ISBN']; ?>">Agrega un genero</a></td><?php
                                    }else{
                                        ?><td><?php echo $dat['nombre']; ?></td><?php
                                    }
                                }
                            }
                            ?>
                            <td class="modify"><a href="agregar/addLibroGenero.php?ISBN=<?php echo $data['ISBN']; ?>"><i class="fas fa-plus"></i></a></td>
                            <td class="delete"><a href="#" onclick="deleteGenBook(ISBN='<?php echo $data['ISBN']; ?>',autor='<?php echo $data['titulo']; ?>')"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <form id="libroAutor" hidden></form>
                        <?php
                    }    
                }
                ?>
            </table>
        </div>
    </div>
</div>

<script src="../js/eliminar.js"></script>