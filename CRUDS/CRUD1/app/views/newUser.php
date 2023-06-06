<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New User</title>
</head>
<body>
    <h1>Insertar Usuario</h1>
    <form action="?method=insert" method="post" enctype="multipart/form-data">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name"><br>
        <span><?=$nameError ?? ''?></span>

        <label for="user">Usuario</label>
        <input type="text" name="user" id="user"><br>
        <span><?=$userError ?? ''?></span>

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password"><br>
        <span><?=$passwordError ?? ''?></span>

        <label for="email">Email</label>
        <input type="text" name="email" id="email"><br><br>
        <span><?=$emailError ?? ''?></span>

        <button type="submit">Insertar Usuario</button>
    </form>
    <br>
    <a href="?method=index"><button>Volver</button></a>
</body>
</html>