<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ConfirmDelete</title>
</head>
<body>
<h3>¿Estás seguro de eliminar el usuario <?=$_GET['id']?>?</h3>
<a href="?method=delete&id=<?=$_GET['id']?>"><button>SI</button></a><br>
<a href="?method=index"><button>NO</button></a>
</body>
</html>