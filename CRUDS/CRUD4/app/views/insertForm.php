<!doctype html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insertar Préstamo</title>
</head>
<body>
<h2>Inserta un Préstamo</h2>
<form action="?controller=Home&method=insert" method="post" enctype="multipart/form-data">
    <label for="name">Nombre:</label>
    <input type="text" name="name" id="name"><br><br>

    <label for="surname">Apellidos:</label>
    <input type="text" name="surname" id="surname"><br><br>

    <label for="title">Título:</label>
    <input type="text" name="title" id="title"><br><br>

    <label for="author">Autor:</label>
    <input type="text" name="author" id="author"><br><br>

    <label for="editorial">Editorial:</label>
    <input type="text" name="editorial" id="editorial"><br><br>

    <label for="loanDate">Fecha Préstamo:</label>
    <input type="date" name="loanDate" id="loanDate"><br><br>

    <button type="submit">Enviar</button>
</form>
<br>
<a href="?controller=Home&method=index"><button>Volver</button></a><br><br>

<?php
if (isset($_GET["errors"])){
    $errors = json_decode($_GET["errors"]);
    foreach ($errors as $error){
        echo "<p style='color: red'>$error</p>";
    }
}
?>
</body>
</html>