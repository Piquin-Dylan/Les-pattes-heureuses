<?php

use App\Models\Adoption;
use Livewire\Component;

new class extends Component {

    public string $searchAnimal = '';


    public function getAdoptionsProperty()
    {
        return Adoption::query()->when($this->searchAnimal, function ($query) {
            $query->where(
                'adoptions.animal_id',
                'like',
                '%' . $this->searchAnimal . '%'
            );
        })->paginate(6);
    }
};
?>

<div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

    <div class="overflow-x-auto">
        <table class="w-full">

            <thead class="bg-gray-50">
            <tr class="text-left text-sm text-gray-500">
                <th class="px-6 py-4 font-medium">Demandeur</th>
                <th class="px-6 py-4 font-medium">Animal</th>
                <th class="px-6 py-4 font-medium">Date</th>
                <th class="px-6 py-4 font-medium">Statut</th>
                <th class="px-6 py-4 font-medium">Actions</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

            @foreach($this->adoptions as $adoption)
                <tr class="transition hover:bg-gray-50">

                    <td class="px-6 py-4">
                            <span class="font-semibold text-gray-900">
                                {{ $adoption->firstName }}
                            </span>
                    </td>

                    <td class="px-6 py-4 text-gray-700">
                        {{ $adoption->animal->name }}
                    </td>

                    <td class="px-6 py-4 text-gray-500">
                        {{ $adoption->created_at->format('d/m/Y') }}
                    </td>

                   <td class="px-6 py-4">
                            <span class="rounded-full bg-[#C67C47]/10 px-3 py-1 text-sm font-semibold text-[#C67C47]">
                                {{ $adoption->status }}
                            </span>
                    </td>

                    <td class="px-6 py-4">
                        <a
                            href="{{ route('adoption.fiche', $adoption->id)}}"
                            class="font-semibold text-[#C67C47] hover:underline">
                            Voir la demande
                        </a>
                    </td>

                </tr>
            @endforeach

            </tbody>

        </table>
    </div>

</div>
