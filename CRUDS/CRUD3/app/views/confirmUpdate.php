<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmar Modificación</title>
</head>
<body>
<h2>¿Estás seguro de actualizar el empleado <?=$_GET['id']?></h2>
<a href="?method=update&id=<?=$_GET['id']?>"><button>SI</button></a>
<a href="?method=index"><button>NO</button></a>
</body>
</html>