<?php

namespace Database\Seeders;

use App\Enums\CoatAnimal;
use App\Enums\Members;
use App\Enums\SexAnimal;
use App\Enums\SpeciesAnimal;
use App\Enums\StatusAnimal;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\User;
use App\Models\Vaccine;
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
            'email' => 'john.doe@gmail.com',
            'phone' => '0470123456',
            'status' => Members::Admin->value,
            'password' => Hash::make('password'),
        ]);
        $volunteers = [
            [
                'lastName' => 'Martin',
                'firstName' => 'Lucas',
                'email' => 'lucas.martin@example.com',
                'phone' => '0471234567',
                'status' => Members::Volunteer->value,
                'password' => Hash::make('password'),
            ],
            [
                'lastName' => 'Dubois',
                'firstName' => 'Emma',
                'email' => 'emma.dubois@example.com',
                'phone' => '0482345678',
                'status' => Members::Volunteer->value,
                'password' => Hash::make('password'),
            ],
            [
                'lastName' => 'Lambert',
                'firstName' => 'Thomas',
                'email' => 'thomas.lambert@example.com',
                'phone' => '0493456789',
                'status' => Members::Volunteer->value,
                'password' => Hash::make('password'),
            ],
            [
                'lastName' => 'Leroy',
                'firstName' => 'Chloé',
                'email' => 'chloe.leroy@example.com',
                'phone' => '0464567890',
                'status' => Members::Volunteer->value,
                'password' => Hash::make('password'),
            ],
            [
                'lastName' => 'Simon',
                'firstName' => 'Hugo',
                'email' => 'hugo.simon@example.com',
                'phone' => '0475678901',
                'status' => Members::Volunteer->value,
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($volunteers as $volunteer) {
            User::factory()->create($volunteer);
        }
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

        $animals = [
            [
                'name' => 'Rocky',
                'description' => 'Chien très joueur, affectueux et habitué aux enfants.',
                'photo' => null,
                'age' => '2021-05-12',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::ADOPTABLE,
                'coat' => CoatAnimal::SHORT_COAT,
                'breed_id' => Breed::where('name', 'Labrador Retriever')->first()->id,
                'vaccine_id' => Vaccine::where('name', 'Rage')->where('species', SpeciesAnimal::chien)->first()->id,
            ],
            [
                'name' => 'Luna',
                'description' => 'Chatte calme qui adore les câlins et les longues siestes.',
                'photo' => null,
                'age' => '2023-02-18',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Female,
                'status' => StatusAnimal::PENDING,
                'coat' => CoatAnimal::LONG_COAT,
                'breed_id' => Breed::where('name', 'Maine Coon')->first()->id,
                'vaccine_id' => Vaccine::where('name', 'Rage')->where('species', SpeciesAnimal::chat)->first()->id,
            ],
            [
                'name' => 'Max',
                'description' => 'Berger Allemand obéissant, parfait pour une famille active.',
                'photo' => null,
                'age' => '2019-09-30',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::ADOPTED,
                'coat' => CoatAnimal::MEDIUM_COAT,
                'breed_id' => Breed::where('name', 'Berger Allemand')->first()->id,
                'vaccine_id' => Vaccine::where('name', 'Parvovirose')->where('species', SpeciesAnimal::chien)->first()->id,
            ],
            [
                'name' => 'Nala',
                'description' => 'Jeune chatte curieuse qui aime jouer toute la journée.',
                'photo' => null,
                'age' => '2022-07-21',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Female,
                'status' => StatusAnimal::IN_ADOPTION,
                'coat' => CoatAnimal::SHORT_COAT,
                'breed_id' => Breed::where('name', 'British Shorthair')->first()->id,
                'vaccine_id' => Vaccine::where('name', 'Coryza')->where('species', SpeciesAnimal::chat)->first()->id,
            ],
            [
                'name' => 'Thor',
                'description' => 'Husky très sportif qui adore courir et les promenades.',
                'photo' => null,
                'age' => '2020-12-08',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::IN_CARE,
                'coat' => CoatAnimal::LONG_COAT,
                'breed_id' => Breed::where('name', 'Husky Sibérien')->first()->id,
                'vaccine_id' => Vaccine::where('name', 'Leptospirose')->where('species', SpeciesAnimal::chien)->first()->id,
            ],
        ];

        foreach ($animals as $animal) {
            Animal::create($animal);
        }
    }

}
