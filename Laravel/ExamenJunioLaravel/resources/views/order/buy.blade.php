<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Restaurante</h1>
    <h2 class="text-xl font-bold mb-4">Enhorabuena, su compra se ha realizado con éxito</h2>
    <h3 class="text-lg font-bold mb-4">Su carrito ya no contiene productos</h3>
    <h4 class="text-lg font-bold mb-4">Precio: {{$price}}€</h4>

    @if(Auth::user()->city == 'Malaga')
        <h4 class="text-lg font-bold mb-4">El usuario es de Malaga, el descuento del 20% seria: {{$finalPrice}}€ en total</h4>
    @else
        <h4 class="text-lg font-bold mb-4">El usuario no es de Malaga</h4>
    @endif

    <p class="mb-4">¿Quieres seguir comprando?</p>
    <form method="get" action="{{ route('category.index') }}">
        <input type="submit" value="SI" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    </form>
    <form method="post" action="{{ route('logout') }}">
        <input type="submit" value="NO" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
    </form>
</x-app-layout>
