<?php
namespace CRUD4\Core;
use CRUD4\App\Models\Member;

$errors = [];
$validation = false;

if (empty($_POST['user'])) {
    $errors['user'] = "El usuario es obligatorio";
    $validation = true;
}

if (empty($_POST['password'])) {
    $errors['password'] = "La contraseña es obligatorio";
    $validation = true;
}

if (!Member::hasUser($_POST['user'], $_POST['password'])) {
    $errors['user'] = "El usuario no existe";
    $validation = true;
}