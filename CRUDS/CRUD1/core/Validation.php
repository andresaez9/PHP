<?php
require __DIR__ . '/../vendor/autoload.php';
use Rakit\Validation\Validator;

class Validation{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    protected function validateInputs($nombre, $usuario, $clave, $email, $id_usuario=''){
        $data = [
            'name' => $nombre,
            'user' => $usuario,
            'password' => $clave,
            'email' => $email
        ];

        $validation = $this->validator->validate($data, [
            'name' => 'required',
            'user' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|email'
        ]);

        $nameError = '';
        $userError = '';
        $passwordError = '';
        $emailError = '';

        if ($validation->fails()){
           $errors = $validation->errors();

           if ($errors->has('name')) {
               $nameError = "El nombre es requerido";
               return false;
           }

           if ($errors->has('user')) {
               $userError = "El usuario es requerido";
               return false;
           }

           if ($errors->has('password')) {
               $passwordError = "La contraseña es requerida";
               return false;
           }

           if ($errors->has('email')) {
               $emailError = "El email es requerido";
               return false;
           }
        }
        return true;
    }
}

