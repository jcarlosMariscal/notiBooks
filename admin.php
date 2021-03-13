<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <main>
        <div class="formulario">
            <h4>Bienvenido a NotiBooks</h4>
            <hr>
            <form action="admin/admin.php" method="POST">
                <!-- <label for="">Nombre</label> -->
                <input type="text" name="name" id="name" placeholder="Ingrese su nombre">
                <!-- <label for="">Contraseña</label> -->
                <input type="password" name="password" id="password" placeholder="Ingrese su contraseña">
                <div class="form-btn">
                    <button class="btn-e" type="submit">Iniciar Sesión</button>
                    <!-- <a href="admin/login.php" class="btn-r">Crear nuevo</a> -->
                </div>
            </form>
        </div>
    </main>
</body>
</html>