<?php
namespace CRUD3\App\Controllers;

use CRUD3\App\Models\Country;
use CRUD3\App\Models\Employee;
use CRUD3\App\Models\Province;
use CRUD3\Core\Validation;

class HomeController {
    public function index() {
        $employees = Employee::getAll();
        $record_per_page = 5;
        require __DIR__ . "/../../vendor/stefangabos/zebra_pagination/Zebra_Pagination.php";
        $pagination = new \Zebra_Pagination();
        $pagination->records(count($employees));
        $pagination->records_per_page($record_per_page);
        $employees = array_slice($employees, (($pagination->get_page() - 1) * $record_per_page), $record_per_page);

        require_once __DIR__ . "/../views/index.php";
    }

    public function insertUser() {
        require __DIR__ . "/../views/insertEmployee.php";
    }

    public function insert() {
        require __DIR__ . "/../../core/Validation.php";

        if (empty($errors)) {
            if (Province::findByName($_POST['province']) && Country::findByName($_POST['country'])) {
                $employee = [
                    'dni' => $_POST['dni'],
                    'name' => $_POST['name'],
                    'surname' => $_POST['surname'],
                    'phone' => $_POST['phone'],
                    'codProvince' => Province::getIdByName($_POST['province'])
                ];

                Employee::insert($employee);
                header("Location: ?method=index&action=insert");
            }
        } else {
            header("Location: ?method=insertUser&errors=" . json_encode($errors));
        }
    }

    public function show() {
        $employee = Employee::findById($_GET['id']);
        $province = Province::getNameById($_GET['id']);
        $message = "
            <p><b>Dni:</b> {$employee['Dni']}</p>
            <p><b>Nombre:</b> {$employee['Nombre']}</p>
            <p><b>Apellidos:</b> {$employee['Apellidos']}</p>
            <p><b>Telefono:</b> {$employee['Telefono']}</p>
            <p><b>Provincia:</b> {$province}</p>
        ";
        $_REQUEST['employee'] = $message;
        $this->showEmployee();
    }

    public function showEmployee() {
        require_once __DIR__ . "/../views/showEmployee.php";
    }

    public function getViewDelete() {
        require_once __DIR__ . '/../views/confirmDelete.php';
    }

    public function delete() {
        Employee::delete($_GET['id']);
        header("Location: ?method=index&action=delete");
    }

    public function getViewUpdate() {
        require_once __DIR__ . "/../views/updateEmployee.php";
        session_start();
        $_SESSION['province'] = $_GET['provincia'];
        $_SESSION['country'] = $_GET['pais'];
    }

    public function confirmUpdate() {
        session_start();
        require __DIR__ . "/../../core/Validation.php";

        $_SESSION['id'] = $_GET['id'];
        $_SESSION['dni'] = $_POST['dni'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['surname'] = $_POST['surname'];
        $_SESSION['phone'] = $_POST['phone'];

        if (empty($errors)) {
            if (Province::findByName($_POST['province'])) {
                $_SESSION['province'] = Province::getIdByName($_POST['province']);
            } else {
                $_SESSION['province'] = $_GET['provincia'];
            }

            require_once __DIR__ . "/../views/confirmUpdate.php";
        } else {
            header("Location: ?method=getViewUpdate&errors=" . json_encode($errors) . "&id=" . $_SESSION['id'] . "&dni=" . $_SESSION['dni'] . "&nombre=" . $_SESSION['name'] . "&apellidos=" . $_SESSION['surname'] . "&telefono=" . $_SESSION['phone'] . "&provincia=" . $_SESSION['province'] . "&pais=" . $_SESSION['country']);
        }

    }

    public function update() {
        session_start();

        $employee = [
            'dni' => $_SESSION['dni'],
            'name' => $_SESSION['name'],
            'surname' => $_SESSION['surname'],
            'phone' => $_SESSION['phone'],
            'codProvince' => $_SESSION['province'],
        ];

        Employee::update($employee, $_SESSION['id']);
        session_destroy();
        session_commit();
        header("Location: ?method=index&action=update");
    }
}