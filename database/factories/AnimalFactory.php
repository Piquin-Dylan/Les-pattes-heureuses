<?php

namespace Database\Factories;

use App\Enums\CoatAnimal;
use App\Enums\SexAnimal;
use App\Enums\SpeciesAnimal;
use App\Enums\StatusAnimal;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition(): array
    {
        $species = fake()->randomElement(SpeciesAnimal::cases())->value;

        return [
            'name' => fake()->firstName(),
            'description' => fake()->sentence(),
            'photo' => null,
            'age' => fake()->date(),
            'species' => $species,
            'sex' => fake()->randomElement(SexAnimal::cases())->value,
            'status' => StatusAnimal::ADOPTABLE->value,
            'coat' => fake()->randomElement(CoatAnimal::cases())->value,
            'slug' => fake()->unique()->slug(),
            'breed_id' => Breed::factory()->state(['species' => $species]),
            'vaccine_id' => Vaccine::factory()->state(['species' => $species]),
        ];
    }
}
