<?php

use App\Models\User;
use Livewire\Component;

new class extends Component {

    public $members;

    public string $searchMembers = '';


    public function mount() {
        $this->members = User::all();
    }

    public function getMembersProperty(): \LaravelIdea\Helper\App\Models\_IH_Animal_C|\Illuminate\Pagination\LengthAwarePaginator|array
    {
        return \App\Models\User::query()
            ->when($this->searchMembers, function ($query) {
                $query->where(
                    'firstName',
                    'like',
                    '%' . $this->searchMembers . '%'
                );
            })->paginate(6);
    }
};
?>

<div>
    <section>
        <x-page-header
            title="Liste du personnels"
            description="Gestion de toute l'équipe"/>


        @foreach($this->members as $member)
        <x-card_members :member="$member"></x-card_members>
        @endforeach
    </section>
</div>
