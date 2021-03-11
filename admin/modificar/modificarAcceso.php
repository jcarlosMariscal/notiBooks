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
        <div class="formulario">
        <?php
        $id = $_GET['acceso'];
        ?>
            <h4>Modificar Usuario: <?php echo $id; ?></h4>
            <hr>
            <form id="formModAcceso">
                <?php
                require "update.php";
                $query = new update();
                $nombre = $query->getAcceso($id);
                if($nombre){
                    foreach($nombre as $data){
                        $name = $data['nombre'];
                    }
                }
                ?>
                <input type="text" name="tabla" value="acceso" hidden>
                <input type="text" name="id_acceso" value="<?php echo $id; ?>" hidden>
                <label for="name">Introcuce nuevo nombre:</label>
                <input type="text" name="name" id="name" value="<?php echo $name; ?>">
                <label for="rol">Seleccione nuevo rol:</label>
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
                <div class="form-btn">
                    <button class="btn-e" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </main>
    <script src="../../js/modificar.js"></script>
</body>
</html>