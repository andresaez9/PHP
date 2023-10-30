<x-app-layout>
    <div class="mb-4">¿Estás seguro de borrar el pedido con el ID {{$id}}?</div>
    <form method="post" action="{{ route('order.delete', [$id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Borrar</button>
    </form>
    <a href="{{ route('order.index') }}" class="text-blue-500 hover:text-blue-700">Cancelar</a>
</x-app-layout>
