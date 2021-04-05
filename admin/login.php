<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <main>
        <div class="form-log">
            <h4>Agrega nuevo usuario</h4>
            <hr>
            <form id="formAdd" class="formLogin">
                <input type="text" name="tabla" value="acceso" hidden>
                <div id="grupo-nombre">
                    <div class="formInputLogin">
                        <input type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre">
                    </div>
                    <p class="formInputError-login">El nombre solo puede contener letras y minimo debe tener 5</p>
                </div>

                <div id="grupo-password">
                    <div class="formInputLogin">
                        <input type="password" name="password" id="password" placeholder="Ingrese su contraseña">
                    </div>
                    <p class=" clear formInputError-login">La contraseña debe ser de 6 a 16 caracteres</p>
                </div>

                <div id="grupo-rol">
                    <div class="formInputLogin">
                        <select name="rol" id="rol">
                            <?php
                            require "main/select.php";
                            $query = new select();
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
    <script src="../js/agregar.js"></script>
</body>
</html>