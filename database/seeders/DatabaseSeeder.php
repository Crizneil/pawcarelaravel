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
        // Admin Account
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => \Illuminate\Support\Facades\Hash::make('admin12345'),
                'role' => 'admin',
                'house_number' => '001',
                'street' => 'Admin St',
                'barangay' => 'Admin Brgy',
                'city' => 'City of Meycauayan',
                'province' => 'Bulacan',
            ]
        );

        // Vet Staff Account
        User::firstOrCreate(
            ['email' => 'staff@gmail.com'],
            [
                'name' => 'Vet Staff',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'vet',
                'house_number' => '002',
                'street' => 'Vet St',
                'barangay' => 'Vet Brgy',
                'city' => 'City of Meycauayan',
                'province' => 'Bulacan',
            ]
        );

        // Pet Owner (via Seeder)
        $this->call(PetOwnerSeeder::class);
    }
}
