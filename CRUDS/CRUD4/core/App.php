<?php
namespace CRUD4\Core;

class App{
    public function __construct()
    {
        isset($_GET['controller']) ? $controllerName = $_GET['controller'] : $controllerName = "Login";

        isset($_GET['method']) ? $method = $_GET['method'] : $method = "index";

        $arguments = [];

        if (isset($_GET["action"])) $arguments["action"] = $_GET["action"];

        if (isset($_GET["errors"])) $arguments["errors"] = $_GET["errors"];

        if(isset($_GET['arg1'])) $arguments[] = $_GET['arg1'];

        if (isset($_GET['arg2'])) $arguments[] = $_GET['arg2'];

        if (isset($_GET['arg3'])) $arguments[] = $_GET['arg3'];

        if (isset($_GET['arg4'])) $arguments[] = $_GET['arg4'];

        if (isset($_GET['arg5'])) $arguments[] = $_GET['arg5'];

        if (isset($_GET['arg6'])) $arguments[] = $_GET['arg6'];

        if (isset($_GET['arg7'])) $arguments[] = $_GET['arg7'];

        $controllerName = $controllerName . "Controller";

        $file = "../app/controllers/$controllerName" . ".php";
        if (file_exists($file)) {
            require $file;
        } else {
            echo "No se ha encontrado el controlador";
            die();
        }

        $controllerName = "CRUD4\\App\\Controllers\\$controllerName";
        $controllerObject = new $controllerName;
        if (method_exists($controllerName, $method)) {
            $controllerObject->$method($arguments);
        } else {
            echo "No encontrado el método";
            die();
        }

    }
}