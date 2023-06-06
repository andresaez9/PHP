<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mostrar Usuario</title>
</head>
<body>
    <h1>Usuario <?=$_GET['id']?></h1>

    <?=$_REQUEST['user']?>
    <br>
    <a href="?method=index"><button>Volver</button></a>
</body>
</html>