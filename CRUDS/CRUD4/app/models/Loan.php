<?php
namespace CRUD4\App\Models;

use CRUD4\Core\Model;
use PDO;
use PDOException;

class Loan extends Model {
    public static function getAll() {
        $members = "";
        try {
            $db = Model::connection();
            // mostramos p.* para coger los tres campos de esa tabla que vamos a pasar esos datos por url
            $stmt = $db->query('SELECT p.*, s.nombre as nombre, s.apellidos as apellidos, 
                                    l.titulo as titulo, l.autor as autor, l.editorial as editorial, 
                                    p.fecha_prestamo as fecha_prestamo
                                    FROM socio s join prestamo p on s.id_socio = p.id_socio join ejemplar_libro l on l.id_ejemplar = p.id_ejemplar');
            $members = $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
        } catch (PDOException $e) {
            echo "Error al leer los datos completos; " . $e->getMessage();
            die();
        }
        return $members;
    }

    public static function findById($id_socio, $id_ejemplar, $fecha_prestamo) {
        $member = "";
        try {
            $db = Model::connection();
            // mostramos p.* para coger los tres campos de esa tabla que vamos a pasar esos datos por url
            $stmt = $db->prepare('SELECT p.*, s.nombre as nombre, s.apellidos as apellidos, 
                                    l.titulo as titulo, l.autor as autor, l.editorial as editorial, 
                                    p.fecha_prestamo as fecha_prestamo
                                    FROM socio s join prestamo p on s.id_socio = p.id_socio join ejemplar_libro l on l.id_ejemplar = p.id_ejemplar
                                    WHERE p.id_socio = :id_socio and p.id_ejemplar = :id_ejemplar and p.fecha_prestamo = :fecha_prestamo');
            $stmt->execute([
                ':id_socio' => $id_socio,
                ':id_ejemplar' => $id_ejemplar,
                ':fecha_prestamo' => $fecha_prestamo
            ]);
            $member = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error al encontrar los datos completos; " . $e->getMessage();
            die();
        }
        return $member;
    }

    public static function insert($id_member, $id_book, $loanDate) {
        try {
            $db = Model::connection();
            $stmt = $db->prepare('INSERT INTO prestamo (id_socio, id_ejemplar, fecha_prestamo) VALUES (:id_socio, :id_ejemplar, :fecha_prestamo)');
            $stmt->execute([
                ':id_socio' => $id_member,
                ':id_ejemplar' => $id_book,
                ':fecha_prestamo' => $loanDate
            ]);
        } catch (PDOException $e) {
            echo "Fallo al insertar un prestamo; " . $e->getMessage();
            die();
        }
    }

    public static function delete($id_member, $id_book, $loanDate) {
        try {
            $db = Model::connection();
            $stmt = $db->prepare('DELETE FROM prestamo WHERE id_socio = :id_member and id_ejemplar = :id_book and fecha_prestamo = :loanDate');
            $stmt->bindValue(':id_member', $id_member);
            $stmt->bindValue(':id_book', $id_book);
            $stmt->bindValue(':loanDate', $loanDate);
        } catch (PDOException $e) {
            echo "Fallo al borrar un préstamo con id_socio = $id_member; id_ejemplar = $id_book y fecha = $loanDate; " . $e->getMessage();
            die();
        }
        return $stmt->execute();
    }

    public static function update($newIdMember, $newIdBook, $newLoanDate, $oldIdMember, $oldIdBook, $oldLoanDate) {
        try {
            $db = Model::connection();
            $stmt = $db->prepare('UPDATE prestamo SET id_socio = :new_id_socio, id_ejemplar = :new_id_ejemplar, fecha_prestamo = :new_fecha_prestamo WHERE id_socio = :old_id_socio AND id_ejemplar = :old_id_ejemplar AND fecha_prestamo = :old_fecha_prestamo');
            $stmt->execute([
                ':new_id_socio' => $newIdMember,
                ':new_id_ejemplar' => $newIdBook,
                ':new_fecha_prestamo' => $newLoanDate,
                ':old_id_socio' => $oldIdMember,
                ':old_id_ejemplar' => $oldIdBook,
                ':old_fecha_prestamo' => $oldLoanDate
            ]);
        } catch (PDOException $e) {
            echo "Error al actualizar el préstamo: " . $e->getMessage();
            die();
        }
    }
}