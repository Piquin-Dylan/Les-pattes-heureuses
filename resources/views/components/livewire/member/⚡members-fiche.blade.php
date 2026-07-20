<?php

use App\Models\User;
use Livewire\Component;

new class extends Component {
    public User $member;


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
