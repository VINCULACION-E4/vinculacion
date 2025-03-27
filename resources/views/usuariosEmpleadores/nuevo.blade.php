@extends('layouts.app')
@section('content')
    <div class="max-w-5xl mx-auto bg-white p-8 shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">Registro de Empresa</h2>
        
        <form action="/crearEmpleador" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Columna 1: Datos de la empresa -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-4">Datos de la Empresa</h3>

                    <label class="block text-sm font-medium text-gray-700">RFC</label>
                    <input type="text" name="rfc" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Nombre Comercial</label>
                    <input type="text" name="nombre_comercial" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Razón Social</label>
                    <input type="text" name="razon_social" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Tipo de Empresa/Instancia</label>
                    <input type="text" name="tipo_empresa" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Sector</label>
                    <input type="text" name="sector" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Giro</label>
                    <input type="text" name="giro" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Número de empleados</label>
                    <input type="number" name="num_empleados" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" name="direccion" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Colonia</label>
                    <input type="text" name="colonia" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Ciudad</label>
                    <input type="text" name="ciudad" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Estado</label>
                    <input type="text" name="estado" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Código Postal</label>
                    <input type="text" name="codigo_postal" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">País</label>
                    <input type="text" name="pais" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Descripción de la empresa</label>
                    <textarea name="descripcion" class="w-full p-2 border rounded-lg mb-3" rows="3" required></textarea>

                    <label class="block text-sm font-medium text-gray-700">Sitio Web</label>
                    <input type="text" name="sitio_web" class="w-full p-2 border rounded-lg mb-3">
                    
                    <label class="block text-sm font-medium text-gray-700">Título y Nombre de la persona responsable</label>
                    <input type="text" name="responsable_nombre" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Puesto de la persona responsable</label>
                    <input type="text" name="responsable_puesto" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Teléfono(s) de la persona responsable</label>
                    <input type="text" name="responsable_telefono" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Correo de la persona responsable</label>
                    <input type="email" name="responsable_correo" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Carrera de interés</label>
                    <select name="carrera_interes" class="w-full p-2 border rounded-lg mb-3">
                        <option value="" disabled selected>Seleccione una carrera</option>
                        <option value="COPU">COPU</option>
                        <option value="IBQA">IBQA</option>
                        <option value="IELE">IELE</option>
                        <option value="IELC">IELC</option>
                        <option value="IGEM">IGEM</option>
                        <option value="IIND">IIND</option>
                        <option value="IINF">IINF</option>
                        <option value="IMAT">IMAT</option>
                        <option value="IMCT">IMCT</option>
                        <option value="IMEC">IMEC</option>
                        <option value="ISIC">ISIC</option>
                        <option value="ITIC">ITIC</option>
                        <option value="LADM">LADM</option>
                        <option value="MCIEA">MCIEA</option>
                        <option value="MCIEO">MCIEO</option>
                        <option value="MCMET">MCMET</option>
                        <option value="MPIIN">MPIIN</option>
                        <option value="MPIM">MPIM</option>
                        <option value="DIEA">DIEA</option>
                        <option value="DCI">DCI</option>
                    </select>
                </div>

                <!-- Columna 2: Datos del usuario -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-4">Datos del Usuario</h3>

                    <label class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                    <input type="text" name="usuario" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" name="password" class="w-full p-2 border rounded-lg mb-3" required>

                    <label class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" class="w-full p-2 border rounded-lg mb-3" required>
                </div>
            </div>

            <!-- Botón de enviar -->
            <div class="mt-6 text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700">
                    Registrar Empresa
                </button>
            </div>
        </form>
    </div>

@endsection