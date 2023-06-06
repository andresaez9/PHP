<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = "teams";
    protected $primaryKey = "id_team";

    protected $fillable = [
      'name',
      'nationality',
      'year'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'player_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'team_user', 'id_user', 'id_team')
            ->withPivot('captain'); //se pone captain porque están relacionadas con la pivote
    }
}
