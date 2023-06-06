<?php
namespace CRUD4\App\Models;

use CRUD4\Core\Model;
use PDOException;

class Member extends Model {
    public static function hasUser($user, $password) {
        $stmt = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('SELECT usuario, clave FROM socio WHERE usuario = :user and clave = :pass');
            $stmt->execute([
                ':user' => $user,
                ':pass' => $password
            ]);
        } catch (PDOException $e) {
            echo "Fallo en devolver el usuario $user; " . $e->getMessage();
            die();
        }
        return $stmt->rowCount() > 0;
    }

    public static function getIdByName($name, $surname) {
        $id_member = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('SELECT id_socio FROM socio WHERE nombre = :name and apellidos = :surname');
            $stmt->execute([
                ':name' => $name,
                ':surname' => $surname
            ]);
            $id_member = $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo "Fallo en devolver el id_socio del $name y $surname; " . $e->getMessage();
            die();
        }
        return $id_member;
    }
}