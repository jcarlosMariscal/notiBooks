<?php
    session_start();
    if (!isset($_SESSION["nombre"])){
        header("Location: ../admin.php");
    }
    require "update.php";
    $query = new update();
    $id = $_GET['autor'];
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
            <?php
                $autor = $query->getAutor($id);
                if($autor){
                    foreach($autor as $data){ $nombre = $data['nombre']; $profesion = $data['profesion']; $nacimiento = $data['nacimiento']; $fallecimiento = $data['fallecimiento']; $obras = $data['obras']; $biografia = $data['biografia'];
                    }
                }
            ?>
            <h3>Modificar autor: <?php echo $id; ?></h3>
            <input type="text" name="tabla" value="autor" hidden>
            <input type="text" name="id_autor" value="<?php echo $id; ?>" hidden>

            <div class="formGrupo-main-one" id="grupo-nombre">
                <label for="nombre" class="formLabel">Nombre: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                </div>
				<p class=" clear formInputError">El nombre solo puede tener letras y espacios</p>
            </div>

            <div class="formGrupo-main-two" id="grupo-profesion">
                <label for="profesion" class="formLabel">Profesion: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="profesion" id="profesion" value="<?php echo $profesion; ?>">
                </div>
				<p class=" clear formInputError">La profesion solo pueden ser letras y espacios.</p>
            </div>

            <div class="formGrupo-body-one clear" id="grupo-imagen">
                <label for="imagen" class="formLabel">Fotografía: </label>
                <div class="formularioInput">
                    <input type="file" class="file" accept="image/png, .jpeg, .jpg, image/gif" name="imagen" id="imagen" >
                </div>
				<p class=" clear formInputError formInputStatic" id="inputFile"><b>Nota: </b>Si no quiere modificar la foto del autor puede omitirlo.</p>
            </div>

            <div class="formGrupo-body-two" id="grupo-fecha_nac">
                <label for="fecha_nac" class="formLabel">A.nacimiento: </label>
                <div class="formularioInput">
                    <input type="date" name="fecha_nac" id="fecha_nac" value="<?php echo $nacimiento; ?>" class="date">
                </div>
                <p class=" clear formInputError"> La fecha es incorrecta</p>
            </div>

            <div class="formGrupo-body-two" id="grupo-fecha_fal">
                <label for="fecha_fal" class="formLabel">A.fallecimiento: </label>
                <div class="formularioInput">
                    <input type="date" name="fecha_fal" id="fecha_fal" value="<?php echo $fallecimiento; ?>" class="date">
                </div>
                <p class=" clear formInputError"> La fecha es incorrecta</p>
            </div>
            
            <div class="formGrupo-main-two-book" id="grupo-obras">
                <label for="obras" class="formLabel">Obras: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="obras" id="obras" value="<?php echo $obras; ?>">
                </div>
				<p class=" clear formInputError">Las obras solo pueden ser letras,espacios,guion bajo,guion,punto,comillas</p>
            </div>

            <div class="formGrupo-end-one clear" id="grupo-editor">
                <label for="cuerpo" class="formLabel">Biografía: </label>
                <div class="formularioInput">
                    <input name="cuerpo" id="cuerpo" type="hidden" >
                    <div id="editor" name="editor" class="editor"><?php echo $biografia; ?></div>
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
    <script src="../../js/modificar.js"></script>
    <!-- <script src="../../js/agregar.js"></script> -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>