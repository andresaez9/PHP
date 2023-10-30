<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Andres Segura Saez

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = "idProd";
    protected $table = "products";

    public function users() {
        return $this->belongsToMany(User::class, 'orders', 'product', 'user')->withPivot('units');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category', 'idCat');
    }
}
