<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Team;
use App\Models\Team_User;
use App\Models\User;
use Database\Factories\TeamFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        self::seedUsers();
        $this->command->info("Tabla usuarios insertada con éxito");

        Team::factory(20)->create();
        $this->command->info("Tabla equipos insertada con éxito");

        Team_User::factory(10)->create();
        $this->command->info("Tabla equipos-usuarios insertada con éxito");
    }

    private function seedUsers() {
        User::factory()->create([
           "name" => "Andres",
           "phone" => "123456789",
           "user_type" => 'admin',
           "email" => "andres@email.com",
           "password" => bcrypt("123")
        ]);

        User::factory()->create([
            "name" => "Faku",
            "phone" => "123456789",
            "user_type" => 'jugador',
            "email" => "faku@email.com",
            "password" => bcrypt("123")
        ]);
    }
}
