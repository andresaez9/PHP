<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    use HasFactory;

    protected $table = 'book_user';

    protected $fillable = [
        'id_user',
        'id_book',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function book() {
        return $this->belongsTo(Book::class, 'id_book');
    }
}
