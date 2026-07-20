<?php

use App\Models\Adoption;
use Livewire\Component;


new class extends Component {
    public Adoption $adoption;

    public $requestAdoption;

    public function mount()
    {
        $this->requestAdoption = $this->adoption->status;
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
</div>
