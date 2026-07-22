@props([
    'function',
    'model',
])

<div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

    <div class="mb-5">

        <h2 class="text-xl font-bold text-gray-900">
            Ajouter une note
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Ajoutez une note interne. Cette note ne sera visible que par les administrateurs.
        </p>

    </div>

    <form wire:submit.prevent="{{ $function }}" class="space-y-5">

        <textarea
            wire:model.live="{{$model}}"
            rows="6"
            placeholder="Écrivez une note..."
            class="w-full resize-none rounded-2xl border border-gray-200 bg-gray-50 p-5 text-gray-700 placeholder:text-gray-400 transition focus:border-[#C67C47] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#C67C47]/20"></textarea>

        @error('form.note')
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

</div>
