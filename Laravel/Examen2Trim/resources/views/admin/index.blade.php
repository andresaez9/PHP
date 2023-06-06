<x-app-layout>
    <div>
        Bienvenido {{$user->name}}; Usuario tipo {{$user->user_type}}
    </div>

    <div>
        <h3>Equipos en los que has jugado:</h3>
        @foreach($teams as $user)
            <h3>
                Equipo: {{$user->name}}
                - El jugador más importante de su historia
                {{ $playerData = \App\Models\User::find($user->player_id) ? $playerData->name : 'No encontrado' }}
            </h3>

            <h2>Jugadores del equipo:</h2>
            @foreach($user->teams as $user)
                <p>{{$user->name}} - {{$user->pivot->captain ? 'Ha sido capitán' : 'No ha sido capitán'}}</p>
            @endforeach
        @endforeach
        {{$teams->links()}}
    </div>
</x-app-layout>
