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
                $recibido = ( empty ($_GET['pagina'] ) ? NULL : $_GET['pagina']);
                // $recibido = ( empty ($_GET['pagina'] ) ? NULL : $_GET['pagina']);
                $pag = ( empty ($_GET['pag'] ) ? NULL : $_GET['pag']);
                if(!$recibido){
                    $recibido = 1;
                }
                if(!$pag){
                    $pag = 1;
                }
                $id = ( empty ($_GET['id'] ) ? NULL : $_GET['id']);
                $editorial = $query->getEditorial($recibido);
                if($editorial){
                    foreach($editorial as $data){
                        ?>
                        <tr>
                            <td><?php echo $data['id_editorial']; ?></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td class="modify"><a href="modificar/modificarEditorial.php?editorial=<?php echo $data['id_editorial']; ?>"><i class="fas fa-marker"></i></a></td>
                            <td class="delete"><a href="#" onclick="eliminarEditorial(id='<?php echo $data['id_editorial']; ?>',nombre='<?php echo $data['nombre']; ?>')"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <section class="paginacion clear">
                <ul class="paginador">
                    <?php
                        $paginador = $query ->paginador("editorial",$recibido,null);
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
        <div class="selectCategoria">
            <table>
                <caption>GENERO</caption>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>
                <?php
                $genero = $query ->getGenero($pag);
                if($genero){
                    foreach($genero as $data){
                        ?>
                        <tr>
                            <td><?php echo $data['id_genero']; ?></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td class="modify"><a href="modificar/modificarGenero.php?genero=<?php echo $data['id_genero']; ?>"><i class="fas fa-marker"></i></a></td>
                            <td class="delete"><a href="#" onclick="eliminarGenero(id='<?php echo $data['id_genero']; ?>',nombre='<?php echo $data['nombre']; ?>')"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <form id="eliminarEditGen" hidden></form>
            <section class="paginacion clear">
                <ul class="paginador">
                    <?php
                        $paginador = $query ->paginador("genero",$pag,null);
                        $total_pag = $paginador[2];
                        $total_registro = $paginador[3];
                        $rango = 10;
                        if($total_registro>=2){
                            ?><li class="<?php echo $pag<=1 ? 'disabled' : '' ?>"><a href="main.php?id=<?php echo $id; ?>&pag=<?php echo $pag-1; ?>">«</a></li><?php
                            

                            if($total_pag<=$rango){
                                for($i=1; $i<=$total_pag; $i++):
                                ?><li><a class="<?php echo $pag==$i ? 'active' : '' ?>" href="main.php?id=<?php echo $id; ?>&pag=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
                                endfor;
                            }else{

                                for($i=max(1, min($pag-4,$total_pag-($rango-1))); $i<=max($rango, min($pag+5,$total_pag)); $i++):
                                ?><li><a class="<?php echo $pag==$i ? 'active' : '' ?>" href="main.php?id=<?php echo $id; ?>&pag=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
                                endfor;
                            }

                            ?><li class="<?php echo $pag>=$total_pag ? 'disabled' : '' ?>"><a href="main.php?id=<?php echo $id; ?>&pag=<?php echo $pag+1; ?>">»</a></li><?php

                        }
                    ?>
                </ul>
            </section>
        </div>

    </div>
</div>
<script src="../js/eliminar.js"></script>