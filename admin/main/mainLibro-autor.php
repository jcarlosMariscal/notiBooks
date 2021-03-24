<div class="main">
    <div class="sectionMain">
        <label for="">Libros por autor</label>
        <a href="../admin/main.php?id=4" class="btn-noticia">Ver más</a>
        <a href="../admin/main.php?id=8" class="btn-noticia">Ver Libro-Genero</a>
    </div>
    <div class="select">
        <div class="resultLibro">
            <table>
                <!-- <caption>NOTICIA</caption> -->
                <tr>
                    <th>ISBN</th>
                    <th>Título</th>
                    <th>Autor(s)</th>
                </tr>
                <?php
                require "select.php";
                $query = new select();
                $recibido = ( empty ($_GET['pagina'] ) ? NULL : $_GET['pagina']);
                if(!$recibido){
                    $recibido = 1;
                }
                $id = ( empty ($_GET['id'] ) ? NULL : $_GET['id']);
                $autor = $query->getLibros($recibido);
                if($autor){
                    foreach($autor as $data){
                        ?>
                        <tr>
                            <td><?php echo $data['ISBN']; ?></td>
                            <td><?php echo $data['titulo']; ?></td>
                            <?php
                            $aut = $query->getAutorID($data['ISBN']);
                            if($aut){
                                foreach($aut as $dat){
                                    if($dat['nombre'] == ""){
                                        ?><td><a class="addG" href="agregar/addLibroAutor.php?ISBN=<?php echo $data['ISBN']; ?>">Agrega un autor</a></td><?php
                                    }else{
                                        ?><td><?php echo $dat['nombre']; ?></td><?php
                                    }
                                }
                            }
                            ?>
                            <td class="modify"><a href="agregar/addLibroAutor.php?ISBN=<?php echo $data['ISBN']; ?>"><i class="fas fa-plus"></i></a></td>
                            <td class="delete"><a href="#" onclick="deleteAutBook(ISBN='<?php echo $data['ISBN']; ?>',autor='<?php echo $data['titulo']; ?>')"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                    }    
                }
                ?>
            </table>
            <form id="libroAutor" hidden></form>
            <section class="paginacion clear">
                <ul class="paginador">
                    <?php
                        $paginador = $query ->paginador("libro",$recibido,null);
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