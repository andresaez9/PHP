<?php
namespace CRUD4\App\Controllers;

use CRUD4\App\Models\Book;
use CRUD4\App\Models\Loan;
use CRUD4\App\Models\Member;

class HomeController {
    public function index() {
        session_start();

        if (!isset($_SESSION["user"])){
            header("Location: ?controller=Login&method=index");
        }

        $loans = Loan::getAll();

        $record_per_page = 4;
        require __DIR__ . "/../../vendor/stefangabos/zebra_pagination/Zebra_Pagination.php";
        $pagination = new \Zebra_Pagination();
        $pagination->records(count($loans));
        $pagination->records_per_page($record_per_page);
        $loans = array_slice($loans, (($pagination->get_page() - 1) * $record_per_page), $record_per_page);

        require_once __DIR__ . "/../views/index.php";
    }

    public function show() {
        $member = Loan::findById($_GET['id_socio'], $_GET['id_ejemplar'], $_GET['fecha_prestamo']);
        $message = "
            <p><b>Nombre:</b> {$member['nombre']}</p>
            <p><b>Apellidos:</b> {$member['apellidos']}</p>
            <p><b>Titulo:</b> {$member['titulo']}</p>
            <p><b>Autor:</b> {$member['autor']}</p>
            <p><b>Editorial:</b> {$member['editorial']}</p>
            <p><b>Fecha Prestamo:</b> {$member['fecha_prestamo']}</p>
        ";
        $_REQUEST['member'] = $message;
        $this->showMember();
    }

    public function showMember() {
        require_once __DIR__ . "/../views/showMember.php";
    }

    public function getViewInsert() {
        require __DIR__ . "/../views/insertForm.php";
    }

    public function insert() {
        require __DIR__ . "/../../core/Validation.php";

        $id_member = Member::getIdByName($_POST['name'], $_POST['surname']);
        $id_book = Book::getIdByName($_POST['title'], $_POST['author'], $_POST['editorial']);

        if (empty($errors)) {
            if ($id_member && $id_book && $_POST['loanDate']) {
                Loan::insert($id_member, $id_book, $_POST['loanDate']); //id_member['id_member'] e id_book['id_book'] son un array por eso hay que llamarlos así cuando tiene fetch()
                header("Location: ?controller=Home&method=index&action=insert");
            } else {
                header("Location: ?controller=Home&method=getViewInsert&errors=" . json_encode($errors));
            }
        }
    }

    public function getViewDelete() {
        require __DIR__ . "/../views/confirmDelete.php";
    }

    public function delete() {
        Loan::delete($_GET['id_socio'], $_GET['id_ejemplar'], $_GET['fecha_prestamo']);
        header("Location: ?controller=Home&method=index&action=delete");
    }

    public function getViewUpdate() {
        require __DIR__ . "/../views/updateForm.php";
    }

    public function confirmUpdate() {
        session_start();
        require __DIR__ . "/../../core/Validation.php";

        $_SESSION['old_idMember'] = $_GET['id_socio'];
        $_SESSION['old_idBook'] = $_GET['id_ejemplar'];
        $_SESSION['old_loanDate'] = $_GET['fecha_prestamo'];

        if (empty($errors)) {
            $id_member = Member::getIdByName($_POST['name'], $_POST['surname']);
            $id_book = Book::getIdByName($_POST['title'], $_POST['author'], $_POST['editorial']);

            $_SESSION['new_idMember'] = $id_member;
            $_SESSION['new_idBook'] = $id_book;
            $_SESSION['new_loanDate'] = $_POST['loanDate'];

            require_once __DIR__ . "/../views/confirmUpdate.php";
        } else {
            header("Location: ?controller=Home&method=getViewUpdate&errors=" . json_encode($errors));
        }
    }

    public function update() {
        session_start();
        Loan::update($_SESSION['new_idMember'], $_SESSION['new_idBook'], $_SESSION['new_loanDate'], $_SESSION['old_idMember'], $_SESSION['old_idBook'], $_SESSION['old_loanDate']);
        header("Location: ?controller=Home&method=index&action=update");
    }
}