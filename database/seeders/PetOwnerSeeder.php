<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PetOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Pet Owner
        $owner = User::firstOrCreate(
            ['email' => 'owner@example.com'],
            [
                'name' => 'Juan Dela Cruz',
                'password' => Hash::make('password'),
                'role' => 'owner',
                'house_number' => 'Block 1 Lot 2',
                'street' => 'Mabini Street',
                'barangay' => 'Pancol',
                'city' => 'City of Meycauayan',
                'province' => 'Bulacan',
            ]
        );

        // Create Pet
        Pet::firstOrCreate(
            ['name' => 'Brownie', 'user_id' => $owner->id],
            [
                'species' => 'Dog',
                'breed' => 'Aspin',
                'birthdate' => '2020-05-15',
                'registry_date' => now(),
                'unique_id' => 'PC-2026-0001',
            ]
        );
        
        Pet::firstOrCreate(
            ['name' => 'Mingming', 'user_id' => $owner->id],
            [
                'species' => 'Cat',
                'breed' => 'Puspin',
                'birthdate' => '2021-08-20',
                'registry_date' => now(),
                'unique_id' => 'PC-2026-0002',
            ]
        );
    }
}
