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
        <form id="formAddOne" class="formOne" enctype="multipart/form-data">
            <h3>Agregar nuevo genero</h3>
            <input type="text" name="tabla" value="genero" hidden>

            <div class="formOneGrupo" id="grupo-genero">
                <label for="genero" class="formOneLabel">Genero: </label>
                <div class="formOneInput">
                    <input class="formInput" type="text" name="genero" id="genero" placeholder="Introduce el nombre del genero">
                </div>
				<p class=" clear formInputError">El genero solo puede contener letras y minimo debe tener 5</p>
            </div>

            <div class="formOneGrupo clear formOneMensaje" id="formulario-mensaje">
                <p><i class="fas fa-exclamation-triangle"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
            </div>

            <div class=" formOneGrupo btn-right-guardar">
                    <button type="submit" class="btn-guardar">Guardar</button>
            </div>
        </form>
    </div>
    <script src="../../js/validar.js"></script>
    <!-- <script src="../../js/agregar.js"></script> -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>