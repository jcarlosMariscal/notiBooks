<?php
    session_start();
    if (!isset($_SESSION["nombre"])){
        header("Location: ../admin.php");
    }
    require "update.php";
    $query = new update();
    $id = $_GET['ISBN'];
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
            $libro = $query -> getLibro($id);
            if($libro){
                foreach($libro as $data){
                    $ISBN = $data['ISBN'];
                    $titulo = $data['titulo'];
                    $prologo = $data['prologo'];
                    $fecha_publi = $data['fecha_publi'];
                    $link = $data['link'];
                    $id_editorial = $data['id_editorial'];
                }
            }
            ?>
            <h3>Modificar Libro <?php echo $id; ?></h3>
            <input type="text" name="tabla" value="libro" hidden>
            <input type="text" name="ISBN" value="<?php echo $ISBN; ?>" hidden class="above">

            <div class="formGrupo-main-two-book" id="grupo-titulo">
                <label for="entrada" class="formLabel">Título: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="titulo" id="titulo" value="<?php echo $titulo; ?>">
                </div>
				<p class=" clear formInputError">El titulo solo pueden ser números y/o letras, con un mínimo de 5 carácteres.</p>
            </div>

            <div class="formGrupo-body-one clear" id="grupo-imagen">
                <label for="imagen" class="formLabel">Portada: </label>
                <div class="formularioInput">
                    <input type="file" class="file" accept="image/png, .jpeg, .jpg, image/gif" name="imagen" id="imagen" >
                </div>
				<p class=" clear formInputError formInputStatic" id="inputFile"><b>Nota: </b>Si no quiere cambiar la portada puede omitirlo</p>
            </div>

            <div class="formGrupo-body-two" id="grupo-fecha">
                <label for="categoria" class="formLabel">F.publicación: </label>
                <div class="formularioInput">
                    <input type="date" name="fecha" id="fecha" value="<?php echo $fecha_publi; ?>" class="date">
                </div>
                <p class=" clear formInputError"> La fecha es incorrecta</p>
            </div>

            <div class="formGrupo-body-two" id="grupo-periodista">
                <label for="editorial" class="formLabel labelStatic">Editorial: </label>
                <div class="formularioInput">
                    <select name="editorial" class="selectDB selectStatic" id="editorial" required>
                        <?php
                            $categoria = $query->getEdit();
                            if($categoria){
                                foreach($categoria as $data){
                                    ?>
                                        <option value="<?php echo $data["id_editorial"]; ?>"><?php echo $data["nombre"]; ?></option>
                                    <?php
                                }
                            }
                        ?>  
                    </select>
                </div>
                <p class=" clear formInputStatic"><b>NOTA:</b> Seleccione una editorial.</p>
            </div>
            
            <div class="formGrupo-main-two-book" id="grupo-url">
                <label for="entrada" class="formLabel">URL: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="url" id="url" value="<?php echo $link; ?>">
                </div>
				<p class=" clear formInputError">Por favor escriba una URL correcta</p>
            </div>

            <div class="formGrupo-end-one clear" id="grupo-editor">
                <label for="cuerpo" class="formLabel">Prólogo: </label>
                <div class="formularioInput">
                    <input name="cuerpo" id="cuerpo" type="hidden" >
                    <div id="editor" name="editor" class="editor"><?php echo $prologo; ?></div>
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