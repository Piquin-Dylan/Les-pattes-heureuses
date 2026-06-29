<?php

use App\Livewire\Form\CreateAnimal;
use Livewire\Component;

new class extends Component {

    public CreateAnimal $form;

    public function save(): void
    {
        $this->form->validate();
        $this->form->submit();
    }
};
?>

<div>
    <form
        wire:submit.prevent="save"
        class="space-y-2">

        <x-form.input
            label_name="Nom de l'animal"
            for_label="name"
            placeholder="Ex : Maya"
            type="text"
            id="name"
            name="name"
            wire:model.live="form.name"
        />

        <x-form.input
            label_name="Description"
            for_label="description"
            placeholder="Ex : il est gentil"
            type="text"
            id="description"
            name="description"
            wire:model.live="form.description"/>

        <x-form.input
            label_name="photo de l'animal"
            for_label="photo"
            placeholder=""
            type="file"
            id="photo"
            name="photo"
            wire:model.live="form.photo"/>

        <x-form.input
            label_name="age de l'animal"
            for_label="age"
            placeholder=""
            type="date"
            id="age"
            name="age"
            wire:model.live="form.age"/>


        <select name="" id="">
            @foreach(\App\Enums\SexeAnimal::cases() as $sexe)
                <option value="">{{$sexe}}</option>
            @endforeach
        </select>
        <button
            type="submit"
            class="mt-6 w-full rounded-2xl bg-[#C67C47] py-4 font-semibold text-white shadow-lg transition duration-300 hover:bg-[#A96534] active:scale-95 cursor-pointer">
            Créer l'animal
        </button>
    </form>
</div>
