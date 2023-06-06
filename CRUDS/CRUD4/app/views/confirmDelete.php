<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmar Eliminación</title>
</head>
<body>
<h2>¿Estás seguro de eliminar el préstamo del socio <?=$_GET['id_socio']?> con el libro <?=$_GET['id_ejemplar']?> en la fecha <?=$_GET['fecha_prestamo']?></h2>
<a href="?controller=Home&method=delete&id_socio=<?=$_GET['id_socio']?>&id_ejemplar=<?=$_GET['id_ejemplar']?>&fecha_prestamo=<?=$_GET['fecha_prestamo']?>"><button>SI</button></a>
<a href="?controller=Home&method=index"><button>NO</button></a>
</body>
</html>