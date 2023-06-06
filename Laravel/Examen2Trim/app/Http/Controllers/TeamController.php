<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Team_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index() {
        $users = User::find(Auth::user()->id_user);
        $teams = $users->teams();

        //return view('admin.index', ['users' => $users, 'teams' => $teams]);
    }
    public function indexAdmin() {
        $user = User::find(Auth::user()->id_user);
        $teams = User::with('teams')->paginate(5);

        return view('admin.index', ['user' => $user, 'teams' => $teams]);
    }
}
