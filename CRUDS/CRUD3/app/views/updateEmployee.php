<!doctype html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar Empleado</title>
</head>
<body>
<h2>Modificación del empleado <?=$_GET['id']?></h2>
<form action="?method=confirmUpdate&id=<?=$_GET['id']?>&province=<?=$_GET['provincia']?>" method="post" enctype="multipart/form-data">
    <label for="dni">DNI:</label>
    <input type="text" name="dni" id="dni" value="<?=$_GET['dni']?>"><br><br>

    <label for="name">Nombre:</label>
    <input type="text" name="name" id="name" value="<?=$_GET['nombre']?>"><br><br>

    <label for="surname">Apellidos:</label>
    <input type="text" name="surname" id="surname" value="<?=$_GET['apellidos']?>"><br><br>

    <label for="phone">Teléfono:</label>
    <input type="text" name="phone" id="phone" value="<?=$_GET['telefono']?>"><br><br>

    <label for="province">Provincia:</label>
    <input type="text" name="province" id="province" value="<?=$_GET['provincia']?>"><br><br>

    <!--<label for="country">País:</label>
    <input type="text" name="country" id="country" value="$_GET['pais']?>" required><br><br>-->

    <button type="submit">Enviar</button>
</form>
<br>
<a href="?method=index"><button>Volver</button></a><br><br>

<?php
if (isset($_GET["errors"])){
    $errors = $_GET["errors"];
    $errors = json_decode($errors);
    foreach ($errors as $error){
        echo "<p style='color: red'>$error</p>";
    }
}
?>
</body>
</html>