<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $asunto }}</title>  <!-- Mostramos el asunto en el título -->
</head>
<body>
    <h1>{{ $asunto }}</h1>  <!-- Mostramos el asunto en el cuerpo -->
    <p>Has recibido un mensaje de la encuesta:</p>
    <p><strong>Contenido del mensaje:</strong></p>
    <p>{{ $mensaje }}</p>  <!-- Mostramos el mensaje en el cuerpo -->
</body>
</html>
