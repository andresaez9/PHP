<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team_User extends Model
{
    use HasFactory;

    protected $table = "team_user";

    protected $fillable = [
        'id_team',
        'id_user',
        'captain'
    ];

    public function team() {
        $this->belongsTo(Team::class, 'id_team');
    }

    public function user() {
        $this->belongsTo(User::class, 'id_user');
    }
}
