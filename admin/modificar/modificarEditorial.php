<?php
    session_start();
    if (!isset($_SESSION["nombre"])){
        header("Location: ../admin.php");
    }
    require "update.php";
    $query = new update();
    $id = $_GET['editorial'];
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
        <form id="formAddOne" class="formOne" enctype="multipart/form-data">
            <?php
                $editorial = $query->getEditorial($id);
                if($editorial){
                    foreach($editorial as $data){
                        $nombre = $data['nombre'];
                    }
                }
            ?>
            <h3>Modificar editorial: <?php echo $id; ?></h3>
            <input type="text" name="tabla" value="editorial" hidden>
            <input type="text" name="id_editorial" value="<?php echo $id; ?>" hidden>

            <div class="formOneGrupo" id="grupo-editorial">
                <label for="editorial" class="formOneLabel">Editorial: </label>
                <div class="formOneInput">
                    <input class="formInput" type="text" name="editorial" id="editorial" value="<?php echo $nombre; ?>">
                </div>
				<p class=" clear formInputError">El editorial solo puede contener letras y minimo debe tener 5</p>
            </div>

            <div class="formOneGrupo clear formOneMensaje" id="formulario-mensaje">
                <p><i class="fas fa-exclamation-triangle"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
            </div>

            <div class=" formOneGrupo btn-right-guardar">
                    <button type="submit" class="btn-guardar">Guardar</button>
            </div>
        </form>
    </div>
    <script src="../../js/modificar.js"></script>
    <!-- <script src="../../js/agregar.js"></script> -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>