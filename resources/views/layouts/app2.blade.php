<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ofertas')</title>
    @vite('resources/css/app.css') <!-- Este es el archivo de Tailwind compilado -->
</head>
<body class="bg-gray-100">

    <!-- Barra de navegación -->
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto">
            <a href="#" class="text-white text-lg font-semibold">Ofertas</a>
        </div>
    </nav>

    <!-- Contenido de la página -->
    <div class="container mx-auto mt-4">
        @yield('content')
    </div>

    <!-- Scripts (si necesitas JavaScript en tu proyecto) -->
    @vite('resources/js/app.js') <!-- Aquí se carga el archivo JS -->
</body>
</html>