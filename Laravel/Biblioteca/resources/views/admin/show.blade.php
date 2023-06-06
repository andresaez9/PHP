@extends('layouts.master')

@section('content')
    <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 shadow p-6 rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Detalles del Préstamo</h1>

        <div>
            <h2 class="text-lg font-bold">Usuario:</h2>
            <p class="mb-2">Nombre: {{ $user->name }}</p>
            <p class="mb-2">Apellido: {{ $user->surname }}</p>
        </div>

        <div class="mt-4">
            <h2 class="text-lg font-bold">Libro:</h2>
            <p class="mb-2">Título: {{ $book->title }}</p>
            <p class="mb-2">Autor: {{ $book->author }}</p>
            <p class="mb-2">Editorial: {{ $book->editorial }}</p>
        </div>

        <div class="mt-4">
            <h2 class="text-lg font-bold">Fecha de Préstamo:</h2>
            <p>{{ $loanDate }}</p>
        </div>
    </div>

    <a href="{{ route('home') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Volver
    </a>
@endsection
