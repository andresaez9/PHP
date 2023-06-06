<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
</head>
<body>
<h3>Bienvenido <?=$_SESSION['user'];?></h3>
<h1>Préstamos</h1>
<?php
$action = [
    'delete' => "<h3 style='color: red'>Prestamo eliminado correctamente</h3>",
    'insert' => "<h3 style='color: forestgreen'>Prestamo insertado correctamente</h3>",
    'update' => "<h3 style='color: blue'>Prestamo modificado correctamente</h3>"
];

if (isset($_GET["action"])){
    if ($_GET["action"] == 'delete'){
        echo $action['delete'];
    }
    if ($_GET["action"] == 'insert'){
        echo $action['insert'];
    }
    if ($_GET["action"] == 'update'){
        echo $action['update'];
    }
}
?>

<table>
    <thead>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Titulo</th>
    <th>Autor</th>
    <th>Editorial</th>
    <th>Fecha Préstamo</th>
    </thead>
    <tbody>
    <?php
    foreach ($loans as $loan) {
        ?>
        <tr>
            <td><?=$loan->nombre?></td>
            <td><?=$loan->apellidos?></td>
            <td><?=$loan->titulo?></td>
            <td><?=$loan->autor?></td>
            <td><?=$loan->editorial?></td>
            <td><?=$loan->fecha_prestamo?></td>
            <td>
                <a href='?controller=Home&method=show&id_socio=<?=$loan->id_socio?>&id_ejemplar=<?=$loan->id_ejemplar?>&fecha_prestamo=<?=$loan->fecha_prestamo?>'>Ver</a>

                <a href="?controller=Home&method=getViewUpdate&id_socio=<?=$loan->id_socio?>&id_ejemplar=<?=$loan->id_ejemplar?>&fecha_prestamo=<?=$loan->fecha_prestamo?>&nombre=<?=$loan->nombre?>&apellidos=<?=$loan->apellidos?>&titulo=<?=$loan->titulo?>&autor=<?=$loan->autor?>&editorial=<?=$loan->editorial?>&fecha_prestamo=<?=$loan->fecha_prestamo?>">Modificar</a>

                <a href="?controller=Home&method=getViewDelete&id_socio=<?=$loan->id_socio?>&id_ejemplar=<?=$loan->id_ejemplar?>&fecha_prestamo=<?=$loan->fecha_prestamo?>">Borrar</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<br>
<?php
$pagination->render();
?>
<a href="?controller=Home&method=getViewInsert"><button>Insertar</button></a><br><br>
<a href="?controller=Logout&method=logout"><button>Cerrar Sesión</button></a>
<link rel="stylesheet" href="../vendor/stefangabos/zebra_pagination/public/css/zebra_pagination.css" type="text/css">
</body>
</html>