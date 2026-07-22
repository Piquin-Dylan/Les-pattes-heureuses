<?php

namespace App\Livewire\Form;

use App\Models\Message;
use App\Models\Note;
use App\Models\User;
use App\Notifications\NewFormContactNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateNote extends Form
{

    #[Validate('required', message: 'Le champs note est requis')]
    public string $message = "";


    public function submit(): void
    {
        $this->validate();


        Note::create([
            'user_id' => Auth::user()->id,
            'content' => $this->message
        ]);

    }
}
