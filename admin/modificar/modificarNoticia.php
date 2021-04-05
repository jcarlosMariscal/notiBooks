<?php
    session_start();
    if (!isset($_SESSION["nombre"])){
        header("Location: ../admin.php");
    }
    require "update.php";
    $query = new update();
    $id = $_GET['noticia'];
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
                $noticia = $query->getNoticia($id);
                if($noticia){
                    foreach($noticia as $datos){
                        $titulo = $datos["titulo"];
                        $entrada = $datos["entrada"];
                        $cuerpo = $datos["cuerpo"];
                    }
                }
            ?>
            <h3>Modificar noticia [ <?php echo $id; ?> ] de: <?php echo $_SESSION["nombre"]["nombre"]; ?></h3>
            <input type="text" name="tabla" value="noticia" hidden>
            <input type="text" name="id_noticia" value="<?php echo $id; ?>" hidden>

            <div class="formGrupo-main-one" id="grupo-titulo">
                <label for="titulo" class="formLabel">Título: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="titulo" id="titulo" value="<?php echo $titulo; ?>">
                </div>
				<p class=" clear formInputError">El titulo solo puede contener números y/o letras, con un mínimo de 10 carácteres.</p>
            </div>

            <div class="formGrupo-main-two" id="grupo-entrada">
                <label for="entrada" class="formLabel">Entrada: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="entrada" id="entrada" value="<?php echo $entrada; ?>">
                </div>
				<p class=" clear formInputError">La entrada solo pueden ser números y/o letras, con un mínimo de 10 carácteres.</p>
            </div>

            <div class="formGrupo-body-one clear" id="grupo-imagen">
                <label for="imagen" class="formLabel">Fotografia: </label>
                <div class="formularioInput">
                    <input type="file" class="file" accept="image/png, .jpeg, .jpg, image/gif" name="imagen" id="imagen" >
                </div>
				<p class=" clear formInputStatic formInputError" id="inputFile"><b>NOTA:</b> Si no quiere modificar la imagen puede omitirlo</p>
            </div>

            <div class="formGrupo-body-two" id="grupo-categoria">
                <label for="categoria" class="formLabel labelStatic">Categoria: </label>
                <div class="formularioInput">
                    <select name="categoria" class="selectDB selectStatic" id="categoria" required>
                        <?php
                        $categoria = $query->getCategorias();
                        if($categoria){
                            foreach($categoria as $data){
                                ?>
                                    <option value="<?php echo $data["id_categoria"]; ?>"><?php echo $data["nombre"]; ?></option>
                                <?php
                            }
                        }
                        ?>  
                    </select>
                </div>
                <p class=" clear formInputStatic"><b>NOTA:</b> Vuelva a seleccionar una/la categoria.</p>
            </div>

            <input type="text" name="id_acceso" value="<?php echo $_SESSION["nombre"]["id_acceso"]; ?>" hidden> <br>
            
            <div class="formGrupo-end-one clear" id="grupo-editor">
                <label for="cuerpo" class="formLabel">Cuerpo: </label>
                <div class="formularioInput">
                    <input name="cuerpo" id="cuerpo" type="hidden" >
                    <div id="editor" name="editor" class="editor"><?php echo $cuerpo; ?></div>
                </div>
				<p class=" clear formInputError">El cuerpo de la noticia no puede quedar en blanco. Evite usar algunos caracteres especiales, pongase en contacto con el desarrollador si tiene problemas.</p>
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