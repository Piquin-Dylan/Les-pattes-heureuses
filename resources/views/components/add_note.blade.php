@props([
    'function',
    'model',
    'notes',
])

<div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

    <div class="mb-6 flex items-center justify-between">

        <div>

            <h2 class="text-xl font-bold text-gray-900">
                Notes internes
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Ajoutez une note interne. Cette note ne sera visible que par les administrateurs.
            </p>

        </div>

        <span class="rounded-full bg-[#C67C47]/10 px-3 py-1 text-sm font-semibold text-[#C67C47]">
            {{ $notes->count() }} note(s)
        </span>

    </div>

    <form wire:submit.prevent="{{ $function }}" class="space-y-5">

        <textarea
            wire:model.live="{{ $model }}"
            rows="5"
            placeholder="Écrivez une note..."
            class="w-full resize-none rounded-2xl border border-gray-200 bg-gray-50 p-5 text-gray-700 placeholder:text-gray-400 transition focus:border-[#C67C47] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#C67C47]/20"></textarea>

        @error('form.message')
        <p class="text-sm text-red-500">
            {{ $message }}
        </p>
        @enderror

        <div class="flex justify-end">

            <button
                type="submit"
                class="rounded-2xl bg-[#C67C47] px-6 py-3 font-semibold text-white transition hover:bg-[#B56F3C]">

                Ajouter la note

            </button>

        </div>

    </form>

    <hr class="my-8 border-gray-200">

    <div class="space-y-4">

        @forelse($notes as $note)

            <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5">

                <div class="mb-3 flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#C67C47] text-sm font-bold text-white">

                            {{ strtoupper(substr($note->user->firstName, 0, 1)) }}

                        </div>

                        <div>

                            <p class="font-semibold text-gray-900">
                                {{ $note->user->firstName }} {{ $note->user->lastName }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $note->created_at->format('d/m/Y à H:i') }}
                            </p>

                        </div>

                    </div>

                </div>

                <p class="leading-7 whitespace-pre-line text-gray-700">
                    {{ $note->content }}
                </p>

            </div>

        @empty

            <div class="rounded-2xl border border-dashed border-gray-300 py-10 text-center">

                <svg class="mx-auto mb-3 h-10 w-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                </svg>

                <p class="font-medium text-gray-700">
                    Aucune note n'a encore été ajoutée.
                </p>

            </div>

        @endforelse

    </div>

</div>
