<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Categorias de productos</h1>
    <ul class="bg-white shadow overflow-hidden sm:rounded-md">
        @foreach($categories as $category)
            <li class="border-b border-gray-200">
                <div class="px-4 py-3">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-400"></div>
                        <div class="ml-4">
                            <div class="text-lg font-medium text-gray-900"><a href="{{route('product.index', ['id' => $category->idCat])}}">{{$category->name}}</a></div>
                            <div class="text-gray-500">{{$category->description}}</div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    @if(session('error'))
        <div class="bg-red-500 text-white px-4 py-2 rounded-md">
            {{ session('error') }}
        </div>
    @endif

    <div class="pagination">
        {{ $categories->links() }}
    </div>
</x-app-layout>
