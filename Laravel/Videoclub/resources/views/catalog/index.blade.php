@extends('layouts.master')

@section('notifications')
    @if(session('success'))
        <div class="bg-green-200 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif
@endsection

@section('content')
    <div class="flex flex-col items-center mb-10">
        <a href="{{ route('catalog.getCreate') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
            Insertar película
        </a>
    </div>

    <div class="grid grid-cols-4 gap-4">
        @foreach ($movies as $movie)
            <div class="flex flex-col items-center">
                <a href="{{ url('/catalog/show/' . $movie->id) }}">
                    <img src="{{ $movie->poster }}" class="h-56 w-40 object-cover" alt="Movie Poster">
                </a>
                <h4 class="mt-3 text-center text-lg font-semibold">{{ $movie->title }}</h4>
            </div>
        @endforeach
    </div>
@endsection

