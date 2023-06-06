@extends('layouts.master')

@section('content')
    <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 shadow p-6 rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Confirmar Borrado de Préstamo</h1>

        <div class="mb-6">
            <p class="mb-2"><span class="font-bold">Nombre:</span> {{$user->name}}</p>
            <p class="mb-2"><span class="font-bold">Apellidos:</span> {{$user->surname}}</p>
            <p class="mb-2"><span class="font-bold">Título:</span> {{$book->title}}</p>
            <p class="mb-2"><span class="font-bold">Autor:</span> {{$book->author}}</p>
            <p class="mb-2"><span class="font-bold">Editorial:</span> {{$book->editorial}}</p>
            <p class="mb-2"><span class="font-bold">Fecha Préstamo:</span> {{$loan_date}}</p>
        </div>

        <div class="flex justify-between">
            <form action="{{ route('admin.delete', [$user->id_user, $book->id_book, $loan_date]) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Borrar</button>
            </form>

            <a href="{{ route('home') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancelar</a>
        </div>
    </div>
@endsection
