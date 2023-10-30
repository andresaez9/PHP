<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Andres Segura Saez

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = "idCat";
    protected $table = "categories";

    protected $fillable = [
        'name',
        'description'
    ];
}
