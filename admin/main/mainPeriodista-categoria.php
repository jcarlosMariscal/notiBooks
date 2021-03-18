<div class="main">
    <div class="sectionMain">
        <?php
        $rol = $_SESSION["nombre"]["id_rol"];
        if($rol == 2){
            ?>
            <a href="main.php?id=7" class="btn-noticia">Ver periodistas</a>
            <label for="periodista"> | </label>
            <a href="../admin/login.php" class="btn-noticia">Agregar periodista</a>
            <?php
        }
        ?>
        <!-- <label for="periodista">Categoria | </label> -->
        <a href="agregar/addCategoria.php" class="btn-noticia">Agregar categoria</a>
    </div>
    <div class="select">
        <?php
        require "select.php";
        $query = new select();

        ?>
        <div class="selectCategoria">
            <table>
                <caption>CATEGORIAS</caption>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>
                <?php
                $categorias = $query->getCategorias();
                if($categorias){
                    foreach($categorias as $data){
                        ?>
                        <tr>
                            <td><?php echo $data['id_categoria']; ?></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td class="modify"><a href="modificar/modificarCategoria.php?categoria=<?php echo $data['id_categoria']; ?>"><i class="fas fa-marker"></i></a></td>
                            <?php
                            if($rol == 2){
                                ?>
                            <td class="delete"><a href="#" onclick="deleteCategoria(id = <?php echo $data['id_categoria']; ?>)"><i class="far fa-trash-alt"></i></a></td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <form id="eliminarCategoria" hidden></form>
        </div>

    </div>
</div>
<script src="../js/eliminar.js"></script>