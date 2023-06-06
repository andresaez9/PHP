<?php
require __DIR__ . "/../models/Users.php";
require __DIR__ . "/../../core/Validation.php";

class HomeController extends Validation {

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->listUsers();
    }

    private function listUsers(){
        Users::getAllUsers() ? $users = Users::getAllUsers() : $users = [];
        require __DIR__ . "/../views/users.php";
    }

    public function show(){
        $user = Users::findById($_GET['id']);
        $message = "
            <p><b>Nombre:</b> {$user["nombre"]}</p>
            <p><b>Usuario:</b> {$user['usuario']}</p>
            <p><b>Clave:</b> {$user['clave']}</p>
            <p><b>Email:</b> {$user['email']}</p>
        ";
        $_REQUEST['user'] = $message; // Incluir el archivo showUser.php y pasar la variable mediante $_REQUEST
        $this->showUser();
    }

    private function showUser(){
        require __DIR__ . "/../views/showUser.php";
    }

    public function newUser() {
        require __DIR__ . "/../views/newUser.php"; //muestra la página para insertar
    }

    public function insert(){
        $name = $_POST['name'];
        $user = $_POST['user'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $validationResult = parent::validateInputs($name, $user, $password, $email);
        if (!$validationResult){
            $page = __DIR__ . "/../views/newUser.php";
            include $page;
            return;
        }
        Users::insert($name, $user, $password, $email);
        header("Location: index.php");
    }

    public function confirmDelete(){
        require __DIR__ . "/../views/confirmDelete.php";
    }

    public function delete(){
        Users::delete($_GET['id']);
        header("Location: index.php");
    }

    public function update(){
        session_start();

        $id = $_SESSION['id'];
        $name = $_SESSION['name'];
        $user = $_SESSION['user'];
        $password = $_SESSION['password'];
        $email = $_SESSION['email'];

        $validationResult = parent::validateInputs($name, $user, $password, $email, $id);
        if (!$validationResult){
            $page = __DIR__ . "/../views/editUser.php";
            include $page;
            return;
        }

        Users::update($_SESSION['id'], $_SESSION['name'], $_SESSION['user'], $_SESSION['password'], $_SESSION['email']);
        header("Location: index.php");
        session_destroy();
        session_commit(); //guarda los cambios en la sesión y asegura que se eliminen los datos de la sesión inmediatamente.
    }

    public function updateUser(){
        require __DIR__ . "/../views/editUser.php";
    }

    public function confirmUpdate(){
        session_start();
        $_SESSION['id'] = $_GET['id'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['email'] = $_POST['email'];
        require __DIR__ . "/../views/confirmUpdate.php";
    }
}