<?php
    session_start();
    if (!isset($_SESSION["nombre"])){
        header("Location: ../admin.php");
    }
    $id = $_GET['genero'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body>
    <div class="formAgregarCat">
        <form id="formModGen" enctype="multipart/form-data">
        <?php
        require "update.php";
        $query = new update();
        $editorial = $query->getGenero($id);
        if($editorial){
            foreach($editorial as $data){
                $nombre = $data['nombre'];
            }
        }
        ?>
            <h3>Modificar Genero: <?php echo $id; ?></h3>
            <input type="text" name="tabla" value="genero" hidden>
            <input type="text" name="id_genero" value="<?php echo $id; ?>" hidden>
            <label for="">Editorial: </label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>">

            <div class="btn-right">
                <button type="submit" class="btn-e addNot">Guardar</button>
            </div>
        </form>
    </div>
    <script src="../../js/modificar.js"></script>
</body>
</html>