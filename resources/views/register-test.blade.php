<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f8ff;
            position: relative;
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
            z-index: 1;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
        }

        input, select {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<img src="/resources/pleca_tecnm.jpg" alt="Logo TecNM" class="logo-izquierda">
<img src="/resources/morelia.png" alt="Logo Morelia" class="logo-derecha">




    <div class="container">
        <h2>Registro</h2>

        <form method="POST" action="{{ route('register.perform') }}">
            @csrf
            <select name="tipo">
                <option value="alumno">Alumno</option>
                <option value="empleador">Empleador</option>
                <option value="vinculacion">Vinculación</option>
            </select>
            <input type="text" name="identificador" placeholder="Identificación">
            <input type="password" name="password" placeholder="Contraseña">
            <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña">
            <input type="email" name="email" placeholder="Correo (Opcional)">
            <button type="submit">Registrarse</button>
        </form>
    </div>

</body>
</html>
