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
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <div class="caja-padre">
        <div class="nav">
            <div class="nav-user">
                <i class="far fa-user"></i>
                <p><?php echo $_SESSION['nombre']['nombre']; ?> <br>
                <a href="cerrarSesion.php">Cerrar sesion</a>
                </p>
            </div>
            <hr class="t">
            <div class="link">
                <hr>
                <?php
                $rol = $_SESSION["nombre"]["id_rol"];
                if($rol == 2){
                    ?>
                    <div class="link-select">
                        <a href="main.php?id=1"><p>Noticia</p></a>
                    </div>
                    <hr>
                    <div class="link-select">
                        <a href="main.php?id=3"><p>Libro</p></a>
                    </div>
                    <hr>
                    <div class="link-select">
                        <a href="main.php?id=6"><p>Autor</p></a>
                    </div>
                    <hr>
                    <div class="link-select">
                        <a href="main.php?id=7"><p>Accesos</p></a>
                    </div>
                    <?php 
                    ?>
                    <?php
                }else{
                    ?>
                    <div class="link-select">
                        <a href="main.php?id=1"><p>Noticia</p></a>
                    </div>
                    <hr>
                    <div class="link-select">
                        <a href="main.php?id=2"><p>Categoria</p></a>
                    </div>
                    <?php
                }
                ?>
                <hr>
            </div>
        </div>
        <?php
        $id = ( empty ($_GET['id'] ) ? NULL : $_GET['id']);
        if($id){
            if($id == 1){
                include "main/mainNoticia.php";
            }elseif($id == 2){
                include "main/mainPeriodista-categoria.php";
            }elseif($id == 3){
                include "main/mainLibro.php";
            }elseif($id == 4){
                include "main/mainEditorial-genero.php";
            }
            elseif($id == 5){
                include "main/mainLibro-autor.php";
            }elseif($id == 6){
                include "main/mainAutor.php";
            }
            elseif($id == 7){
                include "main/mainAcceso.php";
            }
        }else{
            include "main/mainNoticia.php";
        }
        ?>
    </div>
</body>
</html>