<!DOCTYPE html>

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
        <a href="/mostrarAlumnos" class="mr-5 hover:text-gray-900">Usuarios  |</a>
        <a href="/menuEncuestas" class="mr-5 hover:text-gray-900">Encuestas  |</a>
        <a href="/vinculacion_ofertas" class="mr-5 hover:text-gray-900">Ofertas |</a>
        <a href="/indicadores-clave" class="mr-5 hover:text-gray-900">Indicadores clave </a>
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

<body class="bg-blue-100">
   <br>
   @yield('content')
</body>
</html>

<script>
    document.getElementById('userMenuButton').addEventListener('click', function() {
        document.getElementById('userDropdown').classList.toggle('hidden');
    });

    // Cierra el menú si se hace clic fuera
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdown');
        const button = document.getElementById('userMenuButton');

        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>