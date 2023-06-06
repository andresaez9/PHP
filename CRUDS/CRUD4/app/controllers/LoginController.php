<?php
namespace CRUD4\App\Controllers;

class LoginController {
    public function index() {
        require __DIR__ . "/../views/login.php";
    }

    public function start() {
        require __DIR__ . "/../../core/ValidationLogin.php";

        if (empty($errors)) {
            session_start();
            $_SESSION['user'] = $_POST['user'];
            header("Location: ?controller=Home&method=index");
        } else {
            header("Location: ?controller=Login&method=index&errors=" . json_encode($errors));
        }
    }
}