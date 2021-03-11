<?php
    class conexion{
        static function conectarDB(){
            try {
                require ("global.php");
                $cnx = new PDO(DSN,USERNAME,PASSWORD);
                $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $cnx;
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
    }
?>