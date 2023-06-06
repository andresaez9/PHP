<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>

<?php
$action = [
    'logout' => "<h3 style='color: darkgreen'>Se ha cerrado la sesión correctamente</h3>"
];

if (isset($_GET["action"])){
    if ($_GET["action"] == 'logout'){
        echo $action['logout'];
    }
}
?>
<main>
    <form action="index.php?controller=Login&method=start" method="post" enctype="multipart/form-data">
        <label for="user">Usuario</label>
        <input type="text" name="user" id="user" value="<?= $user ?? "" ?>">
        <br>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" value="<?= $password ?? "" ?>">
        <br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</main>
</body>

<?php
if (isset($_GET["errors"])) {
    $errors = $_GET["errors"];
    $errors = json_decode($errors);

    foreach ($errors as $error) {
        echo "<h3 class='error' style='color: red'>$error</h3>";
    }
}
?>
</html>