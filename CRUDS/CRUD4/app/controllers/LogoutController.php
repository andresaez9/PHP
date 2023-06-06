<?php
namespace CRUD4\App\Controllers;

class LogoutController {
    public function logout() {
         session_destroy();

         header("Location: ?controller=Login&method=index&action=logout");
    }
}