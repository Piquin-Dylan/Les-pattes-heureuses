<?php

use App\Enums\CoatAnimal;
use App\Enums\Members;
use App\Enums\SexAnimal;
use App\Enums\SpeciesAnimal;
use App\Enums\StatusAnimal;
use App\Models\Breed;
use App\Models\User;
use App\Models\Vaccine;
use App\Notifications\AnimalSubmittedNotification;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

it('valide les champs obligatoires', function () {

    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('livewire.animals.create-animals')
        ->call('save')
        ->assertHasErrors([
            'form.name',
            'form.description',
            'form.photo',
            'form.age',
            'form.sexe',
            'form.species',
            'form.coat',
            'form.raceChoice',
            'form.vaccineChoice',
        ]);
});

it('cree un animal', function () {

    Storage::fake('local');

    $user = User::factory()->create([
        'status' => Members::Admin->value,
    ]);

    $breed = Breed::factory()->create(['species' => SpeciesAnimal::chat->value]);
    $vaccine = Vaccine::factory()->create(['species' => SpeciesAnimal::chat->value]);

    $this->actingAs($user);

    Livewire::test('livewire.animals.create-animals')
        ->set('form.name', 'Félix')
        ->set('form.description', 'Un chat très câlin.')
        ->set('form.age', '2022-05-10')
        ->set('form.sexe', SexAnimal::Male->value)
        ->set('form.species', SpeciesAnimal::chat->value)
        ->set('form.coat', CoatAnimal::SHORT_COAT->value)
        ->set('form.raceChoice', (string) $breed->id)
        ->set('form.vaccineChoice', (string) $vaccine->id)
        ->set('form.status', StatusAnimal::ADOPTABLE->value)
        ->set('form.photo', UploadedFile::fake()->image('felix.jpg'))
        ->call('save');

    $this->assertDatabaseHas('animals', [
        'name' => 'Félix',
        'species' => SpeciesAnimal::chat->value,
        'sex' => SexAnimal::Male->value,
        'status' => StatusAnimal::ADOPTABLE->value,
        'breed_id' => $breed->id,
        'vaccine_id' => $vaccine->id,
        'slug' => 'felix',
    ]);
});

it('force le statut a en attente pour un benevole', function () {

    Storage::fake('local');

    $user = User::factory()->create([
        'status' => Members::Volunteer->value,
    ]);

    $breed = Breed::factory()->create(['species' => SpeciesAnimal::chat->value]);
    $vaccine = Vaccine::factory()->create(['species' => SpeciesAnimal::chat->value]);

    $this->actingAs($user);

    Livewire::test('livewire.animals.create-animals')
        ->set('form.name', 'Félix')
        ->set('form.description', 'Un chat très câlin.')
        ->set('form.age', '2022-05-10')
        ->set('form.sexe', SexAnimal::Male->value)
        ->set('form.species', SpeciesAnimal::chat->value)
        ->set('form.coat', CoatAnimal::SHORT_COAT->value)
        ->set('form.raceChoice', (string) $breed->id)
        ->set('form.vaccineChoice', (string) $vaccine->id)
        ->set('form.photo', UploadedFile::fake()->image('felix.jpg'))
        ->call('save');

    $this->assertDatabaseHas('animals', [
        'name' => 'Félix',
        'status' => StatusAnimal::PENDING->value,
    ]);
});

it('envoie une notification aux admins quand un benevole soumet un animal', function () {

    Notification::fake();
    Storage::fake('local');

    $volontaire = User::factory()->create([
        'status' => Members::Volunteer->value,
    ]);

    $admin = User::factory()->create([
        'status' => Members::Admin->value,
    ]);

    $breed = Breed::factory()->create(['species' => SpeciesAnimal::chat->value]);
    $vaccine = Vaccine::factory()->create(['species' => SpeciesAnimal::chat->value]);

    $this->actingAs($volontaire);

    Livewire::test('livewire.animals.create-animals')
        ->set('form.name', 'Félix')
        ->set('form.description', 'Un chat très câlin.')
        ->set('form.age', '2022-05-10')
        ->set('form.sexe', SexAnimal::Male->value)
        ->set('form.species', SpeciesAnimal::chat->value)
        ->set('form.coat', CoatAnimal::SHORT_COAT->value)
        ->set('form.raceChoice', (string) $breed->id)
        ->set('form.vaccineChoice', (string) $vaccine->id)
        ->set('form.photo', UploadedFile::fake()->image('felix.jpg'))
        ->call('save');

    Notification::assertSentTo($admin, AnimalSubmittedNotification::class);
});
