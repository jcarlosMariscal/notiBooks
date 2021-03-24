<div class="main">
    <div class="sectionMain">
        <?php
        require "select.php";
        $query = new select();
        $rol = $_SESSION["nombre"]["id_rol"];
        $periodista = $_SESSION["nombre"]["id_acceso"];

        $acceso = ( empty ($_GET['acceso'] ) ? NULL : $_GET['acceso']);
        $id = ( empty ($_GET['id'] ) ? NULL : $_GET['id']);
        $recibido = ( empty ($_GET['pagina'] ) ? NULL : $_GET['pagina']);
        
        if(!$recibido){
            $recibido=1;
        }

        if($rol == 1){
            ?>
            <label for="">Periodista | <?php echo $_SESSION["nombre"]["nombre"]; ?></label>
            <?php
        }
        if($rol == 2){
            ?>
            <div class="mainAdmin">
                <p>Administrador | Seleccione periodista: <b> 
                <?php 
                if(!$acceso || $acceso == "todos"){ echo "Todos"; } 
                $perio = $query->getPeriodistaID($acceso);
                if($perio){
                    foreach($perio as $data){
                        echo $data['nombre'];
                    }
                }
                ?> </b></p>
            </div>
            <div id="perio">
                <ul class="nav-perio">
                    <li><a href="../admin/main.php">Periodista</a>
                        <ul>
                            <li><a href="../admin/main.php?acceso=todos&pagina=1">Todos</a></li>
                            <?php
                            $periodistas = $query->getPeriodistas();
                            if($periodistas){
                                foreach($periodistas as $data){
                                    ?>
                                    <li><a href="../admin/main.php?acceso=<?php echo $data['id_acceso']; ?>&pagina=1"><?php echo $data['nombre']; ?></a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <a href="../admin/main.php?id=2" class="btn-noticia">Ver Más</a>
            <?php
        }
        ?>
        <a href="agregar/addNoticia.php" class="btn-noticia">Agregar noticia</a>
    </div>
    <div class="select">
        <div class="result">
            <table>
                <!-- <caption>NOTICIA</caption> -->
                <tr>
                    <th>#</th>
                    <th>ID_noticia</th>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Categoria</th>
                </tr>
                <?php
                if($rol == 2){
                    if($acceso){
                        $noticias = $query->getNoticias($acceso,$recibido);
                    }else{
                        $acceso = "todos";
                        $noticias = $query->getNoticias($acceso,$recibido);
                    }
                }

                if($rol == 1){
                    $acceso = $periodista;
                    $noticias = $query->getNoticias($acceso,$recibido);
                }
                if($noticias){
                    $i=1;
                    foreach($noticias as $data){
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $data["id_noticia"]; ?></td>
                            <td><?php echo $data["titulo"]; ?></td>
                            <td><?php echo $data["fecha"]; ?></td>
                            <td><?php echo $data["nombre"]; ?></td>
                            <td class="modify"><a href="modificar/modificarNoticia.php?noticia=<?php echo $data['id_noticia']; ?>"><i class="fas fa-marker"></i></a></td>
                            <td class="delete"><a href="#" onclick="deleteNoticia(id = <?php echo $data['id_noticia']; ?>)"><i class="far fa-trash-alt"></i></a></td>
                            
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
            </table>
            <form id="eliminarNoticia" hidden></form>
            <section class="paginacion clear">
                <ul class="paginador">
                    <?php
                        $paginador = $query ->paginador("noticia",$recibido,$acceso);
                        $total_pag = $paginador[2];
                        $total_registro = $paginador[3];
                        $rango = 10;
                        if($total_registro>=2){
                            if(!$id){
                                ?><li class="<?php echo $recibido<=1 ? 'disabled' : '' ?>"><a href="main.php?acceso=<?php echo $acceso; ?>&pagina=<?php echo $recibido-1; ?>">«</a></li><?php
                            }else{
                                ?><li class="<?php echo $recibido<=1 ? 'disabled' : '' ?>"><a href="main.php?id=<?php echo $id; ?>&pagina=<?php echo $recibido-1; ?>">«</a></li><?php
                            }

                            if($total_pag<=$rango){
                                for($i=1; $i<=$total_pag; $i++):
                                if(!$id){
                                    ?><li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="main.php?acceso=<?php echo $acceso; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
                                }else{
                                    ?><li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="main.php?id=<?php echo $id; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
                                }
                                endfor;
                            }else{

                                for($i=max(1, min($recibido-4,$total_pag-($rango-1))); $i<=max($rango, min($recibido+5,$total_pag)); $i++):
                                if(!$id){
                                    ?><li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="main.php?acceso=<?php echo $acceso; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
                                }else{
                                    ?><li><a class="<?php echo $recibido==$i ? 'active' : '' ?>" href="main.php?id=<?php echo $id; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
                                }
                                endfor;
                            }

                            if(!$id){
                                ?><li class="<?php echo $recibido>=$total_pag ? 'disabled' : '' ?>"><a href="main.php?acceso=<?php echo $acceso; ?>&pagina=<?php echo $recibido+1; ?>">»</a></li><?php
                            }else{
                                ?><li class="<?php echo $recibido>=$total_pag ? 'disabled' : '' ?>"><a href="main.php?id=<?php echo $id; ?>&pagina=<?php echo $recibido+1; ?>">»</a></li><?php
                            }

                        }
                    ?>
                </ul>
            </section>
        </div>
    </div>
</div>
<script src="../js/eliminar.js"></script>