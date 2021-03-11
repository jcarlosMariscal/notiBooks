<?php
    session_start();
    if (!isset($_SESSION["nombre"])){
        header("Location: ../admin.php");
    }
    $id_categoria = $_GET['categoria'];
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
        <form id="formModCat" enctype="multipart/form-data">
            <?php
            require "update.php";
            $query = new update();
            $categoria = $query->getCategoriaId($id_categoria);
            if($categoria){
                foreach($categoria as $data){
                    $nombre = $data["nombre"];
                }
            }
            ?>
            <h3>Modificar categoria: <?php echo $_GET['categoria']; ?></h3>
            <input type="text" name="tabla" value="categoria" hidden>
            <input type="text" name="id_categoria" value="<?php echo $id_categoria ?>" hidden>
            <label for="">Categoria: </label>
            <input type="text" name="categoria" value="<?php echo $nombre; ?>">

            <div class="btn-right">
                <button type="submit" class="btn-e addNot">Guardar</button>
            </div>
        </form>
    </div>
    <script src="../../js/modificar.js"></script>
</body>
</html>