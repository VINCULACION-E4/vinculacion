<!DOCTYPE html>
<<<<<<< HEAD
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

=======
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Menu vinculacion')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<header class="relative text-gray-600 body-font">
  <div class="absolute inset-0">
      <img src="{{ asset('images/splash.jpg') }}" alt="Imagen de fondo" class="w-full h-full object-cover opacity-50 ">
  </div>
  <div class="relative container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
      <a href= '/' class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
          <img src="{{ asset('images/logotec.png') }}" alt="Logo de la empresa" class="w-15 h-15 object-cover">
          <span class="ml-3 text-xl">Vinculación</span>
      </a>
      <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
          <a href="/mostrarAlumnos" class="mr-5 hover:text-gray-900">Usuarios</a>
          <a href= "/menuEncuestas" class="mr-5 hover:text-gray-900">Encuestas</a>
          
      </nav>
      <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Button
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
              <path d="M5 12h14M12 5l7 7-7 7"></path>
          </svg>
      </button>
  </div>
</header>

<body class="bg-blue-100">
   <br>
   @yield('content')
</body>
</html>
>>>>>>> origin/CRIS
