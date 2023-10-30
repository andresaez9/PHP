<x-app-layout>
    <div class="mb-4">¿Estás seguro de actualizar el pedido con el ID {{$id}}?</div>
    <form method="post" action="{{ route('order.update', [$id, $quantity]) }}">
        @csrf
        @method('PUT')
        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Actualizar</button>
    </form>
    <a href="{{ route('order.index') }}" class="text-blue-500 hover:text-blue-700">Cancelar</a>
</x-app-layout>
