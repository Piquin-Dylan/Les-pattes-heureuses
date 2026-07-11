<?php

namespace App\Livewire\Form;

use App\Models\Animal;
use App\Models\User;
use App\Notifications\NewAdoptionNotification;
use App\Notifications\NewMemberNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Services\ImageService;
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

    #[Validate('required', message: 'Le champs mot de passe est requis')]
    public string $password = "";

    #[Validate('required', message: 'Le champs téléphone est requis')]
    public string $phone = "";


    public function submit(ImageService $imageService): User
    {
        $this->validate();

        $photo = $imageService->storeAnimalImage($this->photo);

        $member = User::create([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'photo' => $photo,
            'email' => $this->email,
            'password' => $this->password,
            'status' => $this->status,
            'phone' => $this->phone,
        ]);
        Notification::route('mail', [
            $this->email => $this->firstName,
        ])->notify(new NewMemberNotification($member));

        return $member;
    }
}
