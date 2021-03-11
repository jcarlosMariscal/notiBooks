<div class="main">
    <div class="sectionMain">
        <label for="periodista">Editorial | </label>
        <a href="agregar/addEditorial.php" class="btn-noticia">Agregar Editorial</a>
        <label for="periodista">Genero | </label>
        <a href="agregar/addGenero.php" class="btn-noticia">Agregar Genero</a>
    </div>
    <div class="select">
        <div class="selectPeriodista">
            <table>
                <caption>EDITORIALES</caption>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>
                <?php
                require "select.php";
                $query = new select();
                $editorial = $query->getEditorial();
                if($editorial){
                    foreach($editorial as $data){
                        ?>
                        <tr>
                            <td><?php echo $data['id_editorial']; ?></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td class="modify"><a href="modificar/modificarEditorial.php?editorial=<?php echo $data['id_editorial']; ?>"><i class="fas fa-marker"></i></a></td>
                            <td class="delete"><a href="eliminar/datoRecibido.php?editorial=<?php echo $data['id_editorial']; ?>"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
        <div class="selectCategoria">
            <table>
                <caption>GENERO</caption>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>
                <?php
                $genero = $query ->getGenero();
                if($genero){
                    foreach($genero as $data){
                        ?>
                        <tr>
                            <td><?php echo $data['id_genero']; ?></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td class="modify"><a href="modificar/modificarGenero.php?genero=<?php echo $data['id_genero']; ?>"><i class="fas fa-marker"></i></a></td>
                            <td class="delete"><a href="eliminar/datoRecibido.php?genero=<?php echo $data['id_genero']; ?>"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>

    </div>
</div>