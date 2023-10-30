<x-app-layout>
    <p class="mb-4">¿Quieres terminar tu pedido?</p>
    <p class="mb-4">Total: {{$totalPrice}}</p>
    <form method="get" action="{{ route('order.finish', ['price' => $totalPrice]) }}">
        <input type="submit" value="SI" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    </form>
    <form method="get" action="{{ route('order.index') }}">
        <input type="submit" value="NO" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
    </form>
</x-app-layout>
