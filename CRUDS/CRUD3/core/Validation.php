<?php
namespace CRUD3\Core;
/*require __DIR__ . '/../vendor/autoload.php';
use Rakit\Validation\Validator;

class Validation{

    public static function validateInputs($dni, $name, $surname, $phone, $codProvince){
        $validator = new Validator;
        $data = [
            'dni' => $dni,
            'name' => $name,
            'surname' => $surname,
            'phone' => $phone,
            'codProvince' => $codProvince
        ];

        $validation = $validator->validate($data, [
            'dni' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required|min:9',
            'codProvince' => 'required'
        ]);

        $dniError = '';
        $nameError = '';
        $surnameError = '';
        $phoneError = '';
        $codProvinceError = '';

        if ($validation->fails()){
            $errors = $validation->errors();

            if ($errors->has('dni')) {
                $dniError = "El dni es requerido";
                return false;
            }

            if ($errors->has('name')) {
                $nameError = "El nombre es requerido";
                return false;
            }

            if ($errors->has('surname')) {
                $surnameError = "El apellido es requerida";
                return false;
            }

            if ($errors->has('phone')) {
                $phoneError = "El telefono es requerido";
                return false;
            }

            if ($errors->has('codProvince')) {
                $codProvinceError = "La provincia es requerida";
                return false;
            }
        }
        return true;
    }
}*/

$errors = [];
$validation = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['dni'])) {
        $errors['dni'] = "DNI requerido";
    } else {
        $dni = test_input($_POST['dni']);
        $validation = true;

        if (!preg_match("/^[0-9]{8}[A-Z]$/", $_POST['dni'])) {
            $errors['dni'] = "DNI no valido";
        }
    }

    if (empty($_POST['name'])) {
        $errors['name'] = "Nombre requerido";
    } else {
        $name = test_input($_POST['name']);
        $validation = true;

        if (!preg_match("/^[a-zA-Z ]*$/", $_POST['name'])) {
            $errors['name'] = "Nombre no valido";
        }
    }

    if (empty($_POST['surname'])) {
        $errors['surname'] = "Apellido requerido";
    } else {
        $surname = test_input($_POST['surname']);
        $validation = true;

        if (!preg_match("/^[a-zA-Z ]*$/", $_POST['surname'])) {
            $errors['surname'] = "Apellido no valido";
        }
    }

    if (empty($_POST['phone'])) {
        $errors['phone'] = "Telefono requerido";
    } else {
        $phone = test_input($_POST['phone']);
        $validation = true;

        if (!preg_match("/^[0-9]{9}$/", $_POST['phone'])) {
            $errors['phone'] = "Telefono no valido";
        }
    }

    if (empty($_POST['province'])) {
        $errors['province'] = "Provincia requerida";
    } else {
        $province = test_input($_POST['province']);
        $validation = true;

        if (!preg_match("/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/", $_POST['province'])) {
            $errors['province'] = "Provincia no valida";
        }
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

