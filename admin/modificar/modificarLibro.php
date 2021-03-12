<?php
    session_start();
    if (!isset($_SESSION["nombre"])){
        header("Location: ../admin.php");
    }
    $id = $_GET['ISBN'];
    require "update.php";
    $query = new update();
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
        <form id="formModLibro" enctype="multipart/form-data">
        <?php
        $libro = $query -> getLibro($id);
        if($libro){
            foreach($libro as $data){
                $ISBN = $data['ISBN'];
                $titulo = $data['titulo'];
                $prologo = $data['prologo'];
                $fecha_publi = $data['fecha_publi'];
                $link = $data['link'];
                $id_editorial = $data['id_editorial'];
            }
        }
        ?>
            <h3>Modificar Libro <?php echo $id; ?> <i>Si no desea cambiar la portada, por favor, omitalo.</i></h3>
            <input type="text" name="tabla" value="libro" hidden>
            <label for="">ISBN: </label>
            <input type="text" name="ISBN" value="<?php echo $ISBN; ?>" class="above">

            <label for="">Titulo: </label>
            <input type="text" name="titulo" value="<?php echo $titulo; ?>" class="above">

            <label for="">F.Publicacion: </label>
            <input type="date" name="fecha_publi" value="<?php echo $fecha_publi; ?>" class="fech">

            <input type="file" class="file" id="portada">

            <label for="categoria">Editorial: </label>
            <select name="editorial" id="editorial" class="categoria">
                <?php
                $categoria = $query->getEdit();
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
            <input type="text" name="url" class="url" value="<?php echo $link; ?>">
            <label for="">Cuerpo:</label><br>
            <input name="prologo" id="prologo" type="hidden">
            <div id="editor" ><?php echo $prologo; ?></div>
            <div class="btn-right">
                <button type="submit" class="btn-e addNot">Guardar</button>
            </div>
        </form>
    </div>
    <script src="../../quill/quill.js"></script>
    <script src="../../js/modificar.js"></script>
</body>
</html>