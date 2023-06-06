<?php
class App {
    public function __construct()
    {
        if (isset($_GET['controller'])) {
            $controllerName = $_GET['controller'];
        } else {
            $controllerName = 'Home';
        }

        if (isset($_GET['method'])) {
            $method = $_GET['method'];
        } else {
            $method = 'index';
        }

        $arguments = [];
        if (isset($_GET['id'])) {
            $arguments[] = $_GET['id'];
        }
        if (isset($_GET['arg2'])) {
            $arguments[] = $_GET['arg2'];
        }

        $controllerName = $controllerName . "Controller";

        $file = "../app/controllers/$controllerName" . ".php";
        if (file_exists($file)) {
            require $file;
        } else {
            echo "No se ha encontrado el controlador";
            die();
        }

        $controllerObject = new $controllerName;
        if (method_exists($controllerName, $method)) {
            $controllerObject->$method($arguments);
        } else {
            echo "No encontrado el método";
            die();
        }
    }
}