<?php

namespace App\Livewire\Form;

use App\Jobs\ProcessUploadedImage;
use App\Models\Availability;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class EditMember extends Form
{
    public ?User $member = null;

    #[Validate('required', message: 'Le champs prénom est requis')]
    public string $firstName = "";

    #[Validate('required', message: 'Le champs nom est requis')]
    public string $lastName = "";

    #[Validate('nullable|image|max:5120')]
    public ?TemporaryUploadedFile $photo = null;

    public ?string $currentPhoto = null;

    #[Validate('required', message: 'Le champs status est requis')]
    public string $status = "";

    #[Validate('required|email', message: 'Le champs email est requis')]
    public string $email = "";

    #[Validate('required', message: 'Le champs téléphone est requis')]
    public string $phone = "";

    public array $availabilities = [];

    public function setMember(User $member): void
    {
        $this->member = $member;

        $this->firstName = $member->firstName;
        $this->lastName = $member->lastName;
        $this->currentPhoto = $member->photo;
        $this->status = $member->status;
        $this->email = $member->email;
        $this->phone = $member->phone;
        $this->availabilities = Availability::scheduleFor($member);
    }

    public function update(): User
    {
        $this->validate();

        $data = [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'status' => $this->status,
            'email' => $this->email,
            'phone' => $this->phone,
        ];

        $this->member->update($data);

        Availability::saveSchedule($this->member, $this->availabilities);

        if ($this->photo) {
            $tmpPath = $this->photo->store('uploads/tmp', 'local');

            ProcessUploadedImage::dispatch($this->member, $tmpPath, $this->currentPhoto);
        }

        return $this->member;
    }
}
