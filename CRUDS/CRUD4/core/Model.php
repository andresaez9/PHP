<?php
namespace CRUD4\Core;
require __DIR__ . "/../config/loadEnvironmentFile.php";

use PDO;
use PDOException;

class Model {
    protected static function connection() {
        $db = "";
        try {
            $db = new PDO($_ENV["DSN"], $_ENV["USER"], $_ENV["PASSWORD"]);
            $db->query("set charset utf8");
        } catch (PDOException $e){
            echo "Falló la conexión " . $e->getMessage();
        }
        return $db;
    }
}