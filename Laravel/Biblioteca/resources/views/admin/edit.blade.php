@extends('layouts.master')

@section('notifications')
    @if(session('error'))
        <div class="bg-red-200 p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif
@endsection

@section('content')
    <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 shadow p-6 rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Actualizar Préstamo</h1>

        <form action="{{ route('admin.putEdit', [$user->id_user, $book->id_book, $loan_date]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="user" class="block text-gray-700 dark:text-gray-400 font-bold mb-2">Usuario:</label>
                <select name="user" id="user" class="w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-300 py-2 px-3 rounded focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500">
                    <option value="{{ $user->id_user }}" selected>{{ $user->name }}</option>
                    @foreach($users as $newUser)
                        @if($newUser->type !== 'admin' && $newUser->id_user !== $user->id_user)
                            <option value="{{ $newUser->id_user }}">{{ $newUser->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('user')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="book" class="block text-gray-700 dark:text-gray-400 font-bold mb-2">Libro:</label>
                <select name="book" id="book" class="w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-300 py-2 px-3 rounded focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500">
                    <option value="{{ $book->id_book }}" selected>{{ $book->title }}</option>
                    @foreach($books as $newBook)
                        @if($newBook->id_book !== $book->id_book)
                            <option value="{{ $newBook->id_book }}">{{ $newBook->title }}</option>
                        @endif
                    @endforeach
                </select>
                @error('book')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 dark:text-gray-400 font-bold mb-2">Fecha</label>
                <input type="date" name="date" id="date" class="w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-300 py-2 px-3 rounded focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500" value="{{ old('date', $loan_date) }}">
                @error('date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('home') }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Volver
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
@endsection
