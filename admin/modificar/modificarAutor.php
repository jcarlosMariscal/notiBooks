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
        <form id="formModAutor" enctype="multipart/form-data">
        <?php
        require "update.php";
        $query = new update();
        $id = $_GET['autor'];
        $autor = $query->getAutor($id);
        if($autor){
            foreach($autor as $data){
                $nombre = $data['nombre'];
                $profesion = $data['profesion'];
                $nacimiento = $data['nacimiento'];
                $fallecimiento = $data['fallecimiento'];
                $obras = $data['obras'];
                $biografia = $data['biografia'];
            }
        }
        ?>
            <h3>Modificar autor: <?php echo $id; ?> <i>Si no desea cambiar la foto, por favor, omitalo.</i></h3>
            <input type="text" name="tabla" value="autor" hidden>
            <input type="text" name="id_autor" value="<?php echo $id; ?>" hidden>
            <label for="">Nombre: </label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="above1">

            <label for="">Profesion: </label>
            <input type="text" name="profesion" value="<?php echo $profesion; ?>" class="above1">

            <label for="">A.Nac: </label>
            <input type="date" name="nacimiento" value="<?php echo $nacimiento; ?>" class="fech">

            <label for="">A.Fall: </label>
            <input type="date" name="fallecimiento" value="<?php echo $fallecimiento; ?>" class="fech">

            <label for="">Obras: </label>
            <input type="text" name="obras" value="<?php echo $obras; ?>" class="above2">

            <input type="file" class="file" id="fotografia">

            <label for="">Biografia:</label><br>
            <input name="biografia" id="biografia" type="hidden">
            <div id="editor" ><?php echo $biografia; ?></div>
            <div class="btn-right">
                <button type="submit" class="btn-e addNot">Guardar</button>
            </div>
        </form>
    </div>
    <script src="../../quill/quill.js"></script>
    <script src="../../js/modificar.js"></script>
</body>
</html>