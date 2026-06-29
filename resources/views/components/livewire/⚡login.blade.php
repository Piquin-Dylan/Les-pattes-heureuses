<?php

use App\Livewire\Form\Login;
use Livewire\Component;

new class extends Component {

    public Login $form;

    public function save()
    {
        $this->form->validate();


        if (Auth::attempt(["email" => $this->form->email, "password" => $this->form->password
        ])) {
            return $this->redirect('/dashboard');
        } else {

            session()->flash('status', "Le mot de passe ou l'adresse email est incorrect");
        }
    }
};
?>

<section>
    <H2 class="hidden">Page de connexion vers l'admin</H2>
    <form wire:submit.prevent="save">
        <x-form.input
            label_name="Adresse mail"
            for_label="email"
            placeholder="Ex : john.doe@gmail.com"
            type="email"
            id="email"
            name="email"
            wire:model.live="form.email">

            @error('form.email')
            <span class="error">{{ $message }}</span>
            @enderror
        </x-form.input>

        <x-form.input
            label_name="Mot de passe"
            for_label="password"
            placeholder=""
            type="password"
            id="password"
            name="password"
            wire:model.live="form.password">

            @error('form.password')
            <span class="error">{{ $message }}</span>
            @enderror
        </x-form.input>

        <button type="submit"
                class="w-full text-black ">
            Se connecter
        </button>
    </form>
</section>
