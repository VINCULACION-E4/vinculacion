@extends('layouts.headerAlumno')
@section('contenido')
<div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
    <div class="bg-red-600 text-white p-6 rounded-lg shadow-lg w-80 text-center">
      <h3 class="text-xl font-bold mb-4">Error</h3>
      <p class="text-lg mb-4">Ya te encuentras postulado a esta oferta.</p>
      
      <!-- Botón Continuar -->
      <a href="/ofertas" 
         class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 mt-4 block text-center">
         Continuar
      </a>
    </div>
  </div>
@php