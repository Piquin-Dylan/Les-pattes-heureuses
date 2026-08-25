<?php

namespace App\Livewire\Form;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditPasswordForm extends Form
{
    #[Validate('required', message: 'Le mot de passe actuel est requis')]
    public string $currentPassword = '';

    #[Validate('required', message: 'Le nouveau mot de passe est requis')]
    #[Validate('min:8', message: 'Le nouveau mot de passe doit comporter minimum 8 caractères')]
    #[Validate('confirmed', message: 'La confirmation du mot de passe ne correspond pas')]
    public string $password = '';

    public string $password_confirmation = '';

    public function update(): void
    {
        $this->validate();

        validator(
            ['currentPassword' => $this->currentPassword],
            ['currentPassword' => 'current_password'],
            ['currentPassword.current_password' => 'Le mot de passe actuel est incorrect.']
        )->validate();

        Auth::user()->update([
            'password' => $this->password,
        ]);

        $this->reset(['currentPassword', 'password', 'password_confirmation']);
    }
}
