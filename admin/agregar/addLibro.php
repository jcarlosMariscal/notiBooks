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
            <h3>Agregar nuevo libro</h3>
            <input type="text" name="tabla" value="libro" hidden>

            <div class="formGrupo-main-one-book" id="grupo-ISBN">
                <label for="titulo" class="formLabel">ISBN: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="ISBN" id="ISBN" placeholder="Introduce el ISBN del libro">
                </div>
				<p class=" clear formInputError">El ISBN debe ser de 10 a 12 caracteres, solo puede incluir numeros, letras, guiones y sin espacios</p>
            </div>

            <div class="formGrupo-main-two-book" id="grupo-titulo">
                <label for="entrada" class="formLabel">Título: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="titulo" id="titulo" placeholder="Introduce el titulo del libro">
                </div>
				<p class=" clear formInputError">El titulo solo pueden ser números y/o letras, con un mínimo de 5 carácteres.</p>
            </div>

            <div class="formGrupo-body-one clear" id="grupo-imagen">
                <label for="imagen" class="formLabel">Portada: </label>
                <div class="formularioInput">
                    <input type="file" class="file" accept="image/png, .jpeg, .jpg, image/gif" name="imagen" id="imagen" >
                </div>
				<p class=" clear formInputError" id="inputFile">Por favor seleccione una imagen</p>
            </div>

            <div class="formGrupo-body-two" id="grupo-fecha">
                <label for="categoria" class="formLabel">F.publicación: </label>
                <div class="formularioInput">
                    <input type="date" name="fecha" id="fecha" class="date">
                </div>
                <p class=" clear formInputError"> La fecha es incorrecta</p>
            </div>

            <div class="formGrupo-body-two" id="grupo-periodista">
                <label for="editorial" class="formLabel labelStatic">Editorial: </label>
                <div class="formularioInput">
                    <select name="editorial" class="selectDB selectStatic" id="editorial" required>
                        <?php
                            $categoria = $query->getEditorial();
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
                    <input class="formInput" type="text" name="url" id="url" placeholder="Introduce la URL al libro">
                </div>
				<p class=" clear formInputError">Por favor escriba una URL correcta</p>
            </div>

            <div class="formGrupo-end-one clear" id="grupo-editor">
                <label for="cuerpo" class="formLabel">Prólogo: </label>
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