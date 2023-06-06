<?php
namespace CRUD3\App\Models;

use CRUD3\Core\Model;
use PDO;
use PDOException;

class Employee extends Model {

    public static function getAll() {
        $employees = "";
        try {
            $db = Model::connection();
            $stmt=$db->query("SELECT e.*, pr.Nombre as nombreProvincia, p.Nombre as nombrePais
                                    FROM empleado e JOIN provincia pr on e.CodProvincia = pr.CodProvincia
                                    JOIN pais p on pr.CodPais = p.CodPais");
            $employees = $stmt->fetchAll(PDO::FETCH_CLASS, Employee::class);
        } catch (PDOException $e) {
            echo "Fallo en la carga de empleados; " . $e->getMessage();
        }
        return $employees;
    }

    public static function findById($id) {
        $employee = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('SELECT * FROM empleado WHERE Id = :id');
            $stmt->execute([':id' => $id]);
            $employee = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Falló la búsqueda del empleado $id; " . $e->getMessage();
        }
        return $employee;
    }

    public static function findByName($name) {
        $employee = "";
        try {
            $db = Model::connection();
            $stmt = $db->query('SELECT * FROM empleado WHERE Nombre = :name');
            $stmt->execute([':name' => $name]);
            $employee = $stmt->fetch(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            echo "Falló la lectura del empleado con Nombre: $name; " . $e->getMessage();
        }
        return $employee;
    }

    public static function insert($employee) {
        try {
            $db = Model::connection();
            $stmt = $db->prepare('INSERT INTO empleado (Dni, Nombre, Apellidos, Telefono, CodProvincia) VALUES (:dni, :nombre, :apellidos, :telefono, :codProvincia)');
            $stmt->execute([
                ':dni' => $employee['dni'],
                ':nombre' => $employee['name'],
                ':apellidos' => $employee['surname'],
                ':telefono' => $employee['phone'],
                ':codProvincia' => $employee['codProvince']
            ]);
        } catch (PDOException $e) {
            echo  "Falló la inserción del empleado $employee; " . $e->getMessage();
        }
    }

    public static function delete($id) {
        $stmt = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('DELETE FROM empleado WHERE Id = :id');
            $stmt->bindValue(':id', $id);
        } catch (PDOException $e) {
            echo "Falló el borrado del empleado $id; " . $e->getMessage();
        }
        return $stmt->execute();
    }

    public static function update($employee, $id) {
        try{
            $db = Model::connection();
            $stmt = $db->prepare('UPDATE empleado SET Dni=:dni, Nombre=:nombre, Apellidos=:apellidos, Telefono=:telefono, CodProvincia=:provincia WHERE Id=:id');
            $stmt->execute([
                ':dni' => $employee['dni'],
                ':nombre' => $employee['name'],
                ':apellidos' => $employee['surname'],
                ':telefono' => $employee['phone'],
                ':provincia' => $employee['codProvince'],
                ':id' => $id
            ]);
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
}