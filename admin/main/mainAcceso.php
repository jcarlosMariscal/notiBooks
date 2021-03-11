<div class="main">
    <div class="sectionMain">
        <label for="periodista">Accesos |</label>
        <a href="../admin/login.php" class="btn-noticia">Agregar Nuevo</a>
    </div>
    <div class="select">
        <div class="result">
            <table>
                <!-- <caption>NOTICIA</caption> -->
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Rol</th>
                </tr>
                <?php
                require "select.php";
                $query = new select();
                $acceso = $query->getAcceso();
                if($acceso){
                    foreach($acceso as $data){
                        ?>
                        <tr>
                            <td><?php echo $data['id_acceso']; ?></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td><?php echo $data['rol']; ?></td>
                            <td class="modify"><a href="modificar/modificarAcceso.php?acceso=<?php echo $data['id_acceso']; ?>"><i class="fas fa-marker"></i></a></td>
                            <td class="delete"><a href="eliminar/datoRecibido.php?acceso=<?php echo $data['id_acceso']; ?>"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>