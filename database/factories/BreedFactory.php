<?php

namespace Database\Factories;

use App\Enums\SpeciesAnimal;
use App\Models\Breed;
use Illuminate\Database\Eloquent\Factories\Factory;

class BreedFactory extends Factory
{
    protected $model = Breed::class;

    public function definition(): array
    {
        return [
            'species' => fake()->randomElement(SpeciesAnimal::cases())->value,
            'name' => fake()->word(),
        ];
    }
}
