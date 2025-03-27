<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Menu vinculacion')</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <header class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto flex items-center justify-between p-4">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold">
                MiUniversidad
            </a>
    
            <!-- Menú de navegación (visible en pantallas medianas y grandes) -->
            <nav class="hidden md:flex space-x-6">
                <a href="/ofertas" class="hover:text-gray-200">Ofertas</a>
                <a href="/dashboard/encuestas" class="hover:text-gray-200">Encuetas</a>
                <a href="/" class="hover:text-gray-200">otro</a>
            </nav>
    
            <!-- Perfil del usuario -->
            <button class="flex items-center space-x-2 bg-white text-blue-600 px-4 py-2 rounded-full shadow-md hover:bg-gray-100">
                <span class="hidden md:inline font-medium">Alumno</span>
                <img src="https://via.placeholder.com/40" alt="Foto de perfil" class="w-10 h-10 rounded-full border-2 border-white">
            </button>
        </div>
    
    </header>

<body>
    @yield('contenido')
</body>
</html>