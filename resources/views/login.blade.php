<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f0f8ff] flex justify-center items-center h-screen">

    <img src="/resources/pleca_tecnm.jpg" alt="Logo TecNM" class="absolute top-10 left-10 w-24">

    <img src="/resources/morelia.png" alt="Logo Morelia" class="absolute top-10 right-10 w-24">

    <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
        
        <h2 class="text-xl font-semibold mb-4">Selecciona tu tipo de usuario</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button onclick="showForm('alumno')" class="bg-blue-500 text-white py-2 px-4 rounded-full w-full mb-2 hover:bg-blue-600">Alumno</button>
        <button onclick="showForm('empleador')" class="bg-blue-500 text-white py-2 px-4 rounded-full w-full mb-2 hover:bg-blue-600">Empleador</button>
        <button onclick="showForm('vinculacion')" class="bg-blue-500 text-white py-2 px-4 rounded-full w-full mb-4 hover:bg-blue-600">Vinculación</button>

        <form method="POST" action="{{ route('login.perform') }}" id="loginForm" class="hidden">
            @csrf
            <input type="hidden" id="tipo" name="tipo" class="hidden">
            <input type="text" id="identificador" name="identificador" placeholder="Identificación" class="w-full p-3 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="password" name="password" placeholder="Contraseña" class="w-full p-3 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Iniciar Sesión</button>
        </form>
    </div>

    <script>
        function showForm(tipo) {
            document.getElementById('tipo').value = tipo;
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('identificador').placeholder = 
                tipo === 'alumno' ? 'Número de Control' : 
                tipo === 'empleador' ? 'RFC' : 
                tipo === 'vinculacion' ? 'Usuario' : '';
        }
    </script>

</body>
</html>
