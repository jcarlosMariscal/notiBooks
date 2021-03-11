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
        <form id="formAddAutor" enctype="multipart/form-data">
            <h3>Agregar nuevo autor</h3>
            <input type="text" name="tabla" value="autor" hidden>
            <label for="">Nombre: </label>
            <input type="text" name="nombre" placeholder="Introduce el nombre del autor" class="above1">

            <label for="">Profesion: </label>
            <input type="text" name="profesion" placeholder="Introduce la profesion" class="above1">

            <label for="">A.Nac: </label>
            <input type="date" name="nacimiento" placeholder="Introduce año de nacimiento" class="fech">

            <label for="">A.Fall: </label>
            <input type="date" name="fallecimiento" placeholder="Introduce año de fallecimiento" class="fech">

            <label for="">Obras: </label>
            <input type="text" name="obras" placeholder="Introduce las obras más importantes" class="above2">

            <input type="file" class="file" id="fotografia">

            <label for="">Biografia:</label><br>
            <input name="biografia" id="biografia" type="hidden">
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