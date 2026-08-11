<?php

namespace App\Livewire\Form;

use App\Jobs\ProcessUploadedImage;
use App\Models\Animal;
use App\Models\Availability;
use App\Models\User;
use App\Notifications\NewAdoptionNotification;
use App\Notifications\NewMemberNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateMember extends Form
{

    #[Validate('required', message: 'Le champs prénom est requis')]
    public string $firstName = "";

    #[Validate('required', message: 'Le champs nom est requis')]
    public string $lastName = "";

    #[Validate('required|image|max:5120')]
    public ?TemporaryUploadedFile $photo = null;

    #[Validate('required', message: 'Le champs status est requis')]
    public string $status = "";

    #[Validate('required|email', message: 'Le champs email est requis')]
    public string $email = "";

    #[Validate('required', message: 'Le champs téléphone est requis')]
    public string $phone = "";

    public array $availabilities = [];


    public function resetAvailabilities(): void
    {
        $this->availabilities = Availability::defaultSchedule();
    }

    public function submit(): User
    {
        $this->validate();

        $tmpPath = $this->photo->store('uploads/tmp', 'local');

        $member = User::create([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'photo' => null,
            'email' => $this->email,
            'password' => User::DEFAULT_PASSWORD,
            'status' => $this->status,
            'phone' => $this->phone,
        ]);

        Availability::saveSchedule($member, $this->availabilities);

        ProcessUploadedImage::dispatch($member, $tmpPath);

        Notification::route('mail', [
            $this->email => $this->firstName,
        ])->notify(new NewMemberNotification($member));

        return $member;
    }
}
