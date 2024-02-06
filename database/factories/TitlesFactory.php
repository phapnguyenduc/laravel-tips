<?php

namespace Database\Factories;

use App\Models\Title;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TitlesFactory extends Factory
{
    protected $model = Title::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'from_date' => $this->faker->date,
            'to_date' => $this->faker->date,
        ];
    }
}
