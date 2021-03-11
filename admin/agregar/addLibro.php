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
        <form id="formAddLibro" enctype="multipart/form-data">
            <h3>Agregar nuevo Libro</h3>
            <input type="text" name="tabla" value="libro" hidden>
            <label for="">ISBN: </label>
            <input type="text" name="ISBN" placeholder="Introduce el ISBN del libro" class="above">

            <label for="">Titulo: </label>
            <input type="text" name="titulo" placeholder="Introduce el titulo" class="above">

            <label for="">F.Publicacion: </label>
            <input type="date" name="fecha_publi" class="fech">

            <input type="file" class="file" id="portada">

            <label for="categoria">Editorial: </label>
            <select name="categoria" id="categoria" class="categoria">
                <?php
                require "agregar.php";
                $query = new agregar();
                $categoria = $query->getEditorial();
                if($categoria){
                    foreach($categoria as $data){
                        ?>
                            <option value="<?php echo $data["id_editorial"]; ?>"><?php echo $data["nombre"]; ?></option>
                        <?php
                    }
                }
                ?>  
            </select>
            <label for="">URL: </label>
            <input type="text" name="url" class="url" placeholder="URL al libro">
            <label for="">Cuerpo:</label><br>
            <input name="prologo" id="prologo" type="hidden">
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