<?php

namespace Database\Seeders;

use App\Enums\AdoptionStatus;
use App\Enums\CoatAnimal;
use App\Enums\Members;
use App\Enums\SexAnimal;
use App\Enums\SpeciesAnimal;
use App\Enums\StatusAnimal;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Message;
use App\Models\User;
use App\Models\Vaccine;
use App\Services\ImageService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(ImageService $imageService): void
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
            [
                'lastName' => 'Moreno',
                'firstName' => 'Léa',
                'email' => 'lea.moreno@example.com',
                'phone' => '0491122334',
                'status' => Members::Volunteer->value,
                'password' => Hash::make('password'),
            ],
            [
                'lastName' => 'Lefevre',
                'firstName' => 'Nathan',
                'email' => 'nathan.lefevre@example.com',
                'phone' => '0492233445',
                'status' => Members::Volunteer->value,
                'password' => Hash::make('password'),
            ],
            [
                'lastName' => 'Bertrand',
                'firstName' => 'Sarah',
                'email' => 'sarah.bertrand@example.com',
                'phone' => '0493344556',
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
            // --- Adoptables ---
            [
                'name' => 'Rocky',
                'description' => 'Chien très joueur, affectueux et habitué aux enfants.',
                'age' => '2021-05-12',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::ADOPTABLE,
                'coat' => CoatAnimal::SHORT_COAT,
                'breed' => 'Labrador Retriever',
                'vaccine' => 'Rage',
            ],
            [
                'name' => 'Bella',
                'description' => 'Chatte douce et joueuse, idéale pour une famille avec enfants.',
                'age' => '2022-03-14',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Female,
                'status' => StatusAnimal::ADOPTABLE,
                'coat' => CoatAnimal::SHORT_COAT,
                'breed' => 'Européen',
                'vaccine' => 'Typhus (Panleucopénie féline)',
            ],
            [
                'name' => 'Milo',
                'description' => 'Chien curieux et énergique, adore les longues balades en forêt.',
                'age' => '2021-11-02',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::ADOPTABLE,
                'coat' => CoatAnimal::MEDIUM_COAT,
                'breed' => 'Beagle',
                'vaccine' => 'Parainfluenza',
            ],
            [
                'name' => 'Simba',
                'description' => 'Chat très actif au tempérament de tigre, a besoin d\'espace pour se dépenser.',
                'age' => '2023-01-09',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::ADOPTABLE,
                'coat' => CoatAnimal::SHORT_COAT,
                'breed' => 'Bengal',
                'vaccine' => 'Leucose féline (FeLV)',
            ],
            [
                'name' => 'Daisy',
                'description' => 'Chienne douce et affectueuse, s\'entend très bien avec les autres animaux.',
                'age' => '2020-06-25',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Female,
                'status' => StatusAnimal::ADOPTABLE,
                'coat' => CoatAnimal::LONG_COAT,
                'breed' => 'Cocker Anglais',
                'vaccine' => 'Hépatite de Rubarth',
            ],
            [
                'name' => 'Oscar',
                'description' => 'Petit chien plein d\'énergie, idéal pour un maître sportif.',
                'age' => '2022-09-17',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::ADOPTABLE,
                'coat' => CoatAnimal::WIRE_COAT,
                'breed' => 'Jack Russell Terrier',
                'vaccine' => 'Maladie de Carré',
            ],
            [
                'name' => 'Mia',
                'description' => 'Chatte bavarde et affectueuse qui aime suivre son humain partout.',
                'age' => '2021-04-30',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Female,
                'status' => StatusAnimal::ADOPTABLE,
                'coat' => CoatAnimal::SHORT_COAT,
                'breed' => 'Siamois',
                'vaccine' => 'Coryza',
            ],
            [
                'name' => 'Rex',
                'description' => 'Chien loyal et protecteur, bien éduqué et sociabilisé.',
                'age' => '2019-08-11',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::ADOPTABLE,
                'coat' => CoatAnimal::SHORT_COAT,
                'breed' => 'Rottweiler',
                'vaccine' => 'Leptospirose',
            ],

            // --- En attente ---
            [
                'name' => 'Luna',
                'description' => 'Chatte calme qui adore les câlins et les longues siestes.',
                'age' => '2023-02-18',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Female,
                'status' => StatusAnimal::PENDING,
                'coat' => CoatAnimal::LONG_COAT,
                'breed' => 'Maine Coon',
                'vaccine' => 'Rage',
            ],
            [
                'name' => 'Pixel',
                'description' => 'Chat sans poils très câlin, sensible au froid et cherche un foyer chaleureux.',
                'age' => '2023-05-06',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::PENDING,
                'coat' => CoatAnimal::HAIRLESS,
                'breed' => 'Sphynx',
                'vaccine' => 'Chlamydiose féline',
            ],
            [
                'name' => 'Choupette',
                'description' => 'Chienne calme et affectueuse, parfaite pour une adoption senior.',
                'age' => '2018-12-19',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Female,
                'status' => StatusAnimal::PENDING,
                'coat' => CoatAnimal::CURLY_COAT,
                'breed' => 'Caniche',
                'vaccine' => 'Toux du chenil',
            ],
            [
                'name' => 'Rio',
                'description' => 'Chien très intelligent, a besoin de stimulation mentale régulière.',
                'age' => '2022-02-27',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::PENDING,
                'coat' => CoatAnimal::MEDIUM_COAT,
                'breed' => 'Border Collie',
                'vaccine' => 'Parvovirose',
            ],

            // --- En cours d'adoption ---
            [
                'name' => 'Nala',
                'description' => 'Jeune chatte curieuse qui aime jouer toute la journée.',
                'age' => '2022-07-21',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Female,
                'status' => StatusAnimal::IN_ADOPTION,
                'coat' => CoatAnimal::SHORT_COAT,
                'breed' => 'British Shorthair',
                'vaccine' => 'Coryza',
            ],
            [
                'name' => 'Loulou',
                'description' => 'Chat discret et indépendant, en cours de rencontre avec une famille adoptive.',
                'age' => '2021-10-03',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::IN_ADOPTION,
                'coat' => CoatAnimal::SHORT_COAT,
                'breed' => 'Chartreux',
                'vaccine' => 'Typhus (Panleucopénie féline)',
            ],
            [
                'name' => 'Athena',
                'description' => 'Chienne douce et patiente, une visite est déjà prévue avec un couple.',
                'age' => '2020-03-22',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Female,
                'status' => StatusAnimal::IN_ADOPTION,
                'coat' => CoatAnimal::LONG_COAT,
                'breed' => 'Golden Retriever',
                'vaccine' => 'Rage',
            ],

            // --- Adoptés ---
            [
                'name' => 'Max',
                'description' => 'Berger Allemand obéissant, parfait pour une famille active.',
                'age' => '2019-09-30',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::ADOPTED,
                'coat' => CoatAnimal::MEDIUM_COAT,
                'breed' => 'Berger Allemand',
                'vaccine' => 'Parvovirose',
            ],
            [
                'name' => 'Kiwi',
                'description' => 'Chatte très câline qui a retrouvé une famille aimante.',
                'age' => '2019-07-14',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Female,
                'status' => StatusAnimal::ADOPTED,
                'coat' => CoatAnimal::LONG_COAT,
                'breed' => 'Ragdoll',
                'vaccine' => 'Leucose féline (FeLV)',
            ],
            [
                'name' => 'Balto',
                'description' => 'Chien énergique désormais adopté par une famille active.',
                'age' => '2018-01-30',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::ADOPTED,
                'coat' => CoatAnimal::LONG_COAT,
                'breed' => 'Husky Sibérien',
                'vaccine' => 'Leptospirose',
            ],

            // --- Pris en charge / indisponible / en cours / en soin ---
            [
                'name' => 'Thor',
                'description' => 'Husky très sportif qui adore courir et les promenades.',
                'age' => '2020-12-08',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::IN_CARE,
                'coat' => CoatAnimal::LONG_COAT,
                'breed' => 'Husky Sibérien',
                'vaccine' => 'Leptospirose',
            ],
            [
                'name' => 'Nino',
                'description' => 'Chien actuellement pris en charge suite à un abandon, en cours de sociabilisation.',
                'age' => '2022-08-05',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::IN_CARE,
                'coat' => CoatAnimal::SHORT_COAT,
                'breed' => 'Bouledogue Français',
                'vaccine' => 'Maladie de Carré',
            ],
            [
                'name' => 'Salem',
                'description' => 'Chat actuellement indisponible à l\'adoption pour raisons médicales.',
                'age' => '2020-11-12',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::UNAVAILABLE,
                'coat' => CoatAnimal::LONG_COAT,
                'breed' => 'Norvégien',
                'vaccine' => 'Rage',
            ],
            [
                'name' => 'Fripouille',
                'description' => 'Chatte dont le dossier d\'adoption est actuellement en cours de traitement.',
                'age' => '2021-06-08',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Female,
                'status' => StatusAnimal::IN_PROGRESS,
                'coat' => CoatAnimal::LONG_COAT,
                'breed' => 'Persan',
                'vaccine' => 'Chlamydiose féline',
            ],
            [
                'name' => 'Igor',
                'description' => 'Chien actuellement en soins suite à une intervention chirurgicale.',
                'age' => '2020-04-16',
                'species' => SpeciesAnimal::chien,
                'sex' => SexAnimal::Male,
                'status' => StatusAnimal::IN_TREATMENT,
                'coat' => CoatAnimal::MEDIUM_COAT,
                'breed' => 'Berger Allemand',
                'vaccine' => 'Hépatite de Rubarth',
            ],
            [
                'name' => 'Nova',
                'description' => 'Chatte en soins vétérinaires suite à une infection respiratoire.',
                'age' => '2022-12-01',
                'species' => SpeciesAnimal::chat,
                'sex' => SexAnimal::Female,
                'status' => StatusAnimal::IN_TREATMENT,
                'coat' => CoatAnimal::LONG_COAT,
                'breed' => 'Sacré de Birmanie',
                'vaccine' => 'Coryza',
            ],
        ];

        foreach ($animals as $animal) {
            Animal::create([
                'name' => $animal['name'],
                'slug' => Str::slug($animal['name']),
                'description' => $animal['description'],
                'photo' => $this->fetchAnimalPhoto($imageService, $animal['species']),
                'age' => $animal['age'],
                'species' => $animal['species'],
                'sex' => $animal['sex'],
                'status' => $animal['status'],
                'coat' => $animal['coat'],
                'breed_id' => Breed::where('name', $animal['breed'])
                    ->where('species', $animal['species']->value)
                    ->first()
                    ->id,
                'vaccine_id' => Vaccine::where('name', $animal['vaccine'])
                    ->where('species', $animal['species']->value)
                    ->first()
                    ->id,
            ]);
        }

        $adoptions = [
            // --- En attente ---
            [
                'firstName' => 'Julie',
                'lastName' => 'Martin',
                'email' => 'julie.martin@example.com',
                'phone' => '0470123456',
                'message' => 'Je dispose d\'un grand jardin et je recherche un compagnon pour ma famille.',
                'animal' => 'Rocky',
                'status' => AdoptionStatus::Pending,
            ],
            [
                'firstName' => 'Thomas',
                'lastName' => 'Dubois',
                'email' => 'thomas.dubois@example.com',
                'phone' => '0481234567',
                'message' => 'J\'ai déjà eu plusieurs chats et je souhaite adopter Luna.',
                'animal' => 'Luna',
                'status' => AdoptionStatus::Pending,
            ],
            [
                'firstName' => 'Sophie',
                'lastName' => 'Leroy',
                'email' => 'sophie.leroy@example.com',
                'phone' => '0492345678',
                'message' => 'Je suis très active et je pense pouvoir offrir un bon foyer.',
                'animal' => 'Thor',
                'status' => AdoptionStatus::Pending,
            ],
            [
                'firstName' => 'Nicolas',
                'lastName' => 'Simon',
                'email' => 'nicolas.simon@example.com',
                'phone' => '0463456789',
                'message' => 'Je vis en appartement avec beaucoup de temps libre pour m\'occuper d\'un animal.',
                'animal' => 'Nala',
                'status' => AdoptionStatus::Pending,
            ],
            [
                'firstName' => 'Camille',
                'lastName' => 'Lambert',
                'email' => 'camille.lambert@example.com',
                'phone' => '0474567890',
                'message' => 'Je souhaite offrir une seconde chance à un animal du refuge.',
                'animal' => 'Rocky',
                'status' => AdoptionStatus::Pending,
            ],
            [
                'firstName' => 'Élise',
                'lastName' => 'Petit',
                'email' => 'elise.petit@example.com',
                'phone' => '0475998877',
                'message' => 'Nous recherchons un compagnon énergique pour accompagner nos enfants en balade.',
                'animal' => 'Milo',
                'status' => AdoptionStatus::Pending,
            ],

            // --- En cours ---
            [
                'firstName' => 'Antoine',
                'lastName' => 'Garcia',
                'email' => 'antoine.garcia@example.com',
                'phone' => '0476887766',
                'message' => 'Rencontre déjà organisée avec Athena, très bon feeling avec toute la famille.',
                'animal' => 'Athena',
                'status' => AdoptionStatus::InProgress,
            ],
            [
                'firstName' => 'Laura',
                'lastName' => 'Moreau',
                'email' => 'laura.moreau@example.com',
                'phone' => '0477776655',
                'message' => 'Deuxième visite prévue cette semaine avant la décision finale.',
                'animal' => 'Loulou',
                'status' => AdoptionStatus::InProgress,
            ],
            [
                'firstName' => 'Julien',
                'lastName' => 'Faure',
                'email' => 'julien.faure@example.com',
                'phone' => '0478665544',
                'message' => 'Dossier en cours d\'étude par l\'équipe du refuge.',
                'animal' => 'Rio',
                'status' => AdoptionStatus::InProgress,
            ],
            [
                'firstName' => 'Manon',
                'lastName' => 'Girard',
                'email' => 'manon.girard@example.com',
                'phone' => '0479554433',
                'message' => 'Entretien téléphonique réalisé, visite à planifier.',
                'animal' => 'Choupette',
                'status' => AdoptionStatus::InProgress,
            ],

            // --- Réussies ---
            [
                'firstName' => 'Paul',
                'lastName' => 'Bernard',
                'email' => 'paul.bernard@example.com',
                'phone' => '0470443322',
                'message' => 'Adoption finalisée, Max est officiellement arrivé dans son nouveau foyer.',
                'animal' => 'Max',
                'status' => AdoptionStatus::Completed,
            ],
            [
                'firstName' => 'Claire',
                'lastName' => 'Rousseau',
                'email' => 'claire.rousseau@example.com',
                'phone' => '0471332211',
                'message' => 'Kiwi a rejoint notre famille il y a deux semaines, tout se passe très bien.',
                'animal' => 'Kiwi',
                'status' => AdoptionStatus::Completed,
            ],
            [
                'firstName' => 'Vincent',
                'lastName' => 'Blanc',
                'email' => 'vincent.blanc@example.com',
                'phone' => '0472221100',
                'message' => 'Adoption réussie, Balto profite pleinement de son nouveau jardin.',
                'animal' => 'Balto',
                'status' => AdoptionStatus::Completed,
            ],

            // --- Annulées ---
            [
                'firstName' => 'Anaïs',
                'lastName' => 'Fontaine',
                'email' => 'anais.fontaine@example.com',
                'phone' => '0473110099',
                'message' => 'Finalement indisponible pour accueillir un animal en ce moment.',
                'animal' => 'Simba',
                'status' => AdoptionStatus::Cancelled,
            ],
            [
                'firstName' => 'Maxime',
                'lastName' => 'Roy',
                'email' => 'maxime.roy@example.com',
                'phone' => '0474009988',
                'message' => 'Notre projet d\'adoption a été reporté à une date ultérieure.',
                'animal' => 'Bella',
                'status' => AdoptionStatus::Cancelled,
            ],
        ];

        foreach ($adoptions as $adoption) {
            Adoption::create([
                'firstName' => $adoption['firstName'],
                'lastName' => $adoption['lastName'],
                'email' => $adoption['email'],
                'phone' => $adoption['phone'],
                'message' => $adoption['message'],
                'animal_id' => Animal::where('name', $adoption['animal'])->first()->id,
                'status' => $adoption['status'],
            ]);
        }

        $messages = [
            [
                'firstName' => 'Élodie',
                'lastName' => 'Perrin',
                'email' => 'elodie.perrin@example.com',
                'phone' => '0475112233',
                'object' => 'Question sur l\'adoption',
                'message' => 'Bonjour, je souhaiterais savoir si Rocky est toujours disponible pour une visite ce week-end. Merci d\'avance.',
                'read_at' => null,
            ],
            [
                'firstName' => 'Marc',
                'lastName' => 'Delaunay',
                'email' => 'marc.delaunay@example.com',
                'phone' => '0476223344',
                'object' => 'Don pour le refuge',
                'message' => 'Bonjour, je souhaiterais faire un don de nourriture pour vos animaux. Comment puis-je procéder ?',
                'read_at' => now()->subDays(2),
            ],
            [
                'firstName' => 'Isabelle',
                'lastName' => 'Caron',
                'email' => 'isabelle.caron@example.com',
                'phone' => '0477334455',
                'object' => 'Bénévolat',
                'message' => 'Je suis disponible les week-ends et j\'aimerais proposer mon aide au refuge. Puis-je passer vous rencontrer ?',
                'read_at' => null,
            ],
            [
                'firstName' => 'Frédéric',
                'lastName' => 'Noel',
                'email' => 'frederic.noel@example.com',
                'phone' => '0478445566',
                'object' => 'Signalement d\'un animal',
                'message' => 'J\'ai aperçu un chat errant près du parc communal, il semble blessé à la patte. Pouvez-vous intervenir ?',
                'read_at' => now()->subDay(),
            ],
            [
                'firstName' => 'Sandra',
                'lastName' => 'Fabre',
                'email' => 'sandra.fabre@example.com',
                'phone' => '0479556677',
                'object' => 'Horaires d\'ouverture',
                'message' => 'Bonjour, quels sont vos horaires d\'ouverture le samedi ? Je souhaite venir rencontrer Bella.',
                'read_at' => null,
            ],
            [
                'firstName' => 'Guillaume',
                'lastName' => 'Aubert',
                'email' => 'guillaume.aubert@example.com',
                'phone' => '0470667788',
                'object' => 'Partenariat',
                'message' => 'Nous représentons une clinique vétérinaire et souhaiterions discuter d\'un partenariat avec votre refuge.',
                'read_at' => now()->subHours(5),
            ],
        ];

        foreach ($messages as $message) {
            Message::create($message);
        }
    }

    /**
     * Télécharge une vraie photo d'animal (chien via dog.ceo, chat via TheCatAPI)
     * et la fait passer par le pipeline habituel (ImageService) pour générer les
     * différentes tailles webp. Retourne null en cas d'échec (pas de connexion,
     * API indisponible, ...) afin que le seeder ne casse jamais hors-ligne.
     */
    private function fetchAnimalPhoto(ImageService $imageService, SpeciesAnimal $species): ?string
    {
        try {
            $imageUrl = match ($species) {
                SpeciesAnimal::chien => Http::timeout(10)->get('https://dog.ceo/api/breeds/image/random')->json('message'),
                SpeciesAnimal::chat => Http::timeout(10)->get('https://api.thecatapi.com/v1/images/search')->json('0.url'),
            };

            if (! $imageUrl) {
                return null;
            }

            $response = Http::timeout(15)->get($imageUrl);

            if (! $response->successful()) {
                return null;
            }

            $tmpPath = tempnam(sys_get_temp_dir(), 'seed_animal_');
            file_put_contents($tmpPath, $response->body());

            $directory = $imageService->storeAnimalImage($tmpPath);

            unlink($tmpPath);

            return $directory;
        } catch (\Throwable $e) {
            Log::warning('DatabaseSeeder: impossible de récupérer une photo animale.', [
                'species' => $species->value,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

}
