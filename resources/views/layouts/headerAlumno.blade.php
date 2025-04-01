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
                Tecnológico de Morelia
            </a>
    
            <!-- Menú de navegación (visible en pantallas medianas y grandes) -->
            <nav class="hidden md:flex space-x-6">
                <a href="/ofertas" class="hover:text-gray-200">Ofertas</a>
                <a href="/dashboard/encuestas" class="hover:text-gray-200">Encuestas</a>
                
            </nav>
            @php
                $authUser = Auth::guard('usuarios_alumno')->user();
            @endphp
    
            @if($authUser)
            <div class="relative inline-block text-left">
                <button id="userMenuButton" class="flex items-center bg-gray-100 border border-gray-300 py-2 px-4 rounded-lg text-gray-900 hover:bg-gray-200 focus:outline-none">
                    <span class="mr-2">{{ $authUser->alumno->nombre }} {{ $authUser->alumno->apellido_paterno }}</span>
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
        </div>
    
    </header>

<body>
    @yield('contenido')
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