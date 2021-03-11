<?php
    session_start();
    if (!isset($_SESSION["nombre"])){
        header("Location: ../admin.php");
    }
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
        <form id="formAdd" enctype="multipart/form-data">
            <h3>Agregar nueva noticia</h3>
            <input type="text" name="tabla" value="noticia" hidden>
            <label for="">Titulo: </label>
            <input type="text" name="titulo" placeholder="Introduce el título de la Noticia" class="above">

            <label for="">Entrada: </label>
            <input type="text" name="entrada" placeholder="Introduce la entrada de la Noticia" class="above">

            <input type="file" class="file" id="fotografia">

            <input type="text" name="id_acceso" value="<?php echo $_SESSION["nombre"]["id_acceso"]; ?>" hidden>

            <label for="categoria">Categoria: </label>
            <select name="categoria" id="categoria" class="">
                <?php
                require "agregar.php";
                $query = new agregar();
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

            <label for="">Cuerpo:</label><br>
            <input name="cuerpo" id="cuerpo" type="hidden">
            <div id="editor" ></div>
            <div class="btn-right">
                <button type="submit" class="btn-e addNot">Guardar</button>
            </div>
        </form>
    </div>
    <script src="../../quill/quill.js"></script>
    <script src="../../js/agregar.js"></script>
</body>
</html>