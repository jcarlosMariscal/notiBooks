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
            <h3>Agregar nueva noticia</h3>
            <input type="text" name="tabla" value="noticia" hidden>

            <div class="formGrupo-main-one" id="grupo-titulo">
                <label for="titulo" class="formLabel">Título: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="titulo" id="titulo" placeholder="Introduce el título de la noticia">
                </div>
				<p class=" clear formInputError">El titulo solo puede contener números y/o letras, con un mínimo de 10 carácteres.</p>
            </div>

            <div class="formGrupo-main-two" id="grupo-entrada">
                <label for="entrada" class="formLabel">Entrada: </label>
                <div class="formularioInput">
                    <input class="formInput" type="text" name="entrada" id="entrada" placeholder="Introduce la entrada para la noticia">
                </div>
				<p class=" clear formInputError">La entrada solo pueden ser números y/o letras, con un mínimo de 10 carácteres.</p>
            </div>

            <div class="formGrupo-body-one clear" id="grupo-imagen">
                <label for="imagen" class="formLabel">Fotografia: </label>
                <div class="formularioInput">
                    <input type="file" class="file" accept="image/png, .jpeg, .jpg, image/gif" name="imagen" id="imagen" >
                </div>
				<p class=" clear formInputError" id="inputFile">Por favor seleccione una imagen</p>
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
                <p class=" clear formInputStatic"><b>NOTA:</b> Seleccione una categoria.</p>
            </div>

            <?php
                if($_SESSION["nombre"]["id_rol"] == 1){
                    ?><input type="text" name="id_acceso" value="<?php echo $_SESSION["nombre"]["id_acceso"]; ?>" hidden><?php
                }elseif($_SESSION["nombre"]["id_rol"] == 2){
            ?>

            <div class="formGrupo-body-two" id="grupo-periodista">
                <label for="id_acceso" class="formLabel labelStatic">Periodista: </label>
                <div class="formularioInput">
                    <select name="id_acceso" class="selectDB selectStatic" id="id_acceso" required>
                        <?php
                        $periodista = $query->getPeriodista();
                        if($periodista){
                            foreach($periodista as $data){
                                ?>
                                <option value="<?php echo $data['id_acceso']; ?>"><?php echo $data['nombre']; ?></option>
                                <?php
                            }
                        }
                        ?> 
                    </select>
                </div>
                <p class=" clear formInputStatic"><b>NOTA:</b> Seleccione un/una periodista.</p>
            </div>
            <?php } ?>
            
            <div class="formGrupo-end-one clear" id="grupo-editor">
                <label for="cuerpo" class="formLabel">Cuerpo: </label>
                <div class="formularioInput">
                    <input name="cuerpo" id="cuerpo" type="hidden" >
                    <div id="editor" name="editor" class="editor"></div>
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
    <script src="../../js/validar.js"></script>
    <!-- <script src="../../js/agregar.js"></script> -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>