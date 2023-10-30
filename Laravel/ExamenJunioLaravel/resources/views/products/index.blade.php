<x-app-layout>
    <h1 class="text-3xl font-bold mb-4">Productos</h1>

    <h3>Productos de la categoría "{{$category->name}}"</h3>

    @if(session('error'))
        <div class="bg-red-500 text-white px-4 py-2 rounded-md">
            {{ session('error') }}
        </div>
    @endif

    <ul class="bg-white shadow overflow-hidden sm:rounded-md">
        @foreach($products as $product)
            <li class="border-b border-gray-200">
                <div class="px-4 py-3">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-400"></div>
                        <div class="ml-4">
                            <div class="text-lg font-medium text-gray-900">{{$product->name}}</div>
                            <div class="text-gray-500">{{$product->description}}</div>
                            <div class="text-gray-500">Stock: {{$product->stock}}</div>
                            <div class="text-gray-500">Price: {{$product->price}}€</div>
                            <form action="{{route('order.process', [$product->idProd])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <label for="quantity">Cantidad:</label>
                                <input type="number" id="quantity" name="quantity" value="1"><br>
                                <input class="btn-primary bg-gray-400 font-bold mt-4 p-2 cursor-pointer" type="submit" value="Añadir al Carrito">
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</x-app-layout>
