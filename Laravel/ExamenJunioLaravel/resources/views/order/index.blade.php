<x-app-layout>
    <div class="p-4">
        <h2 class="mt-4">Productos</h2>
        <table class="w-full border-collapse">
            <thead>
            <tr>
                <th class="border-b-2 px-4 py-2">Producto</th>
                <th class="border-b-2 px-4 py-2">Categoría</th>
                <th class="border-b-2 px-4 py-2">Unidades</th>
                <th class="border-b-2 px-4 py-2">Precio</th>
                <th class="border-b-2 px-4 py-2">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="border-b px-4 py-2">{{ $order->productName }}</td>
                    <td class="border-b px-4 py-2">{{ $order->categoryName }}</td>
                    <td class="border-b px-4 py-2">{{ $order->units }}</td>
                    <td class="border-b px-4 py-2">{{ $order->units * $order->price}}€</td>
                    <td class="border-b px-4 py-2">
                        <form action="{{route('order.viewUpdate' ,[$order->idOrder])}}" method="get">
                            @csrf
                            <label for="quantity" class="sr-only">Cantidad</label>
                            <input type="number" id="quantity" name="quantity" value="1" class="border p-2 mr-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar</button>
                        </form>
                        <form action="{{route('order.viewDelete', [$order->idOrder])}}" method="get">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <p class="border-b-2 px-4 py-2">Precio Total: {{$totalPrice}}€</p>

        <form method="GET" action="{{ route('order.ready', ['totalPrice' => $totalPrice]) }}">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Realizar Pedido
            </button>
        </form>

        {{$orders->links()}}

        @if(session('delete'))
            <div class="bg-green-500 text-white px-4 py-2 rounded-md">
                {{ session('delete') }}
            </div>
        @endif

        @if(session('update'))
            <div class="bg-yellow-500 text-white px-4 py-2 rounded-md">
                {{ session('update') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white px-4 py-2 rounded-md">
                {{ session('error') }}
            </div>
        @endif
    </div>
</x-app-layout>
