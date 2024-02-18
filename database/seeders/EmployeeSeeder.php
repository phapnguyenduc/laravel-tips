<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 50000; $i++)
        {
            Employee::create([
                'birth_date' => $faker->date,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'gender' => $faker->boolean
            ]);
        }
    }
}
