<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ofertas')</title>
    @vite('resources/css/app.css') <!-- Este es el archivo de Tailwind compilado -->
</head>
<header class="relative text-gray-600 body-font">
    <div class="absolute inset-0">
        <img src="{{ asset('images/splash.jpg') }}" alt="Imagen de fondo" class="w-full h-full object-cover opacity-50 ">
    </div>
    <div class="relative container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a href= '/' class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <img src="{{ asset('images/logotec.png') }}" alt="Logo de la empresa" class="w-12 h-12 object-cover">
            <span class="ml-3 text-xl">Vinculación</span>
        </a>
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
          <a href="/mostrarAlumnos" class="mr-5 hover:text-gray-900">Usuarios  |</a>
          <a href="/menuEncuestas" class="mr-5 hover:text-gray-900">Encuestas  |</a>
          <a href="/vinculacion_ofertas" class="mr-5 hover:text-gray-900">Ofertas</a>
  
          @if(isset($authUser))
          <div class="relative inline-block text-left">
              <button id="userMenuButton" class="flex items-center bg-gray-100 border border-gray-300 py-2 px-4 rounded-lg text-gray-900 hover:bg-gray-200 focus:outline-none">
                  <span class="mr-2">{{ $authUser->nombre }} {{ $authUser->apellido_paterno }}</span>
                  <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                      <path d="M19 9l-7 7-7-7"></path>
                  </svg>
              </button>
          
              <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg">
                  <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                          Cerrar sesión
                      </button>
                  </form>
              </div>
          </div>
          @endif
  
           </nav>
        
    </div>
  </header>
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