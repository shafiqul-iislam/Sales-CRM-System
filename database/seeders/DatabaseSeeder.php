<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
            SaleSeeder::class,
        ]);

        $admin = User::where('email', 'admin@example.com')->first();

        $token = $admin->createToken('assessment')->plainTextToken;

        echo PHP_EOL;
        echo "===================================" . PHP_EOL;
        echo "API Token: " . $token . PHP_EOL;
        echo "===================================" . PHP_EOL;
    }
}
