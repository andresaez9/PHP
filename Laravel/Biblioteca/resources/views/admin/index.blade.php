@extends('layouts.master')

@section('notifications')
    @if(session('success'))
        <div class="bg-green-200 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('delete'))
        <div class="bg-red-200 p-4 mb-4">
            {{ session('delete') }}
        </div>
    @endif

    @if(session('update'))
        <div class="bg-yellow-200 p-4 mb-4">
            {{ session('update') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-200 p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif
@endsection

@section('content')
    <div class="flex flex-col items-center mb-10">
        <a href="{{ route('admin.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
            Insertar prestamo
        </a>
    </div>

    <table class="min-w-full bg-white dark:bg-gray-800">
        <thead>
        <tr>
            <th class="py-3 px-6 text-left uppercase tracking-wider">Nombre</th>
            <th class="py-3 px-6 text-left uppercase tracking-wider">Apellidos</th>
            <th class="py-3 px-6 text-left uppercase tracking-wider">Titulo</th>
            <th class="py-3 px-6 text-left uppercase tracking-wider">Autor</th>
            <th class="py-3 px-6 text-left uppercase tracking-wider">Editorial</th>
            <th class="py-3 px-6 text-left uppercase tracking-wider">Fecha_Prestamo</th>
        </tr>
        </thead>
        <tbody>
        @foreach($loans as $loan)
            <tr>
                <td class="py-4 px-6 border-b border-gray-200 dark:border-gray-700">{{ /*$loan->user->name  -> solo cuando llamamos al modelo pivote*/ $loan->name }}</td>
                <td class="py-4 px-6 border-b border-gray-200 dark:border-gray-700">{{ $loan->surname }}</td>
                <td class="py-4 px-6 border-b border-gray-200 dark:border-gray-700">{{ $loan->title }}</td>
                <td class="py-4 px-6 border-b border-gray-200 dark:border-gray-700">{{ $loan->author }}</td>
                <td class="py-4 px-6 border-b border-gray-200 dark:border-gray-700">{{ $loan->editorial }}</td>
                <td class="py-4 px-6 border-b border-gray-200 dark:border-gray-700">{{ $loan->loan_date }}</td>
                <td class="py-4 px-6 border-b border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.show', [$loan->id_user, $loan->id_book, $loan->loan_date])}}" class="text-blue-500 hover:text-blue-700 mr-2">Ver</a>
                    <a href="{{ route('admin.getEdit', [$loan->id_user, $loan->id_book, $loan->loan_date]) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">Actualizar</a>
                    <a href="{{ route('admin.getDelete', [$loan->id_user, $loan->id_book, $loan->loan_date]) }}" class="text-red-500 hover:text-red-700 mr-2">Borrar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$loans->links()}}
@endsection
