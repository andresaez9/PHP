<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//Andres Segura Saez

class OrderController extends Controller
{
    public function processForm(Request $request, $idProd) {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity');
        $user = User::find(Auth::id());
        $product = Product::find($idProd);

        if ($quantity > $product->stock) {
            return redirect()->action([CategoryController::class, 'getCategories'])->with('error', 'La cantidad no puede ser mayor al stock');
        }

        // Comienzo apilar
        $existingOrder = $user->products()->where('idProd', $product->idProd)->first();

        if ($existingOrder) {
            // El pedido ya existe, actualiza las unidades sumando la cantidad actual
            $existingOrder->pivot->units += $quantity;
            $existingOrder->pivot->save();
        } else {
            // El pedido no existe, añade un nuevo pedido
            $user->products()->attach($product, ['units' => $quantity]);
        }
        // Fin de apilar

        return redirect()->action([OrderController::class, 'index']);
    }

    public function index() {

        $orders = DB::table('orders')
            ->join('products', 'orders.product', '=', 'products.idProd')
            ->join('categories', 'products.category', '=', 'categories.idCat')
            ->select('orders.idOrder as idOrder', 'products.name as productName', 'categories.name as categoryName', 'orders.units', 'products.price')
            ->where('orders.user', '=', Auth::id())
            ->paginate(3);

        $totalPrice = 0;
        foreach ($orders as $order) {
            $price = $order->units * $order->price;
            $totalPrice += $price;
        }

        return view('order.index', ['orders' => $orders, 'totalPrice' => $totalPrice]);
    }

    public function getViewDelete($idOrder) {
        $order = DB::table('orders')->where('idOrder', $idOrder)->first();
        return view('order.viewDelete', ['id' => $order->idOrder]);
    }

    public function delete($idOrder) {
        $user = User::findOrFail(Auth::id());

        $order = $user->products()->wherePivot('idOrder', $idOrder)->first();

        if ($order) {
            $productId = $order->pivot->product;
            $user->products()->detach($productId);

            return redirect()->action([OrderController::class, 'index'])
                ->with('delete', 'El producto se ha borrado');
        } else {
            // El pedido no existe o no pertenece al usuario actual
            return redirect()->action([OrderController::class, 'index'])
                ->with('error', 'El producto no existe o no puede ser borrado');
        }
    }

    public function getViewUpdate($idOrder, Request $request) {
        $order = DB::table('orders')->where('idOrder', $idOrder)->first();

        $quantity = $request->input('quantity');

        return view('order.viewUpdate', ['id' => $order->idOrder, 'quantity' => $quantity]);
    }

    public function update($idOrder, $quantity) {
        $user = User::findOrFail(Auth::id());

        // Encuentra el pedido específico del usuario
        $order = $user->products()->wherePivot('idOrder', $idOrder)->firstOrFail();

        // Actualiza las unidades del pedido
        $order->pivot->units = $quantity;
        $order->pivot->save();

//        DB::table('orders')
//            ->where('customer', $user->idCustomer)
//            ->where('idOrder', $idOrder)
//            ->update(['units' => $quantity]);

        return redirect()->route('order.index')
            ->with('update', 'El producto se ha actualizado correctamente');
    }

    public function orderReady($totalPrice) {
        $user = User::find(Auth::id());

        return view('order.ready', ['totalPrice' => $totalPrice]);
    }

    public function finishOrder($price) {
        $user = User::find(Auth::id());

        $twentyPercent = $price * 0.2;
        $finalPrice = $price - $twentyPercent;

        DB::table('orders')->where('user', $user->idUser)->delete();

        return view('order.buy', ['price' => $price, 'finalPrice' => $finalPrice]);
    }
}
