<div class="main">
    <div class="sectionMain">
        <?php
        $rol = $_SESSION["nombre"]["id_rol"];
        // $acceso = ( empty ($_GET['acceso'] ) ? NULL : $_GET['acceso']);
        $recibido = ( empty ($_GET['pagina'] ) ? NULL : $_GET['pagina']);
        if(!$recibido){
            $recibido = 1;
        }
        $id = ( empty ($_GET['id'] ) ? NULL : $_GET['id']);
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
                $categorias = $query->getCategorias($recibido);
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
            <section class="paginacion clear">
                <ul class="paginador">
                    <?php
                        $paginador = $query ->paginador("categoria",$recibido,null);
                        $total_pag = $paginador[2];
                        $total_registro = $paginador[3];
                        $rango = 10;
                        if($total_registro>=25){
                            ?><li class="<?php echo $recibido<=1 ? 'disabled' : '' ?>"><a href="main.php?id=<?php echo $id; ?>&pagina=<?php echo $recibido-1; ?>">«</a></li><?php
                            

                            if($total_pag<=$rango){
                                for($i=1; $i<=$total_pag; $i++):
                                ?><li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="main.php?id=<?php echo $id; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
                                endfor;
                            }else{

                                for($i=max(1, min($recibido-4,$total_pag-($rango-1))); $i<=max($rango, min($recibido+5,$total_pag)); $i++):
                                ?><li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="main.php?id=<?php echo $id; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
                                endfor;
                            }

                            ?><li class="<?php echo $recibido>=$total_pag ? 'disabled' : '' ?>"><a href="main.php?id=<?php echo $id; ?>&pagina=<?php echo $recibido+1; ?>">»</a></li><?php

                        }
                    ?>
                </ul>
            </section>
        </div>

    </div>
</div>
<script src="../js/eliminar.js"></script>