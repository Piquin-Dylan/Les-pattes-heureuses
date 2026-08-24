<?php

use App\Enums\AdoptionStatus;
use App\Models\Animal;
use App\Notifications\NewAdoptionNotification;
use App\Notifications\NewAnimalAdoptionNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

it('valide les champs obligatoires', function () {

    $animal = Animal::factory()->create();

    Livewire::test('livewire.create-adoption', ['animal' => $animal])
        ->call('save')
        ->assertHasErrors([
            'form.firstName',
            'form.lastName',
            'form.email',
            'form.phone',
            'form.message',
        ]);
});

it('cree une demande d\'adoption', function () {

    $animal = Animal::factory()->create();

    Livewire::test('livewire.create-adoption', ['animal' => $animal])
        ->set('form.firstName', 'Camille')
        ->set('form.lastName', 'Dupont')
        ->set('form.email', 'camille.dupont@example.com')
        ->set('form.phone', '0470123456')
        ->set('form.message', 'Je souhaiterais adopter cet animal.')
        ->call('save')
        ->assertRedirect(route('animal'));

    $this->assertDatabaseHas('adoptions', [
        'animal_id' => $animal->id,
        'firstName' => 'Camille',
        'lastName' => 'Dupont',
        'email' => 'camille.dupont@example.com',
        'phone' => '0470123456',
        'message' => 'Je souhaiterais adopter cet animal.',
        'status' => AdoptionStatus::Pending->value,
    ]);
});

it('envoie une notification a l\'adoptant et au refuge', function () {

    Notification::fake();

    $animal = Animal::factory()->create();

    Livewire::test('livewire.create-adoption', ['animal' => $animal])
        ->set('form.firstName', 'Camille')
        ->set('form.lastName', 'Dupont')
        ->set('form.email', 'camille.dupont@example.com')
        ->set('form.phone', '0470123456')
        ->set('form.message', 'Je souhaiterais adopter cet animal.')
        ->call('save');

    Notification::assertSentOnDemand(
        NewAnimalAdoptionNotification::class,
        fn ($notification, $channels, $notifiable) => $notifiable->routes['mail'] === 'camille.dupont@example.com'
    );

    Notification::assertSentOnDemand(
        NewAdoptionNotification::class,
        fn ($notification, $channels, $notifiable) => $notifiable->routes['mail'] === config('mail.refuge.address')
    );
});

it('ne cree pas de demande si un champ obligatoire est manquant', function () {

    $animal = Animal::factory()->create();

    Livewire::test('livewire.create-adoption', ['animal' => $animal])
        ->set('form.firstName', 'Camille')
        ->call('save');

    $this->assertDatabaseCount('adoptions', 0);
});
