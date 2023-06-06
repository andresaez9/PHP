<?php
require __DIR__ . "/../../core/Model.php";

class Users extends Model{
    public static function getAllUsers() {
        $stmt = "";
        try {
            $db = Model::connection();
            $stmt = $db->query('SELECT * FROM users');
        } catch (PDOException $e){
            echo "Error al mostrar todos los usuarios: " . $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS, Users::class);
    }

    public static function findById($id) {
        $stmt = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('SELECT * FROM users where id_usuario = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if ($stmt->rowCount() == 0) { //control si se encontro algun usuario
                return null;
            }
        } catch (PDOException $e){
            echo "Error al buscar el usuario: " . $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function insert($name, $user, $pass, $email) {
        try {
            $db = Model::connection();
            $stmt = $db->prepare('INSERT INTO users (nombre, usuario, clave, email) VALUES (:nombre, :usuario, :clave, :email)');

            // Bindear los valores de los parámetros a los marcadores de posición en la consulta
            $stmt->bindParam(':nombre', $name);
            $stmt->bindParam(':usuario', $user);
            $stmt->bindParam(':clave', $pass);
            $stmt->bindParam(':email', $email);

            // Ejecutar la consulta
            $stmt->execute();
        }catch (PDOException $e){
            echo "Error al insertar un usuario: " . $e->getMessage();
        }
    }

    public static function delete($id) {
        try {
            $db = Model::connection();
            $stmt = $db->prepare('DELETE FROM users WHERE id_usuario = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }catch (PDOException $e){
            echo "Error al borrar un usuario: " . $e->getMessage();
        }
    }

    public static function update($id, $newName, $newUser, $newPass, $newEmail){
        try {
            $db = Model::connection();
            $stmt = $db->prepare('UPDATE users SET nombre = :nombre, usuario = :usuario, clave = :clave, email = :email WHERE id_usuario = :id');
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $newName);
            $stmt->bindParam(':usuario', $newUser);
            $stmt->bindParam(':clave', $newPass);
            $stmt->bindParam(':email', $newEmail);
            $stmt->execute();
        }catch (PDOException $e){
            echo "Error al actualizar un usuario: " . $e->getMessage();
        }
    }
}