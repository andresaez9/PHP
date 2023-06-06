<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empleados</title>
</head>
<body>
<h1>Empleados</h1>
<?php
$action = [
    'delete' => "<h3 style='color: red'>Empleado eliminado correctamente</h3>",
    'insert' => "<h3 style='color: forestgreen'>Empleado insertado correctamente</h3>",
    'update' => "<h3 style='color: blue'>Empleado modificado correctamente</h3>"
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
    <th>ID</th>
    <th>DNI</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Teléfono</th>
    <th>Provincia</th>
    <th>País</th>
    </thead>
    <tbody>
    <?php
        foreach ($employees as $employee) {
            ?>
            <tr>
                <td><?=$employee->Id?></td>
                <td><?=$employee->Dni?></td>
                <td><?=$employee->Nombre?></td>
                <td><?=$employee->Apellidos?></td>
                <td><?=$employee->Telefono?></td>
                <td><?=$employee->nombreProvincia?></td>
                <td><?=$employee->nombrePais?></td>
                <td>
                    <a href='?method=show&id=<?=$employee->Id?>'>Ver</a>

                    <a href="?method=getViewUpdate&id=<?=$employee->Id?>&dni=<?=$employee->Dni?>&nombre=<?=$employee->Nombre?>
                    &apellidos=<?=$employee->Apellidos?>&telefono=<?=$employee->Telefono?>
                    &provincia=<?=$employee->nombreProvincia?>&pais=<?=$employee->nombrePais?>">Modificar</a>

                    <a href="?method=getViewDelete&id=<?=$employee->Id?>">Borrar</a>
                </td>
            </tr>
            <?php
        }
    ?>
    </tbody>
</table>
<?php
$pagination->render();
?>
<a href="?method=insertUser"><button>Insertar</button></a>
<link rel="stylesheet" href="../vendor/stefangabos/zebra_pagination/public/css/zebra_pagination.css" type="text/css">
</body>
</html>