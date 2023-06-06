@extends('layouts.master')

@section('content')
    <div class="flex flex-wrap">
        <div class="sm:w-1/3 pr-4 pl-4">
            <img src="{{ $movie['poster'] }}" class="h-64 w-64" style="height: 50em; width: 50em">
        </div>
        <div class="sm:w-2/3 pr-4 pl-4">
            <h1 class="text-5xl">{{$movie['title']}}</h1>
            <h2 class="text-xl">Año: {{$movie['year']}}</h2>
            <h2 class="text-xl">Director: {{$movie['director']}}</h2>
            <p class="mt-4"><b>Resumen:</b> {{$movie['synopsis']}}</p>
            <p class="mt-2"><b>Estado:</b> {{$movie['rented'] ? "Película actualmente alquilada" : "Película disponible"}}</p>

            <div class="flex gap-4 mt-4">
                {{--<button class="{{$movie['rented'] ? "bg-red-500 font-bold py-2 px-4 rounded" : "bg-blue-500 font-bold py-2 px-4 rounded"}}">{{$movie['rented'] ? "Devolver película" : "Alquilar película"}}</button>--}}
                <a href="{{route('catalog.getEdit', $movie['id'])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar película</a>
                <a href="{{route("home")}}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Volver al listado</a>

                <form action="{{route("catalog.delete", $movie->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar película</button>
                </form>

                @if ($movie['rented'])
                    <form action="{{route("catalog.return", $movie->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Devolver película</button>
                    </form>
                @else
                    <form action="{{route("catalog.rent", $movie->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Alquilar película</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
