<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\BookUser;
use App\Models\User;
use Database\Factories\BookUserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /*private array $users = [
          [
              'username' => 'andres',
              'password'=> '123',
              'name' => 'Andres',
              'surname' => 'Segura',
              'email' => 'andres@email.com',
              'type' => 'admin'
          ],

        [
            'username' => 'taky',
            'password'=> '123',
            'name' => 'Tania',
            'surname' => 'Rodriguez',
            'email' => 'taky@email.com',
            'type' => 'user'
        ],

        [
            'username' => 'lorena',
            'password'=> '123',
            'name' => 'Lorena',
            'surname' => 'Gonzalez',
            'email' => 'lorena@email.com',
            'type' => 'user'
        ]
    ];*/

    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        self::seedUser();
        $this->command->info('Tabla usuarios creada con datos correctamente!');
        self::seedBook();
        $this->command->info('Tabla libros creada con datos correctamente!');
        self::seedBookUser();
        $this->command->info('Tabla loan creada con datos correctamente!');
    }

    private function seedUser() {
        //User::factory(5)->create(); //no vamos a crear users con factory queremos tener usuarios fijos
        /*DB::table('users')->delete();

        foreach ($this->getUsers() as $user) {
            $u = new User;
            $u->username = $user['username'];
            $u->password = bcrypt($user['password']);
            $u->name = $user['name'];
            $u->surname = $user['surname'];
            $u->email = $user['email'];
            $u->type = $user['type'];
            $u->save();
        }*/
        User::factory()->create([
            'username' => 'andres',
            'password'=> '123',
            'name' => 'Andres',
            'surname' => 'Segura',
            'email' => 'andres@email.com',
            'type' => 'admin'
        ]);

        User::factory()->create([
            'username' => 'taky',
            'password'=> '123',
            'name' => 'Tania',
            'surname' => 'Rodriguez',
            'email' => 'taky@email.com',
            'type' => 'user'
        ]);

        User::factory()->create([
            'username' => 'lorena',
            'password'=> '123',
            'name' => 'Lorena',
            'surname' => 'Gonzalez',
            'email' => 'lorena@email.com',
            'type' => 'user'
        ]);
    }

    private function getUsers() {
        return $this->users;
    }

    private function seedBook() {
        Book::factory(20)->create();
    }

    private function seedBookUser() {
        BookUser::factory(10)->create();
    }
}
