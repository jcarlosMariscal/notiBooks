<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEADER</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a class="menu" href="index.php?id=inicio">INICIO</a></li>
                <li><a class="menu" href="index.php?id=noticias&pagina=1">NOTICIAS</a></li>
                <li><a class="menu" href="index.php?id=libros&pagina=1">LIBROS</a></li>
                <li class="buscador">
                    <div class="buscar">
                        <form action="busqueda.php" method="POST">
                            <p>Busque un libro por su:</p>
                            <select name="temas" id="temas"> <!--Hacer listas desplegables-->
                                <option value="nombre" selected>Nombre</option>
                                <option value="autor">Autor</option>
                                <option value="editorial">Editorial</option>
                                <option value="genero">Genero</option>
                            </select>
                            <input type="text" name="frase" id="frase" placeholder="Escribalo aquí" required>
                            <button class="btnBuscar" type="submit">Buscar</button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
</body>
</html>