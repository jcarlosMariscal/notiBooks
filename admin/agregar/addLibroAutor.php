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
        <form id="formAddAutorLibro" class="formOne" enctype="multipart/form-data">
            <h3>Agregar autor Para el libro <?php echo $_GET['ISBN']; ?></h3>
            <input type="text" name="tabla" value="autorLibro" hidden>
            <input type="text" name="ISBN" value="<?php echo $_GET['ISBN']; ?>" hidden>

            <div class="formGrupoMore" id="grupo-autLibro">
                <label for="autor" class="formLabelMore">Seleccione autor: </label>
                <div class="formInputMore">
                    <select name="autor" id="autor" class="selectDB">
                    <?php
                        require "agregar.php";
                        $query = new agregar();
                        $genero = $query->getAutor();
                        if($genero){
                            foreach($genero as $data){
                                ?>
                                <option value="<?php echo $data['id_autor']; ?>"><?php echo $data['nombre']; ?></option>
                                <?php
                            }
                        }
                    ?>
                    </select>
                </div>
				<!-- <p class=" clear formInputError">La categoria solo puede contener letras y minimo debe tener 5</p> -->
            </div>

            <!-- <div class="formOneGrupo clear formOneMensaje" id="formulario-mensaje">
                <p><i class="fas fa-exclamation-triangle"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
            </div> -->

            <div class="clear formOneGrupo btn-right-guardar">
                    <button type="submit" class="btn-guardar">Guardar</button>
                    <a href="addLibroGenero.php?ISBN=<?php echo $_GET['ISBN']; ?>" class="btn-addMore">Agregar Genero</a>
                    <!-- <a href="addLibroAutor.php?ISBN=<?php echo $_GET['ISBN']; ?>" class="btn-addMore">Agregar Autor</a> -->
                    <a href="../main.php?id=3" class="btn-end">Terminar</a>
            </div>
        </form>
    </div>
    <!-- <script src="../../js/validar.js"></script> -->
    <script src="../../js/agregar.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>