<?php
//require __DIR__ . "/../config/db.php";
require __DIR__ . "/../config/loadEnvironmentFile.php";

class Model {
    protected static function connection() {
        $db = "";
        try {
            $db = new PDO($_ENV["DSN"], $_ENV["USER"], $_ENV["PASSWORD"]);
            $db->query("set charset utf8");
        } catch (PDOException $e){
            echo "Faltó la conexión: " . $e->getMessage();
        }
        return $db;
    }

    protected static function createDatabase(){
        $sql = "";
        try {
            $db = self::connection();
            $sql = 'CREATE DATABASE IF EXISTS ' . $_ENV['DATABASE'];
            $db->exec($sql);
        } catch (PDOException $e){
            die("ERROR: Could not able to execute $sql " . $e->getMessage());
        }
    }

    protected static function createTable(){
        try {
            $db = self::connection();
            $db->exec('use ' . $_ENV['DATABASE']);
            $sql = "DROP TABLE IF EXISTS " . $_ENV['NAME_TABLE'];
            $db->exec($sql);
            $sql = "CREATE TABLE {$_ENV['NAME_TABLE']}(
                id_usuario int auto_increment,
                nombre varchar(30) not null,
                usuario varchar(30) not null,
                clave varchar(50) not null,
                email varchar(50) not null,
                primary key(id_usuario)
            )";
            $db->exec($sql);
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute " . $e->getMessage());
        }
    }
}