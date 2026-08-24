<?php

use App\Enums\Members;
use App\Models\Availability;
use App\Models\User;
use App\Notifications\NewMemberNotification;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

it('valide les champs obligatoires', function () {

    $admin = User::factory()->create([
        'status' => Members::Admin->value,
    ]);

    $this->actingAs($admin);

    Livewire::test('livewire.member.create-member')
        ->call('save')
        ->assertHasErrors([
            'form.firstName',
            'form.lastName',
            'form.photo',
            'form.status',
            'form.email',
            'form.phone',
        ]);
});

it('cree un membre', function () {

    Storage::fake('local');

    $admin = User::factory()->create([
        'status' => Members::Admin->value,
    ]);

    $this->actingAs($admin);

    Livewire::test('livewire.member.create-member')
        ->set('form.firstName', 'Camille')
        ->set('form.lastName', 'Dupont')
        ->set('form.email', 'camille.dupont@example.com')
        ->set('form.phone', '0470123456')
        ->set('form.status', Members::Volunteer->value)
        ->set('form.photo', UploadedFile::fake()->image('camille.jpg'))
        ->call('save');

    $this->assertDatabaseHas('users', [
        'firstName' => 'Camille',
        'lastName' => 'Dupont',
        'email' => 'camille.dupont@example.com',
        'phone' => '0470123456',
        'status' => Members::Volunteer->value,
    ]);
});

it('enregistre les disponibilites du membre', function () {

    Storage::fake('local');

    $admin = User::factory()->create([
        'status' => Members::Admin->value,
    ]);

    $this->actingAs($admin);

    Livewire::test('livewire.member.create-member')
        ->set('form.firstName', 'Camille')
        ->set('form.lastName', 'Dupont')
        ->set('form.email', 'camille.dupont@example.com')
        ->set('form.phone', '0470123456')
        ->set('form.status', Members::Volunteer->value)
        ->set('form.photo', UploadedFile::fake()->image('camille.jpg'))
        ->set('form.availabilities.lundi.morning', true)
        ->set('form.availabilities.mercredi.evening', true)
        ->call('save');

    $member = User::where('email', 'camille.dupont@example.com')->firstOrFail();

    $this->assertDatabaseHas('availabilities', [
        'user_id' => $member->id,
        'day' => 'lundi',
        'morning' => true,
    ]);

    $this->assertDatabaseHas('availabilities', [
        'user_id' => $member->id,
        'day' => 'mercredi',
        'evening' => true,
    ]);
});

it('envoie une notification de bienvenue au nouveau membre', function () {

    Notification::fake();
    Storage::fake('local');

    $admin = User::factory()->create([
        'status' => Members::Admin->value,
    ]);

    $this->actingAs($admin);

    Livewire::test('livewire.member.create-member')
        ->set('form.firstName', 'Camille')
        ->set('form.lastName', 'Dupont')
        ->set('form.email', 'camille.dupont@example.com')
        ->set('form.phone', '0470123456')
        ->set('form.status', Members::Volunteer->value)
        ->set('form.photo', UploadedFile::fake()->image('camille.jpg'))
        ->call('save');

    Notification::assertSentOnDemand(
        NewMemberNotification::class,
        fn ($notification, $channels, $notifiable) => array_key_exists('camille.dupont@example.com', $notifiable->routes['mail'])
    );
});
