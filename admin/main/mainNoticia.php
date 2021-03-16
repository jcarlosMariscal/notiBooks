<div class="main">
    <div class="sectionMain">
        <?php
        require "select.php";
        $query = new select();
        $rol = $_SESSION["nombre"]["id_rol"];
        // $acceso = $_SESSION["nombre"]["id_acceso"];
        $periodista = $_SESSION["nombre"]["id_acceso"];
        $acceso = ( empty ($_GET['acceso'] ) ? NULL : $_GET['acceso']);
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
                            <li><a href="../admin/main.php?acceso=todos">Todos</a></li>
                            <?php
                            $periodistas = $query->getPeriodistas();
                            if($periodistas){
                                foreach($periodistas as $data){
                                    ?>
                                    <li><a href="../admin/main.php?acceso=<?php echo $data['id_acceso']; ?>"><?php echo $data['nombre']; ?></a></li>
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
                        $noticias = $query->getNoticias($acceso);
                    }else{
                        $sn = "todos";
                        $noticias = $query->getNoticias($sn);
                    }
                }
                ?>
                <?php
                if($rol == 1){
                    $noticias = $query->getNoticias($periodista);
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
                            <td class="delete"><a href="#" onclick="deleteNoticia(<?php echo $data['id_noticia']; ?>,titulo = '<?php echo $data['titulo']; ?>')"><i class="far fa-trash-alt"></i></a></td>
                            
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
            </table>
            <form id="eliminarNoticia"></form>
        </div>
    </div>
</div>
<script src="../js/eliminar.js"></script>