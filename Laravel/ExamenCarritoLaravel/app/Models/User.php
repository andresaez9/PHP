<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function articles() {
        //return $this->belongsToMany(Article::class, 'orders', 'idCustomer', 'idArticles')->withPivot('units');

        /*
        Modelo de destino: Article::class
        Nombre de la tabla intermedia: 'orders'
        Nombre de la columna en la tabla intermedia que hace referencia a la clave primaria de User: 'customer'
        Nombre de la columna en la tabla intermedia que hace referencia a la clave primaria de Article: 'article'

        ----------------------------------------------------------
        */
        return $this->belongsToMany(Article::class)->withPivot('units');

    }
}
