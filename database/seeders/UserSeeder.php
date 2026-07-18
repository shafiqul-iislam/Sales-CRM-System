<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'System Admin',
                'email' => 'admin@example.com',
                'phone' => '01710000000',
                'role' => 'admin',
                'kpi_score' => 0,
                'status' => 'active',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'John Smith',
                'email' => 'john@example.com',
                'phone' => '01710000001',
                'role' => 'employee',
                'kpi_score' => 5,
                'status' => 'active',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@example.com',
                'phone' => '01710000002',
                'role' => 'employee',
                'kpi_score' => 3,
                'status' => 'active',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Michael Brown',
                'email' => 'michael@example.com',
                'phone' => '01710000003',
                'role' => 'employee',
                'kpi_score' => 8,
                'status' => 'active',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Emily Davis',
                'email' => 'emily@example.com',
                'phone' => '01710000004',
                'role' => 'employee',
                'kpi_score' => 2,
                'status' => 'active',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
