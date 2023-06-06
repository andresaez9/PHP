<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Email</th>
        </tr>
        </thead>

        <tbody>
        <?php
        if (!empty($users)){
            foreach ($users as $user) {
                ?>
                <tr>
                    <td><?=$user->id_usuario?></td>
                    <td><?=$user->nombre?></td>
                    <td><?=$user->usuario?></td>
                    <td><?=password_hash($user->clave, PASSWORD_DEFAULT)?></td>
                    <td><?=$user->email?></td>
                    <td>
                        <a href='?method=show&id=<?=$user->id_usuario?>'>Ver</a>
                        <a href='?method=confirmDelete&id=<?=$user->id_usuario?>'>Borrar</a>
                        <a href='?method=updateUser&id=<?=$user->id_usuario?>'>Editar</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
    <br>
    <a href="?method=newUser"><button>Insertar Usuario</button></a>
</body>
</html>