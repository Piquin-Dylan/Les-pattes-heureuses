<?php

use App\Livewire\Form\CreateMember;
use App\Services\ImageService;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public CreateMember $form;

    public function save(ImageService $imageService)
    {
        $member = $this->form->submit($imageService);

        return redirect()->route('members.fiche', [
            'member' => $member->id
        ]);
    }
}
?>

<div>
    <div class="w-full px-4 py-6">

        <section class="mb-8">
            <x-page-header
                title="Ajouter un membre"
                description="Complétez les informations de la personne"
            />
            <form
                wire:submit.prevent="save"
                class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-xl font-semibold text-gray-800">
                    Informations de la personne
                </h2>

                <div class="grid gap-5 lg:grid-cols-2">

                    <x-form.input
                        label_name="Nom"
                        for_label="lastName"
                        type="text"
                        id="lastName"
                        name="lastName"
                        wire:model.live="form.lastName"/>

                    <x-form.input
                        label_name="Prénom"
                        for_label="firstName"
                        type="text"
                        id="firstName"
                        name="firstName"
                        wire:model.live="form.firstName"/>

                    <x-form.input
                        label_name="Adress mail"
                        for_label="email"
                        type="email"
                        id="email"
                        name="email"
                        wire:model.live="form.email"/>

                    <x-form.input
                        label_name="Mot de passe"
                        for_label="password"
                        type="password"
                        id="password"
                        name="password"
                        wire:model.live="form.password"/>

                    <x-form.select
                        label_name="Role"
                        for_label="role"
                        name="role"
                        id="role"
                        :options="\App\Enums\Members::cases()"
                        wire:model.live="form.status"/>

                    <x-form.input
                        label_name="Numéros de téléphone"
                        for_label="phone"
                        type="tel"
                        id="phone"
                        name="phone"
                        wire:model.live="form.phone"/>
                </div>

                <div class="mt-6">

                    <x-form.input
                        label_name="Photo"
                        for_label="photo"
                        type="file"
                        id="photo"
                        name="photo"
                        wire:model.live="form.photo"/>

                </div>

                <div class="mt-10 flex justify-end">

                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-[#C67C47] px-8 py-4 text-base font-semibold text-white shadow-lg transition hover:bg-[#b56f3c] active:scale-95 lg:w-auto cursor-pointer">

                        Création du membre

                    </button>

                </div>

            </form>
        </section>
    </div>

</div>
