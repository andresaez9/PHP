<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

//Andres Segura Saez

class CategoryController extends Controller
{
    public function getCategories() {
        $categories = Category::paginate(3);
        return view('category.index', ['categories' => $categories]);
    }
}
