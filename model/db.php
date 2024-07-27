<?php

namespace sistema;

require_once('../config/config.php');

use PDO;
use PDOException;

class Db
{
    static private $pdo;

    static public function conectar()
    {
        if (isset(self::$pdo)) {
            return self::$pdo;
        } else {
            try {
                self::$pdo = new PDO("mysql:host=" . SERVER . ";dbname=" . BANCO, USER, PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo "Não foi possível conectar" . $e->getMessage();
            }
        }
        return self::$pdo;
    }

    public static function preparar($sql)
    {
        return self::conectar()->prepare($sql);
    }
}