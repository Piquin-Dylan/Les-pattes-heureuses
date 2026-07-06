<?php

namespace Database\Factories;

use App\Models\adoption;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class adoptionFactory extends Factory
{
    protected $model = adoption::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
