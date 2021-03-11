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
        <form id="formAddGenLibro" enctype="multipart/form-data">
            <h3>Agregar genero Para el libro <?php echo $_GET['ISBN']; ?></h3>
            <input type="text" name="tabla" value="genero" hidden>
            <input type="text" name="ISBN" value="<?php echo $_GET['ISBN']; ?>" hidden>
            <label for="genero">Seleccione genero: </label>
            <select name="genero" id="genero">
                <?php
                require "agregar.php";
                $query = new agregar();
                $genero = $query->getGenero();
                if($genero){
                    foreach($genero as $data){
                        ?>
                        <option value="<?php echo $data['id_genero']; ?>"><?php echo $data['nombre']; ?></option>
                        <?php
                    }
                }
                ?>
            </select>

            <div class="btn-right">
                <button type="submit" class="btn-e addNot">Guardar</button>
            </div>
        </form>
    </div>
    <script src="../../js/agregar.js"></script>
</body>
</html>