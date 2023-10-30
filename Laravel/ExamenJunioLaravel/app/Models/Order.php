<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Andres Segura Saez

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = "idOrder";
    protected $table = "orders";
}
