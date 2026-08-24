<?php

use App\Models\Adoption;
use App\Models\Animal;
use Livewire\Component;


new class extends Component {
    public Adoption $adoption;


    public \App\Livewire\Form\CreateNote $form;


    public $requestAdoption;
    public $requestAnimal;

    public function mount(): void
    {
        $this->requestAdoption = $this->adoption->status;
        $this->requestAnimal = $this->adoption->animal->status;
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

    public function updateStatusAnimal(): void
    {
        $this->adoption->animal->update([
            'status' => $this->requestAnimal,
        ]);
    }

};
?>

<div>

    <x-fiche_adoption :adoption="$adoption"></x-fiche_adoption>

    <div class="mt-6">
        <x-add_note
            function="save"
            model="form.message"
            :notes="$adoption->notes"
        />
    </div>

</div>
