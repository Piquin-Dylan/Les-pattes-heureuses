<?php

use App\Livewire\Form\Login;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component {

    public Login $form;

    public function save()
    {
        $this->form->validate();

        if (Auth::attempt([
            'email' => $this->form->email,
            'password' => $this->form->password,
        ])) {

            session()->regenerate();

            return $this->redirect('/dashboard');
        }

        session()->flash(
            'status',
            "Le mot de passe ou l'adresse email est incorrect."
        );
    }
};
?>

<section class="min-h-screen bg-[#F8F5F2] px-5 py-8">

    <h2 class="hidden">
        Page de connexion
    </h2>

    <div class="mx-auto flex min-h-screen max-w-md items-center">

        <div class="w-full rounded-[32px] bg-white p-7 shadow-xl">

            <div class="mb-10 flex flex-col items-center">

               {{-- <img
                    src="{{ asset('images/Branding.svg') }}"
                    alt="Les pattes heureuses"
                    class="w-24">--}}

                <span class="mt-5 text-center text-3xl font-bold italic text-[#C67C47]">
                    Les pattes heureuses
                </span>

                <p class="mt-2 text-center text-sm text-gray-500">
                    Connectez-vous à votre espace administrateur
                </p>

            </div>

            @if(session('status'))

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-600">
                    {{ session('status') }}
                </div>

            @endif

            <form
                wire:submit.prevent="save"
                class="space-y-2">

                <x-form.input
                    label_name="Adresse mail"
                    for_label="email"
                    placeholder="john.doe@gmail.com"
                    type="email"
                    id="email"
                    name="email"
                    wire:model.live="form.email"
                />

                <x-form.input
                    label_name="Mot de passe"
                    for_label="password"
                    placeholder="Votre mot de passe"
                    type="password"
                    id="password"
                    name="password"
                    wire:model.live="form.password"
                />

                <button
                    type="submit"
                    class="mt-6 w-full rounded-2xl bg-[#C67C47] py-4 font-semibold text-white shadow-lg transition duration-300 hover:bg-[#A96534] active:scale-95 cursor-pointer">
                    Se connecter
                </button>

            </form>

        </div>

    </div>

</section>
