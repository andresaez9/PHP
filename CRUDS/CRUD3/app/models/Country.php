<?php
namespace CRUD3\App\Models;

use CRUD3\Core\Model;
use PDO;
use PDOException;

class Country extends Model {

    public static function getAll() {
        $countries = "";
        try {
            $db = Model::connection();
            $stmt = $db->query('SELECT * FROM pais');
            $countries = $stmt->fetchAll(PDO::FETCH_CLASS, Country::class);
        } catch (PDOException $e) {
            echo "Falló la lectura de todos los paises: " . $e->getMessage();
        }
        return $countries;
    }

    public static function findById($id): bool
    {
        //$country = "";
        $stmt = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('SELECT * FROM pais WHERE codPais = :id');
            $stmt->execute([':id' => $id]);
            //$country = $stmt->fetch(PDO::FETCH_CLASS);

        } catch (PDOException $e) {
            echo "Falló la lectura del país con ID: $id; " . $e->getMessage();
        }
        //return $country;
        return $stmt->rowCount() > 0;
    }

    public static function findByName($name):bool {
        //$country = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('SELECT * FROM pais WHERE Nombre = :name');
            $stmt->execute([':name' => $name]);
            //$country = $stmt->fetch(PDO::FETCH_CLASS);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Falló la lectura del país con Nombre: $name; " . $e->getMessage();
        }
        //return $country;
        return false;
    }

    public static function insert($country) {
        $stmt = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('INSERT INTO pais (Nombre) VALUES (:name)');
            $stmt->bindValue(":name", $country);
        } catch (PDOException $e) {
            echo  "Falló la inserción del país $country; " . $e->getMessage();
        }
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('DELETE FROM pais WHERE CodPais = :id');
            $stmt->bindValue(':id', $id);
        } catch (PDOException $e) {
            echo "Falló el borrado del país $id; " . $e->getMessage();
        }
        return $stmt->execute();
    }
}