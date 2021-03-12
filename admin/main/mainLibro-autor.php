<div class="main">
    <div class="sectionMain">
        <label for="">Libros por autor</label>
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
                $autor = $query->getLibros();
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
                            <td class="modify"><i class="fas fa-marker"></i></td>
                        </tr>
                        <?php
                    }    
                }
                ?>
            </table>
        </div>
    </div>
</div>