<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

//Andres Segura Saez

class ProductController extends Controller
{
    public function getProducts($id) {
        $category = Category::findOrFail($id);
        $products = Product::where('category', $category->idCat)->paginate(5);

        return view('products.index', ['category' => $category, 'products' => $products]);
    }
}
