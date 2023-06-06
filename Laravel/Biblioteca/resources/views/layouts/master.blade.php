<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include('profile.partials.navbar')

    <article class="container flex flex-col items-center justify-center">
        @yield('notifications')
        @yield('content')
    </article>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
