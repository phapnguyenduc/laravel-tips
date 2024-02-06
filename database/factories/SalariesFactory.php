<?php

namespace Database\Factories;

use App\Models\Salary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SalariesFactory extends Factory
{
    protected $model = Salary::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'salary' => $this->faker->numberBetween(30000, 90000),
            'from_date' => $this->faker->date,
            'to_date' => $this->faker->date,
        ];
    }
}
