<?php

use App\Models\Adoption;
use Livewire\Component;


new class extends Component {
    public Adoption $adoption;
};
?>

<div>
    <x-fiche_adoption :adoption="$adoption"></x-fiche_adoption>
</div>
