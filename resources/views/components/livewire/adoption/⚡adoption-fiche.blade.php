<?php

use App\Models\Adoption;
use Livewire\Component;


new class extends Component {
    public Adoption $adoption;

    public \App\Livewire\Form\CreateNote $form;


    public $requestAdoption;

    public function mount(): void
    {
        $this->requestAdoption = $this->adoption->status;
    }

    public function save(): void
    {
        $this->form->submit($this->adoption);
    }


    public function updateStatusAdoption(): void
    {

        $this->adoption->update([
            'status' => $this->requestAdoption,
        ]);
    }

};
?>

<div>
    <x-fiche_adoption :adoption="$adoption"></x-fiche_adoption>

    <x-update_status
        :enum="\App\Enums\AdoptionStatus::class"
        model="requestAdoption"
        action="updateStatusAdoption"
    />

    <x-add_note
        function="save"
        model="form.message"
        :notes="$adoption->notes"
    />

</div>
