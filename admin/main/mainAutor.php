<div class="main">
    <div class="sectionMain">
        <label for="periodista">Autor |</label>
        <a href="agregar/addAutor.php" class="btn-noticia">Agregar Autor</a>
        <a href="../admin/main.php?id=5" class="btn-noticia">Ver Libro-Autor</a>
    </div>
    <div class="select">
        <div class="result">
            <table>
                <!-- <caption>NOTICIA</caption> -->
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Profesion</th>
                    <th>Nacimiento</th>
                    <th>Muerte</th>
                </tr>
                <?php
                require "select.php";
                $query = new select();
                $autor = $query->getAutores();
                if($autor){
                    foreach($autor as $data){
                        ?>
                        <tr>
                            <td><?php echo $data['id_autor']; ?></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td><?php echo $data['profesion']; ?></td>
                            <td><?php echo $data['nacimiento']; ?></td>
                            <td><?php echo $data['fallecimiento']; ?></td>
                            <td class="modify"><a href="modificar/modificarAutor.php?autor=<?php echo $data['id_autor']; ?>"><i class="fas fa-marker"></i></a></td>
                            <td class="delete"><a href="#" onclick="eliminarAutor(id='<?php echo $data['id_autor']; ?>',nombre='<?php echo $data['nombre']; ?>')"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <form id="eliminarAutor" hidden></form>
        </div>
    </div>
</div>
<script src="../js/eliminar.js"></script>