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
</head>
<body>
    <div class="formAgregarCat">
        <form id="formAddGen" enctype="multipart/form-data">
            <h3>Agregar nuevo genero</h3>
            <input type="text" name="tabla" value="genero" hidden>
            <label for="">Genero: </label>
            <input type="text" name="nombre" placeholder="Introduce el genero">

            <div class="btn-right">
                <button type="submit" class="btn-e addNot">Guardar</button>
            </div>
        </form>
    </div>
    <script src="../../js/agregar.js"></script>
</body>
</html>