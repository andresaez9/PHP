<?php
namespace CRUD4\App\Models;

use CRUD4\Core\Model;
use PDO;
use PDOException;

class Book extends Model {
    public static function getAll() {
        $books = "";
        try {
            $db = Model::connection();
            $stmt = $db->query('SELECT * FROM ejemplar_libro');
            $books = $stmt->fetchAll(PDO::FETCH_CLASS, Book::class);
        } catch (PDOException $e) {
            echo "Falló la lectura de todos los paises: " . $e->getMessage();
        }
        return $books;
    }

    public static function findById($id) {
        $book = "";
        try {
            $db = Model::connection();
            $stmt = $db->query('SELECT * FROM ejemplar_libro WHERE id_ejemplar = :id');
            $stmt->execute([
                ':id' => $id
            ]);
            $book = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Fallo en devolver el libro $id; " . $e->getMessage();
            die();
        }
        return $book;
    }

    public static function getIdByName($title, $author, $editorial) {
        $id_book = "";
        try {
            $db = Model::connection();
            $stmt = $db->prepare('SELECT id_ejemplar FROM ejemplar_libro WHERE titulo = :title and autor = :author and editorial = :editorial');
            $stmt->execute([
                ':title' => $title,
                ':author' => $author,
                ':editorial' => $editorial
            ]);
            $id_book = $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo "Fallo en devolver el id_ejemplar del $title, $author y $editorial; " . $e->getMessage();
            die();
        }
        return $id_book;
    }
}