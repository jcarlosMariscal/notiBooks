<?php
    require "update.php";
    $query = new update();
    $id = $_GET['acceso'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body>
    <main>
        <div class="form-log">
            <h4>Modificar Usuario: <?php echo $id; ?></h4>
            <hr>
            <form id="formMod" class="formLogin">
                <?php
                    $nombre = $query->getAcceso($id);
                    if($nombre){
                        foreach($nombre as $data){
                            $name = $data['nombre'];
                        }
                    }
                ?>
                <input type="text" name="tabla" value="modificarAcceso" hidden>
                <input type="text" name="id_acceso" value="<?php echo $id; ?>" hidden>

                <div id="grupo-nombre">
                    <!-- <label for="nombre">Introcuce nuevo nombre:</label> -->
                    <div class="formInputLogin"> <br>
                        <input type="text" name="nombre" id="nombre" value="<?php echo $name; ?>">
                    </div>
                    <p class="formInputError-login">El nombre solo puede contener letras y minimo debe tener 5</p>
                </div>

                <div id="grupo-rol">
                    <!-- <label for="rol">Vuelva a seleccionar el/un rol: </label> -->
                    <div class="formInputLogin"> <br>
                        <select name="rol" id="rol">
                            <?php
                            $rol = $query->getRol();
                            if($rol){
                                foreach($rol as $data){
                                    ?>
                                    <option value="<?php echo $data['id_rol']; ?>"><?php echo $data['rol']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <p class="formInputError-login-static">Vuelva a seleccionar un/el rol</p>
                </div>
                
                <div class="formOneGrupo formMensajeLogin" id="formulario-mensaje">
                    <p><i class="fas fa-exclamation-triangle"></i><b>Error: </b>Por favor rellena el formulario correctamente</p>
                </div>

                <div class="formOneGrupo form-btn">
                        <button type="submit" class="btn-e">Guardar</button>
                </div>
    
            </form>
        </div>
    </main>
    <script src="../../js/agregar.js"></script>
</body>
</html>