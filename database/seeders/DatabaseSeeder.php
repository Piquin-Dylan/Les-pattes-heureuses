<?php

namespace Database\Seeders;

use App\Enums\SpeciesAnimal;
use App\Models\Breed;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'lastName' => 'Doe',
            'firstName' => 'John',
            'email' => 'john@doe.com',
            'password' => Hash::make('password'),
        ]);
        $breeds = [

            ['species' => SpeciesAnimal::chien->value, 'name' => 'Labrador Retriever'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Golden Retriever'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Berger Allemand'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Border Collie'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Beagle'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Bouledogue Français'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Caniche'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Chihuahua'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Husky Sibérien'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Cocker Anglais'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Rottweiler'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Jack Russell Terrier'],

            ['species' => SpeciesAnimal::chat->value, 'name' => 'Maine Coon'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Persan'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Siamois'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Sphynx'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'British Shorthair'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Ragdoll'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Bengal'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Norvégien'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Sacré de Birmanie'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Chartreux'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Européen'],
        ];

        foreach ($breeds as $breed) {
            Breed::create($breed);
        }

        $vaccines = [

            // Chiens
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Maladie de Carré'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Hépatite de Rubarth'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Parvovirose'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Parainfluenza'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Leptospirose'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Rage'],
            ['species' => SpeciesAnimal::chien->value, 'name' => 'Toux du chenil'],

            // Chats
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Typhus (Panleucopénie féline)'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Coryza'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Leucose féline (FeLV)'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Rage'],
            ['species' => SpeciesAnimal::chat->value, 'name' => 'Chlamydiose féline'],
        ];

        foreach ($vaccines as $vaccine) {
            Vaccine::create($vaccine);
        }
    }
}
