<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(5000)->create();

//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);
//        \App\Models\Employee::factory(500)->create();
        $this->call(EmployeeSeeder::class);
        \App\Models\Department::factory(5000)->create();
        $this->call(DepartmentEmployee::class);
        $this->call(PostSeeder::class);
    }
}
