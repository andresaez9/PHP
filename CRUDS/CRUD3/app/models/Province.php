<?php
namespace CRUD3\App\Models;

use CRUD3\Core\Model;
use PDO;
use PDOException;

class Province extends Model {

    public static function getAll() {
        $provinces = "";
        try {
            $db = Model::connection();
            $stmt = $db->query('SELECT * FROM provincia');
            $provinces = $stmt->fetchAll(PDO::FETCH_CLASS, Province::class);
        } catch (PDOException $e) {
            echo "Fallo en la carga de provincias; " . $e->getMessage();
        }
        return $provinces;
    }

    public static function findById($id): bool
    {
        //$province = "";
        $stmt = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('SELECT * FROM provincia WHERE CodProvincia = :id');
            $stmt->execute([':id' => $id]);
            //$province = $stmt->fetch(PDO::FETCH_CLASS);

        } catch (PDOException $e) {
            echo "Falló la búsqueda de la provincia $id; " . $e->getMessage();
        }
        //return $province;
        return $stmt->rowCount() > 0;
    }

    public static function findByName($name): bool {
        //$province = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('SELECT * FROM provincia WHERE Nombre = :name');
            $stmt->execute([':name' => $name]);
            //$province = $stmt->fetch(PDO::FETCH_CLASS);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Falló la lectura de la provincia con Nombre: $name; " . $e->getMessage();
        }
        //return $province;
        return false;
    }

    public static function getIdByName($name) {
        try {
            $db = Model::connection();
            $stmt = $db->prepare('SELECT CodProvincia FROM provincia WHERE Nombre = :name');
            $stmt->execute([':name' => $name]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo "Falló al encontrar el ID del nombre: $name; " . $e->getMessage();
        }
    }

    public static function getNameById($id) {
        $stmt = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('SELECT Nombre FROM provincia WHERE CodProvincia = :id');
            $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo "Falló al encontrar el Nombre por Id: $id; " . $e->getMessage();
        }
        return $stmt->fetchColumn();
    }


    public static function insert($province, $codCountry) {
        $stmt = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('INSERT INTO provincia (Nombre, CodPais) VALUES (:name, :codCountry)');
            $stmt->bindValue(":name", $province);
            $stmt->bindValue(":codCountry", $codCountry);
        } catch (PDOException $e) {
            echo  "Falló la inserción de la provincia $province; " . $e->getMessage();
        }
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('DELETE FROM provincia WHERE CodPais = :id');
            $stmt->bindValue(':id', $id);
        } catch (PDOException $e) {
            echo "Falló el borrado de la provincia $id; " . $e->getMessage();
        }
        return $stmt->execute();
    }
}