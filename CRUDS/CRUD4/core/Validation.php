<?php
namespace CRUD4\Core;

$errors = [];
$anyError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['name'])) {
        $errors['nameError'] = "Nombre requerido";
    } else {
        $name = test_input($_POST['name']);
        $anyError = true;

        if (!preg_match("/^[a-zA-Z\s]*$/", $_POST['name'])) {
            $errors['nameError'] = "Nombre no valido";
        }
    }

    if (empty($_POST['surname'])) {
        $errors['surnameError'] = "Apellidos requeridos";
    } else {
        $surname = test_input($_POST['surname']);
        $anyError = true;

        if (!preg_match("/^[a-zA-Z\s]*$/", $_POST['surname'])) {
            $errors['surnameError'] = "Apellido no valido";
        }
    }

    if (empty($_POST['title'])) {
        $errors['titleError'] = "Título requerido";
    } else {
        $title = test_input($_POST['title']);
        $anyError = true;

        if (!preg_match("/^[a-zA-Z\s]*$/", $_POST['title'])) {
            $errors['titleError'] = "Título no valido";
        }
    }

    if (empty($_POST['editorial'])) {
        $errors['editorialError'] = "Editorial requerido";
    } else {
        $editorial = test_input($_POST['editorial']);
        $anyError = true;

        if (!preg_match("/^[a-zA-Z\s]*$/", $_POST['editorial'])) {
            $errors['editorialError'] = "Editorial no valido";
        }
    }

    if (empty($_POST['loanDate'])) {
        $errors['dateError'] = "Fecha requerida";
    } else {
        $loanDate = test_input($_POST['loanDate']);
        $anyError = true;
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}