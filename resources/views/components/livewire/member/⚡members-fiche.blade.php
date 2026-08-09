<?php

use App\Models\Availability;
use App\Models\User;
use Livewire\Component;

new class extends Component {
    public User $member;

    public array $availabilities = [];

    public bool $editingAvailabilities = false;

    public function mount(): void
    {
        $this->availabilities = Availability::scheduleFor($this->member);
    }

    public function editAvailabilities(): void
    {
        $this->editingAvailabilities = true;
    }

    public function cancelEditAvailabilities(): void
    {
        $this->availabilities = Availability::scheduleFor($this->member);
        $this->editingAvailabilities = false;
    }

    public function saveAvailabilities(): void
    {
        Availability::saveSchedule($this->member, $this->availabilities);

        $this->editingAvailabilities = false;
    }

    public function deleteMember(): \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        if ($this->member->delete()) {
            return redirect(route('members.show'));
        }
    }
};
?>

<div class="mx-auto max-w-6xl space-y-6">

    <a
            href="{{ route('members.show') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-[#C67C47] hover:underline">

        ← Retour aux membres

    </a>
    <x-fiche_member :member="$member"></x-fiche_member>

    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

        <div class="mb-5 flex items-center justify-between">

            <h2 class="text-lg font-bold text-gray-900">
                Disponibilités
            </h2>

            @can('is-admin')
                @if(! $editingAvailabilities)
                    <button
                        wire:click="editAvailabilities"
                        class="text-sm font-semibold text-[#C67C47] hover:underline cursor-pointer">
                        Modifier
                    </button>
                @endif
            @endcan

        </div>

        <x-form.availability-picker
            :schedule="$availabilities"
            name="availabilities"
            :readonly="! $editingAvailabilities"/>

        @if($editingAvailabilities)
            <div class="mt-6 flex justify-end gap-3">

                <button
                    wire:click="cancelEditAvailabilities"
                    class="rounded-2xl border border-gray-300 px-6 py-3 font-semibold text-gray-600 transition hover:bg-gray-50 cursor-pointer">
                    Annuler
                </button>

                <button
                    wire:click="saveAvailabilities"
                    class="rounded-2xl bg-[#C67C47] px-6 py-3 font-semibold text-white transition hover:bg-[#B56F3C] cursor-pointer">
                    Enregistrer
                </button>

            </div>
        @endif

    </div>

    @can('is-admin')

    <div class="flex flex-col gap-3">

        <button
            class="rounded-2xl bg-[#C67C47] py-4 font-semibold text-white transition hover:bg-[#B56F3C]">

            Modifier le membre
        </button>

        <button wire:click="deleteMember"
                class="rounded-2xl border border-red-500 py-4 font-semibold text-red-500 transition hover:bg-red-50">
            Supprimer
        </button>
    </div>
    @endcan
</div>
