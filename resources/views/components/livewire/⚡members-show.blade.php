<?php

use App\Models\User;
use Livewire\Component;

new class extends Component {


    public string $searchMembers = '';

    public function getMembersProperty(): array|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\_IH_User_C
    {
        return User::query()
            ->when($this->searchMembers, function ($query) {
                $query->where(function ($query) {
                    $query->where(
                        'firstName',
                        'like',
                        '%' . $this->searchMembers . '%'
                    )->orWhere(
                        'lastName',
                        'like',
                        '%' . $this->searchMembers . '%'
                    );
                });
            })
            ->paginate(6);
    }
};
?>

<div>
    <section>
        <div class="space-y-8">

            <x-page-header
                title="Liste du personnel"
                description="Gestion de toute l'équipe"/>

            <div class="rounded-3xl border border-gray-200 bg-white p-5 shadow-sm">

                <div class="lg:col-span-2">

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Recherche
                    </label>

                    <input
                        wire:model.live.debounce.300ms="searchMembers"
                        type="text"
                        placeholder="Nom d'un membre"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#C67C47]">
                </div>

            </div>


            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

                @foreach($this->members as $member)
                    <x-card_members :member="$member"/>
                @endforeach

            </div>

        </div>
    </section>
</div>
