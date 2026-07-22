@props([
    'search',
    'filter',
    'status',
    'enum',
    'pendingOnly',
    'pendingCount',
])

<div class="space-y-5">



    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">

        <div class="mb-5">

            <h2 class="text-lg font-semibold text-gray-900">
                Recherche et filtres
            </h2>

            <p class="text-sm text-gray-500">
                Retrouvez rapidement un animal grâce aux filtres ci-dessous.
            </p>

        </div>

        <div class="grid gap-4 lg:grid-cols-4">

            <div class="lg:col-span-2">

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Recherche
                </label>

                <input
                    wire:model.live.debounce.300ms="{{ $search }}"
                    type="text"
                    placeholder="Nom d'un animal..."
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 transition focus:border-[#C67C47] focus:bg-white focus:ring-4 focus:ring-[#C67C47]/20">

            </div>

            <div>

                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Espèce
                </label>

                <select
                    wire:model.live="{{ $filter }}"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 transition focus:border-[#C67C47] focus:bg-white focus:ring-4 focus:ring-[#C67C47]/20">

                    <option value="toutes">Toutes</option>
                    <option value="chat">Chats</option>
                    <option value="chien">Chiens</option>

                </select>

            </div>

            @can('manage-animals')

                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Statut
                    </label>

                    <select
                        wire:model.live="{{ $status }}"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 transition focus:border-[#C67C47] focus:bg-white focus:ring-4 focus:ring-[#C67C47]/20">

                        <option value="tous">
                            Tous les statuts
                        </option>

                        @foreach($enum::cases() as $status)

                            <option value="{{ $status->value }}">
                                {{ $status->label() }}
                            </option>

                        @endforeach

                    </select>

                </div>

            @endcan

        </div>

    </div>
    @can('manage-animals')
        <div class="flex flex-wrap items-center justify-between gap-4 rounded-xl border border-amber-200 bg-amber-50 p-4">

            <label class="flex cursor-pointer items-center gap-3">

                <input
                    type="checkbox"
                    wire:model.live="{{ $pendingOnly }}"
                    class="h-5 w-5 rounded border-gray-300 text-[#C67C47] focus:ring-[#C67C47]">

                <div>
                    <p class="text-sm text-amber-700">
                        Affiche uniquement les fiches en attente de validation.
                    </p>
                </div>

            </label>

            <span class="rounded-full bg-[#C67C47] px-3 py-1 text-sm font-semibold text-white">
                {{ $pendingCount }}
            </span>

        </div>
    @endcan

</div>
