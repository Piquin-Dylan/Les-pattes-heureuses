@props([
     'search',
     'filter',
     'status',
     'enum'
])

<div class="grid gap-4 lg:grid-cols-4">

    <div class="lg:col-span-2">

        <label class="mb-2 block text-sm font-medium text-gray-700">
            Recherche
        </label>

        <input
            wire:model.live.debounce.300ms="{{$search}}"
            type="text"
            placeholder="Nom d'un animal..."
            class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-[#C67C47]">

    </div>

    <div>

        <label class="mb-2 block text-sm font-medium text-gray-700">
            Espèce
        </label>

        <select
            wire:model.live="{{$filter}}"
            class="w-full rounded-xl border border-gray-300 px-4 py-3">

            <option value="toutes">toutes</option>
            <option value="chat">chat</option>
            <option value="chien">chien</option>

        </select>

    </div>

    @can('manage-animals')
        <div>

            <label class="mb-2 block text-sm font-medium text-gray-700">
                Statut
            </label>

            <select
                wire:model.live="{{$status}}"
                class="w-full rounded-xl border border-gray-300 px-4 py-3">

                <option value="tous">tous</option>

                @foreach($enum::cases() as $status)
                    <option value="{{ $status->value }}">
                        {{ $status->label() }}
                    </option>
                @endforeach

            </select>

        </div>
    @endcan

</div>
