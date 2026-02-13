<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vaccine;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vaccines = [
            [
                'name' => 'Rabies',
                'description' => 'Core vaccine required by law for dogs.',
                'stock' => 50,
                'price' => 350.00,
            ],
            [
                'name' => '5-in-1',
                'description' => 'Protects against Distemper, Adenovirus, Parvovirus, and Parainfluenza.',
                'stock' => 100,
                'price' => 450.00,
            ],
            [
                'name' => 'Deworming',
                'description' => 'Control of roundworms and hookworms.',
                'stock' => 200,
                'price' => 150.00,
            ],
            [
                'name' => 'Heartworm Prevention',
                'description' => 'Monthly preventative medication.',
                'stock' => 30,
                'price' => 500.00,
            ],
            [
                'name' => 'Feline 4-in-1',
                'description' => 'Core vaccine for cats including Rhinotracheitis, Calicivirus, Panleukopenia, and Chlamydia.',
                'stock' => 40,
                'price' => 400.00,
            ],
        ];

        foreach ($vaccines as $vaccine) {
            Vaccine::create($vaccine);
        }
    }
}
