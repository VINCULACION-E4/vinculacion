<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Menu Empresa')</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
            @php
                $authUser = Auth::guard('empleador')->user();
            @endphp
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <a href="/dashboardEmpresa" class="text-2xl font-semibold text-gray-800">{{ $authUser->empleadore->nombre_comercial }}</a>
            <nav>
                <ul class="flex space-x-6">
                    <li>
                        <a href="/dashboardEmpresa" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                            🔷Mis ofertas
                        </a>
                    </li>
                    <li>
                        <a href="/empleador/focus-group/mostrar" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                            📋 Focus Groups
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                                🔒 Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <body class="bg-gray-100">
        @yield('contenido')
    </body>
</html>