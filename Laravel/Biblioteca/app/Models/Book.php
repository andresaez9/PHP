<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $primaryKey = "id_book";

    protected $fillable = [
        'title',
        'author',
        'editorial',
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'book_user', 'id_book', 'id_user')
            ->withPivot('loan_date');
    }
}
