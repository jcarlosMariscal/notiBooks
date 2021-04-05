<?php
    session_start();
    if (!isset($_SESSION["nombre"])){
        header("Location: ../admin.php");
    }
    require "agregar.php";
    $query = new agregar();
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
        <form id="formAdd" class="formulario" enctype="multipart/form-data">
            <h3>Agregar nuevo autor</h3>
            <input type="text" name="tabla" value="autor" hidden>

            <div class="formGrupo-main-one" id="grupo-nombre">
                <label for="nombre" class="formLabel">Nombre: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="nombre" id="nombre" placeholder="Introduce el nombre del autor">
                </div>
				<p class=" clear formInputError">El nombre solo puede tener letras y espacios</p>
            </div>

            <div class="formGrupo-main-two" id="grupo-profesion">
                <label for="profesion" class="formLabel">Profesion: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="profesion" id="profesion" placeholder="Introduce la profesion">
                </div>
				<p class=" clear formInputError">La profesion solo pueden ser letras y espacios.</p>
            </div>

            <div class="formGrupo-body-one clear" id="grupo-imagen">
                <label for="imagen" class="formLabel">Fotografía: </label>
                <div class="formularioInput">
                    <input type="file" class="file" accept="image/png, .jpeg, .jpg, image/gif" name="imagen" id="imagen" >
                </div>
				<p class=" clear formInputError" id="inputFile">Por favor seleccione una imagen</p>
            </div>

            <div class="formGrupo-body-two" id="grupo-fecha_nac">
                <label for="fecha_nac" class="formLabel">A.nacimiento: </label>
                <div class="formularioInput">
                    <input type="date" name="fecha_nac" id="fecha_nac" class="date">
                </div>
                <p class=" clear formInputError"> La fecha es incorrecta</p>
            </div>

            <div class="formGrupo-body-two" id="grupo-fecha_fal">
                <label for="fecha_fal" class="formLabel">A.fallecimiento: </label>
                <div class="formularioInput">
                    <input type="date" name="fecha_fal" id="fecha_fal" class="date">
                </div>
                <p class=" clear formInputError"> La fecha es incorrecta</p>
            </div>
            
            <div class="formGrupo-main-two-book" id="grupo-obras">
                <label for="obras" class="formLabel">Obras: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="obras" id="obras" placeholder="Obras más importantes">
                </div>
				<p class=" clear formInputError">Las obras solo pueden ser letras,espacios,guion bajo,guion,punto,comillas</p>
            </div>

            <div class="formGrupo-end-one clear" id="grupo-editor">
                <label for="cuerpo" class="formLabel">Biografía: </label>
                <div class="formularioInput">
                    <input name="cuerpo" id="cuerpo" type="hidden" >
                    <div id="editor" name="editor" class="editor"></div>
                </div>
				<p class=" clear formInputError">El prólogo del libro no puede quedar en blanco. Evite usar algunos caracteres especiales ( {, }, \ ), pongase en contacto con el desarrollador si tiene problemas.</p>
            </div>

            <div class="formOneGrupo clear formOneMensaje" id="formulario-mensaje">
                <p><i class="fas fa-exclamation-triangle"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
            </div>

            <div class=" formOneGrupo btn-right-guardar">
                    <button type="submit" class="btn-guardar">Guardar</button>
            </div>
        </form>
    </div>
    <script src="../../quill/quill.js"></script>
    <script src="../../js/validar.js"></script>
    <!-- <script src="../../js/agregar.js"></script> -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>