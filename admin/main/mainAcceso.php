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
                $recibido = ( empty ($_GET['pagina'] ) ? NULL : $_GET['pagina']);
                if(!$recibido){
                    $recibido = 1;
                }
                $id = ( empty ($_GET['id'] ) ? NULL : $_GET['id']);
                $acceso = $query->getAcceso($recibido);
                if($acceso){
                    foreach($acceso as $data){
                        ?>
                        <tr>
                            <td><?php echo $data['id_acceso']; ?></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td><?php echo $data['rol']; ?></td>
                            <td class="modify"><a href="modificar/modificarAcceso.php?acceso=<?php echo $data['id_acceso']; ?>"><i class="fas fa-marker"></i></a></td>
                            <td class="delete"><a href="#" onclick="eliminarUser(id='<?php echo $data['id_acceso']; ?>',nombre='<?php echo $data['nombre']; ?>',rol='<?php echo $data['rol']; ?>')"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <form id="eliminarUser" hidden></form>
            <section class="paginacion clear">
                <ul class="paginador">
                    <?php
                        $paginador = $query ->paginador("acceso",$recibido,null);
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