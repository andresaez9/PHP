@extends('layouts.master')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de préstamos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 inline-flex place-content-between w-full">
                    <div>
                        <h1 class="text-blue-600 font-semibold text-2xl">Bienvenido/a {{ Auth::user()->name }}</h1>
                    </div>
                    {{--                    <div>--}}
                    {{--                        <a href="{{ route('loan-printPDF') }}" >--}}
                    {{--                            <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Imprimir en PDF</button>--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>

        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white mx-auto dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="m-6 text-gray-900 dark:text-gray-100">
                        <table class="table-auto m-auto max-w-4xl">
                            <thead class="text-left">
                            <tr>
                                <th class="px-4 py-2">Título</th>
                                <th class="px-4 py-2">Autor</th>
                                <th class="px-4 py-2">Editorial</th>
                                <th class="px-2 py-2">Fecha préstamo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td class="border px-4 py-2">{{ /*$loan->book->title  -> esto es llamando al Modelo pivte*/ $loan->title }}</td>
                                    <td class="border px-4 py-2">{{ $loan->author}}</td>
                                    <td class="border px-4 py-2">{{ $loan->editorial }}</td>
                                    <td class="border px-4 py-2">{{ $loan->loan_date }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$loans->links()}}
                        {{--                        <div class="mt-4">--}}
                        {{--                            {{ $loans->links() }}--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
@endsection
