@props([
    'member'
])

<div class="overflow-hidden rounded-3xl bg-white shadow-md">

    <div class="mt-8 flex items-center justify-center">

        <div class="flex aspect-square w-32 items-center justify-center rounded-full bg-[#C67C47] text-4xl font-bold text-white">

            {{ strtoupper(substr($member->firstName, 0, 1)) }}
            {{ strtoupper(substr($member->lastName, 0, 1)) }}

        </div>

    </div>

    <div class="space-y-6 p-6">

        <div>

            <span class="rounded-full bg-[#C67C47] px-4 py-2 text-sm font-semibold text-white">

                {{ $member->status instanceof \BackedEnum
                    ? $member->status->value
                    : ucfirst($member->status) }}

            </span>

            <h1 class="mt-4 text-3xl font-bold text-gray-900">

                {{ $member->firstName }} {{ $member->lastName }}

            </h1>

        </div>

        <div class="rounded-2xl border border-gray-200 p-5">

            <h2 class="mb-5 text-lg font-bold text-gray-900">

                Informations

            </h2>

            <div class="grid grid-cols-1 gap-y-5 sm:grid-cols-2">

                <div>

                    <p class="text-sm text-gray-500">
                        Prénom
                    </p>

                    <p class="font-semibold text-gray-900">

                        {{ $member->firstName }}

                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Nom
                    </p>

                    <p class="font-semibold text-gray-900">

                        {{ $member->lastName }}

                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Email
                    </p>

                    <p class="break-all font-semibold text-gray-900">

                        {{ $member->email }}

                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Téléphone
                    </p>

                    <p class="font-semibold text-gray-900">

                        {{ $member->phone ?? 'Non renseigné' }}

                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Statut
                    </p>

                    <p class="font-semibold text-gray-900">

                        {{ $member->status instanceof \BackedEnum
                            ? $member->status->value
                            : ucfirst($member->status) }}

                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500">
                        Membre depuis
                    </p>

                    <p class="font-semibold text-gray-900">

                        {{ $member->created_at?->format('d/m/Y') }}

                    </p>

                </div>

            </div>

        </div>

        <div class="rounded-2xl border border-gray-200 p-5">

            <h2 class="mb-4 text-lg font-bold text-gray-900">

                Contact

            </h2>

            <div class="space-y-3">

                <p class="text-gray-600">

                    <span class="font-semibold text-gray-900">
                        Email :
                    </span>

                    {{ $member->email }}

                </p>

                <p class="text-gray-600">

                    <span class="font-semibold text-gray-900">
                        Téléphone :
                    </span>

                    {{ $member->phone ?? 'Non renseigné' }}

                </p>

            </div>

        </div>

    </div>

</div>
