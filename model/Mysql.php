
<?php

class MySql
{
    private static $pdo;

    public static function connect()
    {
        try{
            if (!isset(self::$pdo)) {
                self::$pdo = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE, USER, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$pdo;
        } catch (Exception $e) {
            die('<div class="alert alert-danger p-2"><h3>Erro ao conectar ao banco de dados!</h3><p></p></div>');
        }



        return self::$pdo;
    }

    public static function prepare($query)
    {
        try {
            return self::connect()->prepare($query);
        } catch (Exception $e) {
            echo '<div class="alert alert-danger p-2"><h3>Erro ao preparar a consulta SQL!</h3><p></p></div>';
            return true;
        }
    }
}

?>
