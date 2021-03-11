<?php
    session_start();
    if (!isset($_SESSION["nombre"])){
        header("Location: ../admin.php");
    }
    $id = $_GET['noticia'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link href="../../css/quill.snow.css" rel="stylesheet">
</head>
<body>
    <div class="formAgregar">
        <form id="formModificar" enctype="multipart/form-data">
            <?php
            require "update.php";
            $query = new update();
            $noticia = $query->getNoticia($id);
            if($noticia){
                foreach($noticia as $datos){
                    $titulo = $datos["titulo"];
                    $entrada = $datos["entrada"];
                    $cuerpo = $datos["cuerpo"];
                }
            }
            ?>
            <h3>Modificar noticia [ <?php echo $id; ?> ] de: <?php echo $_SESSION["nombre"]["nombre"]; ?></h3>
            <input type="text" name="tabla" value="noticia" hidden>
            <input type="text" name="id_noticia" value="<?php echo $id; ?>" hidden>
            <label for="">Titulo: </label>
            <input type="text" name="titulo" value="<?php echo $titulo; ?>" class="above">

            <label for="">Entrada: </label>
            <input type="text" name="entrada" value="<?php echo $entrada; ?>" class="above">

            <label for="categoria">Categoria: </label>
            <select name="categoria" id="categoria" class="">
                <?php
                $categoria = $query->getCategorias();
                    if($categoria){
                        foreach($categoria as $data){
                            ?>
                                <option value="<?php echo $data["id_categoria"]; ?>"><?php echo $data["nombre"]; ?></option>
                            <?php
                        }
                    }
                ?>  
            </select>

            <label for="fotografia">¿Desea modificar la imagen?, si no es así, omita este campo.</label>
            <input type="file" class="file" id="fotografia" >

            <input type="text" name="id_acceso" value="<?php echo $_SESSION["nombre"]["id_acceso"]; ?>" hidden> <br>

            <label for="">Cuerpo:</label><br>
            <input name="cuerpo" id="cuerpo" type="hidden" >
            <div id="editor"><?php echo $cuerpo; ?></div>
            <div class="btn-right">
                <button type="submit" class="btn-e addNot">Guardar</button>
            </div>
        </form>
    </div>
    <script src="../../quill/quill.js"></script>
    <script src="../../js/modificar.js"></script>
</body>
</html>