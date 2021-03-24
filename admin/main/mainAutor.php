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
                $recibido = ( empty ($_GET['pagina'] ) ? NULL : $_GET['pagina']);
                if(!$recibido){
                    $recibido = 1;
                }
                $id = ( empty ($_GET['id'] ) ? NULL : $_GET['id']);
                $autor = $query->getAutores($recibido);
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
            <section class="paginacion clear">
                <ul class="paginador">
                    <?php
                        $paginador = $query ->paginador("autor",$recibido,null);
                        $total_pag = $paginador[2];
                        $total_registro = $paginador[3];
                        $rango = 10;
                        if($total_registro>=2){
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