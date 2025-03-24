<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f8ff;
        }


        .logo-izquierda {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 120px;
        }

        .logo-derecha {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 120px;
        }

        

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
            text-align: center;
            width: 300px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }
        input {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<img src="/resources/pleca_tecnm.jpg" alt="Logo TecNM" class="logo-izquierda">
<img src="/resources/morelia.png" alt="Logo Morelia" class="logo-derecha">

    <div class="container">
        <h2>Selecciona tu tipo de usuario</h2>
        <button onclick="showForm('alumno')">Alumno</button>
        <button onclick="showForm('empleador')">Empleador</button>
        <button onclick="showForm('vinculacion')">Vinculación</button>

        <form method="POST" action="{{ route('login.perform') }}" class="hidden" id="loginForm">
            @csrf
            <input type="hidden" id="tipo" name="tipo">
            <input type="text" id="identificador" name="identificador" placeholder="Identificación">
            <input type="password" name="password" placeholder="Contraseña">
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
    <script>
        function showForm(tipo) {
            document.getElementById('tipo').value = tipo;
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('identificador').placeholder = 
                tipo === 'alumno' ? 'Número de Control' : 
                tipo === 'empleador' ? 'RFC' : 
                'Nombre';
        }
    </script>
</body>
</html>
