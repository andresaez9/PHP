<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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

        self::seedUser();
        $this->command->info("Tabla users inicializada con éxito");

        self::seedCategory();
        $this->command->info("Tabla category inicializada con éxito");

        Product::factory(10)->create();
        $this->command->info("Tabla products inicializada con éxito");

        Order::factory(10)->create();
        $this->command->info("Tabla orders inicializada con éxito");
    }

    private function seedUser() {
        User::factory()->create([
            "name" => "Andres",
            "surname" => "Segura",
            "userName" => "andres",
            "city" => "Malaga",
            "email" => "andres@email.com",
            "password" => bcrypt("123")
        ]);

        User::factory()->create([
            "name" => "Francisco",
            "surname" => "Saez",
            "userName" => "francisco",
            "city" => "Granada",
            "email" => "francisco@email.com",
            "password" => bcrypt("123")
        ]);

        User::factory()->create([
            "name" => "Paco",
            "surname" => "Martinez",
            "userName" => "paco",
            "city" => "Jaen",
            "email" => "paco@email.com",
            "password" => bcrypt("123")
        ]);
    }

    private function seedCategory() {
        $categoryData = [
            [
                "name" => "Categoria1",
                "description" => "descripcion categoria 1",
            ],
            [
                "name" => "Categoria2",
                "description" => "descripcion categoria 2",
            ],
            [
                "name" => "Categoria3",
                "description" => "descripcion categoria 3",
            ],
            [
                "name" => "Categoria4",
                "description" => "descripcion categoria 4",
            ],
            [
                "name" => "Categoria5",
                "description" => "descripcion categoria 5",
            ],
        ];

        foreach ($categoryData as $data) {
            Category::factory()->create($data);
        }
    }
}
